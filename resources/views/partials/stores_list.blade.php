@forelse ($stores as $store)
    @php
        $storeUrl = $store->slug
            ? route('store.detail', ['slug' => Str::slug($store->slug)])
            : '#';
    @endphp

    <a href="{{ $storeUrl }}" class="group block">
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 h-full overflow-hidden border border-gray-100">
            <div class="p-4 flex flex-col items-center h-full">
                <div class="relative w-full aspect-square mb-4">
                    <img
                        class="w-full h-full object-contain rounded-lg"
                        src="{{ $store->image ? asset('uploads/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                        loading="lazy"
                        alt="{{ $store->name }}"
                        onerror="this.src='{{ asset('front/assets/images/no-image-found.jpg') }}'"
                    >
                </div>
                <h3 class="text-lg font-medium text-gray-800 text-center group-hover:text-blue-600 transition-colors duration-200 mt-auto">
                    {{ $store->name ?: "Title not found" }}
                </h3>
            </div>
        </div>
    </a>
@empty
    <div class="col-span-full">
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        No stores found. Please check back later.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endforelse
