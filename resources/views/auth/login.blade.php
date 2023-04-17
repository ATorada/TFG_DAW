@extends('layout')

@section('title', 'Inicia sesión')

@section('content')

    <form class="auth">
        <div class="header">Inicia sesión</div>
        <div class="inputs">
            <p class="error">Usuario o contraseña incorrectos</p>
            <input placeholder="Email" class="input" type="text" id="email">
            <input placeholder="Contraseña" class="input" type="password" id="password" autocomplete="off">
            <div class="checkbox-container">
                <label class="checkbox">
                    <input type="checkbox" id="checkbox">
                </label>
                <label for="checkbox" class="checkbox-text">Recuérdame</label>
            </div>
            <button class="button" id="acceder">Acceder</button>
            <p class="register">¿No tienes cuenta? <a href="{{ route('registerForm') }}">¡Regístrate!</a></p>
        </div>
    </form>

@endsection
