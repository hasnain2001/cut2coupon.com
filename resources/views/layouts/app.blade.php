
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
 <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
        @endif

        @livewireStyles
        <script src="//unpkg.com/alpinejs" defer></script>




    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

           <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

             @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
 @livewireScripts
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
        <!-- END wrapper -->
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="//unpkg.com/flowbite@1.4.0/dist/flowbite.min.js"></script>
        <script src="//unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    </body>
</html>
