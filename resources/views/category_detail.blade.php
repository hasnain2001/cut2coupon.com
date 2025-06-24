@extends('layouts.welcome')
@section('title')
{{ $category->title }}
@endsection
@section('description')
{{ $category->description }}
@endsection

@section('main')

<div class="bg-light min-vh-100 py-0">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white p-3 rounded shadow-sm">
                <li class="breadcrumb-item">
                    <a href="/" class="text-primary text-decoration-none fw-semibold">
                        <i class="fas fa-home me-1"></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('category') }}" class="text-primary text-decoration-none fw-semibold">
                        <i class="fas fa-home me-1"></i>category
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-dark mb-3">Featured Stores</h1>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                Discover amazing products from our trusted partners
            </p>
        </div>

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
                            <div class="p-3 d-flex align-items-center justify-content-center" style="height: 160px; background-color: #f8f9fa;">
                                <img
                                    src="{{ $store->image ? asset('uploads/stores/' . $store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                    class="img-fluid object-fit-contain"
                                    alt="{{ $store->name }}"
                                    style="max-height: 100%; max-width: 100%;"
                                    onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'"
                                    loading="lazy"
                                >
                            </div>
                            <div class="card-body text-center">
                                <h6 class="card-title fw-semibold text-dark text-truncate" title="{{ $store->name }}">
                                    {{ $store->name ?: 'Store Name' }}
                                </h6>
                                <div>
                                    <span class="badge bg-primary bg-opacity-10 text-primary small">
                                        Visit Store
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center border rounded-3 p-5 bg-white shadow-sm">
                        <div class="mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 60px; height: 60px;">
                                <i class="fas fa-store fa-lg"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold text-dark">No Stores Available</h4>
                        <p class="text-muted mb-3">
                            We're working on adding new stores. Please check back soon!
                        </p>
                        <a href="/" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-1"></i> Return Home
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
