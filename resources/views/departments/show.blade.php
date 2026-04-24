<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Department Details') }}
            </h2>
            <a href="{{ route('departments.index') }}" class="text-sm text-gray-600 hover:text-gray-900 border border-gray-300 px-4 py-2 rounded-lg bg-white">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $department->name }}</h3>
                        <p class="text-gray-500 text-sm mt-1">Created on {{ $department->created_at->format('M d, Y') }}</p>
                    </div>

                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-100 mb-8">
                        <h4 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Description</h4>
                        <p class="text-slate-800 whitespace-pre-line">{{ $department->description ?? 'No description provided.' }}</p>
                    </div>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('departments.edit', $department) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit Department
                        </a>
                        
                        <form action="{{ route('departments.destroy', $department) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this department?');">
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