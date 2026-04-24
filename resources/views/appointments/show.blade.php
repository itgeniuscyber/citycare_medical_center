<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('appointments.index') }}" class="p-2 bg-white/40 hover:bg-white/80 border border-white/50 rounded-xl shadow-sm transition-colors text-slate-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-3xl text-slate-800 tracking-tight">
                {{ __('Appointment Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12">
        <div class="bg-white/50 backdrop-blur-2xl shadow-xl sm:rounded-[2.5rem] border border-white/60 p-8 sm:p-12 relative overflow-hidden">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10 pb-10 border-b border-slate-200/50">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800 tracking-tight">Appointment #APT-{{ str_pad($appointment->id, 5, '0', STR_PAD_LEFT) }}</h3>
                    <p class="text-sm font-medium text-slate-500 mt-1">Booked on {{ $appointment->created_at->format('M d, Y g:i A') }}</p>
                </div>
                
                @php
                    $statusClasses = [
                        'pending' => 'bg-orange-100 text-orange-700 border-orange-200',
                        'confirmed' => 'bg-blue-100 text-blue-700 border-blue-200',
                        'completed' => 'bg-green-100 text-green-700 border-green-200',
                        'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                    ];
                    $class = $statusClasses[$appointment->status] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                @endphp
                <span class="px-4 py-2 inline-flex text-sm leading-5 font-bold rounded-full border {{ $class }}">
                    Status: {{ ucfirst($appointment->status) }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                
                <!-- Patient Details -->
                <div>
                    <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Patient Information</h4>
                    <div class="bg-white/60 rounded-2xl p-6 border border-white/80 shadow-sm flex items-start gap-4">
                        <div class="flex-shrink-0 h-14 w-14 rounded-2xl bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center text-indigo-700 font-bold text-xl shadow-sm border border-white/50">
                            {{ substr($appointment->patient->first_name, 0, 1) }}{{ substr($appointment->patient->last_name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-lg text-slate-800">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</p>
                            <p class="text-sm font-medium text-slate-500 mb-2">{{ $appointment->patient->phone }}</p>
                            <a href="{{ route('patients.show', $appointment->patient) }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                                View Full Profile <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Doctor Details -->
                <div>
                    <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Assigned Doctor</h4>
                    <div class="bg-white/60 rounded-2xl p-6 border border-white/80 shadow-sm flex items-start gap-4">
                        <div class="flex-shrink-0 h-14 w-14 rounded-2xl overflow-hidden shadow-sm border border-white/50">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($appointment->doctor->user->name) }}&background=14b8a6&color=fff" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="font-bold text-lg text-slate-800">{{ $appointment->doctor->user->name }}</p>
                            <p class="text-sm font-medium text-slate-500 mb-2">{{ $appointment->doctor->department->name ?? 'General' }}</p>
                            @if(in_array(Auth::user()->role, ['admin', 'receptionist']))
                                <a href="{{ route('doctors.show', $appointment->doctor) }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                                    View Doctor Profile <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Schedule Details -->
                <div class="md:col-span-2">
                    <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Schedule Information</h4>
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-white/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6">
                        <div class="flex items-center gap-4 w-full sm:w-auto">
                            <div class="w-12 h-12 rounded-xl bg-white text-blue-600 flex items-center justify-center shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Date</p>
                                <p class="font-bold text-lg text-slate-800">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F d, Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="hidden sm:block w-px h-12 bg-blue-200/50"></div>

                        <div class="flex items-center gap-4 w-full sm:w-auto">
                            <div class="w-12 h-12 rounded-xl bg-white text-indigo-600 flex items-center justify-center shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Time</p>
                                <p class="font-bold text-lg text-slate-800">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="md:col-span-2">
                    <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Patient Notes / Reason for Visit</h4>
                    <div class="bg-white/60 rounded-2xl p-6 border border-white/80 shadow-sm min-h-[100px]">
                        @if($appointment->notes)
                            <p class="text-slate-700 font-medium leading-relaxed">{{ $appointment->notes }}</p>
                        @else
                            <p class="text-slate-400 font-medium italic">No additional notes provided by the patient.</p>
                        @endif
                    </div>
                </div>

            </div>

            @if(in_array(Auth::user()->role, ['admin', 'receptionist', 'doctor']))
            <div class="flex items-center justify-end gap-4 mt-10 pt-8 border-t border-slate-200/50">
                <a href="{{ route('appointments.edit', $appointment) }}" class="px-8 py-3 bg-brand-600 text-white rounded-full text-sm font-bold shadow-lg shadow-brand-500/30 hover:bg-brand-500 hover:shadow-brand-500/50 transition-all flex items-center gap-2">
                    Edit Appointment
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </a>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>