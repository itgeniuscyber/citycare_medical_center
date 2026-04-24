<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-slate-800 tracking-tight">
            Hello, {{ explode(' ', Auth::user()->name)[0] }} 👋
        </h2>
        <p class="text-slate-500 font-medium mt-1">Welcome to your personal patient portal.</p>
    </x-slot>

    <!-- Dashboard Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        
        <!-- Stat Card 1 -->
        <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-2xl shadow-sm hover:shadow-md hover:bg-white/80 transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <span class="bg-white/60 text-slate-500 text-xs font-bold px-3 py-1 rounded-full border border-white/50">Upcoming</span>
            </div>
            <h4 class="text-slate-500 font-semibold mb-1">My Appointments</h4>
            <div class="flex items-end justify-between">
                <p class="text-3xl font-extrabold text-slate-800">{{ $stats['upcoming_appointments'] }}</p>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-2xl shadow-sm hover:shadow-md hover:bg-white/80 transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="bg-white/60 text-slate-500 text-xs font-bold px-3 py-1 rounded-full border border-white/50">History</span>
            </div>
            <h4 class="text-slate-500 font-semibold mb-1">Completed Visits</h4>
            <div class="flex items-end justify-between">
                <p class="text-3xl font-extrabold text-slate-800">{{ $stats['total_visits'] }}</p>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-gradient-to-br from-brand-400 to-brand-600 p-5 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 relative overflow-hidden group text-white">
            <div class="absolute -right-6 -top-5 w-24 h-24 bg-white/20 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>
            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="w-10 h-10 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <h4 class="text-brand-100 font-semibold mb-1 relative z-10">Total Paid</h4>
            <p class="text-3xl font-extrabold relative z-10 tracking-tight"><span class="text-2xl font-semibold opacity-80 mr-1">UGX</span>{{ number_format($stats['total_spent']) }}</p>
        </div>

    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        
        <!-- Left Column -->
        <div class="lg:col-span-2 flex flex-col gap-5">
            <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-slate-800 tracking-tight">My Appointments</h3>
                    <a href="{{ route('appointments.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">View All</a>
                </div>
                
                <div class="space-y-4">
                    @forelse($my_appointments as $appt)
                        <div class="bg-white/80 border border-white/80 p-4 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:shadow-sm transition-shadow">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg shadow-sm border border-white/50 overflow-hidden">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($appt->doctor->user->name) }}&background=3b82f6&color=fff" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-800">Dr. {{ explode(' ', $appt->doctor->user->name)[0] }}</h5>
                                    <p class="text-xs text-slate-500 font-medium">{{ $appt->doctor->department->name ?? 'General' }}</p>
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
                        <p class="text-slate-500 text-sm py-4">You have no appointments. <a href="{{ route('appointments.create') }}" class="text-brand-600 hover:underline">Book one now!</a></p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="flex flex-col gap-5">
            <div class="bg-gradient-to-br from-brand-500 to-blue-600 p-5 rounded-3xl shadow-md relative overflow-hidden group text-white">
                <div class="absolute -right-6 -top-5 w-32 h-32 bg-white/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                <h3 class="text-xl font-bold mb-2 relative z-10">Quick Actions</h3>
                <p class="text-brand-100 text-sm mb-6 relative z-10">Manage your health journey.</p>
                
                <div class="flex flex-col gap-3 relative z-10">
                    <a href="{{ route('appointments.create') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-md p-4 rounded-2xl flex items-center gap-3 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-white text-brand-600 flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="font-semibold">Book Appointment</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>