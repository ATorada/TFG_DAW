<div class="compra-grande">
    <img src="../img/comprasgrandes/{{ $compragrande['id'] }}.png" alt="">
    <p><span class="titulo">{{ $compragrande['fecha'] }}</span></p>
    <p><span class="titulo">{{ $compragrande['nombre'] }}</span></p>
    <br>
    <p><span class="titulo">Total: </span> {{ $compragrande['total'] }}€<span class="titulo"> - €/mes:</span> {{ $compragrande['precio_mes'] }}€</p>
    <div class="botones">
        <button class="borrar">Borrar</button>
        <button class="modificar">Modificar</button>
    </div>

</div>
