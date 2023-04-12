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
                    <tr>
                        <td>01/01/2021</td>
                        <td>Salario</td>
                        <td>1000€</td>
                        <td>
                            <select name="tipo" id="tipo">
                                <option value="1">Alimentación</option>
                                <option value="2">Vivienda</option>
                                <option value="3">Transporte</option>
                                <option value="4">Comunicaciones</option>
                                <option value="5">Ocio</option>
                                <option value="6">Salud</option>
                                <option value="7">Educación</option>
                                <option value="8">Otros</option>
                            </select>
                        </td>
                        <td>
                            <input class="checkbox" type="checkbox">
                        </td>
                    </tr>
                    <tr>
                        <td>01/01/2021</td>
                        <td>Salario</td>
                        <td>1000€</td>
                        <td>
                            <select name="tipo" id="tipo">
                                <option value="1">Alimentación</option>
                                <option value="2">Vivienda</option>
                                <option value="3">Transporte</option>
                                <option value="4">Comunicaciones</option>
                                <option value="5">Ocio</option>
                                <option value="6">Salud</option>
                                <option value="7">Educación</option>
                                <option value="8">Otros</option>
                            </select>
                        </td>
                        <td>
                            <input class="checkbox" type="checkbox">
                        </td>
                    </tr>
                    <tr>
                        <td>01/01/2021</td>
                        <td>Salario</td>
                        <td>1000€</td>
                        <td>
                            <select name="tipo" id="tipo">
                                <option value="1">Alimentación</option>
                                <option value="2">Vivienda</option>
                                <option value="3">Transporte</option>
                                <option value="4">Comunicaciones</option>
                                <option value="5">Ocio</option>
                                <option value="6">Salud</option>
                                <option value="7">Educación</option>
                                <option value="8">Otros</option>
                            </select>
                        </td>
                        <td>
                            <input class="checkbox" type="checkbox">
                        </td>
                    </tr>
                    <tr>
                        <td>01/01/2021</td>
                        <td>Salario</td>
                        <td>1000€</td>
                        <td>
                            <select name="tipo" id="tipo">
                                <option value="1">Alimentación</option>
                                <option value="2">Vivienda</option>
                                <option value="3">Transporte</option>
                                <option value="4">Comunicaciones</option>
                                <option value="5">Ocio</option>
                                <option value="6">Salud</option>
                                <option value="7">Educación</option>
                                <option value="8">Otros</option>
                            </select>
                        </td>
                        <td>
                            <input class="checkbox" type="checkbox">
                        </td>
                    </tr>
                    <tr>
                        <td>01/01/2021</td>
                        <td>Salario</td>
                        <td>1000€</td>
                        <td>
                            <select name="tipo" id="tipo">
                                <option value="1">Alimentación</option>
                                <option value="2">Vivienda</option>
                                <option value="3">Transporte</option>
                                <option value="4">Comunicaciones</option>
                                <option value="5">Ocio</option>
                                <option value="6">Salud</option>
                                <option value="7">Educación</option>
                                <option value="8">Otros</option>
                            </select>
                        </td>
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
