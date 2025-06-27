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
                        <i class="fas fa-list me-1"></i>Categories
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="text-center mb-5">
            <h1 class="display-6 fw-bold text-dark mb-3">{{ $category->name }} Stores</h1>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                {{ $category->description ?? 'Discover amazing products from our trusted partners' }}
            </p>
        </div>

        <!-- Store Grid -->
        <div class="row g-4 mb-5">
            @forelse ($stores as $store)
                @php
                    $storeUrl = $store->slug
                        ? route('store.detail', ['slug' => Str::slug($store->slug)])
                        : '#';
                @endphp

                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ $storeUrl }}" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
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

        <!-- Related Blogs Section -->
        @if($relatedblogs && $relatedblogs->count() > 0)
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 fw-bold mb-0">Related Articles</h2>
                    <a href="{{ route('blog') }}" class="btn btn-sm btn-outline-primary">
                        View All <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-4">
                    @foreach($relatedblogs as $blog)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow-lg transition-all">
                            <a href="{{ route('blog.detail', ['slug' => $blog->slug]) }}" class="text-decoration-none">
                                <div class="position-relative">
                                    <img src="{{ $blog->image ? asset('uploads/blogs/' . $blog->image) : asset('assets/images/no-image-found.png') }}"
                                         class="card-img-top rounded-top"
                                         alt="{{ $blog->name }}"
                                         style="height: 200px; object-fit: fill;"
                                         onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                                    <div class="position-absolute bottom-0 start-0">
                                        <span class="badge bg-primary bg-opacity-75 text-white m-2">
                                            {{ $blog->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-dark fw-semibold">{{ Str::limit($blog->name, 50) }}</h5>
                                    <p class="card-text text-muted small">{{ Str::limit(strip_tags($blog->description), 100) }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            {{ $blog->created_at->format('M d, Y') }}
                                        </small>
                                        <span class="text-primary small fw-semibold">
                                            Read More <i class="fas fa-arrow-right ms-1"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

@endsection

@push('styles')
<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }
    .hover-shadow:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }
    .transition-all {
        transition: all 0.3s ease;
    }
    .hover-shadow-lg:hover {
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        transform: translateY(-5px);
    }
</style>
@endpush
