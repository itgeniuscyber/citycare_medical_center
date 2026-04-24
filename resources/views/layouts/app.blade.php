<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CityCare Medical Centre') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <style>
            [x-cloak] { display: none !important; }
            /* Custom Scrollbar for Main Content */
            .custom-scrollbar::-webkit-scrollbar { width: 6px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background-color: rgba(203, 213, 225, 0.5); border-radius: 10px; }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: rgba(148, 163, 184, 0.8); }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#e5e3db] text-slate-800" x-data="{ sidebarOpen: false }">
        <!-- Background Decorative Elements -->
        <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
            <!-- Blur circles to match the warm/grey aesthetic of the screenshot -->
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-[#fdfbf7] rounded-full mix-blend-overlay filter blur-[100px] transform translate-x-1/3 -translate-y-1/3"></div>
            <div class="absolute bottom-0 left-0 w-[800px] h-[800px] bg-[#dcd8ce] rounded-full mix-blend-multiply filter blur-[100px] transform -translate-x-1/3 translate-y-1/3 opacity-60"></div>
        </div>

        <div class="relative z-10 flex h-screen p-4 sm:p-6 gap-6">
            
            <!-- Left Collapsible Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content Floating Panel -->
            <div class="flex-1 bg-white/50 backdrop-blur-2xl border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-3xl overflow-hidden flex flex-col relative">
                
                <!-- Top Header Bar inside Main Panel -->
                <header class="px-8 lg:px-10 pt-8 pb-4 flex justify-between items-center z-20">
                    <div class="flex-1">
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>

                    <!-- Right Side Top Header (Search & User) -->
                    <div class="flex items-center gap-6">
                        <!-- Global Search Form -->
                        <form action="{{ route('patients.index') }}" method="GET" class="relative hidden md:block">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" class="block w-72 pl-11 pr-4 py-2.5 border border-white/50 rounded-full bg-white/40 focus:bg-white/80 focus:ring-2 focus:ring-brand-500/50 text-sm text-slate-800 placeholder-slate-400 backdrop-blur-md shadow-sm transition-all" placeholder="Search patients..." value="{{ request('search') }}">
                        </form>

                        <!-- Action Icons (Notifications) -->
                        <div class="relative" x-data="{ notifOpen: false }">
                            <button @click="notifOpen = !notifOpen" @click.away="notifOpen = false" class="relative w-10 h-10 rounded-full bg-white/40 hover:bg-white/80 border border-white/50 shadow-sm flex items-center justify-center text-slate-500 transition-colors focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                <!-- Notification Dot -->
                                @if(Auth::user()->role === 'receptionist' || Auth::user()->role === 'admin')
                                    <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                                @endif
                            </button>

                            <!-- Notification Dropdown Content -->
                            <div x-show="notifOpen" x-transition.opacity.duration.200ms class="absolute right-0 mt-3 w-80 bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/50 py-3 z-50 overflow-hidden" x-cloak>
                                <div class="px-4 pb-2 border-b border-slate-100 flex justify-between items-center mb-2">
                                    <h4 class="font-bold text-slate-800">Notifications</h4>
                                    <span class="text-xs font-semibold text-brand-600 bg-brand-50 px-2 py-0.5 rounded-full">New</span>
                                </div>
                                <div class="max-h-64 overflow-y-auto custom-scrollbar px-2">
                                    @if(Auth::user()->role === 'receptionist' || Auth::user()->role === 'admin')
                                        <a href="{{ route('appointments.index') }}" class="block p-3 hover:bg-slate-50 rounded-xl transition-colors mb-1">
                                            <p class="text-sm text-slate-800 font-semibold mb-0.5">System Update</p>
                                            <p class="text-xs text-slate-500">CityCare System v1.0 successfully deployed.</p>
                                            <p class="text-[10px] text-slate-400 mt-1 font-medium">Just now</p>
                                        </a>
                                        <a href="{{ route('appointments.index') }}" class="block p-3 hover:bg-slate-50 rounded-xl transition-colors mb-1">
                                            <div class="flex items-center gap-2 mb-0.5">
                                                <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                                <p class="text-sm text-slate-800 font-semibold">Pending Appointments</p>
                                            </div>
                                            <p class="text-xs text-slate-500">You have pending appointments to confirm.</p>
                                            <p class="text-[10px] text-slate-400 mt-1 font-medium">2 hours ago</p>
                                        </a>
                                    @else
                                        <div class="p-4 text-center">
                                            <p class="text-sm text-slate-500 font-medium">No new notifications.</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="pt-2 border-t border-slate-100 px-4 mt-1 text-center">
                                    <a href="#" class="text-xs font-bold text-brand-600 hover:text-brand-700">Mark all as read</a>
                                </div>
                            </div>
                        </div>

                        <!-- User Profile Dropdown -->
                        <div class="relative" x-data="{ userMenuOpen: false }">
                            <button @click="userMenuOpen = !userMenuOpen" @click.away="userMenuOpen = false" class="flex items-center gap-3 bg-white/40 hover:bg-white/80 border border-white/50 pl-3 pr-4 py-2 rounded-full shadow-sm transition-colors focus:outline-none">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=14b8a6&color=fff&bold=true" alt="Avatar" class="w-8 h-8 rounded-full shadow-sm">
                                <div class="text-left hidden lg:block">
                                    <p class="text-sm font-bold text-slate-800 leading-tight">{{ explode(' ', Auth::user()->name)[0] }}</p>
                                    <p class="text-xs font-medium text-brand-600">{{ ucfirst(Auth::user()->role) }}</p>
                                </div>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            
                            <!-- Dropdown Content -->
                            <div x-show="userMenuOpen" x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-48 bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl border border-white/50 py-2 z-50" x-cloak>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-brand-600">Profile Settings</a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Scrollable Main Content -->
                <main class="flex-1 overflow-y-auto px-8 lg:px-10 pb-6 animate-fade-in custom-scrollbar relative z-10">
                    {{ $slot }}
                    
                    <!-- Footer -->
                    <footer class="mt-12 mb-4 text-center border-t border-white/40 pt-6">
                        <p class="text-xs font-bold tracking-widest text-slate-400 uppercase">
                            SSERUNJOGI MUHAMMAD | VU-BCS-2407-0417-EVE
                        </p>
                    </footer>
                </main>
            </div>
        </div>
    </body>
</html>
