@extends('layouts.welcome')
@section('title', $blog->name . ' | ' . config('app.name'))
@section('description', 'Explore our latest blog post: ' . $blog->name . '. ' . $blog->description)
@section('keywords', $blog->keywords)
@section('author', $blog->author ?? 'Unknown')

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
                        <i class="fas fa-home me-1"></i>Category
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $blog->category->name ?? 'Uncategorized' }}
                </li>
            </ol>
        </nav>
        <!-- Blog Detail -->
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="ratio ratio-16x9">
                        <img src="{{ $blog->image ? asset('uploads/blogs/' . $blog->image) : asset('front/assets/images/no-image-found.jpg') }}"
                             alt="{{ $blog->name }}"
                             class="card-img-top object-fit-cover"
                             loading="lazy">
                    </div>
                    <div class="card-body">
                        <h1 class="card-title text-dark fw-bold mb-3">
                            {{ $blog->name }}
                        </h1>
                        <p class="card-text text-muted mb-4">
                            {{ $blog->description }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary bg-opacity-10 text-primary small">
                                {{ $blog->created_at->format('M d, Y') }}
                            </span>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary small">
                                {{ $blog->user->name ?? 'Unknown' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title text-dark fw-semibold mb-0">
                            Related Blogs
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($relatedBlogs as $relatedBlog)
                                <li class="list-group-item">
                                    <a href="{{ route('blog.detail', ['slug' => $relatedBlog->slug, 'lang' => app()->getLocale()]) }}"
                                       class="text-decoration-none text-dark">
                                        {{ $relatedBlog->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
