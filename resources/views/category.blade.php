@extends('layouts.welcome')
@section('title','Category')
@section('description','hello world ')
@section('main')

<div class="bg-light min-vh-100 py-2">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white p-3 rounded shadow-sm">
                <li class="breadcrumb-item">
                    <a href="/" class="text-primary text-decoration-none fw-semibold">
                        <i class="fas fa-home me-1"></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="text-center mb-3">
            <h1 class="display-6 fw-bold text-dark mb-3">Explore Our Categories</h1>
            <p class="lead text-secondary mx-auto" style="max-width: 600px;">
                Discover a wide range of products organized for your convenience
            </p>
        </div>

        <!-- Categories Grid -->
        <div class="row g-4">
            @foreach ($categories as $category)
                @php
                    $storeurl = $category->slug
                        ? route('category.detail', ['slug' => Str::slug($category->slug), 'lang' => app()->getLocale()])
                        : '#';
                @endphp

                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ $storeurl }}" class="text-decoration-none">
                        <div class="card h-100 shadow-sm border-0 hover-shadow">
                            @if ($category->image)
                                <img
                                    src="{{ asset('uploads/categories/' . $category->image) }}"
                                    alt="{{ $category->title }}"
                                    class="card-img-top img-fluid shadow-lg"
                                    style="height: 160px; object-fit: fill;"
                                    loading="lazy"
                                >
                            @else
                                <div class="d-flex flex-column align-items-center justify-content-center bg-light text-muted" style="height: 160px;">
                                    <i class="fas fa-image fa-2x"></i>
                                    <span class="small mt-1">No image</span>
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title text-dark fw-semibold text-center text-nowrap ">
                                    {{ $category->name }}
                                </h5>
                                <div class="d-flex justify-content-end">
                                    <span class="badge bg-primary bg-opacity-10 text-primary small">Explore</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
