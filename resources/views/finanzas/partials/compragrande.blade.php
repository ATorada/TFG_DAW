<div class="compra-grande" id="{{ $compragrande['id'] }}">

    @php
        $imagePath = 'storage/purchases/purchase_' . $compragrande['id'] . '.png';
        $imageExists = file_exists(public_path($imagePath));
    @endphp

    <img src="{{ $imageExists ? asset($imagePath) : '../img/comprasgrandes/compragrande_placeholder.png' }}"
        alt="">
    <p><span class="titulo">{{ $compragrande['period'] }}</span></p>
    <p><span class="titulo">{{ $compragrande['name'] }}</span></p>
    <br>
    <p><span class="titulo">Total: </span> {{ $compragrande['amount'] }}€<span class="titulo"> - €/mes:</span>
        {{ number_format($compragrande['cost'], 2) }}€</p>
    <div class="botones">
        <button class="borrar">Borrar</button>
        {{-- <button class="modificar">Modificar</button> --}}
    </div>

</div>
