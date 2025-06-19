
    <nav class="navbar text-capitalize">
        <div class="navbar-container">
            <!-- Logo (Left Side) -->
            <a href="/" class="navbar-logo">
                <x-application-logo />
            </a>

            <!-- Mobile Menu Toggle -->
            <div class="navbar-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <!-- Centered Menu Items -->
            <ul class="navbar-menu">
                <li class="navbar-item">
                    <a href="/" class="navbar-links">Home</a>
                </li>
                <li class="navbar-item">
                    <a href="{{ route('about') }}" class="navbar-links">About</a>
                </li>
                <li class="navbar-item">
                    <a href="{{ route('stores') }}" class="navbar-links">stores</a>
                </li>
                <li class="navbar-item">
                    <a href="{{ route('category') }}" class="navbar-links">categories</a>
                </li>
                <li class="navbar-item">
                    <a href="{{ route('contact') }}" class="navbar-links">Contact Us</a>
                </li>
            </ul>

            <!-- Search Bar (Right Side) -->
            <div class="navbar-search">
                <input type="text" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>
    </nav>
