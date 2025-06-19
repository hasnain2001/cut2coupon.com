@extends('layouts.welcome')
@section('title','store')
@section('main')
    <div class="container py-5">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-light rounded px-3 py-2 mb-0 align-items-center">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}" class="text-decoration-none text-primary fw-semibold">
                <i class="fas fa-home me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item active d-flex align-items-center" aria-current="page">
                <span class="mx-2 text-muted">
                <i class="fas fa-chevron-right"></i>
                </span>
                Stores
            </li>
            </ol>
        </nav>

        <!-- Store Grid -->
        <div class="row g-4">
            @forelse ($stores as $store)
                @php
                    $storeUrl = $store->slug
                        ? route('store.detail', ['slug' => Str::slug($store->slug)])
                        : '#';
                @endphp

                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ $storeUrl }}" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm hover-shadow">
                            <div class="ratio ratio-1x1">
                                <img
                                    src="{{ $store->image ? asset('uploads/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                    onerror="this.src='{{ asset('front/assets/images/no-image-found.jpg') }}'"
                                    class="card-img-top object-fit-contain p-2"
                                    alt="{{ $store->name }}"
                                    loading="lazy"
                                >
                            </div>
                            <div class="card-body d-flex flex-column justify-content-end text-center">
                                <h5 class="card-title text-dark fw-semibold small">
                                    {{ $store->name ?: 'Title not found' }}
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <div>No stores found. Please check back later.</div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
