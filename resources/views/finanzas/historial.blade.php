@extends('layout')

@section('title', 'Historial')

@section('content')

    <div id="titulo">
        <h1>Historial</h1>
    </div>
    <div class="main-content">
        <input placeholder="Buscar" class="buscar" type="text" id="buscar">
        <div id="tabla-finanzas">
            <table>
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Periodo</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $finanza)
                        <tr>
                            <td>{{ $finanza['name'] }}</td>
                            <td>{{ $finanza['period'] }}</td>
                            <td>{{ $finanza['is_income'] ? 'Ingreso' : 'Gasto' }}</td>
                            <td class="{{ $finanza['is_income'] ? 'green' : 'red' }}">{{ $finanza['amount'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
