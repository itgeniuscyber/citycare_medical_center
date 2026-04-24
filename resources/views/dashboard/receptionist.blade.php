<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-slate-800 tracking-tight">
            Good Morning, {{ explode(' ', Auth::user()->name)[0] }} 👋
        </h2>
        <p class="text-slate-500 font-medium mt-1">Here is your front desk overview for today.</p>
    </x-slot>

    <!-- Dashboard Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        
        <!-- Stat Card 1 -->
        <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-2xl shadow-sm hover:shadow-md hover:bg-white/80 transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <span class="bg-white/60 text-slate-500 text-xs font-bold px-3 py-1 rounded-full border border-white/50">Today</span>
            </div>
            <h4 class="text-slate-500 font-semibold mb-1">Today's Appointments</h4>
            <div class="flex items-end justify-between">
                <p class="text-3xl font-extrabold text-slate-800">{{ $stats['today_appointments'] }}</p>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-2xl shadow-sm hover:shadow-md hover:bg-white/80 transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="bg-white/60 text-slate-500 text-xs font-bold px-3 py-1 rounded-full border border-white/50">Action Needed</span>
            </div>
            <h4 class="text-slate-500 font-semibold mb-1">Pending Appointments</h4>
            <div class="flex items-end justify-between">
                <p class="text-3xl font-extrabold text-slate-800">{{ $stats['pending_appointments'] }}</p>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-2xl shadow-sm hover:shadow-md hover:bg-white/80 transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="bg-white/60 text-slate-500 text-xs font-bold px-3 py-1 rounded-full border border-white/50">Total</span>
            </div>
            <h4 class="text-slate-500 font-semibold mb-1">Registered Patients</h4>
            <div class="flex items-end justify-between">
                <p class="text-3xl font-extrabold text-slate-800">{{ $stats['total_patients'] }}</p>
            </div>
        </div>

    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        
        <!-- Left Column -->
        <div class="lg:col-span-2 flex flex-col gap-5">
            <!-- Today's Queue (New Feature) -->
            <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800 tracking-tight">Today's Queue</h3>
                        <p class="text-sm text-slate-500 font-medium">Patients arriving today</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    @forelse($todays_queue as $appt)
                        <div class="bg-white/80 border border-white/80 p-4 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:shadow-sm transition-shadow">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl {{ $appt->status == 'confirmed' ? 'bg-blue-50 text-blue-600' : 'bg-orange-50 text-orange-600' }} flex items-center justify-center font-bold text-lg shadow-sm border border-white/50">
                                    {{ \Carbon\Carbon::parse($appt->appointment_time)->format('h:i') }}
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-800">{{ $appt->patient->first_name }} {{ $appt->patient->last_name }}</h5>
                                    <p class="text-xs text-slate-500 font-medium">Dr. {{ $appt->doctor->user->name }} &bull; {{ $appt->patient->phone }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                @if($appt->status == 'pending')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full border bg-orange-100 text-orange-700 border-orange-200">
                                        Pending Confirmation
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full border bg-blue-100 text-blue-700 border-blue-200">
                                        Confirmed
                                    </span>
                                @endif
                                <a href="{{ route('appointments.edit', $appt) }}" class="px-4 py-2 bg-white text-slate-700 text-xs font-bold rounded-lg border border-slate-200 hover:bg-slate-50 transition">Manage</a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="text-slate-500 font-medium">The queue is clear for today!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-slate-800 tracking-tight">Upcoming Appointments</h3>
                    <a href="{{ route('appointments.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">Manage Schedule</a>
                </div>
                
                <div class="space-y-4">
                    @forelse($upcoming_appointments as $appt)
                        <div class="bg-white/80 border border-white/80 p-4 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:shadow-sm transition-shadow">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg shadow-sm border border-white/50">
                                    {{ substr($appt->patient->first_name, 0, 1) }}
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-800">{{ $appt->patient->first_name }} {{ $appt->patient->last_name }}</h5>
                                    <p class="text-xs text-slate-500 font-medium">With Dr. {{ $appt->doctor->user->name }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-5">
                                <div class="text-right">
                                    <p class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($appt->appointment_time)->format('h:i A') }}</p>
                                    <p class="text-xs text-brand-600 font-bold">{{ \Carbon\Carbon::parse($appt->appointment_date)->format('M d, Y') }}</p>
                                </div>
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-orange-100 text-orange-700 border-orange-200',
                                        'confirmed' => 'bg-blue-100 text-blue-700 border-blue-200',
                                        'completed' => 'bg-green-100 text-green-700 border-green-200',
                                        'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                                    ];
                                    $class = $statusClasses[$appt->status] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full border {{ $class }}">
                                    {{ ucfirst($appt->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 text-sm py-4">No upcoming appointments found.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="flex flex-col gap-5">
            <div class="bg-gradient-to-br from-brand-400 to-brand-600 p-5 rounded-3xl shadow-md relative overflow-hidden group text-white">
                <div class="absolute -right-6 -top-5 w-32 h-32 bg-white/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                <h3 class="text-xl font-bold mb-2 relative z-10">Quick Actions</h3>
                <p class="text-brand-100 text-sm mb-6 relative z-10">Common tasks for front desk.</p>
                
                <div class="flex flex-col gap-3 relative z-10">
                    <a href="{{ route('patients.create') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-md p-4 rounded-2xl flex items-center gap-3 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-white text-brand-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <span class="font-semibold">Register Patient</span>
                    </a>
                    <a href="{{ route('appointments.create') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-md p-4 rounded-2xl flex items-center gap-3 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-white text-brand-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="font-semibold">Book Appointment</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>