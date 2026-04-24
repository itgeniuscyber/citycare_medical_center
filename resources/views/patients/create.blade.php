<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Patient') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <form method="POST" action="{{ route('patients.store') }}" class="space-y-8" x-data="{ createAccount: false }">
                        @csrf

                        <!-- Personal Details -->
                        <div>
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 border-b pb-2 border-slate-100">Personal Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- First Name -->
                                <div>
                                    <x-input-label for="first_name" :value="__('First Name')" />
                                    <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <x-input-label for="last_name" :value="__('Last Name')" />
                                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>

                                <!-- Date of Birth -->
                                <div>
                                    <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                    <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required />
                                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                                </div>

                                <!-- Gender -->
                                <div>
                                    <x-input-label for="gender" :value="__('Gender')" />
                                    <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm" required>
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
                        <div>
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 border-b pb-2 border-slate-100">Contact Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Phone -->
                                <div>
                                    <x-input-label for="phone" :value="__('Phone Number')" />
                                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <!-- Emergency Contact -->
                                <div>
                                    <x-input-label for="emergency_contact" :value="__('Emergency Contact (Name & Phone)')" />
                                    <x-text-input id="emergency_contact" class="block mt-1 w-full" type="text" name="emergency_contact" :value="old('emergency_contact')" />
                                    <x-input-error :messages="$errors->get('emergency_contact')" class="mt-2" />
                                </div>

                                <!-- Address -->
                                <div class="md:col-span-2">
                                    <x-input-label for="address" :value="__('Physical Address')" />
                                    <textarea id="address" name="address" rows="3" class="block mt-1 w-full border-gray-300 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm">{{ old('address') }}</textarea>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Patient Portal Access -->
                        <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                            <div class="flex items-center gap-3 mb-4">
                                <input type="checkbox" id="create_account" name="create_account" value="1" class="rounded border-gray-300 text-brand-600 focus:ring-brand-500 h-5 w-5" x-model="createAccount">
                                <label for="create_account" class="font-semibold text-slate-800 cursor-pointer">Create Patient Portal Account</label>
                            </div>
                            <p class="text-sm text-slate-500 mb-4 ml-8">Enable this to allow the patient to log in and view their appointments and medical history online.</p>
                            
                            <div x-show="createAccount" x-transition class="grid grid-cols-1 md:grid-cols-2 gap-6 ml-8 border-l-2 border-brand-200 pl-4 py-2">
                                <div>
                                    <x-input-label for="email" :value="__('Email Address')" />
                                    <x-text-input id="email" class="block mt-1 w-full bg-white" type="email" name="email" :value="old('email')" :required="old('create_account')" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" class="block mt-1 w-full bg-white" type="password" name="password" :required="old('create_account')" />
                                    <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4">
                            <a href="{{ route('patients.index') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">Cancel</a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-brand-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-brand-500 shadow-md transition ease-in-out duration-150">
                                {{ __('Register Patient') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>