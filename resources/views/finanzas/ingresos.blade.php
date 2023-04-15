@extends('layout')

@section('title', 'Ingresos')

@section('content')

    <div class="modal">

        <div class="modal-content">
            <span class="close">x</span>
            <form action="">
                <h1>Añadir finanza</h1>
                <input type="text" name="concept" id="concept" placeholder="Concepto">
                <input type="number" name="amount" id="amount" placeholder="Cantidad">
                <div class="checkbox-container">
                    <input type="checkbox" name="constant" id="constant">
                    <label for="constant">Recurrente</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" name="household" id="household">
                    <label for="household">Unidad Familiar</label>
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
                        <th>Concepto</th>
                        <th>Cantidad</th>
                        <th>Recurrente</th>
                        <th>Unidad Familiar</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($data['income']['finances']) > 0)
                        @foreach ($data['income']['finances'] as $income)
                            <tr>
                                <td>{{ $income['name'] }}</td>
                                <td>{{ $income['amount'] }}</td>
                                <td>
                                    <input class="checkbox" type="checkbox" name="constant" id="constant" disabled
                                        {{ $income['constant'] ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input class="checkbox" type="checkbox" name="compute_household" id="compute_household" disabled
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
        <button class="borrar">
            <b>Borrar</b>
        </button>
        <button class="añadir">
            <b>Añadir</b>
        </button>
    </div>
    <script src="../js/finances.js"></script>
@endsection
