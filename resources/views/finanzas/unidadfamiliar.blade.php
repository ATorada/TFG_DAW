@extends('layout')

@section('title', 'Unidad Familiar')

@section('content')
    <ul class="sidenav">
        <li><a href="{{ route('main') }}">Inicio</a></li>
        <li><a href="{{ route('ingresos') }}">Ingresos</a></li>
        <li><a href="{{ route('gastos') }}">Gastos</a></li>
        <li><a href="{{ route('compragrande') }}">Compra Grande</a></li>
        <li><a href="{{ route('unidadfamiliar') }}">Unidad Familiar</a></li>
        <li><a href="{{ route('historial') }}">Historial</a></li>
        <li><a class="account" href="{{ route('account') }}">Cuenta<img src="img/account_placeholder.png" alt=""></a>
        </li>
    </ul>

    <header>
        <ul class="nav">
            <li class="salir right"><a href="{{ route('index') }}">Salir</a></li>
        </ul>
    </header>

    <div id="titulo">
        <h1>Unidad Familiar</h1>
    </div>
    <div class="main-content">
        <div id="unidadfamiliar">
            <h2>¡No perteneces a una unidad familiar!</h2>
            <div class="botones">
                <button class="modificar">Unirse</button>
                <button class="añadir">Crear</button>
            </div>
            <h2>Código: XXXXXX</h2>
            <div></div>
            <br>
            <div id="integrantes">
                <span><img src="img/account_placeholder.png" alt=""></span>
                <span><img src="img/account_placeholder.png" alt=""></span>
                <span><img src="img/account_placeholder.png" alt=""></span>
                <span><img src="img/account_placeholder.png" alt=""></span>
                <span><img src="img/account_placeholder.png" alt=""></span>
            </div>
            <p><span class="titulo">Ingresos: </span>1000€</p>
            <p><span class="titulo">Gastos: </span>500€</p>

            <button class="borrar">Salir</button>
        </div>
    </div>

@endsection
