@extends('layout')

@section('title', 'Unidad Familiar')

@section('content')

    <div id="titulo">
        <h1>Unidad Familiar</h1>
    </div>
    <div class="main-content">

        @php
            $unidadfamiliar = [
                'codigo' => '123456',
                'integrantes' => ['integrante1', 'integrante2', 'integrante3', 'integrante4', 'integrante5'],
                'ingresos' => '1000',
                'gastos' => '500',
            ];
        @endphp
        <div id="unidad-familiar">

            @if (!isset($unidadfamiliar))
                <h2>¡No perteneces a una unidad familiar!</h2>
                <div class="botones">
                    <button class="modificar">Unirse</button>
                    <button class="añadir">Crear</button>
                </div>
            @else
                <h2>Código: {{ $unidadfamiliar['codigo'] }}</h2>
                <div></div>
                <br>
                <div id="integrantes">
                    @foreach ($unidadfamiliar['integrantes'] as $integrante)
                        <span><img src="../img/account_placeholder.png" alt=""></span>
                    @endforeach
                </div>
                <br>
                <p><span class="titulo">Ingresos: </span>1000€</p>
                <p><span class="titulo">Gastos: </span>500€</p>
                <div class="botones">
                    <button class="borrar">Salir</button>
                </div>
            @endif
        </div>
    </div>

    @endsection
