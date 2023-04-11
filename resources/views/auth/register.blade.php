@extends('layout')

@section('title', 'Regístrate')

@section('content')
    <header>
        <ul class="nav">
            <li class="left"><a href="{{ route('index') }}">Logo</a></li>
            <li class="right"><a href="{{ route('register') }}">Regístrate</a></li>
            <li class="right"><a href="{{ route('login') }}">Iniciar sesión</a></li>
        </ul>
    </header>
    <form class="form">
        <div class="header">Regístrate</div>
        <div class="inputs">
            <input placeholder="Nombre" class="input" type="text">
            <input placeholder="Email" class="input" type="text">
            <input placeholder="Contraseña" class="input" type="password">
            <input placeholder="Repetir Contraseña" class="input" type="password2">
            <button class="login">Registrar</button>
            <p class="register">¿Ya tienes cuenta? <a href="{{ route('main') }}">Inicia sesión</a></p>
        </div>
    </form>

@endsection
