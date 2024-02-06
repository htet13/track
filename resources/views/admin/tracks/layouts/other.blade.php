<label class="border-bottom border-primary mb-2">@lang('global.other_cost')</label>
@php $loopCount = old("other") ? count(old("other.category")) : 1 @endphp
@if(count($track) > 1 && !old("other"))
    @foreach ($track as $index => $other)
        @include('admin.tracks.layouts._other_fields', [
            'loop' => $loop, 
            'fieldValue' => $other->category, 
            'fieldName' => 'other[category][]', 
            'errorName' => 'other.category.'.$index, 
            'fieldCostValue' => $other->cost, 
            'fieldCostName' => 'other[cost][]', 
            'errorCostName' => 'other.cost.'.$index
        ])
    @endforeach
@else
    @for($i = 0; $i < $loopCount; $i++) 
        @include('admin.tracks.layouts._other_fields', [
            'loop'=> (object)['first' => $i === 0], 
            'fieldValue' => old("other.category.$i"), 
            'fieldName' => 'other[category][]', 
            'errorName' => 'other.category.'.$i, 
            'fieldCostValue' => old("other.cost.$i"), 
            'fieldCostName' => 'other[cost][]', 
            'errorCostName' => 'other.cost.'.$i
        ])
    @endfor
@endif
<div class="row">
    <div class="col-12 other-append"></div>
</div>
<div class="line-break"></div>