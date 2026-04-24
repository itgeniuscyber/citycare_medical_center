<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with(['user', 'department'])->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('doctors.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'department_id' => 'required|exists:departments,id',
            'specialization' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'bio' => 'nullable|string',
        ]);

        // Create the user first
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'doctor',
        ]);

        // Create the doctor profile
        $user->doctor()->create([
            'department_id' => $validated['department_id'],
            'specialization' => $validated['specialization'],
            'phone' => $validated['phone'],
            'bio' => $validated['bio'],
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function show(Doctor $doctor)
    {
        $doctor->load(['user', 'department']);
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $departments = Department::all();
        return view('doctors.edit', compact('doctor', 'departments'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($doctor->user_id)],
            'department_id' => 'required|exists:departments,id',
            'specialization' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'bio' => 'nullable|string',
        ]);

        // Update the user
        $doctor->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // If password is provided, update it
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $doctor->user->update(['password' => Hash::make($request->password)]);
        }

        // Update the doctor profile
        $doctor->update([
            'department_id' => $validated['department_id'],
            'specialization' => $validated['specialization'],
            'phone' => $validated['phone'],
            'bio' => $validated['bio'],
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        // Soft delete the user and doctor
        $doctor->user->delete();
        $doctor->delete();
        
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}