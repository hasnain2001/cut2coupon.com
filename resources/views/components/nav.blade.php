<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap CSS -->

    <style>
        /* Navbar Styles */
        .navbar {
            background-color: #003366;
            color: white;
            padding: 0.8rem 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .logo{
            width: 200px;
            height:90px;
            padding-bottom: 20px;
            align-items: center;
        }
        .navbar-brand {
            margin-right: 1rem;
        }

        .navbar-nav .nav-link {
            color: white;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #1d488c;
            transform: translateY(-2px);
        }

        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Mobile Sidebar */
        .mobile-sidebar {
            position: fixed;
            top: 0;
            left: -300px;
            width: 280px;
            height: 100%;
            background-color: #fff;
            z-index: 1050;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
            transition: left 0.3s ease;
        }

        .mobile-sidebar.show {
            left: 0;
        }

        .mobile-sidebar .close-btn {
            background: none;
            border: none;
            font-size: 1.8rem;
            position: absolute;
            top: 15px;
            right: 20px;
            color: #333;
            cursor: pointer;
        }

        .mobile-sidebar ul {
            padding-top: 3rem;
        }

        .mobile-sidebar ul li {
            margin-bottom: 1rem;
        }

        .mobile-sidebar ul li a {
            color: #333;
            font-weight: 500;
            text-decoration: none;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 4px;
        }

        .mobile-sidebar ul li a:hover {
            background-color: #f8f9fa;
            color: #003366;
            transform: translateX(5px);
        }

        /* Overlay for sidebar */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* Mega Menu */
        .mega-dropdown .dropdown-menu {
            width: 100%;
            border: none;
            border-radius: 0;
            margin-top: 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .mega-menu .row {
            padding: 1rem;
        }

        .mega-menu h6 {
            color: #003366;
            font-weight: 600;
            border-bottom: 2px solid #003366;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .mega-menu ul li a {
            color: #555;
            padding: 0.3rem 0;
            display: block;
            transition: all 0.2s;
        }

        .mega-menu ul li a:hover {
            color: #003366;
            padding-left: 5px;
        }

        /* Search Form */
        .search-form {
            position: relative;
        }

        .search-form .form-control {
            border-radius: 20px;
            padding: 0.375rem 1.5rem 0.375rem 1rem;
            border: 1px solid #ced4da;
        }

        .search-form .btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
        }

        /* Language Selector */
        .language-selector .dropdown-toggle {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: white;
            border-radius: 20px;
            padding: 0.375rem 0.75rem;
        }

        .language-selector .dropdown-toggle:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .language-selector .dropdown-menu {
            min-width: 200px;
        }

        /* Modal Styles */
        .modal-header {
            background-color: #003366;
            color: white;
        }

        .modal-title {
            font-weight: 600;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .category-item {
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }

        .category-item img {
            margin-right: 1rem;
            object-fit: cover;
        }

        .category-item:hover {
            background-color: #f8f9fa;
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: #003366;
                padding: 1rem;
                margin-top: 0.5rem;
                border-radius: 0.25rem;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top text-capitalize text-nowrap">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ url(app()->getlocale().'/') }}">
                <x-application-logo class="logo" style=" width
                :200px; height:90px: padding-bottom:10px; " />
            </a>

            <!-- Language Selector (Mobile View) -->
            <div class="d-lg-none d-flex align-items-center me-3">
                <div class="dropdown language-selector">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('uploads/flags/' . $langs->firstWhere('code', app()->getLocale())->flag) }}" width="20" class="me-1">
                        {{ $langs->firstWhere('code', app()->getLocale())->name }}
                    </button>
                    <ul class="dropdown-menu">
                        @foreach ($langs as $lang)
                            <li>
                                <a class="dropdown-item" href="{{ url('/' . $lang->code) }}">
                                    <img src="{{ asset('uploads/flags/' . $lang->flag) }}" width="20" class="me-2">
                                    {{ $lang->name }} ({{ strtoupper($lang->code) }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Hamburger Icon -->
            <button class="navbar-toggler" type="button" id="openSidebarBtn">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Desktop Menu -->
            <div class="collapse navbar-collapse justify-content-center d-none d-lg-flex" id="navbarMenu">
                <ul class="navbar-nav mb-2 mb-lg-0 gap-5 " style="font-size: 1.15rem;">
                    <li class="nav-item"><a class="nav-link " href="{{ url(app()->getlocale().'/') }}">{{ __('nav.home') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('stores', ['lang' => app()->getLocale()]) }}">@lang('nav.stores')</a></li>
                    <li class="nav-item dropdown mega-dropdown position-static">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             @lang('nav.cateories')
                        </a>
                        <div class="dropdown-menu w-100 mt-0 border-0 shadow mega-menu" aria-labelledby="categoriesDropdown" style="left:0; right:0;">
                            <div class="row g-4">
                                @foreach ([0, 5, 10, 15] as $offset)
                                    <div class="col-md-3">
                                        <h6 class="fw-bold mb-3 text-primary">
                                            <i class="fas fa-star me-1"></i>
                                            {{ ['Popular Categories', 'Featured', 'New Arrivals', 'Special Offers'][$loop->index] }}
                                        </h6>
                                        <ul class="list-unstyled">
                                            @foreach ($navcategories->slice($offset, 5) as $category)
                                                <li class="mb-2">
                                                    <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}"
                                                       class="d-flex align-items-center text-decoration-none text-dark px-2 py-1 rounded hover-bg-light"
                                                       style="transition:background 0.2s;">
                                                        <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                                             alt="{{ $category->name }}"
                                                             class="rounded-circle me-2"
                                                             width="28" height="28"
                                                             style="object-fit:cover;">
                                                        <span>{{ $category->name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact', ['lang' => app()->getlocale()] ) }}">@lang('nav.contact')</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blog', ['lang' => app()->getLocale()]) }}">@lang('nav.blogs')</a></li>
                </ul>
            </div>

            <!-- Right Desktop Tools -->
            <div class="d-none d-lg-flex align-items-center gap-3">
                <form class="d-flex search-form" action="{{ route('search') }}" method="GET">
                    <input class="form-control form-control-sm" type="search" name="query" placeholder="@lang('nav.Search here') ">
                    <button class="btn btn-sm" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <div class="dropdown language-selector">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('uploads/flags/' . $langs->firstWhere('code', app()->getLocale())->flag) }}" width="20" class="me-1">
                        {{ $langs->firstWhere('code', app()->getLocale())->name }}
                    </button>
                    <ul class="dropdown-menu">
                        @foreach ($langs as $lang)
                            <li>
                                <a class="dropdown-item" href="{{ url('/' . $lang->code) }}">
                                    <img src="{{ asset('uploads/flags/' . $lang->flag) }}" width="20" class="me-2">
                                    {{ $lang->name }} ({{ strtoupper($lang->code) }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm"><i class="fas fa-user me-1"></i> @lang('nav.Dashboard')</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm"><i class="fas fa-user me-1"></i>@lang('nav.Login')</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Mobile Sidebar and Overlay -->
    <div id="sidebarOverlay" class="sidebar-overlay"></div>
    <div id="mobileSidebar" class="mobile-sidebar">
        <button id="closeSidebarBtn" class="close-btn">&times;</button>
        <ul class="list-unstyled">
            <li><a href="{{ url(app()->getlocale().'/') }}">{{ __('nav.home') }}</a></li>
            <li><a href="{{ route('stores', ['lang' => app()->getLocale()]) }}">{{ __('nav.stores') }}</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#categoriesModal">{{ __('nav.stores') }}</a></li>
            <li><a href="{{ route('contact', ['lang' => app()->getlocale()] ) }}">{{ __('nav.stores') }} {{ __('nav.contact') }}</a></li>
            <li><a href="{{ route('blog', ['lang' => app()->getLocale()]) }}">{{ __('nav.blog') }}</a></li>
            @auth
                <li><a href="{{ route('dashboard') }}"><i class="fas fa-user me-2"></i> @lang('nav.Dashboard')</a></li>
            @else
                <li><a href="{{ route('login') }}"><i class="fas fa-user me-2"></i>@lang('nav.Login')</a></li>
            @endauth
        </ul>
    </div>

    <!-- Categories Modal (Mobile Only) -->
    <div class="modal fade" id="categoriesModal" tabindex="-1" aria-labelledby="categoriesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoriesModalLabel">All Categories</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach ([0, 5, 10, 15] as $offset)
                            <div class="col-6 mb-4">
                                <h6 class="fw-bold">{{ ['Popular Categories', 'Featured', 'New Arrivals', 'Special Offers'][$loop->index] }}</h6>
                                <ul class="list-unstyled">
                                    @foreach ($navcategories->slice($offset, 5) as $category)
                                        <li class="mb-2">
                                            <a class="text-decoration-none text-dark d-flex align-items-center category-item" href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}">
                                                <img src="{{ asset('uploads/categories/' . $category->image) }}" class="rounded-circle me-2" width="30" height="30" alt="{{ $category->name }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile Sidebar Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const openBtn = document.getElementById('openSidebarBtn');
            const closeBtn = document.getElementById('closeSidebarBtn');

            // Open sidebar
            openBtn.addEventListener('click', function() {
                sidebar.classList.add('show');
                overlay.classList.add('show');
                document.body.style.overflow = 'hidden';
            });

            // Close sidebar
            closeBtn.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            });

            // Close sidebar when clicking on overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            });

            // Close sidebar when a link is clicked (optional)
            const sidebarLinks = sidebar.querySelectorAll('a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (!this.hasAttribute('data-bs-toggle')) {
                        sidebar.classList.remove('show');
                        overlay.classList.remove('show');
                        document.body.style.overflow = '';
                    }
                });
            });

            // Initialize Bootstrap modal
            const categoriesModal = new bootstrap.Modal(document.getElementById('categoriesModal'));

            // Function to toggle categories modal (if needed)
            window.toggleCategoriesModal = function() {
                categoriesModal.show();
            };
        });
    </script>
</body>
</html>
