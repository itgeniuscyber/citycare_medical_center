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
            <!-- Removed extreme blur for performance -->
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-[#fdfbf7] rounded-full transform translate-x-1/3 -translate-y-1/3 opacity-80"></div>
            <div class="absolute bottom-0 left-0 w-[800px] h-[800px] bg-[#dcd8ce] rounded-full transform -translate-x-1/3 translate-y-1/3 opacity-40"></div>
        </div>
        
        <div class="min-h-screen flex flex-col relative z-10">
            
            <!-- Navbar -->
            <nav class="w-full px-6 py-4 flex justify-between items-center max-w-[1400px] mx-auto animate-fade-in bg-white/30 backdrop-blur-xl border border-white/60 rounded-full mt-6 shadow-sm">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-xl bg-brand-600 text-white flex items-center justify-center font-bold text-xl shadow-lg">C</div>
                    <span class="font-extrabold text-2xl text-slate-800 tracking-tight">CityCare</span>
                </div>
                <div class="hidden md:flex gap-8 text-sm font-semibold text-slate-600">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-brand-600' : 'hover:text-brand-600' }} transition-colors">Home</a>
                    <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'text-brand-600' : 'hover:text-brand-600' }} transition-colors">Services</a>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-brand-600' : 'hover:text-brand-600' }} transition-colors">Contact</a>
                </div>
                <div class="flex gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-brand-600 text-white rounded-full text-sm font-bold shadow-lg shadow-brand-500/30 hover:bg-brand-700 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-slate-600 rounded-full text-sm font-bold hover:bg-slate-100 transition-colors">Sign In</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-brand-600 text-white rounded-full text-sm font-bold shadow-lg shadow-brand-500/30 hover:bg-brand-700 transition-colors">Book Appointment</a>
                    @endauth
                </div>
            </nav>

            <!-- Hero Section -->
            <main class="flex-1 flex flex-col md:flex-row items-center justify-center max-w-[1400px] mx-auto px-6 py-12 gap-12 lg:gap-24 animate-slide-up mt-8">
                
                <!-- Left Text -->
                <div class="w-full md:w-1/2 flex flex-col items-start text-left z-20">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/60 backdrop-blur-md border border-brand-100 text-brand-600 text-sm font-bold mb-6 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-brand-600 animate-pulse"></span>
                        CityCare Medical Centre
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-6">
                        Protect yourself<br/>and your family
                    </h1>
                    <p class="text-lg text-slate-600 mb-10 max-w-lg leading-relaxed font-medium">
                        Book your appointments online, manage your medical records securely, and get access to the best doctors in the city.
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-brand-600 text-white rounded-full text-lg font-bold shadow-xl shadow-brand-500/30 hover:bg-brand-700 hover:scale-105 transition-all duration-300">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-white/60 backdrop-blur-md text-slate-700 border border-white/60 rounded-full text-lg font-bold shadow-sm hover:bg-white/80 transition-colors">
                            Patient Portal
                        </a>
                    </div>
                </div>

                <!-- Right Graphic -->
                <div class="w-full md:w-1/2 relative flex justify-center items-center">
                    <!-- Background blobs -->
                    <div class="absolute inset-0 bg-gradient-to-br from-brand-400 to-teal-500 rounded-full blur-[100px] opacity-20"></div>
                    
                    <!-- Solid Teal Card Background behind Doctor -->
                    <div class="relative w-[300px] h-[400px] lg:w-[400px] lg:h-[500px] bg-gradient-to-t from-brand-600 to-brand-400 rounded-[3rem] shadow-2xl flex items-end justify-center pt-10 border border-white/20">
                        <img src="{{ asset('images/doctor1.png') }}" alt="Doctor" class="w-[110%] max-w-none ml-8 drop-shadow-2xl z-10">
                        
                        <!-- Floating Stat 1 -->
                        <div class="absolute -left-12 top-1/4 bg-white/80 backdrop-blur-md p-3 rounded-2xl shadow-xl flex items-center gap-3 animate-float border border-white/60 z-20">
                            <div class="w-8 h-8 bg-brand-100 rounded-full flex items-center justify-center text-brand-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-slate-800 font-extrabold text-sm">Top Doctors</p>
                            </div>
                        </div>

                        <!-- Floating Stat 2 -->
                        <div class="absolute -right-8 bottom-1/4 bg-white/80 backdrop-blur-md p-3 rounded-2xl shadow-xl flex items-center gap-3 animate-float border border-white/60 z-20" style="animation-delay: 1.5s;">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-slate-800 font-extrabold text-sm">Safe & Secure</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Features Section -->
            <section class="max-w-[1400px] mx-auto px-6 py-20 z-20 w-full">
                <div class="text-center mb-16">
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-800 mb-4 tracking-tight">World-class Healthcare</h2>
                    <p class="text-slate-500 font-medium max-w-2xl mx-auto">Experience the best medical services with our modern facilities and highly qualified professionals.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white/50 backdrop-blur-xl border border-white/60 p-8 rounded-[2rem] shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 bg-brand-100 text-brand-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Fast Scheduling</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">Book appointments instantly without waiting in long queues. Our dynamic system finds the best slots.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white/50 backdrop-blur-xl border border-white/60 p-8 rounded-[2rem] shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Secure Records</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">Your medical history and payment records are encrypted and accessible only to authorized staff.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white/50 backdrop-blur-xl border border-white/60 p-8 rounded-[2rem] shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Top Specialists</h3>
                        <p class="text-slate-500 font-medium leading-relaxed">We house the city's leading specialists across Cardiology, Pediatrics, Neurology, and more.</p>
                    </div>
                </div>
            </section>
            
            <!-- Footer -->
            <footer class="w-full text-center py-8 text-slate-400 text-xs font-bold tracking-widest uppercase border-t border-white/40 mt-auto relative z-20">
                SSERUNJOGI MUHAMMAD | VU-BCS-2407-0417-EVE
            </footer>
        </div>
    </body>
</html>