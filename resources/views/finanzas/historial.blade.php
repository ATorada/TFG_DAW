@extends('layout')

@section('title', 'Historial')

@section('content')

    <div id="titulo">
        <h1>Historial</h1>
    </div>
    <div class="main-content">
        <input placeholder="Buscar" class="buscar" type="text">
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
                    <tr>
                        <td>Salario</td>
                        <td>01/2021</td>
                        <td>Ingreso</td>
                        <td class="green">1000€</td>
                    </tr>
                    <tr>
                        <td>Salario</td>
                        <td>01/2021</td>
                        <td>Ingreso</td>
                        <td class="green">1000€</td>
                    </tr>
                    <tr>
                        <td>Salario</td>
                        <td>01/2021</td>
                        <td>Gasto</td>
                        <td class="red">1000€</td>
                    </tr>
                    <tr>
                        <td>Salario</td>
                        <td>01/2021</td>
                        <td>Ingreso</td>
                        <td class="green">1000€</td>
                    </tr>
                    <tr>
                        <td>Salario</td>
                        <td>01/2021</td>
                        <td>Gasto</td>
                        <td class="red">1000€</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

@endsection
