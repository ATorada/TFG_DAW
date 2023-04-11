@extends('layout')

@section('title', 'Inicia sesión')

@section('content')
    <header>
        <ul class="nav">
            <li class="left"><a href="{{ route('index') }}">Logo</a></li>
            <li class="right"><a href="{{ route('register') }}">Regístrate</a></li>
            <li class="right"><a href="{{ route('login') }}">Iniciar sesión</a></li>
        </ul>
    </header>
    <form class="form">
        <div class="header">Inicia sesión</div>
        <div class="inputs">
            <input placeholder="Email" class="input" type="text">
            <input placeholder="Contraseña" class="input" type="password">
            <div class="checkbox-container">
                <label class="checkbox">
                    <input type="checkbox" id="checkbox">
                </label>
                <label for="checkbox" class="checkbox-text">Recuérdame</label>
            </div>
            <button class="login">Acceder</button>
            <p class="register">¿No tienes cuenta? <a href="{{ route('register') }}">¡Regístrate!</a></p>
        </div>
    </form>

@endsection
