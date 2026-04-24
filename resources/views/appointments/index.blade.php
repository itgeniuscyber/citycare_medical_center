<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-slate-800 tracking-tight">
                {{ __('Appointments') }}
            </h2>
            <div class="flex gap-3">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="px-5 py-2.5 bg-white text-slate-700 font-semibold rounded-full border border-slate-200 hover:bg-slate-50 transition-colors shadow-sm flex items-center gap-2 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Export
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('appointments.export', 'pdf') }}">Export as PDF</x-dropdown-link>
                        <x-dropdown-link href="{{ route('appointments.export', 'excel') }}">Export as Excel</x-dropdown-link>
                        <x-dropdown-link href="{{ route('appointments.export', 'csv') }}">Export as CSV</x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                @if(in_array(Auth::user()->role, ['admin', 'receptionist', 'patient']))
                <a href="{{ route('appointments.create') }}" class="bg-brand-600 hover:bg-brand-500 text-white px-5 py-2.5 rounded-full shadow-lg shadow-brand-500/30 hover:shadow-brand-500/50 transition-all text-sm font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Book Appointment
                </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto pb-12">
        
        @if (session('success'))
            <div class="mb-6 bg-green-50/80 backdrop-blur-md border border-green-200 text-green-700 px-6 py-4 rounded-2xl relative shadow-sm" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Search and Filter Bar -->
        <div class="mb-8 bg-white/40 backdrop-blur-xl p-6 rounded-3xl shadow-sm border border-white/60 flex flex-col md:flex-row justify-between items-center gap-4">
            <form action="{{ route('appointments.index') }}" method="GET" class="w-full md:max-w-md flex gap-3">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-11 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-full bg-white/50 text-slate-700 placeholder-slate-400 backdrop-blur-sm transition-all py-2.5" placeholder="Search by patient or doctor...">
                </div>
                <button type="submit" class="px-6 py-2.5 bg-slate-800 text-white rounded-full text-sm font-semibold hover:bg-slate-700 transition-colors shadow-md">Search</button>
                @if(request('search'))
                    <a href="{{ route('appointments.index') }}" class="px-6 py-2.5 bg-white/60 border border-white/80 text-slate-600 rounded-full text-sm font-semibold hover:bg-white transition-colors flex items-center shadow-sm">Clear</a>
                @endif
            </form>
        </div>

        <div class="bg-white/40 backdrop-blur-xl shadow-lg sm:rounded-[2.5rem] border border-white/60 overflow-hidden">
            <div class="p-0 text-slate-900">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200/50">
                        <thead class="bg-white/40">
                            <tr>
                                <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Patient</th>
                                <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Doctor</th>
                                <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Date & Time</th>
                                <th scope="col" class="px-8 py-5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-8 py-5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200/50">
                            @forelse ($appointments as $appointment)
                                <tr class="hover:bg-white/60 transition-colors group">
                                    <td class="px-8 py-5 whitespace-nowrap">
                                        <div class="text-sm font-bold text-slate-800">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</div>
                                        <div class="text-xs font-medium text-slate-500 mt-0.5">{{ $appointment->patient->phone }}</div>
                                    </td>
                                    <td class="px-8 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-xl overflow-hidden shadow-sm">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($appointment->doctor->user->name) }}&background=14b8a6&color=fff" class="w-full h-full object-cover">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-slate-800">{{ $appointment->doctor->user->name }}</div>
                                                <div class="text-xs font-medium text-slate-500 mt-0.5">{{ $appointment->doctor->department->name ?? 'General' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-slate-700">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</div>
                                        <div class="text-xs font-bold text-brand-600 mt-0.5">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</div>
                                    </td>
                                    <td class="px-8 py-5 whitespace-nowrap">
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-orange-100 text-orange-700 border-orange-200',
                                                'confirmed' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                'completed' => 'bg-green-100 text-green-700 border-green-200',
                                                'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                                            ];
                                            $class = $statusClasses[$appointment->status] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full border {{ $class }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-3">
                                            <a href="{{ route('appointments.show', $appointment) }}" class="p-2 bg-white/60 hover:bg-blue-50 text-blue-600 rounded-xl transition-colors shadow-sm" title="View Details"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></a>
                                            
                                            @if(in_array(Auth::user()->role, ['admin', 'receptionist', 'doctor']))
                                            <a href="{{ route('appointments.edit', $appointment) }}" class="p-2 bg-white/60 hover:bg-indigo-50 text-indigo-600 rounded-xl transition-colors shadow-sm" title="Edit/Update Status"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></a>
                                            @endif

                                            @if(in_array(Auth::user()->role, ['admin', 'receptionist']))
                                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-white/60 hover:bg-red-50 text-red-600 rounded-xl transition-colors shadow-sm" title="Cancel Appointment"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-16 text-center text-slate-500 font-medium">
                                        No appointments found matching your search.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($appointments->hasPages())
                    <div class="px-8 py-5 border-t border-slate-200/50 bg-white/20">
                        {{ $appointments->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>