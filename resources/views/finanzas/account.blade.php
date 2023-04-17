@extends('layout')

@section('title', 'Cuenta')

@section('content')

    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form action="" {{-- enctype="multipart/form-data" --}}>
                    <h1>Editar usuario</h1>
                    <p class="error" data-name="user">Ese nombre no está disponible</p>
                    <label for="user">Nombre</label>
                    <input type="text" name="user" id="user">
                    <p class="error" data-name="email">Ese correo no está disponible</p>
                    <label for="email">Correo</label>
                    <input type="text" name="email" id="email">
                    <p class="error" data-name="password">Las contraseñas deben coincidir</p>
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                    <p class="error" data-name="image">El archivo debe ser una imagen en formato png</p>
{{--                     <label for="image">Foto de perfil</label>
                    <input type="file" name="image" id="image"> --}}
                    <button type="submit" class="modificar" id="editar">Editar</button>
                </form>
            </div>
        </div>
    </div>
    <div id="titulo">
        <h1>Cuenta</h1>
    </div>
    <div class="main-content">
        {{-- Permite cambiar el nombre, el correo, la contraseña y la foto de perfil --}}
        <div class="account-container">
            <div class="account-info">
{{--                 <div class="account-info-photo">
                    @php
                    $imagePath = 'storage/users/' . $data['id'] . '.png';
                    $imageExists = file_exists(public_path($imagePath));
                    @endphp

                <img id="imagen" src="{{ $imageExists ? asset($imagePath) : '../img/account_placeholder.png' }}">
                </div> --}}
                <div class="account-info-data">
                    <h2>Nombre</h2>
                    <p id="usuario"> {{ $data['user'] ?? '' }} </p>
                    <h2>Correo</h2>
                    <p id="correo"> {{ $data['email'] ?? '' }} </p>
                </div>
                    <button class="modificar" id="editarModal">Editar</button>
                <br>
            </div>
        </div>

    @endsection
