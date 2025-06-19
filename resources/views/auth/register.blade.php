<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-100 p-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-2xl overflow-hidden transition-all duration-300 transform hover:scale-[1.01]">
            <div class="bg-gradient-to-r from-indigo-600 to-blue-600 p-6 text-center">
                <h1 class="text-3xl font-bold text-white">Create Account</h1>
                <p class="mt-2 text-indigo-100">Join our community today</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="p-8 space-y-6">
                @csrf

                <!-- Name -->
                <div class="space-y-2">
                    <x-input-label for="name" :value="__('Name')" class="block text-sm font-medium text-gray-700" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="name" 
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                    type="text" 
                                    name="name" 
                                    :value="old('name')" 
                                    required 
                                    autofocus 
                                    autocomplete="name"
                                    placeholder="John Doe" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-600" />
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <x-text-input id="email" 
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    required 
                                    autocomplete="email"
                                    placeholder="you@example.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-gray-700" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="password" 
                                    class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                    type="password"
                                    name="password"
                                    required 
                                    autocomplete="new-password"
                                    placeholder="••••••••" />
                        <button type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-indigo-600 transition duration-200"
                                onclick="togglePasswordVisibility('password')">
                            <svg id="password-eye-icon" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                            <svg id="password-eye-off-icon" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-sm font-medium text-gray-700" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="password_confirmation" 
                                    class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                    type="password"
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password"
                                    placeholder="••••••••" />
                        <button type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-indigo-600 transition duration-200"
                                onclick="togglePasswordVisibility('password_confirmation')">
                            <svg id="confirm-password-eye-icon" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                            <svg id="confirm-password-eye-off-icon" class="h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-600" />
                </div>

                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition duration-200 hover:underline">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __('Register') }}
                        <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </x-primary-button>
                </div>
            </form>

            <div class="px-8 pb-6 text-center">
                <p class="text-sm text-gray-600">
                    By registering, you agree to our 
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-200">Terms of Service</a> 
                    and 
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-200">Privacy Policy</a>.
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(`${fieldId}-eye-icon`);
            const eyeOffIcon = document.getElementById(`${fieldId}-eye-off-icon`);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }
    </script>
</x-guest-layout>