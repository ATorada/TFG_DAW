@extends('layout')

@section('title', 'Panel principal')

@section('content')

    @php
        $usuario = [
            'flexible' => [
                'mensual' => 1000,
                'semanal' => 250,
                'diario' => 50,
            ],
            'grafica' => [
                'ingresos' => 1000,
                'gastos' => 250,
                'flexible' => 750,
            ],
            'actual' => 1000,
        ];
    @endphp

    <div id="titulo">
        <h1>Panel principal</h1>
    </div>
    <div class="main-content">
        <div id="estado">
            <span>👋🏻 Hola, <span id="nombre">Nombre</span></span>
            <span id="dinero-actual"> {{ $usuario['actual'] }}€</span>
        </div>
        <div class="botones" class="right">
            <a id="ingresos" href="{{ route('ingresos') }}">+</a>
            <a id="gastos" href="{{ route('gastos') }}">-</a> </li>
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
                            data: [ {{ $usuario['grafica']['gastos'] }}, {{ $usuario['grafica']['ingresos'] }}, {{ $usuario['grafica']['flexible'] }} ],
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
            <span id="dinero-flexible-mensual"><span class="titulo">Mensual: </span> {{ $usuario['flexible']['mensual'] }}€</span>
            <span id="dinero-flexible-semanal"><span class="titulo">Semanal: </span> {{ $usuario['flexible']['semanal'] }}€</span>
            <span id="dinero-flexible-diario"><span class="titulo">Diario: </span> {{ $usuario['flexible']['diario'] }}€</span>
        </div>
    </div>

@endsection
