<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Enhanced Profile Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                <!-- Gradient Header with Improved Visual Hierarchy -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 text-white">
                    <div class="flex items-center space-x-4">
                        <!-- Profile Picture with Smooth Transition -->
                        <div class="relative group">
                            <div class="h-24 w-24 rounded-full border-4 border-white/80 bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden transition-all duration-300 group-hover:border-white">
                                @if(Auth::user()->image)
                                    <img src="{{ asset('uploads/user/' . Auth::user()->image) }}" alt="{{ Auth::user()->name }}" class="h-full w-full object-fill">
                                @else
                                    <span class="text-3xl text-gray-600 dark:text-gray-300 font-bold">
                                <img src="{{ asset('assets/images/users/user-5.jpg') }}" alt="default-image" class="rounded-circle">
                                    </span>
                                @endif
                            </div>
                            <a href="{{ route('profile.edit') }}" class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow-md text-indigo-600 hover:bg-gray-50 transition transform hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>
                        </div>

                        <!-- User Info with Better Typography -->
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold tracking-tight">{{ Auth::user()->name }}</h1>
                            <p class="text-indigo-100">{{ Auth::user()->email }}</p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-white/20 rounded-full text-sm backdrop-blur-sm">
                                    Member since {{ Auth::user()->created_at->format('M Y') }}
                                </span>
                                @if(Auth::user()->email_verified_at)
                                    <span class="px-3 py-1 bg-white/20 rounded-full text-sm flex items-center backdrop-blur-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Verified
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Content with Refined Layout -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Personal Info Section -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Personal Information</h3>
                            <div class="space-y-4">
                                <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Full Name</p>
                                    <p class="text-gray-900 dark:text-white font-medium mt-1">{{ Auth::user()->name }}</p>
                                </div>
                                <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email Address</p>
                                    <p class="text-gray-900 dark:text-white font-medium mt-1">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="p-3 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Account Created</p>
                                    <p class="text-gray-900 dark:text-white font-medium mt-1">{{ Auth::user()->created_at->format('F j, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Account Actions with Hover Effects -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">Account Actions</h3>
                            <div class="space-y-3">
                                <a href="{{ route('profile.edit') }}" class="flex items-center p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 hover:shadow-sm">
                                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-300 mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">Update Profile</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Change your personal information</p>
                                    </div>
                                </a>

                                <a href="{{ route('profile.edit') }}" class="flex items-center p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 hover:shadow-sm">
                                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-300 mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">Change Password</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Update your account password</p>
                                    </div>
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 hover:shadow-sm">
                                        <div class="p-3 rounded-full bg-red-100 dark:bg-red-900/50 text-red-600 dark:text-red-300 mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-white">Logout</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Sign out of your account</p>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
