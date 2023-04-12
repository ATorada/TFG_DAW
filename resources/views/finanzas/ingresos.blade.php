@extends('layout')

@section('title', 'Ingresos')

@section('content')

    <div id="titulo">
        <h1>Ingresos</h1>
    </div>

    <div class="main-content">

        <div id="tabla-ingresos">
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Concepto</th>
                        <th>Cantidad</th>
                        <th>Recurrente</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $ingresos = [
                        ['fecha' => '01/01/2021','concepto' => 'Salario','cantidad' => '1000€','recurrente' => true],
                        ['fecha' => '01/01/2021','concepto' => 'Salario','cantidad' => '1000€','recurrente' => false],
                        ['fecha' => '01/01/2021','concepto' => 'Salario','cantidad' => '1000€','recurrente' => true],
                        ['fecha' => '01/01/2021','concepto' => 'Salario','cantidad' => '1000€','recurrente' => false],
                        ['fecha' => '01/01/2021','concepto' => 'Salario','cantidad' => '1000€','recurrente' => true],
                    ];
                    @endphp

                    @foreach ($ingresos as $ingreso)
                        <tr>
                            <td>{{ $ingreso['fecha'] }}</td>
                            <td>{{ $ingreso['concepto'] }}</td>
                            <td>{{ $ingreso['cantidad'] }}</td>
                            <td>
                                <input class="checkbox" type="checkbox" {{ $ingreso['recurrente'] ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button class="borrar">
            <b>Borrar</b>
        </button>
        <button class="añadir">
            <b>Añadir</b>
        </button>
    </div>
@endsection
