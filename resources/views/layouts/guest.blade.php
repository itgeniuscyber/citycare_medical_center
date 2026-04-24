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
    </head>
    <body class="font-sans text-slate-800 antialiased bg-[#e5e3db] selection:bg-brand-600 selection:text-white">
        
        <!-- Background Decorative Elements -->
        <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
            <!-- Blur circles to match the dashboard aesthetic (Removed mix-blend and huge blur for performance) -->
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-[#fdfbf7] rounded-full transform translate-x-1/3 -translate-y-1/3 opacity-80"></div>
            <div class="absolute bottom-0 left-0 w-[800px] h-[800px] bg-[#dcd8ce] rounded-full transform -translate-x-1/3 translate-y-1/3 opacity-40"></div>
        </div>
        
        <div class="min-h-screen flex items-center justify-center p-4 sm:p-8 relative z-10">
            
            <!-- Main Card Container (Removed backdrop-blur-2xl for performance) -->
            <div class="w-full max-w-[1100px] bg-white/95 rounded-[3rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex flex-col md:flex-row overflow-hidden border border-white/60 relative animate-slide-up">
                
                <!-- Left Side: Image/Graphic (Visible on medium screens and up) -->
                <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-brand-100 via-white to-brand-50 relative p-10 items-end justify-center overflow-hidden border-r border-white/50">
                    
                    <!-- Decorative Background Elements behind the Doctor -->
                    <div class="absolute inset-0 z-0 opacity-30" style="background-image: radial-gradient(circle at 2px 2px, #14b8a6 1px, transparent 0); background-size: 20px 20px;"></div>
                    <div class="absolute top-10 left-10 text-brand-600/30">
                        <svg class="w-8 h-8 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <div class="absolute top-1/4 right-10 text-brand-600/30">
                        <svg class="w-12 h-12 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>

                    <!-- Solid Teal Card Background behind Doctor (Like reference image) -->
                    <div class="absolute bottom-0 w-[90%] h-[75%] bg-gradient-to-t from-brand-600 to-brand-400 rounded-t-[3rem] z-10 shadow-2xl shadow-brand-500/20"></div>

                    <!-- Doctor Image -->
                    <!-- We use request()->routeIs('register') to show doctor2 on register, and doctor1 on login -->
                    <img src="{{ asset('images/' . (request()->routeIs('register') ? 'doctor2.png' : 'doctor1.png')) }}" 
                         alt="CityCare Doctor" 
                         class="relative z-20 w-[95%] max-w-[400px] object-contain object-bottom drop-shadow-2xl">

                    <!-- Floating Stats Cards (like the reference image) -->
                    <div class="absolute inset-0 z-30 pointer-events-none">
                        
                        <!-- Mini Stat 1 (Left) -->
                        <div class="absolute left-6 bottom-1/3 bg-white/80 backdrop-blur-md p-3 rounded-2xl shadow-xl flex items-center gap-3 animate-float border border-white/60">
                            <div class="w-8 h-8 bg-brand-100 rounded-full flex items-center justify-center text-brand-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            </div>
                            <div>
                                <p class="text-slate-800 font-extrabold text-sm">5.7 Million</p>
                                <p class="text-slate-500 text-[10px] font-semibold">doses injected</p>
                            </div>
                        </div>

                        <!-- Mini Stat 2 (Right/Bottom) -->
                        <div class="absolute right-8 bottom-16 bg-white/80 backdrop-blur-md p-3 rounded-2xl shadow-xl flex items-center gap-3 animate-float border border-white/60" style="animation-delay: 1.5s;">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <p class="text-slate-800 font-extrabold text-sm">98%</p>
                                <p class="text-slate-500 text-[10px] font-semibold">recovery rate</p>
                            </div>
                        </div>

                        <!-- Logo Header (Top Left) -->
                        <div class="absolute top-10 left-10 flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-brand-600 text-white flex items-center justify-center font-bold text-lg shadow-lg">C</div>
                            <span class="font-extrabold text-xl text-brand-900 tracking-tight">CityCare</span>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Form Area (Removed backdrop-blur-xl) -->
                <div class="w-full md:w-1/2 p-8 sm:p-12 lg:p-16 xl:p-20 bg-white/95 relative flex flex-col justify-center">
                    <!-- Mobile Logo (Hidden on desktop) -->
                    <div class="flex items-center gap-2 mb-8 md:hidden">
                        <div class="w-8 h-8 rounded-lg bg-brand-600 text-white flex items-center justify-center font-bold text-lg shadow-md">
                            C
                        </div>
                        <span class="font-extrabold text-xl text-slate-800 tracking-tight">CityCare</span>
                    </div>

                    {{ $slot }}

                    <!-- Guest Footer -->
                    <div class="mt-8 text-center border-t border-slate-200/60 pt-6">
                        <p class="text-[10px] font-bold tracking-widest text-slate-400 uppercase">
                            SSERUNJOGI MUHAMMAD | VU-BCS-2407-0417-EVE
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
    </body>
</html>
