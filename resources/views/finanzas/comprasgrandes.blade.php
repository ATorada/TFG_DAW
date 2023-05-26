@extends('layout')

@section('title', __('sidenav.purchases'))

@section('content')

    <p class="toast">@lang('finances.purchaseAdded')</p>
    <div class="modal">
        <div class="modal-content">
            <span class="close">x</span>
            <form action="" enctype="multipart/form-data">
                <h1>@lang('finances.addPurchase')</h1>
                <p class="error" id="limite">@lang('finances.noMoreThan')</p>
                <p class="error" data-name="name">@lang('finances.nameField')</p>
                <input type="text" name="name" id="name" placeholder="@lang('finances.concept')">
                <p class="error" data-name="amount">@lang('finances.amountField')</p>
                <input type="number" name="amount" id="amount" placeholder="@lang('finances.amount')">
                <p class="error" data-name="period">@lang('finances.periodField')</p>
                <input type="date" name="period" id="period" placeholder="@lang('finances.period')">
                <p class="error" data-name="image">@lang('finances.imageField')</p>
                <input type="file" name="image" id="image" accept="image/*">
                <button class="añadir" type="submit">@lang('finances.add')</button>
            </form>
        </div>
    </div>

    <div id="titulo">
        <h1>@lang('sidenav.purchases')</h1>
    </div>
    <div class="main-content">

        <div id="añadir-compra">
            <br>
            <button class="añadir" id="añadir">
                <p>@lang('finances.addPurchase')</p>
            </button>
        </div>


        @for ($i = 0; $i < count($data); $i++)
            @include('finanzas.partials.compragrande', ['compragrande' => $data[$i]])
        @endfor


    </div>

@endsection
