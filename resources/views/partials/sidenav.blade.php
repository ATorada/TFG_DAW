<ul class="sidenav">
    <li><a class="logo" href="{{ route('index') }}"><img class="logoImg" src="/img/logo.png" alt=""></a></li>
    <li><a href="{{ route('main') }}">Inicio</a></li>
    <li><a href="{{ route('ingresos') }}">Ingresos</a></li>
    <li><a href="{{ route('gastos') }}">Gastos</a></li>
    <li><a href="{{ route('compragrande') }}">Compras Grandes</a></li>
    <li><a href="{{ route('unidadfamiliar') }}">Unidad Familiar</a></li>
    <li><a href="{{ route('historial') }}">Historial</a></li>
    <li><a class="account" href="{{ route('account') }}">Cuenta<img src="../img/account_placeholder.png" alt=""></a>
    </li>
</ul>

<header>
    <ul class="nav">
        <li class="salir right"><a href="{{ route('index') }}">Salir</a></li>
    </ul>
</header>
