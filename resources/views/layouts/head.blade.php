<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://unpkg.com/htmx.org@1.9.6" integrity="sha384-FhXw7b6AlE/jyjlZH5iHa/tTe9EpJ1Y55RjcgPbjeWMskSxZt1v9qkxLJWNJaGni" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-selector/css/bootstrap-select.min.css') }}">
    <!--icon font css-->
    <link rel="stylesheet" href="{{ asset('vendors/themify-icon/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/elagent/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/animation/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/magnify-pop/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/nice-select/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/scroll/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>