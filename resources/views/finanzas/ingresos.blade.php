@extends('layout')

@section('title', 'Ingresos')

@section('content')
    <ul class="sidenav">
        <li><a href="{{ route('main') }}">Inicio</a></li>
        <li><a href="{{ route('ingresos') }}">Ingresos</a></li>
        <li><a href="{{ route('gastos') }}">Gastos</a></li>
        <li><a href="{{ route('compragrande') }}">Compra Grande</a></li>
        <li><a href="{{ route('unidadfamiliar') }}">Unidad Familiar</a></li>
        <li><a href="{{ route('historial') }}">Historial</a></li>
        <li><a class="account" href="{{ route('account') }}">Cuenta<img src="img/account_placeholder.png" alt=""></a>
        </li>
    </ul>

    <header>
        <ul class="nav">
            <li class="salir right"><a href="{{ route('index') }}">Salir</a></li>
        </ul>
    </header>

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
