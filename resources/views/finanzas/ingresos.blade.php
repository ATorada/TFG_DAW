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
                    <tr>
                        <td>01/01/2021</td>
                        <td>Salario</td>
                        <td>1000€</td>
                        <td>
                            <input class="checkbox" type="checkbox">
                        </td>
                    </tr>
                    <tr>
                        <td>01/01/2021</td>
                        <td>Salario</td>
                        <td>1000€</td>
                        <td>
                            <input class="checkbox" type="checkbox">
                        </td>
                    </tr>
                    <tr>
                        <td>01/01/2021</td>
                        <td>Salario</td>
                        <td>1000€</td>
                        <td>
                            <input class="checkbox" type="checkbox">
                        </td>
                    </tr>
                    <tr>
                        <td>01/01/2021</td>
                        <td>Salario</td>
                        <td>1000€</td>
                        <td>
                            <input class="checkbox" type="checkbox">
                        </td>
                    </tr>
                    <tr>
                        <td>01/01/2021</td>
                        <td>Salario</td>
                        <td>1000€</td>
                        <td>
                            <input class="checkbox" type="checkbox">
                        </td>
                    </tr>
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
