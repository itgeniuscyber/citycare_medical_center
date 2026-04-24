<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-slate-800 tracking-tight">
            Hello, Dr. {{ explode(' ', Auth::user()->name)[0] }} 🩺
        </h2>
        <p class="text-slate-500 font-medium mt-1">Here is your schedule and patient overview.</p>
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
            <h4 class="text-slate-500 font-semibold mb-1">My Appointments</h4>
            <div class="flex items-end justify-between">
                <p class="text-3xl font-extrabold text-slate-800">{{ $stats['today_appointments'] }}</p>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-2xl shadow-sm hover:shadow-md hover:bg-white/80 transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="bg-white/60 text-slate-500 text-xs font-bold px-3 py-1 rounded-full border border-white/50">Total</span>
            </div>
            <h4 class="text-slate-500 font-semibold mb-1">Unique Patients</h4>
            <div class="flex items-end justify-between">
                <p class="text-3xl font-extrabold text-slate-800">{{ $stats['total_patients'] }}</p>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-gradient-to-br from-brand-400 to-brand-600 p-5 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 relative overflow-hidden group text-white">
            <div class="absolute -right-6 -top-5 w-24 h-24 bg-white/20 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>
            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="w-10 h-10 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <h4 class="text-brand-100 font-semibold mb-1 relative z-10">Pending Consultations</h4>
            <p class="text-3xl font-extrabold relative z-10 tracking-tight">{{ $stats['pending_appointments'] }}</p>
        </div>

    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        
        <!-- Left Column -->
        <div class="lg:col-span-2 flex flex-col gap-5">
            <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-slate-800 tracking-tight">Today's Schedule</h3>
                    <a href="{{ route('appointments.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">View All</a>
                </div>
                
                <div class="space-y-4">
                    @forelse($todays_schedule as $appt)
                        <div class="bg-white/80 border border-white/80 p-4 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:shadow-sm transition-shadow">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-lg shadow-sm border border-white/50">
                                    {{ \Carbon\Carbon::parse($appt->appointment_time)->format('h:i') }}
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-800">{{ $appt->patient->first_name }} {{ $appt->patient->last_name }}</h5>
                                    <p class="text-xs text-slate-500 font-medium">Phone: {{ $appt->patient->phone }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
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
                                <a href="{{ route('appointments.show', $appt) }}" class="text-sm font-bold text-brand-600 hover:underline">Details</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 text-sm py-4">You have no appointments scheduled for today.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="flex flex-col gap-5">
            <!-- Mini Calendar -->
            <div class="bg-slate-800 text-white p-5 rounded-3xl shadow-lg relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2"></div>
                <div class="flex justify-between items-center mb-6 relative z-10">
                    <h3 class="text-lg font-bold">{{ \Carbon\Carbon::now()->format('F Y') }}</h3>
                </div>
                
                <div class="grid grid-cols-7 gap-1 text-center text-xs font-medium text-slate-400 mb-2 relative z-10">
                    <div>Su</div><div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div>
                </div>
                <div class="grid grid-cols-7 gap-1 text-center text-sm font-semibold relative z-10">
                    @php
                        $start = \Carbon\Carbon::now()->startOfMonth();
                        $end = \Carbon\Carbon::now()->endOfMonth();
                        $today = \Carbon\Carbon::now()->format('j');
                    @endphp
                    @for ($i = 0; $i < $start->dayOfWeek; $i++)
                        <div class="py-1"></div>
                    @endfor
                    @for ($day = 1; $day <= $end->daysInMonth; $day++)
                        @if ($day == $today)
                            <div class="py-1 bg-brand-500 text-white rounded-lg shadow-sm">{{ $day }}</div>
                        @else
                            <div class="py-1 text-white">{{ $day }}</div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
</x-app-layout>