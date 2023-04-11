@extends('layout')

@section('title', 'Historial')

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
