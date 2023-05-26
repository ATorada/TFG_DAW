@extends('layout')

@section('title', __('auth.login'))

@section('content')

    <form class="auth">
        <div class="header">@lang('auth.login')</div>
        <div class="inputs">
            <p class="error">@lang('auth.incorrect')</p>
            <input placeholder="@lang('auth.email')" class="input" type="text" id="email">
            <input placeholder="@lang('auth.password')" class="input" type="password" id="password" autocomplete="off">
            <div class="checkbox-container">
                <label class="checkbox">
                    <input type="checkbox" id="checkbox">
                </label>
                <label for="checkbox" class="checkbox-text">@lang('auth.remember')</label>
            </div>
            <button class="button" id="acceder">@lang('auth.access')</button>
            <p class="register">@lang('auth.dontHaveAcc') <a href="{{ route('registerForm') }}">@lang('auth.signup')</a></p>
        </div>
    </form>

@endsection
