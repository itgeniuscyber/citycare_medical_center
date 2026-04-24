<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('appointments.index') }}" class="p-2 bg-white/40 hover:bg-white/80 border border-white/50 rounded-xl shadow-sm transition-colors text-slate-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-3xl text-slate-800 tracking-tight">
                {{ __('Edit Appointment') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12">
        <div class="bg-white/50 backdrop-blur-2xl shadow-xl sm:rounded-[2.5rem] border border-white/60 p-8 sm:p-12 relative overflow-hidden">
            
            <form method="POST" action="{{ route('appointments.update', $appointment) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Patient & Doctor Details -->
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="patient_id" :value="__('Patient')" class="text-slate-700 font-bold mb-2" />
                            <select id="patient_id" name="patient_id" class="block w-full px-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm" required>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->first_name }} {{ $patient->last_name }} ({{ $patient->phone }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('patient_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="doctor_id" :value="__('Doctor')" class="text-slate-700 font-bold mb-2" />
                            <select id="doctor_id" name="doctor_id" class="block w-full px-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm" required>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                        Dr. {{ explode(' ', $doctor->user->name)[0] ?? $doctor->user->name }} ({{ $doctor->department->name ?? 'General' }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Date & Time & Status -->
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="appointment_date" :value="__('Date')" class="text-slate-700 font-bold mb-2" />
                            <input type="date" id="appointment_date" name="appointment_date" value="{{ old('appointment_date', $appointment->appointment_date->format('Y-m-d')) }}" class="block w-full px-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm" required>
                            <x-input-error :messages="$errors->get('appointment_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="appointment_time" :value="__('Time (HH:MM)')" class="text-slate-700 font-bold mb-2" />
                            <input type="time" id="appointment_time" name="appointment_time" value="{{ old('appointment_time', \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i')) }}" class="block w-full px-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm" required>
                            <x-input-error :messages="$errors->get('appointment_time')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" class="text-slate-700 font-bold mb-2" />
                            <select id="status" name="status" class="block w-full px-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm" required>
                                <option value="pending" {{ old('status', $appointment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status', $appointment->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ old('status', $appointment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $appointment->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <x-input-label for="notes" :value="__('Notes')" class="text-slate-700 font-bold mb-2" />
                    <textarea id="notes" name="notes" rows="4" class="block w-full p-4 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm resize-none">{{ old('notes', $appointment->notes) }}</textarea>
                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-4 mt-8 pt-8 border-t border-slate-200/50">
                    <a href="{{ route('appointments.index') }}" class="px-6 py-3 bg-white/60 border border-white/80 text-slate-600 rounded-full text-sm font-bold hover:bg-white transition-colors shadow-sm">
                        Cancel
                    </a>
                    <button type="submit" class="px-8 py-3 bg-brand-600 text-white rounded-full text-sm font-bold shadow-lg shadow-brand-500/30 hover:bg-brand-500 hover:shadow-brand-500/50 transition-all flex items-center gap-2">
                        Update Appointment
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>