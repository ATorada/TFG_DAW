@extends('layout')

@section('title', 'Cuenta')

@section('content')

    <div id="titulo">
        <h1>Cuenta</h1>
    </div>
    <div class="main-content">
        {{-- Permite cambiar el nombre, el correo, la contraseña y la foto de perfil --}}
        <div class="account-container">
            <div class="account-info">
                <div class="account-info-photo">
                    <img src="../img/account_placeholder.png" alt="">
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
