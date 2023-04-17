<header>
    <ul class="nav">
        <li class="left"><a class="logo" href="{{ route('index') }}"><img class="logoImg" src="/img/logo.png"alt=""></a></li>
        @if (Session::has('token'))
{{--             <li class="right"><a href="{{ route('logout') }}">Salir</a></li> --}}
            <li class="right"><a href="{{ route('finance.index') }}">Panel principal</a></li>
        @else
            <li class="right"><a href="{{ route('registerForm') }}">Regístrate</a></li>
            <li class="right"><a href="{{ route('loginForm') }}">Iniciar sesión</a></li>
        @endif

    </ul>
</header>
