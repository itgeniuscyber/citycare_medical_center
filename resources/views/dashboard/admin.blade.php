<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-slate-800 tracking-tight">
            Good Morning, {{ explode(' ', Auth::user()->name)[0] }} 👋
        </h2>
        <p class="text-slate-500 font-medium mt-1">Here is the overview of CityCare Medical Centre today.</p>
    </x-slot>

    <!-- Dashboard Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        
        <!-- Stat Card 1 -->
        <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-2xl shadow-sm hover:shadow-md hover:bg-white/80 transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="bg-white/60 text-slate-500 text-xs font-bold px-3 py-1 rounded-full border border-white/50">+12%</span>
            </div>
            <h4 class="text-slate-500 font-semibold mb-1">Total Patients</h4>
            <div class="flex items-end justify-between">
                <p class="text-3xl font-extrabold text-slate-800">{{ \App\Models\Patient::count() }}</p>
                <!-- Mini sparkline (SVG) -->
                <svg class="w-16 h-8 text-orange-400 opacity-80" viewBox="0 0 100 30" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M0,25 L20,15 L40,20 L60,5 L80,10 L100,0"></path></svg>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-2xl shadow-sm hover:shadow-md hover:bg-white/80 transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <span class="bg-white/60 text-slate-500 text-xs font-bold px-3 py-1 rounded-full border border-white/50">Active</span>
            </div>
            <h4 class="text-slate-500 font-semibold mb-1">Available Doctors</h4>
            <div class="flex items-end justify-between">
                <p class="text-3xl font-extrabold text-slate-800">{{ \App\Models\Doctor::count() }}</p>
                <svg class="w-16 h-8 text-blue-400 opacity-80" viewBox="0 0 100 30" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M0,15 L20,25 L40,5 L60,20 L80,10 L100,15"></path></svg>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-2xl shadow-sm hover:shadow-md hover:bg-white/80 transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <span class="bg-white/60 text-slate-500 text-xs font-bold px-3 py-1 rounded-full border border-white/50">Today</span>
            </div>
            <h4 class="text-slate-500 font-semibold mb-1">Appointments</h4>
            <div class="flex items-end justify-between">
                <p class="text-3xl font-extrabold text-slate-800">24</p>
                <div class="w-8 h-8 rounded-full border-4 border-green-200 border-t-green-500 flex items-center justify-center"></div>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-gradient-to-br from-brand-400 to-brand-600 p-5 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 relative overflow-hidden group text-white">
            <!-- Decorative BG -->
            <div class="absolute -right-6 -top-5 w-24 h-24 bg-white/20 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>
            
            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="w-10 h-10 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <h4 class="text-brand-100 font-semibold mb-1 relative z-10">Today's Revenue</h4>
            <p class="text-3xl font-extrabold relative z-10 tracking-tight"><span class="text-2xl font-semibold opacity-80 mr-1">UGX</span>2.4M</p>
        </div>

    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        
        <!-- Left Column (Chart/Activity) -->
        <div class="lg:col-span-2 flex flex-col gap-5">
            <!-- Big Chart Card -->
            <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-3xl shadow-sm relative overflow-hidden">
                <div class="flex justify-between items-center mb-6 relative z-10">
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800 tracking-tight">Activity Tracking</h3>
                        <p class="text-sm text-slate-500 font-medium">Patient visits over the last 7 days</p>
                    </div>
                    <select class="bg-white/50 border border-white/80 rounded-full px-4 py-2 text-sm font-semibold text-slate-600 focus:ring-2 focus:ring-brand-500 outline-none cursor-pointer backdrop-blur-md shadow-sm">
                        <option>Weekly</option>
                        <option>Monthly</option>
                    </select>
                </div>
                
                <!-- Chart.js Canvas -->
                <div class="relative z-10 h-72 w-full">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>

            <!-- Lower Left Section (e.g. Diet Plan in screenshot -> Recent Patients) -->
            <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-800 tracking-tight">Recent Patients</h3>
                    <a href="{{ route('patients.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">View All</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white/80 border border-white/80 p-4 rounded-2xl flex items-center gap-4 hover:shadow-sm transition-shadow cursor-pointer">
                        <img src="https://ui-avatars.com/api/?name=Sarah+Namagembe&background=fce7f3&color=db2777" class="w-10 h-10 rounded-xl object-cover">
                        <div>
                            <h5 class="font-bold text-slate-800">Sarah Namagembe</h5>
                            <p class="text-xs text-slate-500 font-medium">Checkup</p>
                        </div>
                    </div>
                    <div class="bg-orange-500 text-white p-4 rounded-2xl flex items-center gap-4 hover:shadow-md transition-shadow cursor-pointer">
                        <img src="https://ui-avatars.com/api/?name=Paul+Kato&background=ffedd5&color=ea580c" class="w-10 h-10 rounded-xl object-cover">
                        <div>
                            <h5 class="font-bold">Paul Kato</h5>
                            <p class="text-xs text-orange-200 font-medium">Dental</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column (Profile & Schedule) -->
        <div class="flex flex-col gap-5">
            
            <!-- User Snippet (Like top right of screenshot) -->
            <div class="bg-slate-800 text-white p-5 rounded-3xl shadow-lg relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2"></div>
                <div class="flex justify-between items-center mb-6 relative z-10">
                    <h3 class="text-lg font-bold">April 2026</h3>
                    <div class="flex gap-2">
                        <button class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                        <button class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
                    </div>
                </div>
                
                <!-- Mini Calendar (Aesthetic) -->
                <div class="grid grid-cols-7 gap-1 text-center text-xs font-medium text-slate-400 mb-2 relative z-10">
                    <div>Su</div><div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div>
                </div>
                <div class="grid grid-cols-7 gap-1 text-center text-sm font-semibold relative z-10">
                    <div class="py-1 text-slate-500">29</div><div class="py-1 text-slate-500">30</div><div class="py-1 text-slate-500">31</div><div class="py-1">1</div><div class="py-1">2</div><div class="py-1">3</div><div class="py-1">4</div>
                    <div class="py-1">5</div><div class="py-1">6</div><div class="py-1">7</div><div class="py-1">8</div><div class="py-1">9</div><div class="py-1">10</div><div class="py-1">11</div>
                    <div class="py-1">12</div><div class="py-1">13</div><div class="py-1">14</div><div class="py-1">15</div><div class="py-1">16</div><div class="py-1">17</div><div class="py-1">18</div>
                    <div class="py-1">19</div><div class="py-1">20</div><div class="py-1">21</div><div class="py-1">22</div>
                    <div class="py-1 bg-brand-500 text-white rounded-lg shadow-sm">23</div>
                    <div class="py-1 text-brand-400">24</div><div class="py-1">25</div>
                </div>
            </div>

            <!-- Scheduled List -->
            <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-3xl shadow-sm flex-1">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-800 tracking-tight">Scheduled</h3>
                    <a href="#" class="text-sm font-semibold text-slate-500 hover:text-brand-600">View all</a>
                </div>

                <div class="space-y-4">
                    <!-- Schedule Item 1 -->
                    <div class="bg-white/80 border border-white/80 p-4 rounded-2xl flex items-center gap-4 hover:shadow-sm transition-shadow cursor-pointer group">
                        <div class="w-10 h-10 rounded-xl overflow-hidden shadow-sm">
                            <img src="https://ui-avatars.com/api/?name=Dr+Mukasa&background=14b8a6&color=fff" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-brand-600 font-bold uppercase tracking-wider mb-0.5">Cardiology</p>
                            <h5 class="font-bold text-slate-800">Dr. Mukasa</h5>
                            <p class="text-xs text-slate-500 font-medium">10 Patients queued</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-sm font-bold text-slate-800 group-hover:text-brand-600 transition-colors">09:30 AM</span>
                        </div>
                    </div>

                    <!-- Schedule Item 2 -->
                    <div class="bg-white/80 border border-white/80 p-4 rounded-2xl flex items-center gap-4 hover:shadow-sm transition-shadow cursor-pointer group">
                        <div class="w-10 h-10 rounded-xl overflow-hidden shadow-sm">
                            <img src="https://ui-avatars.com/api/?name=Jane+Doe&background=3b82f6&color=fff" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mb-0.5">Dental</p>
                            <h5 class="font-bold text-slate-800">Dr. Jane</h5>
                            <p class="text-xs text-slate-500 font-medium">5 Patients queued</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-sm font-bold text-slate-800 group-hover:text-brand-600 transition-colors">11:00 AM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('activityChart');
            if(!ctx) return;
            const ctxContext = ctx.getContext('2d');
            
            // Create a gradient for the line chart fill
            let gradient = ctxContext.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(20, 184, 166, 0.5)'); // Brand color with opacity
            gradient.addColorStop(1, 'rgba(20, 184, 166, 0.0)');

            // PHP variables passed from controller
            const chartLabels = JSON.parse('@json($chartLabels ?? [])');
            const chartData = JSON.parse('@json($chartData ?? [])');

            new Chart(ctxContext, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Appointments',
                        data: chartData,
                        borderColor: '#14b8a6', // brand-500
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#14b8a6',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4 // Smooth curves like the screenshot
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 12,
                            titleFont: { size: 13, family: 'Inter' },
                            bodyFont: { size: 14, family: 'Inter', weight: 'bold' },
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' Appointments';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { color: '#64748b', font: { family: 'Inter', weight: '500' } }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(203, 213, 225, 0.3)',
                                drawBorder: false,
                                borderDash: [5, 5]
                            },
                            ticks: { 
                                stepSize: 1,
                                color: '#64748b', 
                                font: { family: 'Inter', weight: '500' } 
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            });
        });
    </script>
</x-app-layout>