
<!DOCTYPE html>
<html lang="en" data-layout-mode="detached">

    <head>
        <meta charset="utf-8" />
        <title> @yield('title') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="canonical" href="{{ url()->current() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <!-- Styles / Scripts -->
      @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else

        @endif

@livewireStyles

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

           <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

        @include('components.nav')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
                @livewireScripts
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="//unpkg.com/flowbite@1.4.0/dist/flowbite.min.js"></script>
        <script src="//unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    </body>
</html>
