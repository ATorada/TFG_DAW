@extends('layout')

@section('title', 'Unidad Familiar')

@section('content')
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form action="">
                    <h1>Unirse a una unidad familiar</h1>
                    <p class="error">El código ingresado no es válido</p>
                    <label for="codigo">Código de la unidad familiar</label>
                    <input type="text" name="codigo" id="codigo">
                    <button type="submit" class="añadir" id="unirse">Unirse</button>
                </form>
            </div>
        </div>
    </div>
    <div id="titulo">
        <h1>Unidad Familiar</h1>
    </div>
    <div class="main-content">
        <div id="unidad-familiar">
            <div style="{{ isset($data['error']) ? '' : 'display: none' }}" id="no-unidad">
                <h2>¡No perteneces a una unidad familiar!</h2>
                <div class="botones">
                    <button class="modificar" id="unirseModal">Unirse</button>
                    <button class="añadir" id="crear">Crear</button>
                </div>
            </div>
            <div style="{{ isset($data['error']) ? 'display: none' : '' }}" id="unidad">
                <h2>Código <p id="uuid">{{ $data['uuid'] ?? ''  }}</p> </h2>
                <br>
                <div id="integrantes">
                        @foreach ($data['members'] ?? [] as $user)
                            {{-- <span><img src="../img/account_placeholder.png" alt="user"></span> --}}
                            <span>{{ $user }}</span>
                        @endforeach
                </div>

                <br>
                <p><span class="titulo">Ingresos: </span> <span id="income"> {{ $data['income'] ?? '' }}€</span></p>
                <p><span class="titulo">Gastos: </span> <span id="expenses"> {{ $data['expenses'] ?? '' }}€</span></p>
                <div class="botones">
                    <button class="borrar">Salir</button>
                </div>
            </div>
        </div>
    </div>

@endsection
