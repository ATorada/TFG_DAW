@extends('layout')

@section('title', 'Gastos')

@section('content')

<p class="toast">Gasto añadido correctamente</p>

    <div class="modal">
        <div class="modal-content">
            <span class="close">x</span>
            <form action="">
                <h1>Añadir finanza</h1>
                <p class="error" data-name="name">El campo concepto es obligatorio, no debe repetirse y debe ser menor de 50
                    caracteres</p>
                <input type="text" name="name" id="name" placeholder="Concepto">
                <p class="error" data-name="amount">El campo cantidad es obligatorio y debe ser un número positivo</p>
                <input type="number" name="amount" id="amount" placeholder="Cantidad">
                <select name="category" id="category">
                    <option value="alimentacion" selected>Alimentación</option>
                    <option value="vivienda">Vivienda</option>
                    <option value="transporte">Transporte</option>
                    <option value="ocio">Ocio</option>
                    <option value="comunicaciones">Comunicaciones</option>
                    <option value="salud">Salud</option>
                    <option value="educacion">Educación</option>
                    <option value="otros">Otros</option>
                </select>
                <div class="checkbox-container">
                    <input type="checkbox" name="constant" id="constant" value="1">
                    <label for="constant">Recurrente</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" name="compute_household" id="compute_household" value="1">
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
            <h2>Ahorro actual: <span id="ahorroActual" >{{ $data['ahorro'] ?? 0 }}</span></h2>
            <h2>Dinero disponible: <span id="dineroDisponible">{{ $data['flexible'] }}</span>/<span id="dineroTotal">{{ $data['flexible'] + ($data['ahorro'] ?? 0) }}</span></h2>

            <input data-id="{{ $data['ahorro_id'] ?? 0 }}"" type="range" min="0" max="100" value="0" id="ahorroSlider">
            <output>0%</output>

            <div id="botones">
            @if (isset($data['ahorro']))
                <button class="añadir" id="añadirAhorro" style="display: none">Añadir ahorro</button>
                <button class="modificar" id="editarAhorro">Modificar ahorro</button>
            @else
                <button class="añadir" id="añadirAhorro">Añadir ahorro</button>
                <button class="modificar" id="editarAhorro" style="display: none">Modificar ahorro</button>
            @endif
            <button class="borrar" id="borrarAhorro">Borrar ahorro</button>
            </div>
        </div>
        <div id="tabla-gastos">
            <table>
                <thead>
                    <tr>
                        <th hidden>Id</th>
                        <th>Concepto</th>
                        <th>Cantidad</th>
                        <th>Tipo</th>
                        <th>Recurrente</th>
                        <th>Unidad Familiar</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($data['expenses']) > 0)
                        @foreach ($data['expenses'] as $gasto)
                            <tr>
                                <td hidden id="id">{{ $gasto['id'] }}</td>
                                <td>{{ $gasto['name'] }}</td>
                                <td>{{ $gasto['amount'] }}</td>
                                <td>
                                    <select name="category" id="category">
                                        <option value="alimentacion"
                                            {{ $gasto['category'] == 'alimentacion' ? 'selected' : '' }}>
                                            Alimentación</option>
                                        <option value="vivienda" {{ $gasto['category'] == 'vivienda' ? 'selected' : '' }}>
                                            Vivienda
                                        </option>
                                        <option value="transporte"
                                            {{ $gasto['category'] == 'transporte' ? 'selected' : '' }}>
                                            Transporte</option>
                                        <option value="comunicaciones"
                                            {{ $gasto['category'] == 'comunicaciones' ? 'selected' : '' }}>Comunicaciones
                                        </option>
                                        <option value="ocio" {{ $gasto['category'] == 'ocio' ? 'selected' : '' }}>Ocio
                                        </option>
                                        <option value="salud" {{ $gasto['category'] == 'salud' ? 'selected' : '' }}>Salud
                                        </option>
                                        <option value="educacion"
                                            {{ $gasto['category'] == 'educacion' ? 'selected' : '' }}>
                                            Educación</option>
                                        <option value="otros" {{ $gasto['category'] == 'otros' ? 'selected' : '' }}>Otros
                                        </option>
                                    </select>
                                <td>
                                    <input class="checkbox" type="checkbox" {{ $gasto['constant'] ? 'checked' : '' }} name="constant">
                                </td>
                                <td>
                                    <input class="checkbox" type="checkbox"
                                        {{ $gasto['compute_household'] ? 'checked' : '' }} name="compute_household">
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6"><b>No hay gastos</b></td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
        <button class="borrar disabled" disabled id="borrar">
            <b>Borrar</b>
        </button>
        <button class="añadir" id="añadir">
            <b>Añadir</b>
        </button>
    </div>
@endsection
