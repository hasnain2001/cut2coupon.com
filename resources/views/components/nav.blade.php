
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
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#categoriesModal">@lang('nav.cateories')</a></li>
            <li><a href="{{ route('contact', ['lang' => app()->getlocale()] ) }}">{{ __('nav.stores') }} {{ __('nav.contact') }}</a></li>
            <li><a href="{{ route('blog', ['lang' => app()->getLocale()]) }}">@lang('nav.blogs')</a></li>
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

