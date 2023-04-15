@extends('layout')

@section('title', 'Regístrate')

@section('content')

    <form class="auth">
        <div class="header">Regístrate</div>
        <div class="inputs">
            <input placeholder="Nombre" class="input" type="text" id="user">
            <input placeholder="Email" class="input" type="text" id="email">
            <input placeholder="Contraseña" class="input" type="password" id="password">
            <input placeholder="Repetir Contraseña" class="input" type="password" id="password_confirmation">
            <button class="button" id="registrar">Registrar</button>
            <p class="register">¿Ya tienes cuenta? <a href="{{ route('loginForm') }}">Inicia sesión</a></p>
        </div>
    </form>

@endsection
