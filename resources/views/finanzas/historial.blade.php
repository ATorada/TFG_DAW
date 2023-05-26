@extends('layout')

@section('title', __('finances.history'))

@section('content')

    <div id="titulo">
        <h1>@lang('finances.history')</h1>
    </div>
    <div class="main-content">
        <input placeholder="@lang('finances.search')" class="buscar" type="text" id="buscar">
        <div id="tabla-finanzas">
            <table>
                <thead>
                    <tr>
                        <th>@lang('finances.concept')</th>
                        <th>@lang('finances.period')</th>
                        <th>@lang('finances.type')</th>
                        <th>@lang('finances.amount')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $finanza)
                        <tr>
                            <td>{{ $finanza['name'] }}</td>
                            <td>{{ $finanza['period'] }}</td>
                            <td>{{ $finanza['is_income'] ? __('finances.singleIncome') : __('finances.singleExpense') }}</td>
                            <td class="{{ $finanza['is_income'] ? 'green' : 'red' }}">{{ $finanza['amount'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
