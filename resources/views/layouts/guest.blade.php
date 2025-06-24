<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-layout-mode="detached">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>

    <meta name="description" content="@yield('description', 'Default description')">
    <meta name="keywords" content="@yield('keywords', 'default, keywords')">
    <meta name="author" content="@yield('author', 'default, author')">
    <meta name="publisher" content="OBM TECH">
    <meta name="language" content="{{ app()->getLocale() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-M+Q6o9Uq1Rl4TfVaJq7vNRF1LDbctavVmhXaC32B7+hP4A1fMK+F9uD+K2olXZzYpWHzv2FgZdbQFzZj4pA5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
     <!-- CSS Assets -->
      <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    @stack('styles')
    @livewireStyles
</head>

<body>
    <div id="wrapper">

        <!-- Navbar -->
        @include('components.nav')

        <!-- Main Content -->
        <div class="content-page container-fluid py-4">
            <main>
                {{ $slot }}
            </main>
        </div>

    </div> <!-- End Wrapper -->

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/navbar.js') }}"></script>
    @livewireScripts
    @stack('scripts')
</body>
</html>
