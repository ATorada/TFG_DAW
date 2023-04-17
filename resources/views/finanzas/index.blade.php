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

            <span>👋🏻 Hola, <span id="nombre">{{$data['user']}}</span></span>
            {{-- Resta $data['income'] - $data['expenses'] --}}
            <span id="dinero-actual">
                @if ($data['flexible'] >= 0)
                    <span class="dinero-actual">{{ $data['income'] - $data['expenses'] }}€</span>
                @else ($data['income'] - $data['expenses'] < 0)
                    <span class="dinero-actual red">{{ $data['income'] - $data['expenses'] }}€</span>
                @endif
            </span>
        </div>
        <div class="botones" class="right">
            <a id="ingresos" href="{{ route('finance.income') }}">+</a>
            <a id="gastos" href="{{ route('finance.expenses') }}">-</a> </li>
        </div>
        <div id="grafica">
            <h1>Finanzas del mes</h1>
            @if ($data['flexible'] != 0)
                <canvas id="grafico"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    var ctx = document.getElementById('grafico').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            datasets: [{
                                label: 'Finanzas del mes',
                                data: [ {{ $data['expenses'] }}, {{ $data['income'] }}, {{ $data['flexible'] >= 0 ? $data['flexible'] : 0 }}],
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
            @else
                <p>No hay datos para mostrar</p>
            @endif
        </div>
        <div id="dinero-flexible">
            <h1>Dinero flexible</h1>
            @php
                $dias = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
            @endphp
            <span id="dinero-flexible-mensual"><span class="titulo">Mensual: </span> <span class="{{ $data['flexible'] >= 0 ? '' : 'red' }}"> {{ round($data['flexible'], 2) }}€</span></span>
            <span id="dinero-flexible-semanal"><span class="titulo">Semanal: </span> <span class="{{ $data['flexible'] >= 0 ? '' : 'red' }}">{{ round($data['flexible']/4, 2) }}€</span></span>
            <span id="dinero-flexible-diario"><span class="titulo">Diario: </span> <span class="{{ $data['flexible'] >= 0 ? '' : 'red' }}">{{ round($data['flexible'] / $dias) }}€</span></span>
        </div>
    </div>

@endsection
