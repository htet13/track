@php
$loopCount = old("driver") ? count(old("driver.fee")) : 1;
@endphp

@if($track && !old("driver"))
    @foreach ($track->driverTracks as $index => $driver)
        @include('admin.tracks.layouts._driver_fields', 
        [
            'customLoop' => $loop, 
            'fieldValue' => $driver->employee_id, 'fieldName' => 'driver[driver_id][]', 'errorName' => 'driver.driver_id.'.$index, 
            'fieldFeeValue' => $driver->fee, 'fieldFeeName' => 'driver[fee][]', 'errorFeeName' => 'driver.fee.'.$index,
            'fieldIsPaidValue' => $driver->is_paid, 'fieldIsPaidName' => 'driver[is_paid][]', 'errorIsPaidName' => 'driver.is_paid.'.$index
        ])
    @endforeach
@else
    @for($i = 0; $i < $loopCount; $i++)
        @include('admin.tracks.layouts._driver_fields', 
        [
            'customLoop' => (object)['first' => $i === 0], 
            'fieldValue' => old("driver.driver_id.$i"), 'fieldName' => 'driver[driver_id][]', 'errorName' => 'driver.driver_id.'.$i, 
            'fieldFeeValue' => old("driver.fee.$i"), 'fieldFeeName' => 'driver[fee][]', 'errorFeeName' => 'driver.fee.'.$i,
            'fieldIsPaidValue' => old("driver.is_paid.$i"), 'fieldIsPaidName' => 'driver[is_paid][]', 'errorIsPaidName' => 'driver.is_paid.'.$i
        ])
    @endfor
@endif

<div class="row">
    <div class="col-12 driver-track-append"></div>
</div>
<div class="line-break"></div>
