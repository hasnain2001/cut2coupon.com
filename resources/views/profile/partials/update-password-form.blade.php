<section class="bg-white p-6 rounded-lg shadow-md border border-gray-100">
    <header>
        <h2 class="text-xl font-semibold text-gray-800">
            {{ _('Update Password') }}
        </h2>

        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
            {{ _('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div x-data="{ show: false }" class="relative">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="block text-sm font-medium text-gray-700 mb-1" />
            <input
                :type="show ? 'text' : 'password'"
                id="update_password_current_password"
                name="current_password"
                autocomplete="current-password"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
            />
            <div class="absolute inset-y-0 right-3 top-8 flex items-center text-sm leading-5 cursor-pointer" @click="show = !show">
                <svg x-show="!show" class="w-5 h-5 text-gray-400 hover:text-gray-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <svg x-show="show" class="w-5 h-5 text-gray-400 hover:text-gray-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.943-9.542-7a10.05 10.05 0 012.367-4.364m2.94-2.106A9.955 9.955 0 0112 5c4.478 0 8.269 2.943 9.542 7a9.955 9.955 0 01-4.148 5.136M15 12a3 3 0 00-3-3m0 0a2.99 2.99 0 00-2.122.879m0 0L3 3"/>
                </svg>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-sm text-red-600" />
        </div>

        {{-- New Password --}}
        <div x-data="{ show: false }" class="relative">
            <x-input-label for="update_password_password" :value="__('New Password')" class="block text-sm font-medium text-gray-700 mb-1" />
            <input
                :type="show ? 'text' : 'password'"
                id="update_password_password"
                name="password"
                autocomplete="new-password"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
            />
            <div class="absolute inset-y-0 right-3 top-8 flex items-center text-sm leading-5 cursor-pointer" @click="show = !show">
                <svg x-show="!show" class="w-5 h-5 text-gray-400 hover:text-gray-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <svg x-show="show" class="w-5 h-5 text-gray-400 hover:text-gray-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.943-9.542-7a10.05 10.05 0 012.367-4.364m2.94-2.106A9.955 9.955 0 0112 5c4.478 0 8.269 2.943 9.542 7a9.955 9.955 0 01-4.148 5.136M15 12a3 3 0 00-3-3m0 0a2.99 2.99 0 00-2.122.879m0 0L3 3"/>
                </svg>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        {{-- Confirm Password --}}
        <div x-data="{ show: false }" class="relative">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="block text-sm font-medium text-gray-700 mb-1" />
            <input
                :type="show ? 'text' : 'password'"
                id="update_password_password_confirmation"
                name="password_confirmation"
                autocomplete="new-password"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
            />
            <div class="absolute inset-y-0 right-3 top-8 flex items-center text-sm leading-5 cursor-pointer" @click="show = !show">
                <svg x-show="!show" class="w-5 h-5 text-gray-400 hover:text-gray-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <svg x-show="show" class="w-5 h-5 text-gray-400 hover:text-gray-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.943-9.542-7a10.05 10.05 0 012.367-4.364m2.94-2.106A9.955 9.955 0 0112 5c4.478 0 8.269 2.943 9.542 7a9.955 9.955 0 01-4.148 5.136M15 12a3 3 0 00-3-3m0 0a2.99 2.99 0 00-2.122.879m0 0L3 3"/>
                </svg>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button
                type="submit"
                class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150"
            >
                {{ _('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition.duration.500ms
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-600 font-medium"
                >{{ _('Password updated successfully!') }}</p>
            @endif
        </div>
    </form>
</section>
