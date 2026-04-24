<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class AppointmentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Appointment::with(['patient', 'doctor.user'])->orderBy('appointment_date', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Patient Name',
            'Doctor Name',
            'Department',
            'Date',
            'Time',
            'Status',
            'Notes'
        ];
    }

    public function map($appointment): array
    {
        return [
            $appointment->id,
            $appointment->patient->first_name . ' ' . $appointment->patient->last_name,
            'Dr. ' . $appointment->doctor->user->name,
            $appointment->doctor->department->name ?? 'General',
            Carbon::parse($appointment->appointment_date)->format('Y-m-d'),
            Carbon::parse($appointment->appointment_time)->format('h:i A'),
            ucfirst($appointment->status),
            $appointment->notes
        ];
    }
}