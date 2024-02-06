@php
    $loopCount = old("oil") ? count(old("oil.price")) : 1;
@endphp

@if($track && !old("oil"))
    @foreach ($track->oilCosts as $index => $oil)
        @include('admin.tracks.layouts._oil_fields', ['loop' => $loop, 'fieldValue' => $oil->liter, 'fieldName' => 'oil[liter][]', 'errorName' => 'oil.liter.'.$index, 'fieldPriceValue' => $oil->price, 'fieldPriceName' => 'oil[price][]', 'errorPriceName' => 'oil.price.'.$index])
    @endforeach
@else
    @for($i = 0; $i < $loopCount; $i++)
        @include('admin.tracks.layouts._oil_fields', ['loop' => (object)['first' => $i === 0], 'fieldValue' => old("oil.liter.$i"), 'fieldName' => 'oil[liter][]', 'errorName' => 'oil.liter.'.$i, 'fieldPriceValue' => old("oil.price.$i"), 'fieldPriceName' => 'oil[price][]', 'errorPriceName' => 'oil.price.'.$i])
    @endfor
@endif

<div class="row">
    <div class="col-12 liter-price-append"></div>
</div>
<div class="line-break"></div>
