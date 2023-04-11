@extends('layout')

@section('title', 'Compra grande')

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
        <h1>Compra grande</h1>
    </div>
    <div class="main-content">

        <div id="añadirCompraGrande">
            <br>
            <button class="añadir">
                <p>Añadir</p>
            </button>
        </div>

        <div class="compragrande">
            <img src="img/compragrande_placeholder.png" alt="">
            <p><span class="titulo">01/2021</span> </p>
            <p><span class="titulo">Nombre</span></p>
            <p><span class="titulo"></span></p>
            <br>
            <p><span class="titulo">Total: </span>1000€<span class="titulo"> - €/mes:</span> 100€</p>
            <div class="botones">
                <button class="borrar">Borrar</button>
                <button class="modificar">Modificar</button>
            </div>
        </div>

        <div class="compragrande">
            <img src="img/compragrande_placeholder.png" alt="">
            <p><span class="titulo">01/2021</span> </p>
            <p><span class="titulo">Nombre</span></p>
            <p><span class="titulo"></span></p>
            <br>
            <p><span class="titulo">Total: </span>1000€<span class="titulo"> - €/mes:</span> 100€</p>
            <div class="botones">
                <button class="borrar">Borrar</button>
                <button class="modificar">Modificar</button>
            </div>
        </div>

        <div class="compragrande">
            <img src="img/compragrande_placeholder.png" alt="">
            <p><span class="titulo">01/2021</span> </p>
            <p><span class="titulo">Nombre</span></p>
            <p><span class="titulo"></span></p>
            <br>
            <p><span class="titulo">Total: </span>1000€<span class="titulo"> - €/mes:</span> 100€</p>
            <div class="botones">
                <button class="borrar">Borrar</button>
                <button class="modificar">Modificar</button>
            </div>
        </div>

        <div class="compragrande">
            <img src="img/compragrande_placeholder.png" alt="">
            <p><span class="titulo">01/2021</span> </p>
            <p><span class="titulo">Nombre</span></p>
            <p><span class="titulo"></span></p>
            <br>
            <p><span class="titulo">Total: </span>1000€<span class="titulo"> - €/mes:</span> 100€</p>
            <div class="botones">
                <button class="borrar">Borrar</button>
                <button class="modificar">Modificar</button>
            </div>
        </div>

        <div class="compragrande">
            <img src="img/compragrande_placeholder.png" alt="">
            <p><span class="titulo">01/2021</span> </p>
            <p><span class="titulo">Nombre</span></p>
            <br>
            <p><span class="titulo">Total: </span>1000€<span class="titulo"> - €/mes:</span> 100€</p>
            <div class="botones">
                <button class="borrar">Borrar</button>
                <button class="modificar">Modificar</button>
            </div>
        </div>

    </div>

@endsection
