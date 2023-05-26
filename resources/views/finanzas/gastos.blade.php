@extends('layout')

@section('title', __('sidenav.expenses'))

@section('content')

<p class="toast">@lang('finances.expenseAdded')</p>

    <div class="modal">
        <div class="modal-content">
            <span class="close">x</span>
            <form action="">
                <h1>@lang('finances.addFinance')</h1>
                <p class="error" data-name="name">@lang('finances.nameField')</p>
                <input type="text" name="name" id="name" placeholder="@lang('finances.concept')">
                <p class="error" data-name="amount">@lang('finances.amountField')</p>
                <input type="number" name="amount" id="amount" placeholder="@lang('finances.amount')">
                <select name="category" id="category">
                    <option value="alimentacion" selected>@lang('finances.food')</option>
                    <option value="vivienda">@lang('finances.housing')</option>
                    <option value="transporte">@lang('finances.transport')</option>
                    <option value="ocio">@lang('finances.leisure')</option>
                    <option value="comunicaciones">@lang('finances.communications')</option>
                    <option value="salud">@lang('finances.health')</option>
                    <option value="educacion">@lang('finances.education')</option>
                    <option value="otros">@lang('finances.others')</option>
                </select>
                <div class="checkbox-container">
                    <input type="checkbox" name="constant" id="constant" value="1">
                    <label for="constant">@lang('finances.constant')</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" name="compute_household" id="compute_household" value="1">
                    <label for="compute_household">@lang('sidenav.household')</label>
                </div>
                <input type="hidden" name="is_income" id="is_income" value="0">
                <button class="añadir" type="submit">@lang('finances.add')</button>
            </form>
        </div>
    </div>

    <div id="titulo">
        <h1>@lang('sidenav.expenses')</h1>
    </div>

    <div class="main-content">
        <div id="ahorro">
            <h1>@lang('finances.savings')</h1>
            <h2>@lang('finances.currentSavings')<span id="ahorroActual" >{{ $data['ahorro'] ?? 0 }}</span></h2>
            <h2>@lang('finances.availableMoney')<span id="dineroDisponible">{{ (($data['income'] ?? 0) ? $data['income'] : 0) - $data['ahorro'] }}</span>/<span id="dineroTotal">{{ (($data['income'] ?? 0) ? $data['income'] : 0) }}</span></h2>
            <input data-id="{{$data['ahorro_id']}}" type="range" min="0" max="100" value="{{ intval(intval($data['ahorro'])*100/intval((($data['income'] ?? 0) ? $data['income'] : 1))) }}" id="ahorroSlider">
            <output>{{ intval(intval($data['ahorro'] ?? 0)*100/intval((($data['income'] ?? 0) ? $data['income'] : 1))) }}%</output>

            <div id="botones">
            @if ($data['ahorro'])
                <button class="añadir" id="añadirAhorro" style="display: none">@lang('finances.addSavings')</button>
                <button class="modificar" id="editarAhorro">@lang('finances.modifySavings')</button>
            @else
                <button class="añadir" id="añadirAhorro">@lang('finances.addSavings')</button>
                <button class="modificar" id="editarAhorro" style="display: none">@lang('finances.modifySavings')</button>
            @endif
            <button class="borrar" id="borrarAhorro">@lang('finances.deleteSavings')</button>
            </div>
        </div>
        <div id="tabla-gastos">
            <table>
                <thead>
                    <tr>
                        <th hidden>Id</th>
                        <th>@lang('finances.concept')</th>
                        <th>@lang('finances.amount')</th>
                        <th>@lang('finances.category')</th>
                        <th>@lang('finances.constant')</th>
                        <th>@lang('finances.household')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($data['expenses']) > 0)
                        @foreach ($data['expenses'] as $gasto)
                            <tr>
                                <td hidden id="id">{{ $gasto['id'] }}</td>
                                <td>{{ $gasto['name'] }}</td>
                                <td>{{ $gasto['amount'] }}</td>
                                <td>
                                    <select name="category" id="category">
                                        <option value="alimentacion"
                                            {{ $gasto['category'] == 'alimentacion' ? 'selected' : '' }}>
                                            @lang('finances.food')</option>
                                        <option value="vivienda" {{ $gasto['category'] == 'vivienda' ? 'selected' : '' }}>
                                            @lang('finances.housing')</option>
                                        </option>
                                        <option value="transporte"
                                            {{ $gasto['category'] == 'transporte' ? 'selected' : '' }}>
                                            @lang('finances.transport')</option>
                                        <option value="comunicaciones"
                                            {{ $gasto['category'] == 'comunicaciones' ? 'selected' : '' }}>@lang('finances.communications')
                                        </option>
                                        <option value="ocio" {{ $gasto['category'] == 'ocio' ? 'selected' : '' }}>@lang('finances.leisure')
                                        </option>
                                        <option value="salud" {{ $gasto['category'] == 'salud' ? 'selected' : '' }}>@lang('finances.health')
                                        </option>
                                        <option value="educacion"
                                            {{ $gasto['category'] == 'educacion' ? 'selected' : '' }}>
                                            @lang('finances.education')</option>
                                        <option value="otros" {{ $gasto['category'] == 'otros' ? 'selected' : '' }}>@lang('finances.others')
                                        </option>
                                    </select>
                                <td>
                                    <input class="checkbox" type="checkbox" {{ $gasto['constant'] ? 'checked' : '' }} name="constant">
                                </td>
                                <td>
                                    <input class="checkbox" type="checkbox"
                                        {{ $gasto['compute_household'] ? 'checked' : '' }} name="compute_household">
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6"><b>@lang('finances.noExpenses')</b></td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
        <button class="borrar disabled" disabled id="borrar">
            <b>@lang('finances.delete')</b>
        </button>
        <button class="añadir" id="añadir">
            <b>@lang('finances.add')</b>
        </button>
    </div>
@endsection
