@extends('layouts.welcome')

@section('title', 'Cut2Coupon | Latest Discount Codes of '. date('y') .' |  Best Offers and Deals')
@section('description', 'Explore our amazing stores and offers. Find the best products and services in one place.')
@section('keywords', 'coupons, discount codes, best offers, deals')
@section('author', 'john doe')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
<style>
:root {
    --imperial-blue: #00539C;
    --dark-blue: #002147;
    --white: #FFFFFF;
}

.btn-code, .btn-deal, .btn-welcome {
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transform: translateY(0);
    display: inline-block;
    text-align: center;
    text-decoration: none;
}

/* Code Button */
.btn-code {
    background-color: var(--imperial-blue);
    border: 2px dotted var(--dark-blue);
    color: white;
}

.btn-code:hover {
    background-color: var(--dark-blue);
    border-color: var(--imperial-blue);
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    animation: pulse 1.5s infinite;
}

/* Deal Button */
.btn-deal {
    background-color: var(--imperial-blue);
    color: white;
    border: 2px dotted var(--imperial-blue);
}

.btn-deal:hover {
    background-color: var(--imperial-blue);
    color: white;
    border-color: var(--dark-blue);
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 83, 156, 0.3);
}

.btn-deal::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: rgba(255, 255, 255, 0.1);
    transform: rotate(45deg);
    transition: all 0.6s ease;
    pointer-events: none;
}

.btn-deal:hover::before {
    left: 100%;
}

/* Welcome Button */
.btn-welcome {
    background-color: var(--imperial-blue);
    color: var(--white);
    border: none;
}

.btn-welcome:hover {
    background-color: var(--dark-blue);
    color: var(--white);
    animation: bounce 0.5s;
}

/* Animations */
@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(0, 83, 156, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(0, 83, 156, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(0, 83, 156, 0);
    }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

/* Ripple Effect */
.btn-code:after, .btn-deal:after, .btn-welcome:after {
    content: "";
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
    background-image: radial-gradient(circle, #fff 10%, transparent 10.01%);
    background-repeat: no-repeat;
    background-position: 50%;
    transform: scale(10, 10);
    opacity: 0;
    transition: transform .5s, opacity 1s;
}

.btn-code:active:after, .btn-deal:active:after, .btn-welcome:active:after {
    transform: scale(0, 0);
    opacity: .3;
    transition: 0s;
}

    .blog-section {
        position: relative;
        overflow: hidden;
    }

    .blog-card {
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .transition-scale {
        transition: transform 0.5s ease;
    }

    .blog-card:hover .transition-scale {
        transform: scale(1.05);
    }

    .blog-slider {
        padding-bottom: 40px;
    }

    .swiper-button-prev, .swiper-button-next {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .swiper-button-prev {
        left: 10px;
    }

    .swiper-button-next {
        right: 10px;
    }

    .swiper-button-prev:hover, .swiper-button-next:hover {
        background: #4e73df;
        color: white;
    }

    .object-cover {
        object-fit: cover;
    }

    .blog-share:hover {
        background: #4e73df;
        color: white;
    }

    .blog-bookmark:hover {
        background: #e74a3b;
        color: white;
    }

    @media (max-width: 768px) {
        .swiper-button-prev, .swiper-button-next {
            display: none;
        }
    }
    hr {
        border: dotted 2px #4e73df;
        height: 1px;
    }
</style>
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
<hr>
<!-- Stores Section -->
<section class="stores-section ">
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
<hr>
<!-- Featured Couponscode Section -->
<section class="featured-coupons  bg-gradient-to-r from-purple-50 to-blue-50">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="section-title fw-bold display-7">Latest Discount & Promo Codes</h3>
            <p class="lead text-muted">Grab the best deals and discounts from our top stores</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach ($couponscode as $coupon)
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="text-center p-4 border-bottom">
                        <img src="{{ $coupon->store->image ? asset('uploads/stores/' . $coupon->store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                             alt="{{ $coupon->store->name }}"
                             class="img-fluid mb-2"
                             style="height: 100px; object-fit: contain"
                             loading="lazy"
                             onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                    </div>

                    <div class="card-body">
                        <div class="mb-2">
                            <span class="badge bg-success rounded-pill"><i class="fas fa-check-circle me-1"></i> Verified</span>
                        </div>
                        <h6 class="mb-1 fw-semibold">{{ $coupon->store->name }}</h6>
                        <p class="text-muted small mb-2">{{ $coupon->name }}</p>

                        <ul class="list-unstyled text-muted small mb-3">
                            <li><i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($coupon->created_at)->format('d M Y') }}</li>
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

        @if($couponscode->count() > 0)
        <div class="text-center mt-5">
            <a href="{{ route('coupons.index') }}" class=" btn-welcome px-4 py-2">
                View All Coupons <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        @endif
    </div>
</section>
<hr>
<!-- Featured Couponsdeal Section -->
<section class="featured-coupons  bg-gradient-to-r from-purple-50 to-blue-50">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="section-title fw-bold display-7">Latest Discount & Promo Codes</h3>
            <p class="lead text-muted">Grab the best deals and discounts from our top stores</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach ($couponsdeal as $coupon)
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="text-center p-4 border-bottom">
                        <img src="{{ $coupon->store->image ? asset('uploads/stores/' . $coupon->store->image) : asset('front/assets/images/no-image-found.jpg') }}"
                             alt="{{ $coupon->store->name }}"
                             class="img-fluid mb-2"
                             style="height: 100px; object-fit: contain"
                             loading="lazy"
                             onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                    </div>

                    <div class="card-body">
                        <div class="mb-2">
                            <span class="badge bg-success rounded-pill"><i class="fas fa-check-circle me-1"></i> Verified</span>
                        </div>
                        <h6 class="mb-1 fw-semibold">{{ $coupon->store->name }}</h6>
                        <p class="text-muted small mb-2">{{ $coupon->name }}</p>

                        <ul class="list-unstyled text-muted small mb-3">
                            <li><i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($coupon->created_at)->format('d M Y') }}</li>
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

        @if($couponscode->count() > 0)
        <div class="text-center mt-5">
            <a href="{{ route('coupons.index') }}" class=" btn-welcome px-4 py-2">
                View All Coupons <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
        @endif
    </div>
</section>
<hr>
<!-- category Section -->
<section class="py-2 border-dotted">
    <div class="container border-dotted ">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Most Visited Categories</h2>
        </div>

        <div class="row justify-content-center g-2">
            @foreach ($categories as $category)
                @php
                    $categoryUrl = $category->slug ? route('category.detail', ['slug' => Str::slug($category->slug)]) : '#';
                    $image = $category->image
                        ? asset('uploads/categories/' . $category->image)
                        : asset('front/assets/images/no-image-found.jpg');
                @endphp

                <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
                    <a href="{{ $categoryUrl }}" class="text-decoration-none text-dark">
                        <div class="mb-2">
                            <img src="{{ $image }}"
                                 alt="{{ $category->name }}"
                                 class="img-fluid rounded-circle border p-2 shadow-sm"
                                 style="width: 60px; height: 60px; object-fit: contain;"
                                 onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                        </div>
                        <div class="fw-semibold small">{{ $category->name }}</div>
                    </a>
                </div>
            @endforeach
        </div>

        @if($categories->count() > 0)
            <div class="text-center mt-5">
                <a href="{{ route('category', ['lang' => app()->getLocale()]) }}" class=" btn-welcome px-4 py-2 shadow-sm">
                    View All Categories <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        @endif
    </div>
</section>
<hr>
<section class="blog-section py-1 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-3 d-inline-flex align-items-center">
                <i class="fas fa-newspaper me-2"></i>Latest Updates
            </span>
            <h3 class="fw-bold  mb-2">Discover Our Latest Blogs</h3>
              </div>

        <div class="position-relative">
            <div class="swiper-container blog-slider px-2 py-4">
                <div class="swiper-wrapper">
                    @foreach ($blogs as $blog)
                    <div class="swiper-slide">
                        <div class="card blog-card h-100 border-0 shadow-sm overflow-hidden">
                            <div class="card-img-top position-relative overflow-hidden" style="height: 200px;">
                               <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}">
                                <img src="{{ $blog->image ? asset('uploads/blogs/' . $blog->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                     alt="{{ $blog->title }}"
                                     class="img-fluid w-100 h-100 object-cover-fill transition-scale"
                                     loading="lazy"
                                     onerror="this.src='{{ asset('assets/images/no-image-found.png') }}'">
                                </a>
                                <div class="card-img-overlay d-flex align-items-end p-0">
                                    <span class="badge bg-primary position-absolute top-0 end-0 m-3">{{ $blog->category->name ?? 'General' }}</span>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <small class="text-muted">
                                        <i class="far fa-calendar-alt me-2"></i>{{ $blog->created_at->format('M d, Y') }}
                                    </small>
                                    <small class="text-muted ms-3">
                                        <i class="far fa-clock me-2"></i>{{ ceil(str_word_count($blog->description) / 200) }} min read
                                    </small>
                                </div>

                                <h5 class="card-title fw-bold mb-3">{{ $blog->name }}</h5>
                                <p class="card-text text-muted mb-4">{{ Str::limit(strip_tags($blog->description), 120) }}</p>

                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" class="btn btn-link text-primary p-0 text-decoration-none d-flex align-items-center">
                                        Read More <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                    <div class="d-flex">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation buttons -->
            <button class="swiper-button-prev blog-slider-prev">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="swiper-button-next blog-slider-next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="btn-welcome px-4 py-2">
                <i class="fas fa-book-open me-2"></i>View All Articles
            </a>
        </div>
    </div>
</section>
    <!-- Coupon Code Modal -->
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow border-0">
                <!-- Modal Header -->
                <div class="modal-header position-relative bg-primary text-white border-0 rounded-top-4">
                    <div class="position-absolute top-0 start-50 translate-middle mt-n4">
                        <span class="badge bg-danger px-3 py-2 shadow-sm">
                            <i class="fas fa-bolt me-1"></i> LIMITED TIME
                        </span>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body text-center py-4 px-5">
                    <!-- Logo -->
                    <div class="mb-4">
                        <img src="" alt="Brand Logo" id="storeImage" class="img-fluid rounded-circle shadow border-4 border-light" style="width: 80px; height: 80px; object-fit: contain;">
                    </div>
                    <!-- Title -->
                    <h5 class="fw-bold text-dark mb-3" id="couponName"></h5>
                    <!-- Coupon Code Section -->
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <p class="small text-muted mb-2">
                            <i class="fas fa-tag me-1"></i> YOUR COUPON CODE
                        </p>
                        <div class="d-flex justify-content-center align-items-center gap-2 mb-3">
                            <span id="couponCode" class="fw-bold fs-4 text-dark"></span>
                            <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard()">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <p id="copyMessage" class="small text-success fw-bold mb-0" style="display: none;">
                            <i class="fas fa-check-circle me-1"></i> Copied to clipboard!
                        </p>
                    </div>
                    <!-- Instructions -->
                    <p class="small text-muted mb-0">
                        <i class="fas fa-info-circle me-1"></i> Use this code at checkout on
                        <a href="" id="couponUrl" class="text-decoration-none fw-semibold text-dark"></a>
                    </p>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer bg-light rounded-bottom-4 justify-content-center">
                    <a href="" id="storeLink" target="_blank" class="btn-deal rounded-pill px-4">
                        <i class="fas fa-external-link-alt me-2"></i> Go to Store
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/welcom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include Swiper JS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Swiper
            const blogSwiper = new Swiper('.blog-slider', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                navigation: {
                    nextEl: '.blog-slider-next',
                    prevEl: '.blog-slider-prev',
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2,
                    },
                    992: {
                        slidesPerView: 3,
                    },
                    1200: {
                        slidesPerView: 4,
                    }
                }
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Bookmark functionality
            document.querySelectorAll('.blog-bookmark').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.classList.toggle('btn-outline-danger');
                    this.classList.toggle('btn-danger');
                    this.querySelector('i').classList.toggle('far');
                    this.querySelector('i').classList.toggle('fas');

                    const tooltip = bootstrap.Tooltip.getInstance(this);
                    if (this.classList.contains('btn-danger')) {
                        this.setAttribute('data-bs-original-title', 'Bookmarked');
                    } else {
                        this.setAttribute('data-bs-original-title', 'Bookmark');
                    }
                    tooltip.show();
                });
            });
        });
    </script>
    <script>
        let couponModal = null;

        document.addEventListener('DOMContentLoaded', function() {
            couponModal = new bootstrap.Modal(document.getElementById('couponModal'));
        });

        function handleRevealCode(event, couponId, couponCode, couponName, storeImage, destinationUrl, storeName) {
            event.preventDefault();

            // Update modal content
            document.getElementById('couponCode').textContent = couponCode;
            document.getElementById('couponName').textContent = couponName;
            document.getElementById('storeImage').src = storeImage;
            document.getElementById('couponUrl').href = destinationUrl;
            document.getElementById('couponUrl').textContent = storeName;
            document.getElementById('storeLink').href = destinationUrl;

            // Update click count
            updateClickCount(couponId);

            // Show modal
            if (couponModal) {
                couponModal.show();
                // Redirect to destination_url after showing modal
                setTimeout(function() {
                    window.open(destinationUrl, '_blank');
                }, 500); // Adjust delay as needed
            } else {
                window.open(destinationUrl, '_blank');
            }
        }

        function updateClickCount(couponId) {
            fetch('{{ route("update.clicks") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ coupon_id: couponId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const usedCountElement = document.getElementById('usedCount' + couponId);
                    if (usedCountElement) {
                        usedCountElement.innerHTML = `<i class="fas fa-users me-1"></i> ${data.clicks}`;
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function copyToClipboard() {
            const code = document.getElementById('couponCode').textContent;
            navigator.clipboard.writeText(code).then(() => {
                const copyMessage = document.getElementById('copyMessage');
                copyMessage.style.display = 'block';
                setTimeout(() => {
                    copyMessage.style.display = 'none';
                }, 3000);
            });
        }
    </script>
@endpush
