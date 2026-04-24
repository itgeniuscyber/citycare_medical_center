<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-slate-800 tracking-tight">
            Good Morning, {{ explode(' ', Auth::user()->name)[0] }} 👋
        </h2>
        <p class="text-slate-500 font-medium mt-1">Here is your billing and revenue overview.</p>
    </x-slot>

    <!-- Dashboard Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        
        <!-- Stat Card 1 -->
        <div class="bg-gradient-to-br from-brand-400 to-brand-600 p-5 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 relative overflow-hidden group text-white">
            <div class="absolute -right-6 -top-5 w-24 h-24 bg-white/20 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>
            <div class="flex justify-between items-start mb-4 relative z-10">
                <div class="w-10 h-10 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <h4 class="text-brand-100 font-semibold mb-1 relative z-10">Today's Revenue</h4>
            <p class="text-3xl font-extrabold relative z-10 tracking-tight"><span class="text-2xl font-semibold opacity-80 mr-1">UGX</span>{{ number_format($stats['today_revenue']) }}</p>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-2xl shadow-sm hover:shadow-md hover:bg-white/80 transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="bg-white/60 text-slate-500 text-xs font-bold px-3 py-1 rounded-full border border-white/50">Pending</span>
            </div>
            <h4 class="text-slate-500 font-semibold mb-1">Unpaid Invoices</h4>
            <div class="flex items-end justify-between">
                <p class="text-3xl font-extrabold text-slate-800">{{ $stats['pending_payments'] }}</p>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-2xl shadow-sm hover:shadow-md hover:bg-white/80 transition-all duration-300 group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <span class="bg-white/60 text-slate-500 text-xs font-bold px-3 py-1 rounded-full border border-white/50">Total</span>
            </div>
            <h4 class="text-slate-500 font-semibold mb-1">Total Transactions</h4>
            <div class="flex items-end justify-between">
                <p class="text-3xl font-extrabold text-slate-800">{{ $stats['total_transactions'] }}</p>
            </div>
        </div>

    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        
        <!-- Left Column -->
        <div class="lg:col-span-2 flex flex-col gap-5">
            <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-slate-800 tracking-tight">Recent Transactions</h3>
                    <a href="{{ route('payments.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">View All</a>
                </div>
                
                <div class="space-y-4">
                    @forelse($recent_payments as $payment)
                        <div class="bg-white/80 border border-white/80 p-4 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:shadow-sm transition-shadow">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl {{ $payment->status == 'completed' ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600' }} flex items-center justify-center font-bold text-lg shadow-sm border border-white/50">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-800">{{ $payment->patient->first_name }} {{ $payment->patient->last_name }}</h5>
                                    <p class="text-xs text-slate-500 font-medium">{{ $payment->created_at->diffForHumans() }} &bull; {{ ucfirst($payment->payment_method) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-5">
                                <div class="text-right">
                                    <p class="text-sm font-bold text-slate-800">UGX {{ number_format($payment->amount) }}</p>
                                </div>
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-orange-100 text-orange-700 border-orange-200',
                                        'completed' => 'bg-green-100 text-green-700 border-green-200',
                                        'failed' => 'bg-red-100 text-red-700 border-red-200',
                                    ];
                                    $class = $statusClasses[$payment->status] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full border {{ $class }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 text-sm py-4">No recent transactions found.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="flex flex-col gap-5">
            <!-- New Revenue Chart -->
            <div class="bg-white/60 backdrop-blur-xl border border-white/80 p-5 rounded-3xl shadow-sm">
                <h3 class="text-xl font-bold text-slate-800 tracking-tight mb-6">Revenue by Method</h3>
                <div class="relative h-48 w-full flex items-center justify-center">
                    <canvas id="revenuePieChart"></canvas>
                </div>
            </div>

            <div class="bg-gradient-to-br from-slate-700 to-slate-900 p-5 rounded-3xl shadow-md relative overflow-hidden group text-white">
                <div class="absolute -right-6 -top-5 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-500"></div>
                <h3 class="text-xl font-bold mb-2 relative z-10">Cashier Actions</h3>
                <p class="text-slate-300 text-sm mb-6 relative z-10">Manage billing and invoices.</p>
                
                <div class="flex flex-col gap-3 relative z-10">
                    <a href="{{ route('payments.create') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-md p-4 rounded-2xl flex items-center gap-3 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-white text-slate-800 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <span class="font-semibold">Record New Payment</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenuePieChart');
            if(!ctx) return;

            // Data passed from controller
            const revenueData = JSON.parse('@json($revenueByMethod ?? [])');
            
            // Format labels and data
            const labels = Object.keys(revenueData).map(method => {
                // Capitalize and format (e.g. mobile_money -> Mobile Money)
                return method.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
            });
            const data = Object.values(revenueData);

            if(data.length === 0) {
                // Fallback if no data
                ctx.parentElement.innerHTML = '<p class="text-slate-400 text-sm font-medium text-center">No revenue data available yet.</p>';
                return;
            }

            new Chart(ctx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            '#14b8a6', // brand-500
                            '#3b82f6', // blue-500
                            '#f97316', // orange-500
                            '#8b5cf6'  // violet-500
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: { family: 'Inter', size: 12, weight: '600' },
                                color: '#64748b'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 12,
                            titleFont: { size: 13, family: 'Inter' },
                            bodyFont: { size: 14, family: 'Inter', weight: 'bold' },
                            callbacks: {
                                label: function(context) {
                                    let value = context.raw || 0;
                                    return ' UGX ' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>