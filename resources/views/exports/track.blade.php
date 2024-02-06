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
                <th colspan="2">{{ trans('global.person') }}</th>
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
                <th>{{ trans('cruds.driver.title_singular') }}</th>
                <th>{{ trans('cruds.spare.title_singular') }}</th>
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
                <tr id="row{{ $track->id }}">
                    <td class="text-center">{{ $index+1 }}</td>
                    <td class="w-90">{{ $track->date->format('d-m-Y') }}</td>
                    <td class="w-90">{{ $track->carNo->name }}</td>
                    <td>
                        @foreach ($track->fromcities as $city)
                            <div>{{ $city->name }}</div>@if(!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($track->tocities as $city)
                            <div>{{ $city->name }}</div>@if(!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td>{{ number_format($track->expense) }}</td>
                    <td>{{ $track->issuer->name }}</td>
                    <td>{{ $track->driver->name }}</td>
                    <td>{{ $track->spare->name }}</td>
                    <td>
                        @foreach ($track->oilCosts as $oil)
                            <div>{{ $oil->liter }}</div>@if(!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($track->oilCosts as $oil)
                            <div>{{ $oil->price }}</div>@if(!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td>{{ number_format($track->check_cost) }}</td>
                    <td>{{ number_format($track->gate_cost) }}</td>
                    <td>{{ number_format($track->food_cost) }}</td>
                    <td>
                        @foreach ($track->otherCosts as $other)
                            <div>{{ $other->category }}</div>, @if(!$loop->last)<br><br>@endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($track->otherCosts as $other)
                            <div>{{ $other->cost }}</div>@if(!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td>{{ number_format($track->total) }}</td>
                    
                </tr>
            @empty
            <tr>
                <td colspan="18" class="text-center">
                    {{ trans('global.no_data_found') }}
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>