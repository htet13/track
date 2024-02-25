<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body style="font-family: 'Pyidaungsu'">
    <table id="order-listing" class="table">
        <thead class="text-center align-middle">
            <tr>
                <th rowspan="2">{{ trans('global.no') }}</th>
                <th rowspan="2" class="w-90">{{ trans('global.date') }}</th>
                <th rowspan="2" class="w-90">{{ trans('cruds.car_no.title_singular') }}</th>
                <th colspan="2">{{ trans('cruds.track.title_singular') }}</th>
                <th colspan="2">{{ trans('global.expense') }}</th>
                <th colspan="3">{{ trans('cruds.driver.title_singular') }}</th>
                <th colspan="3">{{ trans('cruds.spare.title_singular') }}</th>
                <th colspan="2">{{ trans('global.oil') }}</th>
                <th colspan="2">{{ trans('global.road_cost') }}</th>
                <th rowspan="2">{{ trans('global.food_cost') }}</th>
                <th colspan="2">{{ trans('global.other_cost') }}</th>
                <th rowspan="2">{{ trans('global.total') }}</th>
            </tr>
            <tr>
                <th>{{ trans('global.from') }}</th>
                <th>{{ trans('global.to') }}</th>
                <th>{{ trans('global.amount') }}</th>
                <th>{{ trans('cruds.issuer.title_singular') }}</th>
                <th>{{ trans('global.name') }}</th>
                <th>{{ trans('global.drive_fee') }}</th>
                <th>ရှင်း/ မရှင်း</th>
                <th>{{ trans('global.name') }}</th>
                <th>{{ trans('global.drive_fee') }}</th>
                <th>ရှင်း/ မရှင်း</th>
                <th>{{ trans('global.liter') }}</th>
                <th>{{ trans('global.price') }}</th>
                <th>{{ trans('global.check') }}</th>
                <th>{{ trans('global.gate') }}</th>
                <th>{{ trans('global.category') }}</th>
                <th>{{ trans('global.cost') }}</th>
            </tr>
        </thead>
        <tbody class="text-center align-middle">
            @forelse ($tracks as $index => $track)
                @php 
                    $driverTracksCount = count($track->driverTracks);
                    $spareTracksCount = count($track->spareTracks);
                    $difference = abs($driverTracksCount - $spareTracksCount);
                    $maxCount = max($driverTracksCount, $spareTracksCount);
                @endphp
                <tr id="row{{ $track->id }}">
                    <td rowspan="{{ $maxCount }}" class="text-center">{{ $index + 1 }}</td>
                    <td rowspan="{{ $maxCount }}" class="w-90">{{ $track->date->format('d-m-Y') }}</td>
                    <td rowspan="{{ $maxCount }}" class="w-90">{{ $track->carNo->name }}</td>
                    <td rowspan="{{ $maxCount }}">
                        @foreach ($track->fromcities as $city)
                        <div class="badge bg-success rounded-pill">{{ $city->name }}</div>
                        @endforeach
                    </td>
                    <td rowspan="{{ $maxCount }}">
                        @foreach ($track->tocities as $city)
                        <div class="badge bg-success rounded-pill">{{ $city->name }}</div>
                        @endforeach
                    </td>
                    <td rowspan="{{ $maxCount }}">{{ number_format($track->expense) }}</td>
                    <td rowspan="{{ $maxCount }}">{{ $track->issuer->name }}</td>
                    <td>{{ $track->driverTracks[0]->driver->name }}</td>
                    <td>{{ $track->driverTracks[0]->fee }}</td>
                    <td>@lang('global.'.$track->driverTracks[0]->is_paid)</td>
                    <td>{{ $track->spareTracks[0]->spare->name }}</td>
                    <td>{{ $track->spareTracks[0]->fee }}</td>
                    <td>@lang('global.'.$track->spareTracks[0]->is_paid)</td>
                    <td rowspan="{{ $maxCount }}">
                        @foreach ($track->oilCosts as $oil)
                        <div>{{ number_format($oil->liter) }}</div>
                        @endforeach
                    </td>
                    <td rowspan="{{ $maxCount }}">
                        @foreach ($track->oilCosts as $oil)
                        <div>{{ number_format($oil->price) }}</div>
                        @endforeach
                    </td>
                    <td rowspan="{{ $maxCount }}">{{ number_format($track->check_cost) }}</td>
                    <td rowspan="{{ $maxCount }}">{{ number_format($track->gate_cost) }}</td>
                    <td rowspan="{{ $maxCount }}">{{ number_format($track->food_cost) }}</td>
                    <td rowspan="{{ $maxCount }}">
                        @foreach ($track->otherCosts as $other)
                        <div style=" @if(!$loop->last) border-bottom: 1px solid #031F63; @endif padding-top: 5px; padding-bottom: 5px;">{{ $other->category }}</div>
                        @endforeach
                    </td>
                    <td rowspan="{{ $maxCount }}">
                        @foreach ($track->otherCosts as $other)
                        <div>{{ number_format($other->cost) }}</div>
                        @endforeach
                    </td>
                    <td rowspan="{{ $maxCount }}">{{ number_format($track->total) }}</td>
                    
                </tr>
                @for($i=1; $i < $maxCount; $i++)
                <tr>
                    @if($i < $driverTracksCount)
                    <td>{{ $track->driverTracks[$i]->driver->name }}</td>
                    <td>{{ $track->driverTracks[$i]->fee }}</td>
                    <td>@lang('global.'.$track->driverTracks[$i]->is_paid)</td>
                    @else
                    <td></td>
                    <td></td>
                    <td></td>
                    @endif
                    @if($i < $spareTracksCount)
                    <td>{{ $track->spareTracks[$i]->spare->name }}</td>
                    <td>{{ $track->spareTracks[$i]->fee }}</td>
                    <td>@lang('global.'.$track->spareTracks[$i]->is_paid)</td>
                    @else
                    <td></td>
                    <td></td>
                    <td></td>
                    @endif
                </tr>
                @endfor
                @empty
                <tr>
                    <td colspan="22" class="text-center">
                        {{ trans('global.no_data_found') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>