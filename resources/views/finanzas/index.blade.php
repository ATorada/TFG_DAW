@extends('layout')

@section('title', __('sidenav.home'))

@section('content')
    {{ session(['locale' => 'es']) }}
    <div id="titulo">
        <h1>@lang('sidenav.home')</h1>
    </div>
    <div class="main-content">
        <div id="estado">

            <span>@lang('finances.hello') <span id="nombre">{{$data['user']}}</span></span>

            <span id="dinero-actual">
                @if ($data['flexible'] >= 0)
                    <span class="dinero-actual">{{ $data['income'] - $data['expenses'] }}€</span>
                @else
                    <span class="dinero-actual red">{{ $data['income'] - $data['expenses'] }}€</span>
                @endif
            </span>
        </div>
        <div class="botones" class="right">
            <a id="ingresos" href="{{ route('finance.income') }}">+</a>
            <a id="gastos" href="{{ route('finance.expenses') }}">-</a> </li>
        </div>
        <div id="grafica">
            <h1>@lang('finances.monthlyFinances')</h1>
            @if ($data['flexible'] != 0)
                <canvas id="grafico"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    var ctx = document.getElementById('grafico').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            datasets: [{
                                label: '@lang('finances.monthlyFinances')',
                                data: [ {{ $data['expenses'] }}, {{ $data['income'] }}, {{ $data['flexible'] >= 0 ? $data['flexible'] : 0 }}],
                                backgroundColor: ['#ef909088', '#c0e93b6e', '#a0ca1685'],
                                borderColor: ['#EF9090', '#BFE93B', '#A0CA16'],
                                borderWidth: 1
                            }],
                            labels: ['@lang('finances.expenses')', '@lang('finances.income')', '@lang('finances.flexibleMoney')']
                        },
                        options: {
                            responsive: true
                        }
                    });
                </script>
            @else
                <p>@lang('finances.noData')</p>
            @endif
        </div>
        <div id="dinero-flexible">
            <h1>@lang('finances.flexibleMoney')</h1>
            @php
                $dias = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
            @endphp
            <span id="dinero-flexible-mensual"><span class="titulo">@lang('finances.monthly')</span> <span class="{{ $data['flexible'] >= 0 ? '' : 'red' }}"> {{ round($data['flexible'], 2) }}€</span></span>
            <span id="dinero-flexible-semanal"><span class="titulo">@lang('finances.weekly')</span> <span class="{{ $data['flexible'] >= 0 ? '' : 'red' }}">{{ round($data['flexible']/4, 2) }}€</span></span>
            <span id="dinero-flexible-diario"><span class="titulo">@lang('finances.daily') </span> <span class="{{ $data['flexible'] >= 0 ? '' : 'red' }}">{{ round($data['flexible'] / $dias) }}€</span></span>
        </div>
    </div>

@endsection
