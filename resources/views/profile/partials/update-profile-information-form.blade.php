<section class="bg-white p-6 rounded-xl shadow-md border border-gray-200 transition-all duration-300 hover:shadow-lg">
    <header>
        <h2 class="text-2xl font-semibold text-gray-800">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-700 font-medium mb-1" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error class="mt-2 text-sm text-red-600" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium mb-1" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />
          <!-- Image upload field -->


            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="text-sm text-gray-700">
                        {{ __('Your email address is unverified.') }}
                        <button
                            form="send-verification"
                            class="ml-1 underline text-indigo-600 hover:text-indigo-800 font-medium transition"
                        >
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 animate-pulse">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Save Button --}}
        <div class="flex items-center gap-4 pt-4">
            <x-primary-button class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-md transition">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition.duration.500ms
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-600 font-medium"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>


</section>
