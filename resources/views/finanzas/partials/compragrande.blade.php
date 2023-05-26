<div class="compra-grande" id="{{ $compragrande['id'] }}">

    @php
        $imagePath = 'storage/purchases/purchase_' . $compragrande['id'] . '.png';
        $imageExists = file_exists(public_path($imagePath));
    @endphp

    <img src="{{ $imageExists ? asset($imagePath) : '../img/comprasgrandes/compragrande_placeholder.png' }}"
        alt="">
    <p><span class="titulo">{{$compragrande['created_at']}} - {{ $compragrande['period'] }}</span></p>
    <p><span class="titulo">  <u>{{ $compragrande['name'] }}</u></span></p>
    <br>
    <p><span class="titulo">@lang('finances.total')</span> {{ number_format($compragrande['payed'],2) }} / {{ number_format($compragrande['amount'],2) }}€<span class="titulo"> <br> @lang('finances.monthPurchase')</span>
        {{ number_format($compragrande['cost'], 2) }}€</p>
    <div class="botones">
        <button class="borrar">@lang('finances.delete')</button>
        {{-- <button class="modificar">Modificar</button> --}}
    </div>

</div>
