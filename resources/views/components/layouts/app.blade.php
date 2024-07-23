<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Base Laravel 10')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <!-- End fonts -->

        <!-- core:css -->
        <link rel="stylesheet" href="{{ asset('../assets/vendors/core/core.css')}}">
        <!-- endinject -->

        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('../assets/vendors/flatpickr/flatpickr.min.css')}}">
        <!-- End plugin css for this page -->

        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('../assets/fonts/feather-font/css/iconfont.css')}}">
        <link rel="stylesheet" href="{{ asset('../assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
        <!-- endinject -->

        <!-- Layout styles -->  
            <link rel="stylesheet" href="{{ asset('../assets/css/demo1/style.css')}}">
        <!-- End layout styles -->

        <link rel="shortcut icon" href="{{ asset('../assets/images/favicon.png')}}" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.6.0-web/css/all.min.css') }}">
        @stack('css')
        @livewireStyles
    </head>
    <body>
        
        <div class="main-wrapper">
            @include('layouts.admin.sidebar')
            <div class="page-wrapper">
            @include('layouts.admin.navbar')
                <div class="page-content">
                    {{ $slot }}
            
                </div>
                @include('layouts.admin.footer')
            </div>
        </div>
        
        <script src="{{ asset('../assets/vendors/core/core.js')}}"></script>
        <!-- endinject -->

        <!-- Plugin js for this page -->
        <script src="{{ asset('../assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
        <script src="{{ asset('../assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
        <!-- End plugin js for this page -->

        <!-- inject:js -->
        <script src="{{ asset('../assets/vendors/feather-icons/feather.min.js')}}"></script>
        <script src="{{ asset('../assets/js/template.js')}}"></script>
        <!-- endinject -->

        <!-- Custom js for this page -->
        <script src="{{ asset('../assets/js/dashboard-dark.js')}}"></script>
        <!-- End custom js for this page -->
        @stack('modals')
        
        @stack('js')
        @livewireScripts
    </body>
</html>
