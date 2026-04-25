<x-guest-layout>
    <div class="max-w-2xl w-full mx-auto animate-fade-in">
        
        <div class="mb-10 text-center md:text-left">
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight mb-2">Create Account</h2>
            <p class="text-slate-500 font-medium">Join CityCare to manage your health easily.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- First Name -->
                <div>
                    <x-input-label for="first_name" :value="__('First Name')" class="text-slate-700 font-semibold" />
                    <x-text-input id="first_name" class="block w-full mt-2 py-3 border-slate-200 bg-slate-50 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" placeholder="First Name" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <!-- Last Name -->
                <div>
                    <x-input-label for="last_name" :value="__('Last Name')" class="text-slate-700 font-semibold" />
                    <x-text-input id="last_name" class="block w-full mt-2 py-3 border-slate-200 bg-slate-50 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" placeholder="Last Name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
            </div>

            <!-- Date of Birth & Gender -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <x-input-label for="date_of_birth" :value="__('Date of Birth')" class="text-slate-700 font-semibold" />
                    <x-text-input id="date_of_birth" class="block w-full mt-2 py-3 border-slate-200 bg-slate-50 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all" type="date" name="date_of_birth" :value="old('date_of_birth')" required />
                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="gender" :value="__('Gender')" class="text-slate-700 font-semibold" />
                    <select id="gender" name="gender" class="block w-full mt-2 py-3 border-slate-200 bg-slate-50 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
            </div>

            <!-- Email Address & Phone -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <x-input-label for="phone" :value="__('Phone Number')" class="text-slate-700 font-semibold" />
                    <x-text-input id="phone" class="block w-full mt-2 py-3 border-slate-200 bg-slate-50 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all" type="text" name="phone" :value="old('phone')" required placeholder="e.g. 0700000000" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 font-semibold" />
                    <div class="relative mt-2">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                        </div>
                        <x-text-input id="email" class="block w-full pl-10 pr-3 py-3 border-slate-200 bg-slate-50 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <!-- Password & Confirm Password -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-semibold" />
                    <div class="relative mt-2">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <x-text-input id="password" class="block w-full pl-10 pr-3 py-3 border-slate-200 bg-slate-50 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" placeholder="••••••••" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-700 font-semibold" />
                    <div class="relative mt-2">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <x-text-input id="password_confirmation" class="block w-full pl-10 pr-3 py-3 border-slate-200 bg-slate-50 rounded-xl focus:ring-brand-500 focus:border-brand-500 transition-all"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <!-- Hidden Role Input (Defaults to patient for public registration) -->
            <input type="hidden" name="role" value="patient">

            <div class="mt-8">
                <button type="submit" class="w-full flex justify-center items-center px-4 py-3.5 bg-brand-600 border border-transparent rounded-xl font-bold text-white shadow-lg shadow-brand-500/30 hover:bg-brand-700 hover:shadow-brand-500/50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 transition-all duration-200">
                    {{ __('Create Account') }}
                </button>
            </div>

            <div class="mt-8 text-center text-sm text-slate-500">
                Already registered? 
                <a href="{{ route('login') }}" class="font-bold text-brand-600 hover:text-brand-500 transition-colors">Log in here</a>
            </div>
        </form>
    </div>
</x-guest-layout>
