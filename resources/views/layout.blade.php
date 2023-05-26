<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    {{-- Carga finanzas.css en páginas específicas --}}
    @if (Request::is('finances*'))
        <script src="{{ asset('js/finances/main.js') }}"></script>
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
    @if (Request::is('finances*'))

        {{-- Si es gastos carga su script --}}
        @if (Request::is('finances/expenses*'))
            <script src="{{ asset('js/finances/gastos.js') }}"></script>
        @endif

        {{-- Si es ingresos carga su script --}}
        @if (Request::is('finances/income*'))
            <script src="{{ asset('js/finances/ingresos.js') }}"></script>
        @endif

        {{-- Si es purchases carga su script --}}
        @if (Request::is('finances/purchases*'))
            <script src="{{ asset('js/finances/purchases.js') }}"></script>
        @endif

        {{-- Si es historz carga su script --}}
        @if (Request::is('finances/history*'))
            <script src="{{ asset('js/finances/history.js') }}"></script>
        @endif

        {{-- Si es household carga su script --}}
        @if (Request::is('finances/household*'))
            <script src="{{ asset('js/finances/household.js') }}"></script>
        @endif

        {{-- Si es account carga su script --}}
        @if (Request::is('finances/account*'))
            <script src="{{ asset('js/finances/account.js') }}"></script>
        @endif
    @endif
    <script>
            //Al id es, en , y de les añade un onclick que crea una cookie llamada locale que contiene el id del elemento pulsado
    if (document.querySelector('#es')) {
        document.querySelector('#es').addEventListener('click', function (e) {
            document.cookie = "locale=es;path=/";
            document.cookie = "locale=es;path=/finances";
            location.reload();
        });
    }

    if (document.querySelector('#en')) {
        document.querySelector('#en').addEventListener('click', function (e) {
            document.cookie = "locale=en;path=/";
            document.cookie = "locale=en;path=/finances";
            location.reload();
        });
    }

    if (document.querySelector('#de')) {
        document.querySelector('#de').addEventListener('click', function (e) {
            document.cookie = "locale=de;path=/";
            document.cookie = "locale=de;path=/finances";
            location.reload();
        });
    }
    </script>
</body>

</html>
