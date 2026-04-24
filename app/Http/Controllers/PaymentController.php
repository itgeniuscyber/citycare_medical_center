<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    public function export($format)
    {
        if (!in_array($format, ['excel', 'csv', 'pdf'])) {
            abort(404);
        }

        $export = new PaymentsExport();

        if ($format === 'pdf') {
            $data = [
                'title' => 'Payments Report',
                'headers' => $export->headings(),
                'rows' => collect($export->collection())->map(fn($item) => $export->map($item))->toArray()
            ];
            
            $pdf = Pdf::loadView('exports.pdf', $data);
            return $pdf->download('payments_report_' . date('Y-m-d') . '.pdf');
        }

        $extension = $format === 'excel' ? \Maatwebsite\Excel\Excel::XLSX : \Maatwebsite\Excel\Excel::CSV;
        $filename = 'payments_report_' . date('Y-m-d') . '.' . ($format === 'excel' ? 'xlsx' : 'csv');

        return Excel::download($export, $filename, $extension);
    }
    public function index(Request $request)
    {
        $query = Payment::with(['patient', 'appointment.doctor.user']);

        // Role-based filtering
        $user = Auth::user();
        if ($user->role === 'patient') {
            $query->where('patient_id', $user->patient->id ?? 0);
        }

        // Search logic
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('patient', function($pq) use ($search) {
                $pq->where('first_name', 'like', "%{$search}%")
                   ->orWhere('last_name', 'like', "%{$search}%");
            })->orWhere('id', 'like', "%{$search}%");
        }

        $payments = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $patients = Patient::orderBy('first_name')->get();
        // Get appointments that haven't been fully paid yet
        $appointments = Appointment::with(['patient', 'doctor.user'])
                                   ->whereIn('status', ['confirmed', 'completed'])
                                   ->orderBy('appointment_date', 'desc')
                                   ->get();
        
        return view('payments.create', compact('patients', 'appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|max:50',
            'status' => 'required|in:pending,completed,failed',
        ]);

        Payment::create([
            'patient_id' => $request->patient_id,
            'appointment_id' => $request->appointment_id,
            'amount' => $request->amount,
            'payment_date' => Carbon::now(),
            'payment_method' => $request->payment_method,
            'status' => $request->status,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully.');
    }

    public function show(Payment $payment)
    {
        $payment->load(['patient', 'appointment.doctor.user']);
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $patients = Patient::orderBy('first_name')->get();
        $appointments = Appointment::with(['patient', 'doctor.user'])->orderBy('appointment_date', 'desc')->get();
        
        return view('payments.edit', compact('payment', 'patients', 'appointments'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|max:50',
            'status' => 'required|in:pending,completed,failed',
        ]);

        $payment->update([
            'patient_id' => $request->patient_id,
            'appointment_id' => $request->appointment_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment record deleted successfully.');
    }
}