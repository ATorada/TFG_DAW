@extends('layout')

@section('title', 'Gastos')

@section('content')

    <div id="titulo">
        <h1>Gastos</h1>
    </div>

    <div class="main-content">
        <div id="ahorro">
            <h1>Ahorro</h1>
            <h2>1000€</h2>
            <input type="range" min="0" max="100" value="50" id="ahorroSlider">
        </div>
        <div id="tabla-gastos">
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Concepto</th>
                        <th>Cantidad</th>
                        <th>Tipo</th>
                        <th>Recurrente</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $gastos = [
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'alimentacion', 'recurrente' => true],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'vivienda', 'recurrente' => false],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'transporte', 'recurrente' => true],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'comunicaciones', 'recurrente' => true],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'ocio', 'recurrente' => true],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'salud', 'recurrente' => false],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'educacion', 'recurrente' => true],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'otros', 'recurrente' => true],
                        ];
                    @endphp

                    @foreach ($gastos as $gasto)
                        <tr>
                            <td>{{ $gasto['fecha'] }}</td>
                            <td>{{ $gasto['concepto'] }}</td>
                            <td>{{ $gasto['cantidad'] }}</td>
                            <td>
                                <select name="tipo" id="tipo">
                                    <option value="alimentacion" {{ $gasto['tipo'] == 'alimentacion' ? 'selected' : '' }}>Alimentación</option>
                                    <option value="vivienda" {{ $gasto['tipo'] == 'vivienda' ? 'selected' : '' }}>Vivienda</option>
                                    <option value="transporte" {{ $gasto['tipo'] == 'transporte' ? 'selected' : '' }}>Transporte</option>
                                    <option value="comunicaciones" {{ $gasto['tipo'] == 'comunicaciones' ? 'selected' : '' }}>Comunicaciones</option>
                                    <option value="ocio" {{ $gasto['tipo'] == 'ocio' ? 'selected' : '' }}>Ocio</option>
                                    <option value="salud" {{ $gasto['tipo'] == 'salud' ? 'selected' : '' }}>Salud</option>
                                    <option value="educacion" {{ $gasto['tipo'] == 'educacion' ? 'selected' : '' }}>Educación</option>
                                    <option value="otros" {{ $gasto['tipo'] == 'otros' ? 'selected' : '' }}>Otros</option>
                                </select>
                            <td>
                                <input class="checkbox" type="checkbox" {{ $gasto['recurrente'] ? 'checked' : '' }}>
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
