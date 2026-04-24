<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AppointmentsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class AppointmentController extends Controller
{
    public function export($format)
    {
        if (!in_array($format, ['excel', 'csv', 'pdf'])) {
            abort(404);
        }

        $export = new AppointmentsExport();

        if ($format === 'pdf') {
            $data = [
                'title' => 'Appointments Report',
                'headers' => $export->headings(),
                'rows' => collect($export->collection())->map(fn($item) => $export->map($item))->toArray()
            ];
            
            $pdf = Pdf::loadView('exports.pdf', $data)->setPaper('a4', 'landscape');
            return $pdf->download('appointments_report_' . date('Y-m-d') . '.pdf');
        }

        $extension = $format === 'excel' ? \Maatwebsite\Excel\Excel::XLSX : \Maatwebsite\Excel\Excel::CSV;
        $filename = 'appointments_report_' . date('Y-m-d') . '.' . ($format === 'excel' ? 'xlsx' : 'csv');

        return Excel::download($export, $filename, $extension);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Appointment::with(['patient', 'doctor.user', 'doctor.department']);

        // Role-based filtering
        $user = Auth::user();
        if ($user->role === 'doctor') {
            $query->where('doctor_id', $user->doctor->id ?? 0);
        } elseif ($user->role === 'patient') {
            $query->where('patient_id', $user->patient->id ?? 0);
        }

        // Search logic
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('patient', function($pq) use ($search) {
                    $pq->where('first_name', 'like', "%{$search}%")
                       ->orWhere('last_name', 'like', "%{$search}%");
                })->orWhereHas('doctor.user', function($dq) use ($search) {
                    $dq->where('name', 'like', "%{$search}%");
                });
            });
        }

        $appointments = $query->orderBy('appointment_date', 'desc')
                              ->orderBy('appointment_time', 'desc')
                              ->paginate(10);

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctors = Doctor::with(['user', 'department'])->get();
        $patients = Patient::orderBy('first_name')->get();
        
        return view('appointments.create', compact('doctors', 'patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'notes' => 'nullable|string|max:500',
        ]);

        // Prevent double booking logic
        $exists = Appointment::where('doctor_id', $request->doctor_id)
                             ->where('appointment_date', $request->appointment_date)
                             ->where('appointment_time', $request->appointment_time)
                             ->whereIn('status', ['pending', 'confirmed'])
                             ->exists();
        
        if ($exists) {
            return back()->withInput()->withErrors(['appointment_time' => 'This time slot is already booked for the selected doctor.']);
        }

        Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['patient', 'doctor.user', 'doctor.department']);
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $doctors = Doctor::with(['user', 'department'])->get();
        $patients = Patient::orderBy('first_name')->get();
        
        return view('appointments.edit', compact('appointment', 'doctors', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string|max:500',
        ]);

        // Prevent double booking logic on update
        if ($request->doctor_id != $appointment->doctor_id || 
            $request->appointment_date != $appointment->appointment_date->format('Y-m-d') || 
            $request->appointment_time != Carbon::parse($appointment->appointment_time)->format('H:i')) {
            
            $exists = Appointment::where('doctor_id', $request->doctor_id)
                             ->where('appointment_date', $request->appointment_date)
                             ->where('appointment_time', $request->appointment_time)
                             ->where('id', '!=', $appointment->id)
                             ->whereIn('status', ['pending', 'confirmed'])
                             ->exists();
            
            if ($exists) {
                return back()->withInput()->withErrors(['appointment_time' => 'This time slot is already booked for the selected doctor.']);
            }
        }

        $appointment->update([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment cancelled successfully.');
    }

    /**
     * API Endpoint: Get available time slots for a doctor on a specific date.
     */
    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        $doctorId = $request->doctor_id;
        $date = $request->date;

        // Base schedule for the day (e.g., 9:00 AM to 5:00 PM, every 30 mins)
        $allSlots = [
            '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
            '12:00', '12:30', '13:00', '13:30', '14:00', '14:30',
            '15:00', '15:30', '16:00', '16:30'
        ];

        // Get booked slots
        $bookedAppointments = Appointment::where('doctor_id', $doctorId)
                                         ->where('appointment_date', $date)
                                         ->whereIn('status', ['pending', 'confirmed'])
                                         ->get();

        $bookedSlots = $bookedAppointments->map(function ($appt) {
            return Carbon::parse($appt->appointment_time)->format('H:i');
        })->toArray();

        // Filter available slots
        $availableSlots = array_values(array_filter($allSlots, function ($slot) use ($bookedSlots, $date) {
            // Also filter out past slots if the date is today
            if (Carbon::parse($date)->isToday()) {
                if (Carbon::now()->format('H:i') > $slot) {
                    return false;
                }
            }
            return !in_array($slot, $bookedSlots);
        }));

        return response()->json([
            'available_slots' => $availableSlots
        ]);
    }
}