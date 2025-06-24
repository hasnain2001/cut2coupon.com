<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --imperial-blue: #00539C;
            --imperial-blue-dark: #003366;
            --imperial-blue-light: #1a75ff;
            --white: #ffffff;
            --off-white: #f5f5f5;
            --black: #333333;
            --gray-light: #e0e0e0;
            --gray-dark: #777;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            overflow-x: hidden;
        }

        .navbar {
            background-color: var(--imperial-blue);
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .navbar.sticky {
            background-color: var(--imperial-blue-dark);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
            transition: var(--transition);
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
            width: 100%;
            max-width: 1400px;
            padding: 0 2rem;
        }

        .navbar-logo {
            color: var(--white);
            text-decoration: none;
            display: flex;
            align-items: center;
            z-index: 1001;
            font-weight: 600;
            font-size: 1.3rem;
        }

        .navbar-logo .d-block {
            height: 2rem;
            width: auto;
            margin-right: 0.5rem;
        }

        /* Main Navigation */
        .navbar-menu {
            display: flex;
            list-style: none;
            align-items: center;
            margin: 0 auto;
        }

        .navbar-item {
            height: 80px;
            position: relative;
        }

        .navbar-links {
            color: var(--white);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 1.2rem;
            height: 100%;
            transition: var(--transition);
            position: relative;
            font-weight: 500;
        }

        .navbar-links:hover {
            color: var(--imperial-blue-light);
            transition: var(--transition);
        }

        /* Search Bar */
        .navbar-search {
            display: flex;
            align-items: center;
            margin-left: 1rem;
        }

        .navbar-search input {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 20px 0 0 20px;
            outline: none;
            width: 180px;
            transition: width 0.3s ease;
            font-size: 0.9rem;
        }

        .navbar-search input:focus {
            width: 220px;
        }

        .navbar-search button {
            background: var(--imperial-blue-light);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0 20px 20px 0;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .navbar-search button:hover {
            background: var(--imperial-blue-dark);
        }

        /* Right side navigation (login, language) */
        .navbar-right {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .navbar-right-item {
            height: 80px;
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Language Dropdown */
        .language-dropdown {
            position: relative;
        }

        .language-toggle {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0 1rem;
            height: 100%;
        }

        .language-toggle img {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 0.5rem;
        }

        .language-toggle i {
            margin-left: 0.5rem;
            font-size: 0.8rem;
            transition: var(--transition);
        }

        .language-dropdown-content {
            position: absolute;
            right: 0;
            top: 80px;
            background-color: var(--white);
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 8px 8px;
            z-index: 1000;
            display: none;
            overflow: hidden;
        }

        .language-dropdown-content a {
            color: var(--black);
            padding: 12px 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }

        .language-dropdown-content a:hover {
            background-color: var(--off-white);
            color: var(--imperial-blue);
        }

        .language-dropdown-content img {
            margin-right: 0.5rem;
        }

        .language-dropdown:hover .language-dropdown-content {
            display: block;
        }

        /* Mobile Toggle */
        .navbar-toggle {
            display: none;
            cursor: pointer;
            z-index: 1001;
            padding: 0.5rem;
            margin-left: 1rem;
        }

        .bar {
            display: block;
            width: 25px;
            height: 3px;
            margin: 5px auto;
            background-color: var(--white);
            transition: var(--transition);
        }

        /* Mega Dropdown Styles */
        .mega-dropdown {
            position: static;
        }

        .mega-content {
            position: absolute;
            left: 0;
            width: 100%;
            background-color: var(--white);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            display: none;
            z-index: 999;
            border-top: 1px solid var(--gray-light);
        }

        .mega-dropdown:hover .mega-content {
            display: block;
        }

        .mega-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .mega-col {
            flex: 1;
            min-width: 200px;
            padding: 0 1rem;
            margin-bottom: 1rem;
        }

        .mega-col h3 {
            color: var(--imperial-blue);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--gray-light);
        }

        .mega-col ul {
            list-style: none;
        }

        .mega-col li {
            margin-bottom: 0.5rem;
        }

        .mega-col a {
            color: var(--black);
            text-decoration: none;
            transition: var(--transition);
            display: block;
            padding: 0.3rem 0;
        }

        .mega-col a:hover {
            color: var(--imperial-blue-light);
            padding-left: 0.5rem;
        }

        /* Mobile Menu Styles */
        @media screen and (max-width: 1024px) {
            .navbar-container {
                padding: 0 1.5rem;
            }

            .navbar-menu {
                position: fixed;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100vh;
                background-color: var(--imperial-blue-dark);
                flex-direction: column;
                justify-content: flex-start;
                padding-top: 90px;
                transition: var(--transition);
                z-index: 998;
                overflow-y: auto;
            }

            .navbar-menu.active {
                left: 0;
            }

            .navbar-item {
                width: 100%;
                height: auto;
                padding: 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .navbar-links {
                text-align: left;
                padding: 1.2rem 1.5rem;
                width: 100%;
                justify-content: flex-start;
            }

            .navbar-links:hover {
                background-color: var(--imperial-blue-light);
                color: var(--white);
                padding-left: 2rem;
            }

            .navbar-right {
                display: none;
            }

            .navbar-toggle {
                display: block;
            }

            .navbar-toggle.active .bar:nth-child(1) {
                transform: translateY(8px) rotate(45deg);
            }

            .navbar-toggle.active .bar:nth-child(2) {
                opacity: 0;
            }

            .navbar-toggle.active .bar:nth-child(3) {
                transform: translateY(-8px) rotate(-45deg);
            }

            .navbar-search {
                display: none;
            }

            .mega-content {
                display: none !important;
            }

            /* Mobile dropdown indicator */
            .mega-dropdown .navbar-links::after {
                content: '+';
                margin-left: auto;
                font-size: 1.2rem;
            }

            .mega-dropdown .navbar-links.active::after {
                content: '-';
            }

            /* Language dropdown styles for mobile */
            .language-dropdown .language-toggle {
                padding: 1.2rem 1.5rem;
                width: 100%;
                justify-content: flex-start;
            }

            .language-dropdown-content {
                position: static;
                box-shadow: none;
                background-color: transparent;
                display: none;
                width: 100%;
            }

            .language-dropdown-content a {
                color: var(--white);
                padding: 0.8rem 2rem;
                opacity: 0.9;
            }

            .language-dropdown-content a:hover {
                background-color: transparent;
                color: var(--white);
                opacity: 1;
                padding-left: 2.5rem;
            }

            .language-dropdown:hover .language-dropdown-content {
                display: none;
            }
        }

        @media screen and (max-width: 768px) {
            .navbar-container {
                padding: 0 1rem;
            }

            .navbar-search input {
                width: 150px;
            }

            .navbar-search input:focus {
                width: 180px;
            }
        }

        /* Categories Modal */
        .categories-modal, .language-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1002;
            overflow-y: auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .categories-modal.active, .language-modal.active {
            display: block;
        }

        .modal-content {
            background-color: var(--white);
            border-radius: 8px;
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            position: relative;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-light);
        }

        .modal-header h2 {
            color: var(--imperial-blue);
            margin: 0;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--black);
            transition: var(--transition);
        }

        .close-modal:hover {
            color: var(--imperial-blue-light);
        }

        .modal-cols {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .modal-col {
            flex: 1;
            min-width: 200px;
        }

        .modal-col h3 {
            color: var(--imperial-blue);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--gray-light);
        }

        .modal-col ul {
            list-style: none;
        }

        .modal-col li {
            margin-bottom: 0.5rem;
        }

        .modal-col a {
            color: var(--black);
            text-decoration: none;
            transition: var(--transition);
            display: block;
            padding: 0.3rem 0;
        }

        .modal-col a:hover {
            color: var(--imperial-blue-light);
            padding-left: 0.5rem;
        }

        /* Language modal specific styles */
        .language-list {
            list-style: none;
        }

        .language-list li {
            margin-bottom: 1rem;
        }

        .language-list a {
            display: flex;
            align-items: center;
            color: var(--black);
            text-decoration: none;
            transition: var(--transition);
            padding: 0.5rem;
            border-radius: 4px;
        }

        .language-list a:hover {
            background-color: var(--off-white);
            color: var(--imperial-blue);
        }

        .language-list img {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            margin-right: 1rem;
        }

        /* No scroll when menu/modal is open */
        body.no-scroll {
            overflow: hidden;
            height: 100vh;
        }
    </style>
</head>
<body>

<nav class="navbar text-capitalize">
    <div class="navbar-container">
        <!-- Logo (Left Side) -->
        <a href="/" class="navbar-logo">
            <x-application-logo />
            <span>YourBrand</span>
        </a>

        <!-- Centered Menu Items -->
        <ul class="navbar-menu" id="navbarMenu">
            <li class="navbar-item">
                <a href="/" class="navbar-links">{{ __('message.home') }}</a>
            </li>
            <li class="navbar-item">
                <a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="navbar-links">About</a>
            </li>
            <li class="navbar-item">
                <a href="{{ route('stores', ['lang' => app()->getLocale()]) }}" class="navbar-links">@lang('message.brands')</a>

            </li>
            <li class="navbar-item mega-dropdown">
                <a href="{{ route('category') }}" class="navbar-links" id="categoriesLink">Categories <i class="fas fa-chevron-down" style="font-size: 0.8rem; margin-left: 0.3rem;"></i></a>
                <div class="mega-content">
                    <div class="mega-row">
                        <div class="mega-col">
                            <h3>Popular Categories</h3>
                            <ul>
                                @foreach ($categories->take(5) as $category)
                                    <li>
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
                                @foreach ($categories->slice(5, 5) as $category)
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
                                @foreach ($categories->slice(10, 5) as $category)
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
                                @foreach ($categories->slice(15, 5) as $category)
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
            </li>
            <li class="navbar-item">
                <a href="{{ route('contact') }}" class="navbar-links">Contact Us</a>
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

<!-- Categories Modal -->
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
                    @foreach ($categories->take(5) as $category)
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
                    @foreach ($categories->slice(5, 5) as $category)
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
                    @foreach ($categories->slice(10, 5) as $category)
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
                    @foreach ($categories->slice(15, 5) as $category)
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const navbarMenu = document.getElementById('navbarMenu');
        const body = document.body;

        // Categories modal elements
        const categoriesLink = document.getElementById('categoriesLink');
        const categoriesModal = document.getElementById('categoriesModal');
        const closeCategoriesModal = document.getElementById('closeCategoriesModal');

        // Language elements
        const languageToggle = document.getElementById('languageToggle');
        const languageModal = document.getElementById('languageModal');
        const closeLanguageModal = document.getElementById('closeLanguageModal');
        const languageDesktopDropdown = document.getElementById('languageDesktopDropdown');

        // Toggle mobile menu
        function toggleMenu() {
            navbarMenu.classList.toggle('active');
            mobileMenuToggle.classList.toggle('active');
            body.classList.toggle('no-scroll');
        }

        // Close mobile menu when clicking on a menu item
        function closeMenu(event) {
            if (!event.target.closest('.mega-dropdown') && !event.target.closest('.language-dropdown')) {
                navbarMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
                body.classList.remove('no-scroll');
            }
        }

        // Open categories modal on mobile
        function openCategoriesModal(event) {
            if (window.innerWidth <= 1024) {
                event.preventDefault();
                categoriesModal.classList.add('active');
                body.classList.add('no-scroll');
            }
        }

        // Close categories modal
        function closeCategoriesModalFunc() {
            categoriesModal.classList.remove('active');
            body.classList.remove('no-scroll');
        }

        // Open language modal on mobile
        function openLanguageModal(event) {
            if (window.innerWidth <= 1024) {
                event.preventDefault();
                languageModal.classList.add('active');
                body.classList.add('no-scroll');
            }
        }

        // Close language modal
        function closeLanguageModalFunc() {
            languageModal.classList.remove('active');
            body.classList.remove('no-scroll');
        }

        // Close modal when clicking outside
        function handleOutsideClick(event) {
            if (event.target === categoriesModal) {
                closeCategoriesModalFunc();
            }
            if (event.target === languageModal) {
                closeLanguageModalFunc();
            }
        }

        // Event listeners
        mobileMenuToggle.addEventListener('click', toggleMenu);

        // Close menu when clicking on regular links
        const navLinks = document.querySelectorAll('.navbar-links:not(.mega-dropdown .navbar-links)');
        navLinks.forEach(link => link.addEventListener('click', closeMenu));

        // Categories link
        if (categoriesLink) {
            categoriesLink.addEventListener('click', openCategoriesModal);
        }

        // Close categories modal button
        if (closeCategoriesModal) {
            closeCategoriesModal.addEventListener('click', closeCategoriesModalFunc);
        }

        // Language toggle
        if (languageToggle) {
            languageToggle.addEventListener('click', openLanguageModal);
        }

        // Close language modal button
        if (closeLanguageModal) {
            closeLanguageModal.addEventListener('click', closeLanguageModalFunc);
        }

        // Close modals when clicking outside
        document.addEventListener('click', handleOutsideClick);

        // Close menu when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const isClickInsideMenu = navbarMenu.contains(event.target);
            const isClickOnToggle = mobileMenuToggle.contains(event.target);

            if (!isClickInsideMenu && !isClickOnToggle && navbarMenu.classList.contains('active')) {
                toggleMenu();
            }
        });

        // Sticky navbar on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('sticky', window.scrollY > 0);
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024) {
                // Reset mobile menu if resized to desktop
                navbarMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
                body.classList.remove('no-scroll');
            }
        });

        // Close modals with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                if (categoriesModal.classList.contains('active')) {
                    closeCategoriesModalFunc();
                }
                if (languageModal.classList.contains('active')) {
                    closeLanguageModalFunc();
                }
            }
        });

        // Prevent desktop language dropdown from closing when clicking inside
        if (languageDesktopDropdown) {
            languageDesktopDropdown.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        }
    });
</script>
</body>
</html>
