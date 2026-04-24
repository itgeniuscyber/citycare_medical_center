<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Us - CityCare Medical Centre</title>
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
                    <h1 class="text-4xl lg:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">Get in Touch</h1>
                    <p class="text-lg text-slate-600 max-w-2xl mx-auto font-medium">We are here to help. Reach out to CityCare Medical Centre for general inquiries, emergency contacts, or to provide feedback.</p>
                </div>

                <div class="flex flex-col lg:flex-row gap-12 lg:gap-24 items-start">
                    
                    <!-- Contact Info (Left) -->
                    <div class="w-full lg:w-1/3 space-y-8">
                        <div class="bg-white/60 backdrop-blur-xl border border-white/60 rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-brand-100 text-brand-600 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-lg">Visit Us</h4>
                                    <p class="text-sm font-semibold text-brand-600 uppercase tracking-wide mt-1">Main Clinic</p>
                                </div>
                            </div>
                            <p class="text-slate-600 font-medium ml-16">123 CityCare Avenue,<br/>Kampala, Uganda</p>
                        </div>

                        <div class="bg-white/60 backdrop-blur-xl border border-white/60 rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-brand-100 text-brand-600 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-lg">Call Us</h4>
                                    <p class="text-sm font-semibold text-brand-600 uppercase tracking-wide mt-1">24/7 Support</p>
                                </div>
                            </div>
                            <p class="text-slate-600 font-medium ml-16">+256 800 123 456<br/>+256 700 987 654</p>
                        </div>

                        <div class="bg-white/60 backdrop-blur-xl border border-white/60 rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-brand-100 text-brand-600 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-lg">Email Us</h4>
                                    <p class="text-sm font-semibold text-brand-600 uppercase tracking-wide mt-1">General Inquiries</p>
                                </div>
                            </div>
                            <p class="text-slate-600 font-medium ml-16">info@citycare.com<br/>support@citycare.com</p>
                        </div>
                    </div>

                    <!-- Contact Form (Right) -->
                    <div class="w-full lg:w-2/3 bg-white/80 backdrop-blur-2xl border border-white/60 rounded-[3rem] p-10 lg:p-14 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                        <h3 class="text-2xl font-bold text-slate-800 mb-2">Send a Message</h3>
                        <p class="text-slate-500 font-medium mb-8">Fill out the form below and our team will get back to you within 24 hours.</p>

                        <form class="space-y-6" action="#" method="POST" onsubmit="event.preventDefault(); alert('Message sent successfully!');">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Full Name</label>
                                    <input type="text" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors" placeholder="muhammad Twaha" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                                    <input type="email" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors" placeholder="twaha@example.com" required>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Subject</label>
                                <input type="text" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors" placeholder="How can we help?" required>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Message</label>
                                <textarea rows="5" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-colors resize-none" placeholder="Type your message here..." required></textarea>
                            </div>

                            <button type="submit" class="w-full py-4 bg-brand-600 text-white rounded-xl font-bold text-lg shadow-lg shadow-brand-500/30 hover:bg-brand-700 transition-colors">
                                Send Message
                            </button>
                        </form>
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