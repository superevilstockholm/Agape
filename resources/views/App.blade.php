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
    {{-- Custom Styles --}}
    <style>
        * {
            font-family: 'Inter', Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <!-- jQuery + Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    @include('components.navbar_component')
    <main>
        @yield('content')
    </main>
    @include('components.footer_component')
    {{-- Bootstrap --}}
    <script src="{{ asset('static/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
