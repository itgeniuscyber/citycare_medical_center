<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Doctor Profile') }}
            </h2>
            <a href="{{ route('doctors.index') }}" class="text-sm text-gray-600 hover:text-gray-900 border border-gray-300 px-4 py-2 rounded-lg bg-white">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    
                    <div class="flex items-center gap-6 mb-8 pb-8 border-b border-gray-100">
                        <div class="flex-shrink-0 h-24 w-24 rounded-full bg-brand-100 flex items-center justify-center text-brand-700 font-bold text-3xl">
                            {{ substr($doctor->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $doctor->user->name }}</h3>
                            <p class="text-brand-600 font-medium">{{ $doctor->specialization }}</p>
                            <div class="flex gap-4 mt-2 text-sm text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    {{ $doctor->user->email }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    {{ $doctor->phone }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="bg-slate-50 p-6 rounded-xl border border-slate-100">
                            <h4 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Department Information</h4>
                            <div class="mt-2">
                                <p class="text-slate-800 font-medium">{{ $doctor->department->name }}</p>
                                <p class="text-slate-500 text-sm mt-1">{{ $doctor->department->description }}</p>
                            </div>
                        </div>

                        <div class="bg-slate-50 p-6 rounded-xl border border-slate-100">
                            <h4 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Biography</h4>
                            <p class="text-slate-800 whitespace-pre-line">{{ $doctor->bio ?? 'No biography provided.' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('doctors.edit', $doctor) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit Doctor
                        </a>
                        
                        <form action="{{ route('doctors.destroy', $doctor) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>