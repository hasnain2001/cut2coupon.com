@extends('layouts.welcome')
@section('title','Cut2Coupon | Latest Discount Codes of ' . date('Y') . ' | Best Offers and Deals')
@section('description', 'Explore our amazing stores and offers. Find the best products and services in one place.')
@section('keywords', 'stores, offers, products, services')
@section('author', 'john doe')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endpush
@section('main')
<!-- Featured Couponsdeal Section -->
<section class="featured-coupons  bg-gradient-to-r from-purple-50 to-blue-50">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="section-title fw-bold display-7">@lang('welcome.H2') </h3>
            <p class="lead text-muted">@lang('welcome.p2')</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach ($coupons as $coupon)
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="text-center p-4 border-bottom">
                         <a href="{{  route('store.detail', ['slug' => Str::slug($coupon->store->slug)]) }}">
                        <img src="{{ $coupon->store->image ? asset('uploads/stores/' . $coupon->store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                             alt="{{ $coupon->store->name }}"
                             class="img-fluid mb-2"
                             style="height: 100px; object-fit: contain"
                             loading="lazy"
                             onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                         </a>
                    </div>

                    <div class="card-body">
                        <div class="mb-2">
                            <span class="badge bg-success rounded-pill"><i class="fas fa-check-circle me-1"></i> Verified</span>
                        </div>
                        <small class="text-muted small mb-2">{{ $coupon->store->name }}</small>
                        <h6 class="mb-1 fw-semibold">{{ $coupon->name }}</h6>
                        <p >{{$coupon->description}}</p>

                        <ul class="list-unstyled text-muted small mb-3">
                        <li>
                            <i class="far fa-calendar-alt me-1"></i>
                            <span class="{{ \Carbon\Carbon::parse($coupon->ending_date)->isPast() ? 'text-danger' : 'text-success' }}">
                                {{ \Carbon\Carbon::parse($coupon->ending_date)->isPast() ? 'Expired ' : '' }}
                                {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d M Y') }}
                            </span>
                        </li>
                            <li><i class="fas fa-user me-1"></i> {{ $coupon->clicks ?? 0 }} People Used</li>
                        </ul>

                          @if ($coupon->code)
                            <button class=" btn-code w-100 reveal-code"
                                onclick="handleRevealCode(event, {{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ asset('uploads/stores/' . $coupon->store->image) }}', '{{ $coupon->store->destination_url }}', '{{ $coupon->store->name }}')">
                                <i class="fas fa-ticket-alt me-2"></i> Get Code
                            </button>
                        @else
                            <a href="{{ $coupon->store->destination_url }}" target="_blank"
                                class=" btn-deal w-100"
                                onclick="updateClickCount({{ $coupon->id }})">
                                <i class="fas fa-shopping-bag me-2"></i> View Deal
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
   @if ($coupons->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $coupons->links('pagination::bootstrap-5') }}
    </div>
    @endif
    </div>
</section>
@endsection
