@extends('layout')

@section('title', 'Ingresos')

@section('content')
    <p class="toast">Ingreso añadido correctamente</p>
    <div class="modal">
        <div class="modal-content">
            <span class="close">x</span>
            <form action="">
                <h1>Añadir finanza</h1>
                <p class="error" data-name="name">El campo concepto es obligatorio, no debe repetirse y debe ser menor de 50 caracteres</p>
                <input type="text" name="name" id="name" placeholder="Concepto">
                <p class="error" data-name="amount">El campo cantidad es obligatorio y debe ser un número positivo menor de 100000</p>
                <input type="number" name="amount" id="amount" placeholder="Cantidad">
                <div class="checkbox-container">
                    <input type="checkbox" name="constant" id="constant" value="1">
                    <label for="constant">Recurrente</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" name="compute_household" id="compute_household" value="1">
                    <label for="compute_household">Unidad Familiar</label>
                </div>
                <input type="hidden" name="is_income" id="is_income" value="1">
                <button class="añadir" type="submit">Añadir</button>
            </form>
        </div>
    </div>

    <div id="titulo">
        <h1>Ingresos</h1>
    </div>

    <div class="main-content">

        <div id="tabla-ingresos">
            <table>
                <thead>
                    <tr>
                        <th hidden>Id</th>
                        <th>Concepto</th>
                        <th>Cantidad</th>
                        <th>Recurrente</th>
                        <th>Unidad Familiar</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($data['income']) > 0)
                        @foreach ($data['income'] as $income)
                            <tr>
                                <td hidden id="id">{{ $income['id'] }}</td>
                                <td>{{ $income['name'] }}</td>
                                <td>{{ $income['amount'] }}</td>
                                <td>
                                    <input class="checkbox" type="checkbox" name="constant" id="constant"
                                        {{ $income['constant'] ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input class="checkbox" type="checkbox" name="compute_household" id="compute_household"
                                        {{ $income['compute_household'] ? 'checked' : '' }}>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5"><b>No hay ingresos</b></td>
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
