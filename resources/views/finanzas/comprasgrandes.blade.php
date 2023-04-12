@extends('layout')

@section('title', 'Compras grandes')

@section('content')

    <div id="titulo">
        <h1>Compra grande</h1>
    </div>
    <div class="main-content">

        <div id="añadir-compra">
            <br>
            <button class="añadir">
                <p>Añadir</p>
            </button>
        </div>


        @for ($i = 0; $i < 5; $i++)
            @include('finanzas.partials.compragrande', ['compragrande' => ['id'=>'compragrande_placeholder', 'nombre'=>'nombre','fecha' => '01/01/2021', 'total' => '1000', 'precio_mes' => '100']])
        @endfor


    </div>

@endsection
