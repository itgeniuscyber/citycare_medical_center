<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('payments.index') }}" class="p-2 bg-white/40 hover:bg-white/80 border border-white/50 rounded-xl shadow-sm transition-colors text-slate-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-3xl text-slate-800 tracking-tight">
                {{ __('Record Payment') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto pb-12">
        <div class="bg-white/50 backdrop-blur-2xl shadow-xl sm:rounded-[2.5rem] border border-white/60 p-8 sm:p-12 relative overflow-hidden">
            
            <form method="POST" action="{{ route('payments.store') }}">
                @csrf

                <div class="space-y-6 mb-8">
                    <!-- Patient -->
                    <div>
                        <x-input-label for="patient_id" :value="__('Select Patient')" class="text-slate-700 font-bold mb-2" />
                        <select id="patient_id" name="patient_id" class="block w-full px-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm" required>
                            <option value="" disabled selected>-- Select a Patient --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->first_name }} {{ $patient->last_name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('patient_id')" class="mt-2" />
                    </div>

                    <!-- Appointment -->
                    <div>
                        <x-input-label for="appointment_id" :value="__('Linked Appointment (Optional)')" class="text-slate-700 font-bold mb-2" />
                        <select id="appointment_id" name="appointment_id" class="block w-full px-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm">
                            <option value="">-- No specific appointment --</option>
                            @foreach($appointments as $appt)
                                <option value="{{ $appt->id }}" {{ old('appointment_id') == $appt->id ? 'selected' : '' }}>
                                    #APT-{{ str_pad($appt->id, 5, '0', STR_PAD_LEFT) }} - {{ $appt->patient->first_name }} ({{ \Carbon\Carbon::parse($appt->appointment_date)->format('M d') }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('appointment_id')" class="mt-2" />
                    </div>

                    <!-- Amount -->
                    <div>
                        <x-input-label for="amount" :value="__('Amount (UGX)')" class="text-slate-700 font-bold mb-2" />
                        <input type="number" id="amount" name="amount" value="{{ old('amount') }}" step="0.01" class="block w-full px-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm" required placeholder="e.g., 50000">
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <x-input-label for="payment_method" :value="__('Payment Method')" class="text-slate-700 font-bold mb-2" />
                        <select id="payment_method" name="payment_method" class="block w-full px-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm" required>
                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="mobile_money" {{ old('payment_method') == 'mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                            <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Credit/Debit Card</option>
                            <option value="insurance" {{ old('payment_method') == 'insurance' ? 'selected' : '' }}>Insurance</option>
                        </select>
                        <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-input-label for="status" :value="__('Status')" class="text-slate-700 font-bold mb-2" />
                        <select id="status" name="status" class="block w-full px-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm" required>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-8 border-t border-slate-200/50">
                    <a href="{{ route('payments.index') }}" class="px-6 py-3 bg-white/60 border border-white/80 text-slate-600 rounded-full text-sm font-bold hover:bg-white transition-colors shadow-sm">
                        Cancel
                    </a>
                    <button type="submit" class="px-8 py-3 bg-brand-600 text-white rounded-full text-sm font-bold shadow-lg shadow-brand-500/30 hover:bg-brand-500 hover:shadow-brand-500/50 transition-all">
                        Save Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>