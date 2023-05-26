@extends('layout')

@section('title', __('finances.income'))

@section('content')
    <p class="toast">@lang('finances.incomeAdded')</p>
    <div class="modal">
        <div class="modal-content">
            <span class="close">x</span>
            <form action="">
                <h1>@lang('finances.addFinance')</h1>
                <p class="error" data-name="name">@lang('finances.nameField')</p>
                <input type="text" name="name" id="name" placeholder="@lang('finances.concept')">
                <p class="error" data-name="amount">@lang('finances.amountField')</p>
                <input type="number" name="amount" id="amount" placeholder="@lang('finances.amount')">
                <div class="checkbox-container">
                    <input type="checkbox" name="constant" id="constant" value="1">
                    <label for="constant">@lang('finances.constant')</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" name="compute_household" id="compute_household" value="1">
                    <label for="compute_household">@lang('finances.household')</label>
                </div>
                <input type="hidden" name="is_income" id="is_income" value="1">
                <button class="añadir" type="submit">@lang('finances.add')</button>
            </form>
        </div>
    </div>

    <div id="titulo">
        <h1>@lang('finances.income')</h1>
    </div>

    <div class="main-content">

        <div id="tabla-ingresos">
            <table>
                <thead>
                    <tr>
                        <th hidden>Id</th>
                        <th>@lang('finances.concept')</th>
                        <th>@lang('finances.amount')</th>
                        <th>@lang('finances.constant')</th>
                        <th>@lang('finances.household')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($data['income']) > 0)
                        @foreach ($data['income'] as $income)
                            <tr>
                                <td hidden id="id">{{ $income['id'] }}</td>
                                <td>{{ $income['name'] }}</td>
                                <td>{{ $income['amount'] }}</td>
                                <td>
                                    <input class="checkbox" type="checkbox" name="constant" id="constant"
                                        {{ $income['constant'] ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input class="checkbox" type="checkbox" name="compute_household" id="compute_household"
                                        {{ $income['compute_household'] ? 'checked' : '' }}>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5"><b>@lang('finances.noIncome')</b></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <button class="borrar disabled" disabled id="borrar">
            <b>@lang('finances.delete')</b>
        </button>
        <button class="añadir" id="añadir">
            <b>@lang('finances.addFinance')</b>
        </button>
    </div>
@endsection
