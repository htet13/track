@php
$loopCount = old("spare") ? count(old("spare.fee")) : 1;
@endphp

@if($track && !old("spare"))
    @foreach ($track->spareTracks as $index => $spare)
        @include('admin.tracks.layouts._spare_fields', 
        [
            'customLoop' => $loop, 
            'fieldValue' => $spare->employee_id, 'fieldName' => 'spare[spare_id][]', 'errorName' => 'spare.spare_id.'.$index, 
            'fieldFeeValue' => $spare->fee, 'fieldFeeName' => 'spare[fee][]', 'errorFeeName' => 'spare.fee.'.$index,
            'fieldIsPaidValue' => $spare->is_paid, 'fieldIsPaidName' => 'spare[is_paid][]', 'errorIsPaidName' => 'spare.is_paid.'.$index
        ])
    @endforeach
@else
    @for($i = 0; $i < $loopCount; $i++)
        @include('admin.tracks.layouts._spare_fields', 
        [
            'customLoop' => (object)['first' => $i === 0], 
            'fieldValue' => old("spare.spare_id.$i"), 'fieldName' => 'spare[spare_id][]', 'errorName' => 'spare.spare_id.'.$i, 
            'fieldFeeValue' => old("spare.fee.$i"), 'fieldFeeName' => 'spare[fee][]', 'errorFeeName' => 'spare.fee.'.$i,
            'fieldIsPaidValue' => old("spare.is_paid.$i"), 'fieldIsPaidName' => 'spare[is_paid][]', 'errorIsPaidName' => 'spare.is_paid.'.$i
        ])
    @endfor
@endif

<div class="row">
    <div class="col-12 spare-track-append"></div>
</div>
<div class="line-break"></div>
