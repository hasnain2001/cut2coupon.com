<footer class="bg-dark text-white pt-5 pb-3 shadow-lg text-capitalize">
    <div class="container">
        <!-- Main Footer Content -->
        <div class="row">
            <!-- Company Info -->
            <div class="col-md-3 mb-4">
                  <a class="navbar-brand" href="{{ url(app()->getlocale().'/') }}">
                <x-application-logo class="logo" />
                  </a>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white text-decoration-none fs-4 rounded-circle bg-white bg-opacity-25 p-2 transition-hover" style="transition:.2s;">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none fs-4 rounded-circle bg-white bg-opacity-25 p-2 transition-hover" style="transition:.2s;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none fs-4 rounded-circle bg-white bg-opacity-25 p-2 transition-hover" style="transition:.2s;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none fs-4 rounded-circle bg-white bg-opacity-25 p-2 transition-hover" style="transition:.2s;">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>

            <!-- Info Links -->
            <div class="col-md-3 mb-4">
                <h3 class="h5 mb-3 fw-bold text-white">@lang('nav.Info Links')</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('about', ['lang' => app()->getLocale()]) }}" class="text-white-50 text-decoration-none link-hover">@lang('nav.about')</a></li>
                    <li class="mb-2"><a href="{{ route('contact', ['lang' => app()->getLocale()]) }}" class="text-white-50 text-decoration-none link-hover">@lang('nav.contact')</a></li>
                    <li class="mb-2"><a href="{{ route('privacy', ['lang' => app()->getLocale()]) }}" class="text-white-50 text-decoration-none link-hover">@lang('nav.Privacy Policy')</a></li>
                    <li class="mb-2"><a href="{{ route('terms', ['lang' => app()->getLocale()]) }}" class="text-white-50 text-decoration-none link-hover">@lang('nav.Terms of Service')</a></li>
                    <li class="mb-2"><a href="{{ route('imprint', ['lang' => app()->getLocale()]) }}" class="text-white-50 text-decoration-none link-hover">@lang('nav.Imprint')</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="col-md-3 mb-4">
                <h3 class="h5 mb-3 fw-bold text-white">@lang('nav.Quick Links')</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ url(app()->getlocale().'/') }}" class="text-white-50 text-decoration-none link-hover">@lang('nav.home')</a></li>
                    <li class="mb-2"><a href="{{ route('stores',['lang' => app()->getLocale()]) }}" class="text-white-50 text-decoration-none link-hover">@lang('nav.stores')</a></li>
                    <li class="mb-2"><a href="{{ route('coupons',['lang' => app()->getLocale()]) }}" class="text-white-50 text-decoration-none link-hover">@lang('nav.Coupons')</a></li>
                    <li class="mb-2"><a href="{{ route('category',['lang' => app()->getLocale()]) }}" class="text-white-50 text-decoration-none link-hover">@lang('nav.cateories')</a></li>
                    <li class="mb-2"><a href="{{ route('blog',['lang' => app()->getLocale()]) }}" class="text-white-50 text-decoration-none link-hover">@lang('nav.blogs')</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-3 mb-4">
                <h3 class="h5 mb-3 fw-bold text-white">@lang('nav.contact')</h3>
                <ul class="list-unstyled text-white-50">
                    <li class="mb-2 d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-2 text-white"></i>
                        123 Street, City, Country
                    </li>
                    <li class="mb-2 d-flex align-items-center">
                        <i class="fas fa-phone-alt me-2 text-white"></i>
                        +1 234 567 890
                    </li>
                    <li class="mb-2 d-flex align-items-center">
                        <i class="fas fa-envelope me-2 text-white"></i>
                        info@example.com
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="border-top border-secondary mt-4 pt-3">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <p class="text-white-50 small mb-0">
                        &copy; {{ date('y') }} @lang('nav.Company Name. All rights reserved')
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex gap-3 justify-content-md-end">
                        <a href="{{ route('privacy', ['lang' => app()->getLocale()] ) }}" class="text-white-50 small text-decoration-none link-hover">@lang('nav.Privacy Policy')</a>
                        <a href="{{ route('terms', ['lang' => app()->getLocale()]) }}" class="text-white-50 small text-decoration-none link-hover">@lang('nav.Terms of Service')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


