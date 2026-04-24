<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Patient Profile') }}
            </h2>
            <a href="{{ route('patients.index') }}" class="text-sm text-gray-600 hover:text-gray-900 border border-gray-300 px-4 py-2 rounded-lg bg-white shadow-sm">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-8 pb-8 border-b border-gray-100">
                        <div class="flex-shrink-0 h-24 w-24 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-3xl shadow-sm">
                            {{ substr($patient->first_name, 0, 1) }}{{ substr($patient->last_name, 0, 1) }}
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3">
                                <h3 class="text-2xl font-bold text-gray-900">{{ $patient->first_name }} {{ $patient->last_name }}</h3>
                                @if($patient->user_id)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-md bg-green-100 text-green-800 border border-green-200">Portal Active</span>
                                @endif
                            </div>
                            <p class="text-slate-500 font-medium mt-1">Patient ID: #PT-{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="flex gap-2 w-full md:w-auto">
                            <a href="{{ route('patients.edit', $patient) }}" class="flex-1 md:flex-none text-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 shadow-sm hover:bg-gray-50 transition">
                                Edit Profile
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="bg-slate-50 p-6 rounded-xl border border-slate-100">
                            <h4 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Personal Details
                            </h4>
                            <ul class="space-y-3 text-sm">
                                <li class="flex justify-between border-b border-slate-200 pb-2">
                                    <span class="text-slate-500">Date of Birth:</span>
                                    <span class="font-medium text-slate-800">{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('F d, Y') }}</span>
                                </li>
                                <li class="flex justify-between border-b border-slate-200 pb-2">
                                    <span class="text-slate-500">Age:</span>
                                    <span class="font-medium text-slate-800">{{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} years</span>
                                </li>
                                <li class="flex justify-between pb-2">
                                    <span class="text-slate-500">Gender:</span>
                                    <span class="font-medium text-slate-800">{{ $patient->gender }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-slate-50 p-6 rounded-xl border border-slate-100">
                            <h4 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                Contact Information
                            </h4>
                            <ul class="space-y-3 text-sm">
                                <li class="flex flex-col border-b border-slate-200 pb-2">
                                    <span class="text-slate-500 mb-1">Phone Number:</span>
                                    <span class="font-medium text-slate-800">{{ $patient->phone }}</span>
                                </li>
                                <li class="flex flex-col border-b border-slate-200 pb-2">
                                    <span class="text-slate-500 mb-1">Address:</span>
                                    <span class="font-medium text-slate-800">{{ $patient->address ?? 'Not provided' }}</span>
                                </li>
                                <li class="flex flex-col pb-2">
                                    <span class="text-slate-500 mb-1">Emergency Contact:</span>
                                    <span class="font-medium text-slate-800">{{ $patient->emergency_contact ?? 'Not provided' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                        <form action="{{ route('patients.destroy', $patient) }}" method="POST" onsubmit="return confirm('Are you sure you want to completely delete this patient record?');" class="ml-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-50 text-red-600 border border-red-200 rounded-lg font-semibold text-xs uppercase tracking-widest hover:bg-red-100 hover:text-red-700 transition ease-in-out duration-150">
                                Delete Record
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>