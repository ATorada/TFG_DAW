@extends('layout')

@section('title', __('auth.register'))

@section('content')

    <form class="auth">
        <div class="header">@lang('auth.register')</div>
        <div class="inputs">
            <input placeholder="@lang('auth.name')" class="input" type="text" id="user">
            <input placeholder="@lang('auth.email')" class="input" type="text" id="email">
            <input placeholder="@lang('auth.password')" class="input" type="password" id="password">
            <input placeholder="@lang('auth.repeatPassword')" class="input" type="password" id="password_confirmation">
            <button class="button" id="registrar">@lang('auth.register')</button>
            <p class="register">@lang('auth.alreadyHaveAcc') <a href="{{ route('loginForm') }}">@lang('auth.login')</a></p>
        </div>
    </form>

@endsection
