<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Patient') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/40 backdrop-blur-xl overflow-hidden shadow-lg sm:rounded-[2.5rem] border border-white/60">
                <div class="p-10 text-slate-900">
                    <form method="POST" action="{{ route('patients.store') }}" class="space-y-8" x-data="{ createAccount: false }">
                        @csrf

                        <!-- Personal Details -->
                        <div class="bg-white/50 backdrop-blur-sm p-8 rounded-3xl border border-white/60 shadow-sm">
                            <h3 class="text-xl font-bold text-slate-800 mb-6 border-b pb-3 border-slate-200/50 flex items-center gap-2">
                                <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Personal Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- First Name -->
                                <div>
                                    <x-input-label for="first_name" :value="__('First Name')" class="text-slate-700 font-semibold ml-1" />
                                    <x-text-input id="first_name" class="block mt-2 w-full py-3 px-4 border-slate-200/60 bg-white/60 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all shadow-sm" type="text" name="first_name" :value="old('first_name')" required autofocus />
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <x-input-label for="last_name" :value="__('Last Name')" class="text-slate-700 font-semibold ml-1" />
                                    <x-text-input id="last_name" class="block mt-2 w-full py-3 px-4 border-slate-200/60 bg-white/60 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all shadow-sm" type="text" name="last_name" :value="old('last_name')" required />
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>

                                <!-- Date of Birth -->
                                <div>
                                    <x-input-label for="date_of_birth" :value="__('Date of Birth')" class="text-slate-700 font-semibold ml-1" />
                                    <x-text-input id="date_of_birth" class="block mt-2 w-full py-3 px-4 border-slate-200/60 bg-white/60 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all shadow-sm" type="date" name="date_of_birth" :value="old('date_of_birth')" required />
                                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                                </div>

                                <!-- Gender -->
                                <div>
                                    <x-input-label for="gender" :value="__('Gender')" class="text-slate-700 font-semibold ml-1" />
                                    <select id="gender" name="gender" class="block mt-2 w-full py-3 px-4 border-slate-200/60 bg-white/60 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all shadow-sm" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Contact Details -->
                        <div class="bg-white/50 backdrop-blur-sm p-8 rounded-3xl border border-white/60 shadow-sm">
                            <h3 class="text-xl font-bold text-slate-800 mb-6 border-b pb-3 border-slate-200/50 flex items-center gap-2">
                                <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                Contact Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Phone -->
                                <div>
                                    <x-input-label for="phone" :value="__('Phone Number')" class="text-slate-700 font-semibold ml-1" />
                                    <x-text-input id="phone" class="block mt-2 w-full py-3 px-4 border-slate-200/60 bg-white/60 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all shadow-sm" type="text" name="phone" :value="old('phone')" required />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <!-- Emergency Contact -->
                                <div>
                                    <x-input-label for="emergency_contact" :value="__('Emergency Contact (Name & Phone)')" class="text-slate-700 font-semibold ml-1" />
                                    <x-text-input id="emergency_contact" class="block mt-2 w-full py-3 px-4 border-slate-200/60 bg-white/60 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all shadow-sm" type="text" name="emergency_contact" :value="old('emergency_contact')" />
                                    <x-input-error :messages="$errors->get('emergency_contact')" class="mt-2" />
                                </div>

                                <!-- Address -->
                                <div class="md:col-span-2">
                                    <x-input-label for="address" :value="__('Physical Address')" class="text-slate-700 font-semibold ml-1" />
                                    <textarea id="address" name="address" rows="3" class="block mt-2 w-full py-3 px-4 border-slate-200/60 bg-white/60 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all shadow-sm">{{ old('address') }}</textarea>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Patient Portal Access -->
                        <div class="bg-indigo-50/50 backdrop-blur-sm p-8 rounded-3xl border border-indigo-100/60 shadow-sm relative overflow-hidden">
                            <div class="absolute top-0 right-0 p-8 opacity-10">
                                <svg class="w-32 h-32 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            
                            <div class="flex items-center gap-4 mb-4 relative z-10">
                                <input type="checkbox" id="create_account" name="create_account" value="1" class="rounded-lg border-indigo-300 text-indigo-600 focus:ring-indigo-500 h-6 w-6 transition-all" x-model="createAccount">
                                <label for="create_account" class="font-bold text-lg text-indigo-900 cursor-pointer">Create Patient Portal Account</label>
                            </div>
                            <p class="text-sm font-medium text-indigo-700/70 mb-6 ml-10 relative z-10">Enable this to allow the patient to log in and view their appointments and medical history online.</p>
                            
                            <div x-show="createAccount" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-6 ml-10 border-l-4 border-indigo-200 pl-6 py-2 relative z-10">
                                <div>
                                    <x-input-label for="email" :value="__('Email Address')" class="text-indigo-900 font-semibold ml-1" />
                                    <x-text-input id="email" class="block mt-2 w-full py-3 px-4 border-white/80 bg-white/80 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-sm" type="email" name="email" :value="old('email')" :required="old('create_account')" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="password" :value="__('Password')" class="text-indigo-900 font-semibold ml-1" />
                                    <x-text-input id="password" class="block mt-2 w-full py-3 px-4 border-white/80 bg-white/80 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 transition-all shadow-sm" type="password" name="password" :required="old('create_account')" />
                                    <p class="text-xs font-semibold text-indigo-600/60 mt-2 ml-1">Minimum 8 characters</p>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-6 pt-6">
                            <a href="{{ route('patients.index') }}" class="text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">Cancel</a>
                            <button type="submit" class="inline-flex items-center px-8 py-4 bg-brand-600 border border-transparent rounded-full font-bold text-sm text-white uppercase tracking-wider hover:bg-brand-500 shadow-lg shadow-brand-500/30 hover:shadow-brand-500/50 transition-all duration-200">
                                {{ __('Register Patient') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>