

<nav class="navbar text-capitalize sticky-top">
    <div class="navbar-container">
        <!-- Logo (Left Side) -->
        <a href="{{ url(app()->getlocale().'/') }}" class="navbar-logo">
            <x-application-logo />
        </a>

        <!-- Centered Menu Items -->
        <ul class="navbar-menu" id="navbarMenu">
            <li class="navbar-item">
                <a href="/" class="navbar-links">{{ __('message.home') }}</a>
            </li>

            <li class="navbar-item">
                <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="navbar-links">@lang('message.brands')</a>

            </li>
            <li class="navbar-item mega-dropdown">
                <a href="{{ route('category', ['lang' => app()->getLocale()]) }}" class="navbar-links" id="categoriesLink">Categories <i class="fas fa-chevron-down" style="font-size: 0.8rem; margin-left: 0.3rem;"></i></a>
                <div class="mega-content">
                    <div class="mega-row">
                        <div class="mega-col">
                            <h3>Popular Categories</h3>
                            <ul>
                                @foreach ($navcategories->take(5) as $category)
                                    <li style="display: flex; align-items: center; gap: 8px;">
                                        <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="{{ $category->title }}"
                                            class="rounded-circle img-fluid"
                                            style="height: 24px; width: 24px; object-fit: cover;"
                                            loading="lazy">
                                        <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="mega-col">
                            <h3>Featured</h3>
                            <ul>
                                @foreach ($navcategories->slice(5, 5) as $category)
                                    <li>
                                        <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="mega-col">
                            <h3>New Arrivals</h3>
                            <ul>
                                @foreach ($navcategories->slice(10, 5) as $category)
                                    <li>
                                        <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="mega-col">
                            <h3>Special Offers</h3>
                            <ul>
                                @foreach ($navcategories->slice(15, 5) as $category)
                                    <li>
                                        <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>  </div>
            </li>
            <li class="navbar-item">
                <a href="{{ route('contact', ['lang' => app()->getlocale()] ) }}" class="navbar-links">Contact Us</a>
            </li>
             <li class="navbar-item">
                <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="navbar-links">Blogs</a>
            </li>
        </ul>

        <!-- Right Side Navigation -->
        <div class="navbar-right">
            <!-- Search Bar -->
            <div class="navbar-search">
                <input type="text" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </div>

              <!-- Language Selector -->
        <div class="navbar-right-item language-dropdown" id="languageDesktopDropdown">
            <div class="language-toggle" id="languageToggle">
                <img src="{{ asset('uploads/flags/' . $langs->firstWhere('code', app()->getLocale())->flag) }}" alt="{{ app()->getLocale() }}">
                <span class=" text-white">{{ $langs->firstWhere('code', app()->getLocale())->name }}</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="language-dropdown-content">
                @foreach ($langs as $lang)
                    <a href="{{ url('/' . $lang->code) }}" class="language-link">
                        <img src="{{ asset('uploads/flags/' . $lang->flag) }}" alt="{{ $lang->name }}" width="20" height="20">
                        {{ $lang->name }} ({{ strtoupper($lang->code) }})
                    </a>
                @endforeach
            </div>
        </div>

            <!-- Login Link -->
            <div class="navbar-right-item">
                @auth
                    <a href="{{ route('dashboard') }}" class="navbar-links">
                        <i class="fas fa-user"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="navbar-links">
                        <i class="fas fa-user"></i> Login
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Menu Toggle -->
        <div class="navbar-toggle" id="mobileMenuToggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </div>
</nav>

<!-- navCategories Modal -->
<div class="categories-modal" id="categoriesModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>All Categories</h2>
            <button class="close-modal" id="closeCategoriesModal">&times;</button>
        </div>
        <div class="modal-cols">
            <div class="modal-col">
                <h3>Popular Categories</h3>
                <ul>
                    @foreach ($navcategories->take(5) as $category)
                        <li>
                            <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-col">
                <h3>Featured</h3>
                <ul>
                    @foreach ($navcategories->slice(5, 5) as $category)
                        <li>
                            <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-col">
                <h3>New Arrivals</h3>
                <ul>
                    @foreach ($navcategories->slice(10, 5) as $category)
                        <li>
                            <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-col">
                <h3>Special Offers</h3>
                <ul>
                    @foreach ($navcategories->slice(15, 5) as $category)
                        <li>
                            <a href="{{ route('category.detail', ['slug' => Str::slug($category->slug)]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

