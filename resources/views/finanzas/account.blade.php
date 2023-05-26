@extends('layout')

@section('title', __('sidenav.account'))

@section('content')

    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form action="" {{-- enctype="multipart/form-data" --}}>
                    <h1>@lang('finances.editUser')</h1>
                    <p class="error" data-name="user">@lang('finances.nameField')</p>
                    <label for="user">@lang('finances.name')</label>
                    <input type="text" name="user" id="user">
                    <p class="error" data-name="email">@lang('finances.emailField')</p>
                    <label for="email">@lang('finances.email')</label>
                    <input type="text" name="email" id="email">
                    <p class="error" data-name="password">@lang('finances.passwordField')</p>
                    <label for="password">@lang('finances.password')</label>
                    <input type="password" name="password" id="password">
                    <label for="password_confirmation">@lang('finances.confirmPassword')</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                    <p class="error" data-name="image">@lang('finances.imageField')</p>
{{--                     <label for="image">Foto de perfil</label>
                    <input type="file" name="image" id="image"> --}}
                    <button type="submit" class="modificar" id="editar">@lang('finances.edit')
                </form>
            </div>
        </div>
    </div>
    <div id="titulo">
        <h1>@lang('sidenav.account')</h1>
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
                    <h2>@lang('finances.name')</h2>
                    <p id="usuario"> {{ $data['user'] ?? '' }} </p>
                    <h2>@lang('finances.email')</h2>
                    <p id="correo"> {{ $data['email'] ?? '' }} </p>
                </div>
                    <button class="modificar" id="editarModal">@lang('finances.edit')</button>
                <br>
            </div>
        </div>

    @endsection
