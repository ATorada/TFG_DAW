@extends('layout')

@section('title', 'Compras grandes')

@section('content')

    <p class="toast">Compra añadida correctamente</p>
    <div class="modal">
        <div class="modal-content">
            <span class="close">x</span>
            <form action="" enctype="multipart/form-data">
                <h1>Añadir compra</h1>
                <p class="error" id="limite">No puedes añadir más de 5 compras grandes</p>
                <p class="error" data-name="name">El campo concepto es obligatorio y debe ser menor de 50 caracteres</p>
                <input type="text" name="name" id="name" placeholder="Concepto">
                <p class="error" data-name="amount">El campo cantidad es obligatorio y debe ser un número positivo</p>
                <input type="number" name="amount" id="amount" placeholder="Cantidad">
                <p class="error" data-name="period">El campo periodo es obligatorio y debe ser una fecha posterior a este mes</p>
                <input type="date" name="period" id="period" placeholder="Periodo">
                <p class="error" data-name="image">El campo debe ser un archivo de tipo imagen png.</p>
                <input type="file" name="image" id="image" accept="image/*">
                <button class="añadir" type="submit">Añadir</button>
            </form>
        </div>
    </div>

    <div id="titulo">
        <h1>Compra grande</h1>
    </div>
    <div class="main-content">

        <div id="añadir-compra">
            <br>
            <button class="añadir" id="añadir">
                <p>Añadir</p>
            </button>
        </div>


        @for ($i = 0; $i < count($data); $i++)
            @include('finanzas.partials.compragrande', ['compragrande' => $data[$i]])
        @endfor


    </div>

@endsection
