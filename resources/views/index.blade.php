@extends('layout')

@section('title', 'Página principal')

@section('content')

    <div class="content">
        <div id="portada">
            <h1><span class="marked">Controla tu dinero</span> de manera fácil, rápida y gratuita</h1>
            <a href="{{ route('register') }}">
                Comenzar ahora
            </a>
        </div>
        <div id="secciones">
            <div id="seccion-principal">
                <div id="lugar">
                    <img src="img/mismositio_placeholder.png" alt="">
                    <h2>El mismo lugar</h2>
                    <p>Todos tus gastos, ingresos y gestiones en el mismo sitio.</p>
                </div>
                <div id="recurrente">
                    <img src="img/recurrente_placeholder.png" alt="">
                    <h2>No olvides lo recurrente</h2>
                    <p>Pon tus finanzas una vez y recuérdalas siempre.</p>
                </div>
                <div id="movimientos">
                    <img src="img/historial_placeholder.png" alt="">
                    <h2>Revisa tus movimientos</h2>
                    <p>Revisa siempre que quieras todos tus movimientos para no olvidar nada.</p>
                </div>
                <div id="familia">
                    <img src="img/familia_placeholder.png" alt="">
                    <h2>La familia y uno más</h2>
                    <p>Gestiona una unidad familiar, ahorrar no es solo de uno.</p>
                </div>
            </div>
            <div id="seccion-controla">
                <img src="img/greenarrow2_placeholder.png" alt="">
                <div>
                    <h2>Controla</h2>
                    <p>Controla todo el dinero que entra y sale de tus bolsillos.</p>
                </div>
            </div>
            <div id="seccion-facil">
                <div>
                    <img src="img/heart2_placeholder.png" alt="">
                    <div>
                        <h2>Fácil</h2>
                        <p>Acceso rápido e intuitivo, fácil de usar y entender para todos.</p>
                    </div>
                </div>
            </div>
            <div id="seccion-accesible">
                <img src="img/world4_placeholder.png" alt="">
                <div>
                    <h2>Accesible</h2>
                    <p>Accesible desde todas las partes del mundo cuando más lo necesites.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
