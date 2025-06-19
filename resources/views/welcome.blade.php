@extends('layouts.welcome')

@section('title', 'Welcome to Our Platform')
@section('description', 'Explore our amazing stores and offers. Find the best products and services in one place.')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
<style>
    .hero-slide {
        position: relative;
        overflow: hidden;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .hero-slide img {
        width: 100%;
        height: 300px;
        object-fit: fill;
        transition: transform 0.5s ease;
    }

    .hero-slide:hover img {
        transform: scale(1.02);
    }

    .slide-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 2rem;
        color: white;
    }
    @media (max-width: 576px) {
        .hero-slide img {
            height: 200px;
        }
    }
    .hero-slide h2 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .store-card {
        transition: all 0.3s ease;
        height: 100%;
    }

    .store-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .store-image {
        height: 200px;
        object-fit: fill;
    }

    .swiper-button-prev,
    .swiper-button-next {
        background: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .swiper-button-prev::after,
    .swiper-button-next::after {
        font-size: 1rem;
        color: #333;
    }

    .section-title {
        position: relative;
        padding-bottom: 1rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(to right, #0d6efd, #6c757d);
    }
</style>
@endpush

@section('main')
<!-- Hero Slider Section -->
<section class="hero-slider py-0 bg-light">
    <div class="container">
        <div class="swiper heroSwiper rounded-3 overflow-hidden shadow-sm">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                <div class="swiper-slide hero-slide">
                    <a href="{{ $slider->link }}">
                        <img src="{{ $slider->image ? asset('uploads/slider/' . $slider->image) : asset('front/assets/images/no-image-found.jpg') }}"
                             alt="{{ $slider->title }}"
                             loading="lazy">
                        <div class="slide-overlay">
                            <h2 class="fw-bold mb-2">{{ $slider->title }}</h2>
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
<section class="stores-section py-2">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title display-5 fw-bold">Our Stores</h2>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                Discover our beautifully curated stores across the country
            </p>
        </div>

        <div class="swiper storesSwiper">
            <div class="swiper-wrapper pb-4">
                @foreach ($stores as $store)
                @php
                    $storeUrl = $store->slug ? route('store.detail', ['slug' => Str::slug($store->slug)]) : '#';
                @endphp

                <div class="swiper-slide">
                    <div class="card store-card border-0 shadow-sm h-100">
                        <div class="overflow-hidden" style="height: 200px;">
                            <img src="{{ $store->image ? asset('uploads/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                 class="img-fluid w-100 store-image"
                                 alt="{{ $store->name }}"
                                 loading="lazy"
                                 onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                        </div>
                        <div class="card-body">
                            <h3 class="h5 card-title fw-bold">{{ $store->name }}</h3>
                            <p class="card-text text-muted mb-3 line-clamp-2">{{ $store->description }}</p>
                            <a href="{{ $storeUrl }}" class="btn btn-primary stretched-link">
                                Visit Store <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- Featured coupon Section -->
<section class="featured-coupons py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title display-5 fw-bold">Featured Coupons</h2>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                Grab the best deals and discounts from our featured stores
            </p>
        </div>

        <div class="row g-4">
   @foreach ($coupons as $coupon)
   <div class="col-md-4">
       <div class="card h-100 border-0 shadow-sm">
         <img src="{{ $coupon->store->image ? asset('uploads/stores/' . $coupon->store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                 class="img-fluid w-100 store-image"
                                 alt="{{ $coupon->store->name }}"
                                 loading="lazy"
                                 onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
           <div class="card-body">
               <h5 class="card-title">{{ $coupon->name }}</h5>
               <p class="card-text text-muted">{{ $coupon->description }}</p>
               <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store->slug)]) }}" class="btn btn-primary">
                   View Store <i class="fas fa-arrow-right ms-2"></i>
               </a>
               <a href="{{ $coupon->store->destination_url }}" class="btn btn-secondary">
                  view deal <i class="fas fa-external-link-alt ms-2"></i>
               </a>
                  <a href="{{ $coupon->store->destination_url }}" class="btn btn-secondary">
                  activate coupons<i class="fas fa-external-link-alt ms-2"></i>
               </a>
           </div>
       </div>
   </div>
   @endforeach
        </div>
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
    });

    // Stores Slider
    const storesSwiper = new Swiper('.storesSwiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
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
