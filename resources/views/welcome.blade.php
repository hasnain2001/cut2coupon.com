@extends('layouts.welcome')

@section('title', 'mybrand | Latest Discount Codes of 2025 |  Best Offers and Deals')
@section('description', 'Explore our amazing stores and offers. Find the best products and services in one place.')
@section('keywords', 'coupons, discount codes, best offers, deals')
@section('author', 'john doe')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endpush

@section('main')
<!-- Hero Slider Section -->
<section class="hero-slider" >
    <div class="container">
        <div class="swiper heroSwiper rounded-xl overflow-hidden shadow-lg">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                <div class="swiper-slide hero-slide">
                    <a href="{{ $slider->link }}" class="block h-full">
                        <img src="{{ $slider->image ? asset('uploads/slider/' . $slider->image) : asset('front/assets/images/no-image-found.jpg') }}"
                             alt="{{ $slider->title }}"
                             loading="lazy">
                        <div class="slide-overlay">
                            <h2 class="fw-bold mb-3">{{ $slider->title }}</h2>
                            <p class="mb-0">{{ $slider->description }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- Stores Section -->
<section class="stores-section section-spacing">
    <div class="container">
        <div class="text-center mb-10">
            <h2 class="section-title display-6 fw-bold">Our Featured Stores</h2>
            <p class="section-subtitle lead text-muted">
                Discover our beautifully curated stores offering the best products and services
            </p>
        </div>

        <div class="swiper storesSwiper">
            <div class="swiper-wrapper pb-5">
                @foreach ($stores as $store)
                @php
                    $storeUrl = $store->slug ? route('store.detail', ['slug' => Str::slug($store->slug)]) : '#';
                @endphp

                <div class="swiper-slide">
                    <div class="card store-card">
                        <div class="store-image-container">
                             <a href="{{ $storeUrl }}" class="text-decoration-none text-dark ">
                            <img src="{{ $store->image ? asset('uploads/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                 class="store-image"
                                 alt="{{ $store->name }}"
                                 loading="lazy"
                                 onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                        </div>
                        <div class="card-body">
                            <h3 class="h5 card-title fw-bold">{{ $store->name }}</h3>
                            <p class="card-text text-muted mb-4">{{ Str::limit($store->description, 100) }}</p>
                            <div class="d-flex justify-content-center">


                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- Featured Coupons Section -->
<section class="featured-coupons section-spacing bg-gradient-to-r from-purple-50 to-blue-50">
    <div class="container">
        <div class="text-center mb-10">
            <h3 class="section-title display-5 fw-bold">Exclusive Deals</h3>
            <p class="section-subtitle lead text-muted">
                Grab the best deals and discounts from our top stores
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach ($coupons as $coupon)
            <div class="col-lg-4 col-md-6">
                <div class="coupon-card">
                    <div class="coupon-image-container">
                        <img src="{{ $coupon->store->image ? asset('uploads/stores/' . $coupon->store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                             class="coupon-image"
                             alt="{{ $coupon->store->name }}"
                             loading="lazy"
                             onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                        <span class="coupon-badge">HOT DEAL</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $coupon->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($coupon->description, 120) }}</p>
                        <div class="coupon-actions">
                            <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store->slug)]) }}"
                               class="btn btn-primary btn-sm">
                                View Store
                            </a>
                            <a href="{{ $coupon->store->destination_url }}"
                               class="btn btn-outline-primary btn-sm">
                                Get Deal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- @if($coupons->count() > 0)
        <div class="text-center mt-5">
            <a href="{{ route('coupons.index') }}" class="btn btn-primary px-5 py-2">
                View All Coupons <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        @endif --}}
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hero Slider
        const heroSwiper = new Swiper('.heroSwiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
        });

        // Stores Slider
        const storesSwiper = new Swiper('.storesSwiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                576: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                992: { slidesPerView: 4 },
            }
        });
    });
</script>
@endpush
