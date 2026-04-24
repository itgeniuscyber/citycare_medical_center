<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class PaymentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Payment::with(['patient'])->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Patient Name',
            'Amount (UGX)',
            'Payment Method',
            'Status',
            'Transaction Date'
        ];
    }

    public function map($payment): array
    {
        return [
            $payment->id,
            $payment->patient->first_name . ' ' . $payment->patient->last_name,
            $payment->amount,
            ucfirst(str_replace('_', ' ', $payment->payment_method)),
            ucfirst($payment->status),
            Carbon::parse($payment->created_at)->format('Y-m-d H:i:s')
        ];
    }
}