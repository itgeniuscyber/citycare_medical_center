<nav x-data="{ open: false }" class="bg-[#e4e2dd]/80 border-b border-gray-300/50 sticky top-0 z-50 backdrop-blur-xl">
    <!-- Primary Navigation Menu -->
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-[72px]">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-400 to-brand-600 text-white flex items-center justify-center font-bold text-2xl shadow-sm border border-white/20">
                            C
                        </div>
                        <span class="font-bold text-2xl text-slate-800 tracking-tight hidden sm:block">CityCare</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-12 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-xl px-4 py-2 hover:bg-white/50 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white shadow-sm border border-white/40 text-brand-600 font-semibold' : 'text-slate-600 font-medium' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            {{ __('Overview') }}
                        </div>
                    </x-nav-link>
                    
                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('departments.index')" :active="request()->routeIs('departments.*')" class="rounded-xl px-4 py-2 hover:bg-white/50 transition-all duration-200 {{ request()->routeIs('departments.*') ? 'bg-white shadow-sm border border-white/40 text-brand-600 font-semibold' : 'text-slate-600 font-medium' }}">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                Departments
                            </div>
                        </x-nav-link>
                        <x-nav-link :href="route('doctors.index')" :active="request()->routeIs('doctors.*')" class="rounded-xl px-4 py-2 hover:bg-white/50 transition-all duration-200 {{ request()->routeIs('doctors.*') ? 'bg-white shadow-sm border border-white/40 text-brand-600 font-semibold' : 'text-slate-600 font-medium' }}">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Doctors
                            </div>
                        </x-nav-link>
                    @endif
                    
                    @if(in_array(Auth::user()->role, ['admin', 'receptionist']))
                        <x-nav-link :href="route('patients.index')" :active="request()->routeIs('patients.*')" class="rounded-xl px-4 py-2 hover:bg-white/50 transition-all duration-200 {{ request()->routeIs('patients.*') ? 'bg-white shadow-sm border border-white/40 text-brand-600 font-semibold' : 'text-slate-600 font-medium' }}">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Patients
                            </div>
                        </x-nav-link>
                        <x-nav-link href="#" :active="false" class="rounded-xl px-4 py-2 hover:bg-white/50 transition-all duration-200 text-slate-600 font-medium">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Schedule
                            </div>
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Search Bar in Header (Aesthetic) -->
                <div class="relative mr-6">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" class="block w-64 pl-10 pr-3 py-2 border-0 rounded-2xl bg-white/50 focus:bg-white focus:ring-2 focus:ring-brand-500/50 text-sm text-slate-800 placeholder-slate-400 backdrop-blur-sm transition-all" placeholder="Search anything here...">
                </div>

                <div class="flex items-center gap-3 pl-6 border-l border-slate-300/50">
                    <div class="flex flex-col items-end">
                        <span class="text-sm font-bold text-slate-800 leading-tight">{{ Auth::user()->name }}</span>
                        <span class="text-xs font-medium text-brand-600">{{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                    
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center focus:outline-none transition ease-in-out duration-150">
                                <div class="w-10 h-10 rounded-full bg-white shadow-sm border border-white/50 flex items-center justify-center overflow-hidden hover:ring-2 ring-brand-500 ring-offset-2 ring-offset-[#e4e2dd] transition-all">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=14b8a6&color=fff&bold=true" alt="Avatar" class="w-full h-full object-cover">
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile Settings') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    <span class="text-red-600">{{ __('Log Out') }}</span>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link href="#" :active="false">Users</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('departments.index')" :active="request()->routeIs('departments.*')">Departments</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('doctors.index')" :active="request()->routeIs('doctors.*')">Doctors</x-responsive-nav-link>
            @endif
            
            @if(in_array(Auth::user()->role, ['admin', 'receptionist']))
                <x-responsive-nav-link :href="route('patients.index')" :active="request()->routeIs('patients.*')">Patients</x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">Appointments</x-responsive-nav-link>
            @endif
            
            @if(Auth::user()->role === 'doctor')
                <x-responsive-nav-link href="#" :active="false">My Schedule</x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">Patients</x-responsive-nav-link>
            @endif
            
            @if(in_array(Auth::user()->role, ['admin', 'cashier']))
                <x-responsive-nav-link href="#" :active="false">Payments</x-responsive-nav-link>
            @endif
            
            @if(Auth::user()->role === 'patient')
                <x-responsive-nav-link href="#" :active="false">My Appointments</x-responsive-nav-link>
                <x-responsive-nav-link href="#" :active="false">Medical History</x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 flex justify-between items-center">
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="px-3 py-1 bg-brand-50 text-brand-700 text-xs font-bold uppercase tracking-wider rounded-full border border-brand-200">
                    {{ ucfirst(Auth::user()->role) }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
