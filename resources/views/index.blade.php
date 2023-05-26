@extends('layout')

@section('title',  __('homepage.page'))

@section('content')

    <div class="content">
        <div id="portada">
            <h1>@lang('homepage.control')</h1>

            @if (session('token'))
            <a href="{{ route('finance.index') }}">
                @lang('homepage.dashboard')
            </a>
            @else
            <a href="{{ route('registerForm') }}">
                @lang('homepage.start')
            </a>
            @endif
            <br>
            <img src="img/seccionPrincipal.png" alt="">
        </div>
        <div id="secciones">
            <div id="seccion-principal">
                <div id="lugar">
                    <img src="img/mismositio_placeholder.png" alt="">
                    <h2>@lang('homepage.samePlace')</h2>
                    <p>@lang('homepage.allExpenses')</p>
                </div>
                <div id="recurrente">
                    <img src="img/recurrente_placeholder.png" alt="">
                    <h2>@lang('homepage.dontForget')</h2>
                    <p>@lang('homepage.setFinances')</p>
                </div>
                <div id="movimientos">
                    <img src="img/historial_placeholder.png" alt="">
                    <h2>@lang('homepage.checkMovements')</h2>
                    <p>@lang('homepage.alwaysCheck')</p>
                </div>
                <div id="familia">
                    <img src="img/familia_placeholder.png" alt="">
                    <h2>@lang('homepage.family')</h2>
                    <p>@lang('homepage.manageHousehold')</p>
                </div>
            </div>
            <div id="seccion-controla">
                <img src="img/greenarrow2_placeholder.png" alt="">
                <div>
                    <h2>@lang('homepage.controlMoney')</h2>
                    <p>@lang('homepage.controlMoney2')</p>
                </div>
            </div>
            <div id="seccion-facil">
                <div>
                    <img src="img/heart2_placeholder.png" alt="">
                    <div>
                        <h2>@lang('homepage.easy')</h2>
                        <p>@lang('homepage.easy2')</p>
                    </div>
                </div>
            </div>
            <div id="seccion-accesible">
                <img src="img/world4_placeholder.png" alt="">
                <div>
                    <h2>@lang('homepage.accessible')</h2>
                    <p>@lang('homepage.accessible2')</p>
                </div>
            </div>
        </div>
    </div>
@endsection
