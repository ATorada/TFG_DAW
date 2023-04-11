@extends('layout')

@section('title', 'Panel principal')

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
        <h1>Panel principal</h1>
    </div>
    <div class="main-content">
        <div id="estado">
            <span>👋🏻 Hola, <span id="nombre">Nombre</span></span>
            <span id="dinero-actual">0€</span>
        </div>
        <div class="botones" class="right">
                <a href="{{ route('ingresos') }}">+</a>
                <a class="gastos" href="{{ route('gastos') }}">-</a> </li>
        </div>
        <div id="grafica">
            <h1>Finanzas del mes</h1>
            <canvas id="grafico"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var ctx = document.getElementById('grafico').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        datasets: [{
                            label: 'Finanzas del mes',
                            data: [100, 455, 15],
                            backgroundColor: ['#ef909088', '#c0e93b6e', '#a0ca1685'],
                            borderColor: ['#EF9090', '#BFE93B', '#A0CA16'],
                            borderWidth: 1
                        }],
                        labels: ['Gastos', 'Ingresos', 'Dinero Flexible']
                    },
                    options: {
                        responsive: true
                    }
                });
            </script>
        </div>
        <div id="dinero-flexible">
            <h1>Dinero flexible</h1>
            <span id="dinero-flexible-mensual"><span class="titulo">Mensual: </span> 0€</span>
            <span id="dinero-flexible-semanal"><span class="titulo">Semanal: </span> 0€</span>
            <span id="dinero-flexible-diario"><span class="titulo">Diario: </span> 0€</span>
        </div>
    </div>

@endsection
