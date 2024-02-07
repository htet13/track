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
        <th colspan="2">{{ trans('cruds.track.title_singular') }}</th>
        <th rowspan="2">{{ trans('global.expense') }}</th>
        <th colspan="2">{{ trans('global.oil') }}</th>
        <th colspan="2">{{ trans('global.road_cost') }}</th>
        <th rowspan="2">{{ trans('global.food_cost') }}</th>
        <th rowspan="2">{{ trans('global.other_cost') }}</th>
        <th rowspan="2">{{ trans('global.total') }}</th>
    </tr>
    <tr>
        <th>{{ trans('global.from') }}</th>
        <th>{{ trans('global.to') }}</th>
        <th>{{ trans('global.liter') }}</th>
        <th>{{ trans('global.price') }}</th>
        <th>{{ trans('global.check') }}</th>
        <th>{{ trans('global.gate') }}</th>
    </tr>
  </thead>
  <tbody>
  @forelse ($reports as $index => $track)
    <tr id="row{{ $track->id }}">
        <td class="text-center">{{ $index + 1 }}</td>
        <td>
            @foreach ($track->fromcities as $city)
                <div class="badge bg-success rounded-pill">{{ $city->name }}</div>
                @if(!$loop->last)<br>@endif
            @endforeach
        </td>
        <td>
            @foreach ($track->tocities as $city)
                <div class="badge bg-success rounded-pill">{{ $city->name }}</div>
                @if(!$loop->last)<br>@endif
            @endforeach
        </td>
        <td>{{ number_format($track->expense) }}</td>
        <td>{{ number_format($track->total_oil) }}</td>
        <td>{{ number_format($track->total_price) }}</td>
        <td>{{ number_format($track->check_cost) }}</td>
        <td>{{ number_format($track->gate_cost) }}</td>
        <td>{{ number_format($track->food_cost) }}</td>
        <td>{{ number_format($track->other_cost) }}</td>
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