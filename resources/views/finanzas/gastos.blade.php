@extends('layout')

@section('title', 'Gastos')

@section('content')

    <div class="modal">

        <div class="modal-content">
            <span class="close">x</span>
            <form action="">
                <h1>Añadir finanza</h1>
                <input type="text" name="name" id="name" placeholder="Concepto">
                <input type="number" name="amount" id="amount" placeholder="Cantidad">
                <select name="category" id="category">
                    <option value="alimentacion">Alimentación</option>
                    <option value="hogar">Hogar</option>
                    <option value="transporte">Transporte</option>
                    <option value="ocio">Ocio</option>
                    <option value="ropa">Ropa</option>
                    <option value="salud">Salud</option>
                    <option value="otros">Otros</option>
                </select>
                <div class="checkbox-container">
                    <input type="checkbox" name="constant" id="constant">
                    <label for="constant">Recurrente</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" name="compute_household" id="compute_household">
                    <label for="compute_household">Unidad Familiar</label>
                </div>
                <input type="hidden" name="is_income" id="is_income" value="0">
                <button class="añadir" type="submit">Añadir</button>
            </form>
        </div>
    </div>

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
                        <th>Unidad Familiar</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $gastos = [
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'alimentacion', 'recurrente' => true, 'unidadfamiliar' => true],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'vivienda', 'recurrente' => false, 'unidadfamiliar' => false],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'transporte', 'recurrente' => true, 'unidadfamiliar' => true],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'comunicaciones', 'recurrente' => true, 'unidadfamiliar' => false],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'ocio', 'recurrente' => true, 'unidadfamiliar' => false],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'salud', 'recurrente' => false, 'unidadfamiliar' => true],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'educacion', 'recurrente' => true, 'unidadfamiliar' => false],
                            ['fecha' => '01/01/2021', 'concepto' => 'Salario', 'cantidad' => '1000€', 'tipo' => 'otros', 'recurrente' => true, 'unidadfamiliar' => true],
                        ];
                    @endphp

                    @foreach ($gastos as $gasto)
                        <tr>
                            <td>{{ $gasto['fecha'] }}</td>
                            <td>{{ $gasto['concepto'] }}</td>
                            <td>{{ $gasto['cantidad'] }}</td>
                            <td>
                                <select name="tipo" id="tipo">
                                    <option value="alimentacion" {{ $gasto['tipo'] == 'alimentacion' ? 'selected' : '' }}>
                                        Alimentación</option>
                                    <option value="vivienda" {{ $gasto['tipo'] == 'vivienda' ? 'selected' : '' }}>Vivienda
                                    </option>
                                    <option value="transporte" {{ $gasto['tipo'] == 'transporte' ? 'selected' : '' }}>
                                        Transporte</option>
                                    <option value="comunicaciones"
                                        {{ $gasto['tipo'] == 'comunicaciones' ? 'selected' : '' }}>Comunicaciones</option>
                                    <option value="ocio" {{ $gasto['tipo'] == 'ocio' ? 'selected' : '' }}>Ocio</option>
                                    <option value="salud" {{ $gasto['tipo'] == 'salud' ? 'selected' : '' }}>Salud</option>
                                    <option value="educacion" {{ $gasto['tipo'] == 'educacion' ? 'selected' : '' }}>
                                        Educación</option>
                                    <option value="otros" {{ $gasto['tipo'] == 'otros' ? 'selected' : '' }}>Otros</option>
                                </select>
                            <td>
                                <input class="checkbox" type="checkbox" {{ $gasto['recurrente'] ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input class="checkbox" type="checkbox" {{ $gasto['unidadfamiliar'] ? 'checked' : '' }}>
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

    <script src="{{ asset('js/finances.js') }}"></script>

@endsection
