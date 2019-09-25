<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Font -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


	<!-- Stylesheets -->

	<link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet">

	<link href="{{ asset('frontend/css/swiper.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/css/ionicons.css') }}" rel="stylesheet">
    
    <!-- toastr -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    
    @stack('css')
</head>
<body>

    <div id="app">
        @include('layouts.frontend.partial.header')
    
        @yield('content')
            
        @include('layouts.frontend.partial.footer')
    </div>
    
    <!-- SCIPTS -->

    <script src="{{ asset('frontend/js/jquery-3.1.1.min.js') }}"></script>

    <script src="{{ asset('frontend/js/tether.min.js') }}"></script>

    <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>

    <script src="{{ asset('frontend/js/scripts.js') }}"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}', 'Error', {
                closeButton: true, 
                progressBar: true, 
            });
        </script>
        @endforeach
    @endif
    
    @stack('js')

</body>
</html>
