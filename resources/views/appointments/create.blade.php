<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('appointments.index') }}" class="p-2 bg-white/40 hover:bg-white/80 border border-white/50 rounded-xl shadow-sm transition-colors text-slate-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-3xl text-slate-800 tracking-tight">
                {{ __('Book Appointment') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12">
        <div class="bg-white/50 backdrop-blur-2xl shadow-xl sm:rounded-[2.5rem] border border-white/60 p-8 sm:p-12 relative overflow-hidden">
            
            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf

                <!-- Section 1: Patient Details -->
                <div class="mb-10">
                    <h3 class="text-xl font-bold text-slate-800 tracking-tight mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-brand-100 text-brand-600 flex items-center justify-center text-sm">1</span>
                        Patient Selection
                    </h3>
                    
                    @if(Auth::user()->role === 'patient')
                        <input type="hidden" name="patient_id" value="{{ Auth::user()->patient->id ?? '' }}">
                        <div class="p-4 bg-white/60 rounded-2xl border border-white/80 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-100 text-brand-600 flex items-center justify-center font-bold text-lg shadow-sm border border-white/50">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs font-medium text-slate-500">Booking for yourself</p>
                            </div>
                        </div>
                    @else
                        <div>
                            <x-input-label for="patient_id" :value="__('Select Patient')" class="text-slate-700 font-bold mb-2" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <select id="patient_id" name="patient_id" class="block w-full pl-12 pr-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm" required>
                                    <option value="" disabled selected>-- Select a Patient --</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                            {{ $patient->first_name }} {{ $patient->last_name }} ({{ $patient->phone }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('patient_id')" class="mt-2" />
                        </div>
                    @endif
                </div>

                <div class="border-t border-slate-200/50 mb-10"></div>

                <!-- Section 2: Schedule & Doctor -->
                <div class="mb-10">
                    <h3 class="text-xl font-bold text-slate-800 tracking-tight mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm">2</span>
                        Doctor & Time
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Doctor Selection -->
                        <div>
                            <x-input-label for="doctor_id" :value="__('Select Doctor')" class="text-slate-700 font-bold mb-2" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <select id="doctor_id" name="doctor_id" class="block w-full pl-12 pr-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm" required>
                                    <option value="" disabled selected>-- Select a Doctor --</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                            {{ str_starts_with($doctor->user->name, 'Dr.') ? '' : 'Dr. ' }}{{ $doctor->user->name }} ({{ $doctor->department->name ?? 'General' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" />
                        </div>

                        <!-- Date Selection -->
                        <div>
                            <x-input-label for="appointment_date" :value="__('Date')" class="text-slate-700 font-bold mb-2" />
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <input type="date" id="appointment_date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}" class="block w-full pl-12 pr-4 py-3 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm" required>
                            </div>
                            <x-input-error :messages="$errors->get('appointment_date')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Dynamic Time Slots (AJAX Area) -->
                    <div id="time-slots-container" class="hidden">
                        <x-input-label :value="__('Available Time Slots')" class="text-slate-700 font-bold mb-3" />
                        
                        <div id="slots-loader" class="text-slate-500 text-sm flex items-center gap-2 mb-4 hidden">
                            <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Checking availability...
                        </div>

                        <!-- Slots Grid -->
                        <div id="slots-grid" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                            <!-- Slots will be injected here via JS -->
                        </div>
                        <input type="hidden" id="appointment_time" name="appointment_time" value="{{ old('appointment_time') }}" required>
                        <p id="no-slots-message" class="text-red-500 text-sm font-medium hidden mt-2">No slots available for this date. Please select another date.</p>
                        <x-input-error :messages="$errors->get('appointment_time')" class="mt-2" />
                    </div>

                </div>

                <div class="border-t border-slate-200/50 mb-10"></div>

                <!-- Section 3: Notes -->
                <div class="mb-10">
                    <h3 class="text-xl font-bold text-slate-800 tracking-tight mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-sm">3</span>
                        Additional Notes
                    </h3>

                    <div>
                        <x-input-label for="notes" :value="__('Reason for Visit (Optional)')" class="text-slate-700 font-bold mb-2" />
                        <textarea id="notes" name="notes" rows="3" class="block w-full p-4 border border-white/60 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 rounded-2xl bg-white/60 text-slate-700 backdrop-blur-sm transition-all shadow-sm resize-none" placeholder="Briefly describe the symptoms or reason for the appointment...">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 mt-8 pt-8 border-t border-slate-200/50">
                    <a href="{{ route('appointments.index') }}" class="px-6 py-3 bg-white/60 border border-white/80 text-slate-600 rounded-full text-sm font-bold hover:bg-white transition-colors shadow-sm">
                        Cancel
                    </a>
                    <button type="submit" class="px-8 py-3 bg-brand-600 text-white rounded-full text-sm font-bold shadow-lg shadow-brand-500/30 hover:bg-brand-500 hover:shadow-brand-500/50 transition-all flex items-center gap-2">
                        Confirm Booking
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- AJAX Script for Dynamic Slots (Exam Part C) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const doctorSelect = document.getElementById('doctor_id');
            const dateInput = document.getElementById('appointment_date');
            const timeContainer = document.getElementById('time-slots-container');
            const slotsGrid = document.getElementById('slots-grid');
            const timeInput = document.getElementById('appointment_time');
            const loader = document.getElementById('slots-loader');
            const noSlotsMsg = document.getElementById('no-slots-message');

            function fetchAvailableSlots() {
                const doctorId = doctorSelect.value;
                const date = dateInput.value;

                if (!doctorId || !date) {
                    timeContainer.classList.add('hidden');
                    return;
                }

                // Show container & loader
                timeContainer.classList.remove('hidden');
                loader.classList.remove('hidden');
                slotsGrid.innerHTML = '';
                noSlotsMsg.classList.add('hidden');
                timeInput.value = ''; // reset

                // Fetch API Call
                fetch(`/api/available-slots?doctor_id=${doctorId}&date=${date}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    loader.classList.add('hidden');
                    
                    if (data.available_slots && data.available_slots.length > 0) {
                        data.available_slots.forEach(slot => {
                            // Create button element
                            const btn = document.createElement('button');
                            btn.type = 'button';
                            btn.className = 'slot-btn py-2 px-3 border border-brand-200 bg-brand-50 hover:bg-brand-100 text-brand-700 text-sm font-bold rounded-xl transition-all shadow-sm';
                            
                            // Format 24h to 12h for display
                            const [hourString, minute] = slot.split(':');
                            const hour = parseInt(hourString, 10);
                            const ampm = hour >= 12 ? 'PM' : 'AM';
                            const hour12 = hour % 12 || 12;
                            btn.innerText = `${hour12}:${minute} ${ampm}`;
                            
                            btn.dataset.time = slot;
                            
                            // Handle click
                            btn.addEventListener('click', function() {
                                // Reset all buttons
                                document.querySelectorAll('.slot-btn').forEach(b => {
                                    b.classList.remove('bg-brand-600', 'text-white', 'shadow-brand-500/40', 'border-transparent');
                                    b.classList.add('bg-brand-50', 'text-brand-700', 'border-brand-200');
                                });
                                // Highlight selected
                                this.classList.remove('bg-brand-50', 'text-brand-700', 'border-brand-200');
                                this.classList.add('bg-brand-600', 'text-white', 'shadow-brand-500/40', 'border-transparent');
                                
                                // Set hidden input
                                timeInput.value = this.dataset.time;
                            });

                            slotsGrid.appendChild(btn);
                        });
                    } else {
                        noSlotsMsg.classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error fetching slots:', error);
                    loader.classList.add('hidden');
                });
            }

            doctorSelect.addEventListener('change', fetchAvailableSlots);
            dateInput.addEventListener('change', fetchAvailableSlots);

            // Trigger on load if old values exist
            if (doctorSelect.value && dateInput.value) {
                fetchAvailableSlots();
            }
        });
    </script>
</x-app-layout>