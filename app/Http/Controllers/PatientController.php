<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        // Advanced Feature: Search & Filtering
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        }

        // Pagination
        $patients = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:Male,Female,Other',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'emergency_contact' => 'nullable|string|max:255',
            
            // Optional User Account for Patient Portal
            'create_account' => 'nullable|boolean',
            'email' => 'required_if:create_account,1|nullable|email|unique:users,email',
            'password' => 'required_if:create_account,1|nullable|min:8',
        ]);

        $userId = null;

        // Create User account if requested
        if ($request->filled('create_account')) {
            $user = User::create([
                'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'patient',
            ]);
            $userId = $user->id;
        }

        Patient::create([
            'user_id' => $userId,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'emergency_contact' => $validated['emergency_contact'],
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient registered successfully.');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:Male,Female,Other',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'emergency_contact' => 'nullable|string|max:255',
        ]);

        $patient->update($validated);

        // Update linked user account name if it exists
        if ($patient->user_id) {
            $patient->user->update([
                'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            ]);
        }

        return redirect()->route('patients.index')->with('success', 'Patient details updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        // Soft delete the patient record (and user account if it exists)
        if ($patient->user_id) {
            $patient->user->delete();
        }
        $patient->delete();
        
        return redirect()->route('patients.index')->with('success', 'Patient record deleted successfully.');
    }
}
