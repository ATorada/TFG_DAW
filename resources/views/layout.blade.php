<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    {{-- Carga finanzas.css en páginas específicas --}}
    @if (Request::is('finances*'))
        <link rel="stylesheet" href="{{ asset('css/finanzas.css') }}">
    @endif

    {{-- Carga homepage.css en la página principal --}}
    @if (Request::is('/'))
        <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    @endif

    {{-- Carga auth.css en las páginas de login y register --}}
    @if (Request::is('login') || Request::is('register'))
        <script src="{{ asset('js/auth.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @endif

</head>

<body>

    @if (Request::is('finances*'))
        @include('partials.sidenav')
    @else
        @include('partials.topnav')
    @endif

    @yield('content')

    {{-- @include('partials.footer') --}}
</body>

</html>
