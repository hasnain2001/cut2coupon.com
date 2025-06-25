<?php
header("X-Robots-Tag:index, follow");
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-layout-mode="detached">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Default Title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Default description')">
    <meta name="author" content="Coderthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="@yield('title')">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords', 'default, keywords')">
    <meta name="author" content="@yield('author', 'default, author')">
    <meta name="publisher" content="OBM TECH">
    <meta name="language" content="{{ app()->getLocale() }}">
    <meta name="copyright" content="OBM TECH">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
    <meta property="og:image:alt" content="@yield('title')">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Font Awesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-M+Q6o9Uq1Rl4TfVaJq7vNRF1LDbctavVmhXaC32B7+hP4A1fMK+F9uD+K2olXZzYpWHzv2FgZdbQFzZj4pA5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


    @stack('styles')
    @livewireStyles
</head>

<body class="bg-light">
    <!-- Begin page -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            @include('components.nav')

            <!-- Page Content -->
            <main class="py-4 text-capitalize">
                @yield('main')
            </main>

            @include('components.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- Scripts -->

    @livewireScripts
    <!-- JavaScript Libraries -->
    <script src="{{ asset('assets/js/navbar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
     @stack('scripts')
</body>
</html>
