<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        switch ($user->role) {
            case 'admin':
                return $this->adminDashboard();
            case 'receptionist':
                return $this->receptionistDashboard();
            case 'doctor':
                return $this->doctorDashboard();
            case 'cashier':
                return $this->cashierDashboard();
            case 'patient':
                return $this->patientDashboard();
            default:
                return view('dashboard');
        }
    }

    private function adminDashboard()
    {
        $stats = [
            'total_patients' => Patient::count(),
            'total_doctors' => Doctor::count(),
            'today_appointments' => Appointment::whereDate('appointment_date', Carbon::today())->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
        ];
        
        $scheduled_today = Appointment::with(['patient', 'doctor.user'])
            ->whereDate('appointment_date', Carbon::today())
            ->orderBy('appointment_time')
            ->take(5)->get();

        // Get appointments count for the last 7 days for the chart
        $last7Days = collect();
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $count = Appointment::whereDate('appointment_date', $date)->count();
            $last7Days->push($date->format('D'));
            $chartData[] = $count;
        }

        $chartLabels = $last7Days->toArray();

        return view('dashboard.admin', compact('stats', 'scheduled_today', 'chartLabels', 'chartData'));
    }

    private function receptionistDashboard()
    {
        $stats = [
            'today_appointments' => Appointment::whereDate('appointment_date', Carbon::today())->count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'total_patients' => Patient::count(),
        ];
        
        // Patients that are arriving today and need attention
        $todays_queue = Appointment::with(['patient', 'doctor.user'])
            ->whereDate('appointment_date', Carbon::today())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('appointment_time')
            ->get();
            
        // Upcoming appointments (from tomorrow onwards)
        $upcoming_appointments = Appointment::with(['patient', 'doctor.user'])
            ->whereDate('appointment_date', '>', Carbon::today())
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->take(10)->get();

        return view('dashboard.receptionist', compact('stats', 'todays_queue', 'upcoming_appointments'));
    }

    private function doctorDashboard()
    {
        $doctor = Auth::user()->doctor;
        $doctorId = $doctor ? $doctor->id : 0;

        $stats = [
            'today_appointments' => Appointment::where('doctor_id', $doctorId)
                                               ->whereDate('appointment_date', Carbon::today())->count(),
            'total_patients' => Appointment::where('doctor_id', $doctorId)
                                           ->distinct('patient_id')->count('patient_id'),
            'pending_appointments' => Appointment::where('doctor_id', $doctorId)
                                                 ->where('status', 'pending')->count(),
        ];
        
        $todays_schedule = Appointment::with('patient')
            ->where('doctor_id', $doctorId)
            ->whereDate('appointment_date', Carbon::today())
            ->orderBy('appointment_time')
            ->get();

        return view('dashboard.doctor', compact('stats', 'todays_schedule'));
    }

    private function cashierDashboard()
    {
        $stats = [
            'today_revenue' => Payment::where('status', 'completed')
                                      ->whereDate('payment_date', Carbon::today())->sum('amount'),
            'pending_payments' => Payment::where('status', 'pending')->count(),
            'total_transactions' => Payment::count(),
        ];
        
        $recent_payments = Payment::with(['patient', 'appointment'])
            ->orderBy('created_at', 'desc')
            ->take(10)->get();

        // Get revenue grouped by payment method for the pie chart
        $revenueByMethod = Payment::where('status', 'completed')
            ->select('payment_method', DB::raw('SUM(amount) as total'))
            ->groupBy('payment_method')
            ->pluck('total', 'payment_method')
            ->toArray();

        return view('dashboard.cashier', compact('stats', 'recent_payments', 'revenueByMethod'));
    }

    private function patientDashboard()
    {
        $patient = Auth::user()->patient;
        $patientId = $patient ? $patient->id : 0;

        $stats = [
            'total_visits' => Appointment::where('patient_id', $patientId)
                                         ->where('status', 'completed')->count(),
            'upcoming_appointments' => Appointment::where('patient_id', $patientId)
                                                  ->whereDate('appointment_date', '>=', Carbon::today())
                                                  ->whereIn('status', ['pending', 'confirmed'])->count(),
            'total_spent' => Payment::where('patient_id', $patientId)
                                    ->where('status', 'completed')->sum('amount'),
        ];
        
        $my_appointments = Appointment::with('doctor.user')
            ->where('patient_id', $patientId)
            ->orderBy('appointment_date', 'desc')
            ->take(5)->get();

        return view('dashboard.patient', compact('stats', 'my_appointments'));
    }
}