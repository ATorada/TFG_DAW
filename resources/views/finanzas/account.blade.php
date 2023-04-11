@extends('layout')

@section('title', 'Cuenta')

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
        <h1>Cuenta</h1>
    </div>
    <div class="main-content">
        {{-- Permite cambiar el nombre, el correo, la contraseña y la foto de perfil --}}
        <div class="accountInfo">
            <div class="account-info">
                <div class="account-info-photo">
                    <img src="img/account_placeholder.png" alt="">
                </div>
                <div class="account-info-data">
                    <h2>Nombre</h2>
                    <p>Nombre del usuario</p>
                    <h2>Correo</h2>
                    <p>Correo del usuario</p>
                </div>
                <button class="modificar">Modificar</button>
                <br>
            </div>
        </div>

    @endsection
