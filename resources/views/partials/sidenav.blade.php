<ul class="sidenav">
    <li><a class="logo" href="{{ route('index') }}"><img class="logoImg" src="/img/logo.png" alt=""></a></li>
    <li><a href="{{ route('finance.index') }}">Inicio</a></li>
    <li><a href="{{ route('finance.income') }}">Ingresos</a></li>
    <li><a href="{{ route('finance.expenses') }}">Gastos</a></li>
    <li><a href="{{ route('purchases.index') }}">Compras Grandes</a></li>
    <li><a href="{{ route('household.index') }}">Unidad Familiar</a></li>
    <li><a href="{{ route('finance.history') }}">Historial</a></li>
    <li><a class="account" href="{{ route('account') }}">Cuenta<img src="../img/account_placeholder.png" alt=""></a>
    </li>
</ul>

<header>
    <ul class="nav">
        <li class="salir right"><a href="{{ route('index') }}">Salir</a></li>
    </ul>
</header>
