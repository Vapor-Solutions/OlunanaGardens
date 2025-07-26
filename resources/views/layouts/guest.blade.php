<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin-lte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/admin-lte/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin-lte/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/admin-lte/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/admin-lte/plugins/summernote/summernote-bs4.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="container-fluid min-vh-100">
        <div class="row min-vh-100">
            <!-- Left Side -->
            <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center olunana-bg text-white p-5" >
                <div style="background-image: url('/gallery/IMG_9272.jpg'); position: absolute; width: 100%; height: 100%; background-size: cover; background-position: center; z-index: -1;">

                </div>
                <img class="mb-4" src="{{ asset('company_logo.png') }}" style="max-width: 25%; height: auto;" alt="Logo">
                <h3 class="fw-bold text-center"> Welcome to</h3>
                <h1 class="display-4 text-center" style="font-weight: 500;"> Olunana Gardens</h1>
                <p class="lead text-center mt-3">
                    BLOOMING EVENTS IN NATURE'S EMBRACE</p>
            </div>
            <!-- Right Side -->
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center shadow-sm" style="background-color: #A1a1a1;">
                <div class="w-100">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</body>

</html>
