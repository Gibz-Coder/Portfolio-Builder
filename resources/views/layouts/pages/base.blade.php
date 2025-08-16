<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $user->name ?? 'Portfolio' }} - Portfolio</title>

    <!--=============== UNICONS ===============-->
    <link rel="stylesheet" href="{{ asset('assets/fonts/unicons/css/line.css') }}">
    
    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>
<body>
    @yield('content')

    <!--==================== SWIPER JS ====================-->
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>

    <!--==================== MAIN JS ====================-->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
