<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('seo_description', 'Yayasan Agape Hijau Abadi')">
    <title>@yield('title', 'Yayasan Agape Hijau Abadi')</title>
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('static/bootstrap/css/bootstrap.min.css') }}">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="{{ asset('static/bootstrap-icons/bootstrap-icons.min.css') }}">
    {{-- Custom bootstrap styles --}}
    <link rel="stylesheet" href="{{ asset('static/css/custom-bootstrap.css') }}">
    {{-- Owl Carousel --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>
    {{-- Start Template Assets --}}
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('static/template_assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/template_assets/plugins/fontawesome/css/all.min.css') }}">
    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{ asset('static/template_assets/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/template_assets/css/material.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('static/template_assets/css/font-awesome.min.css') }}">
    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{ asset('static/template_assets/css/line-awesome.min.css') }}">
    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{ asset('static/template_assets/plugins/morris/morris.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('static/template_assets/css/style.css') }}">
    {{-- End Template Assets --}}
    {{-- Custom Styles --}}
    <style>
        * {
            font-family: 'Inter', Helvetica, sans-serif;
        }
        :root {
            --bs-success: #699834 !important;
            --bs-success-rgb: 105, 152, 52 !important;
        }
        .bg-success {
            background-color: var(--bs-success) !important;
        }
    </style>
</head>
<body class="bg-white">
    {{-- Global JS --}}
    <script src="{{ asset('static/js/global-script.js') }}"></script>
    <!-- jQuery + Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    {{-- Sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('layout')
    {{-- Bootstrap --}}
    <script src="{{ asset('static/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- Axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{-- Start Template Assets --}}
    <!-- Slimscroll JS -->
    <script src="{{ asset('static/template_assets/js/jquery.slimscroll.min.js') }}"></script>
    <!-- Theme Settings JS -->
    <script src="{{ asset('static/template_assets/js/layout.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('static/template_assets/js/app.js') }}"></script>
    {{-- End Template Assets --}}
</body>
</html>
