<header>
    <ul class="nav">
        <li class="left"><a class="logo" href="{{ route('index') }}"><img class="logoImg" src="/img/logo.png"alt=""></a></li>
        @if (Session::has('token'))
{{--             <li class="right"><a href="{{ route('logout') }}">Salir</a></li> --}}
            <li class="right"><a href="{{ route('finance.index') }}">@lang('topnav.main')</a></li>
        @else
            <li class="right"><a href="{{ route('registerForm') }}">@lang('auth.signup')</a></li>
            <li class="right"><a href="{{ route('loginForm') }}">@lang('auth.login')</a></li>
        @endif
        <li class="left" id="es"><a href="{{ route('locale', 'es') }}">ES</a></li>
        <li class="left" id="en"><a href="{{ route('locale', 'en') }}">EN</a></li>
        <li class="left" id="de"><a href="{{ route('locale', 'de') }}">DE</a></li>

    </ul>
</header>
