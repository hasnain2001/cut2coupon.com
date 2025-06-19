@extends('layouts.welcome')
@section('title')
{{ $store->title }}
@endsection
@section('description')
{{ $store->description }}
@endsection


@section('main')
    <main class="container my-5">
        @php
        $codeCount = 0;
        $dealCount = 0;
        foreach ($coupons as $coupon) {
            if ($coupon->code) {
                $codeCount++;
            } else {
                $dealCount++;
            }
        }
        $totalCount = $codeCount + $dealCount;
        @endphp

        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url(app()->getLocale() . '/') }}" class="text-primary">Home</a></li>
                @if($store->category)
                    <li class="breadcrumb-item"><a href="{{ route('category.detail', ['slug' => Str::slug($store->category)]) }}" class="text-primary">{{ $store->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item"><a href="{{ route('stores') }}" class="text-primary">Stores</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $store->slug }}</li>
            </ol>
        </nav>

        <!-- Store Header -->
        <div class="text-center mb-5">
            <h1 class="display-4 font-weight-bold text-dark mb-3">{{ $store->name }}</h1>
            <p class="lead text-muted">Save more with the best deals and discounts!</p>
        </div>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-9">
                @if($coupons->isEmpty())
                    <div class="alert alert-warning text-center py-4">
                        <h4 class="alert-heading">Oops! No Coupons Available</h4>
                        <p class="mb-3">Don't worry, you can still explore amazing deals from our partnered brands.</p>
                        <a href="{{ route('stores') }}" class="btn btn-primary btn-lg">
                            Explore Brands <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                @else
                    <div class="row">
                        @foreach ($coupons as $coupon)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                                    <div class="card-body d-flex flex-column">
                                        <div class="text-center mb-4">
                                            <img src="{{ asset('uploads/stores/' . $store->image) }}" alt="{{ $store->name }}" class="img-fluid" style="max-height: 80px;">
                                        </div>

                                        <div class="flex-grow-1">
                                            <div class="border-top pt-3">
                                                <h5 class="card-title font-weight-bold">{{ $coupon->name }}</h5>
                                                <hr>
                                            </div>

                                            <p class="small mb-3 {{ strtotime($coupon->ending_date) < strtotime(now()) ? 'text-danger' : 'text-muted' }}">
                                                <i class="far fa-clock mr-1"></i> Ends: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d-m-Y') }}
                                            </p>


                                        </div>

            <div class="coupon-card">
                <!-- Your coupon card content here -->

                <div class="mt-auto pt-3">
                    @if ($coupon->code)
                        <button class="btn btn-primary btn-block py-2"
                        wire:click="showCouponModal({{ $coupon->id }}, '{{ addslashes($coupon->code) }}', '{{ addslashes($coupon->name) }}', '{{ asset('uploads/stores/' . $store->store_image) }}', '{{ addslashes($coupon->store->destination_url) }}', '{{ addslashes($coupon->store->name) }}')">
                            <span class="coupon-text">Activate Coupon</span>
                        </button>
                    @else
                        <a href="{{ $coupon->store->destination_url }}" target="_blank"
                        class="btn btn-success btn-block py-2">
                            View Deal
                        </a>
                    @endif

                    <span id="usedCount{{ $coupon->id }}">Used By: {{ $coupon->clicks }}</span>
                </div>

                @livewire('coupon-modal')
            </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($store->content)
                    <div class="mt-5 bg-white p-4 rounded shadow-sm">
                        {!! $store->content !!}
                    </div>
                @else
                    <div class="mt-5 text-center text-muted">No additional content available</div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        <img src="{{ asset('uploads/stores/' . $store->image) }}" alt="{{ $store->name }}" class="img-fluid rounded-circle shadow-sm mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #f8f9fa;">
                        <h4 class="card-title font-weight-bold">{{ $store->name }}</h4>
                        <div class="my-3">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= 4 ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                        <a href="{{ $store->destination_url }}" class="btn btn-primary btn-block mb-3">
                            Visit Store <i class="fas fa-external-link-alt ml-2"></i>
                        </a>

                        <p class="card-text text-muted mb-3">{{ $store->description }}</p>

                        @if($store->user)
                            <p class="small text-muted mb-3">Added by: <span class="font-weight-bold">{{ $store->user->name }}</span></p>
                        @endif

                        <div class="border-top pt-3 mb-3">
                            <h5 class="font-weight-bold">About {{ $store->name }}</h5>
                            <div class="bg-light p-3 rounded mt-2">
                                <p class="small text-muted mb-0">{{ $store->about }}</p>
                            </div>
                        </div>

                        <div class="border-top pt-3 mb-3">
                            <h5 class="font-weight-bold">Filter By Voucher Codes</h5>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <a href="{{ url()->current() }}" class="btn btn-sm btn-primary">All</a>
                                <a href="{{ url()->current() }}?sort=codes" class="btn btn-sm btn-primary">Codes</a>
                                <a href="{{ url()->current() }}?sort=deals" class="btn btn-sm btn-primary">Deals</a>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <h5 class="font-weight-bold">Summary</h5>
                            <ul class="list-unstyled mt-3">
                                <li class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">
                                        <i class="fas fa-tag text-primary mr-2"></i> Total Codes
                                    </span>
                                    <span class="badge badge-dark">{{ $codeCount }}</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">
                                        <i class="fas fa-shopping-bag text-primary mr-2"></i> Total Deals
                                    </span>
                                    <span class="badge badge-dark">{{ $dealCount }}</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">
                                        <i class="fas fa-file-alt text-primary mr-2"></i> Total
                                    </span>
                                    <span class="badge badge-dark">{{ $totalCount }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('styles')
    <style>
        .hover-shadow:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
        .breadcrumb-item.active {
            color: #6c757d;
        }
        .display-4 {
            font-size: 2.5rem;
        }
        @media (max-width: 768px) {
            .display-4 {
                font-size: 2rem;
            }
        }
    </style>
@endpush
