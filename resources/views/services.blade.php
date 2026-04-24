<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Services - CityCare Medical Centre</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased bg-[#e5e3db] selection:bg-brand-600 selection:text-white">
        
        <!-- Background Decorative Elements -->
        <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
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

            <!-- Main Content -->
            <main class="flex-1 max-w-[1400px] mx-auto px-6 py-16 w-full animate-slide-up z-20">
                
                <div class="text-center mb-16">
                    <h1 class="text-4xl lg:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">Our Medical Services</h1>
                    <p class="text-lg text-slate-600 max-w-2xl mx-auto font-medium">Comprehensive healthcare solutions tailored to your needs. CityCare provides specialized treatments across multiple disciplines.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Service 1 -->
                    <div class="bg-white/60 backdrop-blur-xl border border-white/60 rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-brand-400 to-brand-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-brand-500/30">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Cardiology</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">Comprehensive heart care, from diagnostics to advanced surgical procedures. Our cardiologists are equipped with state-of-the-art technology.</p>
                    </div>

                    <!-- Service 2 -->
                    <div class="bg-white/60 backdrop-blur-xl border border-white/60 rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-blue-500/30">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Laboratory Tests</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">Accurate and rapid diagnostic testing. We offer full blood counts, biochemistry, microbiology, and advanced pathology services.</p>
                    </div>

                    <!-- Service 3 -->
                    <div class="bg-white/60 backdrop-blur-xl border border-white/60 rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-orange-500/30">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Pediatrics</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">Specialized care for infants, children, and adolescents. From routine vaccinations to treatment of complex childhood illnesses.</p>
                    </div>
                    
                    <!-- Service 4 -->
                    <div class="bg-white/60 backdrop-blur-xl border border-white/60 rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-purple-500/30">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Neurology</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">Expert diagnosis and treatment of disorders affecting the brain, spinal cord, and nervous system using advanced imaging.</p>
                    </div>

                    <!-- Service 5 -->
                    <div class="bg-white/60 backdrop-blur-xl border border-white/60 rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-green-500/30">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">General Surgery</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">Safe and effective surgical interventions. Our modern operating theaters adhere to the highest international safety standards.</p>
                    </div>

                    <!-- Service 6 -->
                    <div class="bg-white/60 backdrop-blur-xl border border-white/60 rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-pink-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-pink-500/30">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Inpatient Care</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">Comfortable recovery rooms with 24/7 nursing care, ensuring you or your loved ones recover in a peaceful, safe environment.</p>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="w-full text-center py-8 text-slate-400 text-xs font-bold tracking-widest uppercase border-t border-white/40 mt-auto relative z-20">
                SSERUNJOGI MUHAMMAD | VU-BCS-2407-0417-EVE
            </footer>
        </div>
    </body>
</html>