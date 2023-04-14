@extends('layout')

@section('title', 'Regístrate')

@section('content')

    <form class="auth">
        <div class="header">Regístrate</div>
        <div class="inputs">
            <input placeholder="Nombre" class="input" type="text">
            <input placeholder="Email" class="input" type="text">
            <input placeholder="Contraseña" class="input" type="password">
            <input placeholder="Repetir Contraseña" class="input" type="password2">
            <button class="button">Registrar</button>
            <p class="register">¿Ya tienes cuenta? <a href="{{ route('loginForm') }}">Inicia sesión</a></p>
        </div>
    </form>

@endsection
