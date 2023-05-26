<ul class="sidenav">
    <li><a class="logo" href="{{ route('index') }}"><img class="logoImg" src="/img/logo.png" alt=""></a></li>
    <li><a href="{{ route('finance.index') }}">@lang('sidenav.home')</a></li>
    <li><a href="{{ route('finance.income') }}">@lang('sidenav.income')</a></li>
    <li><a href="{{ route('finance.expenses') }}">@lang('sidenav.expenses')</a></li>
    <li><a href="{{ route('purchases.index') }}">@lang('sidenav.purchases')</a></li>
    <li><a href="{{ route('household.index') }}">@lang('sidenav.household')</a></li>
    <li><a href="{{ route('finance.history') }}">@lang('sidenav.history')</a></li>
    <li><a class="account" href="{{ route('account') }}">@lang('sidenav.account')</a>
    </li>
</ul>

<header>
    <ul class="nav">
        <li class="salir right"><a href="{{ route('logout') }}">@lang('auth.logout')</a></li>
        <li class="right" id="es"><a href="{{ route('locale', 'es') }}">ES</a></li>
        <li class="right" id="en"><a href="{{ route('locale', 'en') }}">EN</a></li>
        <li class="right" id="de"><a href="{{ route('locale', 'de') }}">DE</a></li>
    </ul>
</header>
