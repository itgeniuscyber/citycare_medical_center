<aside :class="sidebarOpen ? 'w-64' : 'w-24'" class="transition-all duration-300 ease-in-out flex flex-col items-center py-8 bg-white/40 backdrop-blur-2xl border border-white/60 shadow-xl rounded-[2.5rem] relative flex-shrink-0">
    
    <!-- Toggle Button -->
    <button @click="sidebarOpen = !sidebarOpen" class="absolute -right-3 top-12 bg-white/80 backdrop-blur border border-white/80 text-slate-600 rounded-full p-1.5 shadow-lg hover:text-brand-600 transition-colors z-20">
        <svg x-show="!sidebarOpen" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
        <svg x-show="sidebarOpen" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
    </button>

    <!-- Logo -->
    <div class="mb-10 w-full px-6 flex justify-center">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-brand-400 to-brand-600 text-white flex items-center justify-center font-bold text-2xl shadow-lg shadow-brand-500/30 border border-white/20 flex-shrink-0">
                C
            </div>
            <span x-show="sidebarOpen" x-transition.opacity.duration.300ms class="font-extrabold text-2xl text-slate-800 tracking-tight whitespace-nowrap">CityCare</span>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 w-full px-4 space-y-3 flex flex-col items-center overflow-x-hidden">
        
        <!-- Overview -->
        <a href="{{ route('dashboard') }}" class="w-full flex items-center p-3 rounded-2xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-white/70 shadow-sm border border-white/60 text-brand-600' : 'text-slate-600 hover:bg-white/40 hover:text-brand-600' }}" :class="sidebarOpen ? 'justify-start px-4' : 'justify-center'">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <span x-show="sidebarOpen" x-transition.opacity class="ml-3 font-semibold whitespace-nowrap">Overview</span>
        </a>

        @if(Auth::user()->role === 'admin')
            <!-- Departments -->
            <a href="{{ route('departments.index') }}" class="w-full flex items-center p-3 rounded-2xl transition-all duration-200 group {{ request()->routeIs('departments.*') ? 'bg-white/70 shadow-sm border border-white/60 text-brand-600' : 'text-slate-600 hover:bg-white/40 hover:text-brand-600' }}" :class="sidebarOpen ? 'justify-start px-4' : 'justify-center'">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span x-show="sidebarOpen" x-transition.opacity class="ml-3 font-semibold whitespace-nowrap">Departments</span>
            </a>

            <!-- Doctors -->
            <a href="{{ route('doctors.index') }}" class="w-full flex items-center p-3 rounded-2xl transition-all duration-200 group {{ request()->routeIs('doctors.*') ? 'bg-white/70 shadow-sm border border-white/60 text-brand-600' : 'text-slate-600 hover:bg-white/40 hover:text-brand-600' }}" :class="sidebarOpen ? 'justify-start px-4' : 'justify-center'">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <span x-show="sidebarOpen" x-transition.opacity class="ml-3 font-semibold whitespace-nowrap">Doctors</span>
            </a>
        @endif

        @if(in_array(Auth::user()->role, ['admin', 'receptionist']))
            <!-- Patients -->
            <a href="{{ route('patients.index') }}" class="w-full flex items-center p-3 rounded-2xl transition-all duration-200 group {{ request()->routeIs('patients.*') ? 'bg-white/70 shadow-sm border border-white/60 text-brand-600' : 'text-slate-600 hover:bg-white/40 hover:text-brand-600' }}" :class="sidebarOpen ? 'justify-start px-4' : 'justify-center'">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span x-show="sidebarOpen" x-transition.opacity class="ml-3 font-semibold whitespace-nowrap">Patients</span>
            </a>
        @endif

        <!-- Appointments -->
        <a href="{{ route('appointments.index') }}" class="w-full flex items-center p-3 rounded-2xl transition-all duration-200 group {{ request()->routeIs('appointments.*') ? 'bg-white/70 shadow-sm border border-white/60 text-brand-600' : 'text-slate-600 hover:bg-white/40 hover:text-brand-600' }}" :class="sidebarOpen ? 'justify-start px-4' : 'justify-center'">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span x-show="sidebarOpen" x-transition.opacity class="ml-3 font-semibold whitespace-nowrap">Schedule</span>
        </a>

        @if(in_array(Auth::user()->role, ['admin', 'cashier']))
            <!-- Payments -->
            <a href="{{ route('payments.index') }}" class="w-full flex items-center p-3 rounded-2xl transition-all duration-200 group {{ request()->routeIs('payments.*') ? 'bg-white/70 shadow-sm border border-white/60 text-brand-600' : 'text-slate-600 hover:bg-white/40 hover:text-brand-600' }}" :class="sidebarOpen ? 'justify-start px-4' : 'justify-center'">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span x-show="sidebarOpen" x-transition.opacity class="ml-3 font-semibold whitespace-nowrap">Payments</span>
            </a>
        @endif
    </nav>

    <!-- User Profile / Logout at Bottom -->
    <div class="mt-auto w-full px-4 flex flex-col items-center">
        <!-- Settings (Dark Mode / Light Mode toggle representation) -->
        <a href="{{ route('profile.edit') }}" class="w-full flex items-center p-3 rounded-2xl text-slate-500 hover:bg-white/40 hover:text-brand-600 transition-all duration-200 mb-4 {{ request()->routeIs('profile.edit') ? 'bg-white/60 text-brand-600 shadow-sm' : '' }}" :class="sidebarOpen ? 'justify-start px-4' : 'justify-center'">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <span x-show="sidebarOpen" x-transition.opacity class="ml-3 font-semibold whitespace-nowrap">Settings</span>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center p-3 rounded-2xl bg-white/50 border border-white/60 text-slate-700 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all duration-200 shadow-sm" :class="sidebarOpen ? 'justify-start px-4' : 'justify-center'">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span x-show="sidebarOpen" x-transition.opacity class="ml-3 font-semibold whitespace-nowrap">Logout</span>
            </button>
        </form>
    </div>
</aside>