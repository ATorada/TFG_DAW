@extends('layout')

@section('title', __('sidenav.household'))

@section('content')
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form action="">
                    <h1>@lang('finances.joinHousehold')</h1>
                    <p class="error">@lang('finances.codeNotValid')</p>
                    <label for="codigo">@lang('finances.householdCode')</label>
                    <input type="text" name="codigo" id="codigo">
                    <button type="submit" class="añadir" id="unirse">@lang('finances.join')</button>
                </form>
            </div>
        </div>
    </div>
    <div id="titulo">
        <h1>@lang('sidenav.household')</h1>
    </div>
    <div class="main-content">
        <div id="unidad-familiar">
            <div style="{{ isset($data['error']) ? '' : 'display: none' }}" id="no-unidad">
                <h2>@lang('finances.notBelong')</h2>
                <div class="botones">
                    <button class="modificar" id="unirseModal">@lang('finances.join')</button>
                    <button class="añadir" id="crear">@lang('finances.create')</button>
                </div>
            </div>
            <div style="{{ isset($data['error']) ? 'display: none' : '' }}" id="unidad">
                <h2>@lang('finances.code') <p id="uuid">{{ $data['uuid'] ?? ''  }}</p> </h2>
                <br>
                <div id="integrantes">
                        @foreach ($data['members'] ?? [] as $user)
                            {{-- <span><img src="../img/account_placeholder.png" alt="user"></span> --}}
                            <span>{{ $user }}</span>
                        @endforeach
                </div>

                <br>
                <p><span class="titulo">@lang('finances.incomeHousehold') </span> <span id="income"> {{ $data['income'] ?? '' }}€</span></p>
                <p><span class="titulo">@lang('finances.expensesHousehold') </span> <span id="expenses"> {{ $data['expenses'] ?? '' }}€</span></p>
                <div class="botones">
                    <button class="borrar">@lang('finances.delete')</button>
                </div>
            </div>
        </div>
    </div>

@endsection
