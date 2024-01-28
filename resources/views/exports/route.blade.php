<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body style="font-family: 'Pyidaungsu'">
    <table id="order-listing" class="table">
        <thead>
            <tr class="bg-primary text-white">
                <th><b>စဉ်</b></th>
                <th><b>@lang('global.from')</b></th>
                <th><b>@lang('global.to')</b></th>
                <th><b>@lang('global.total')</b></th>
                <th><b>@lang('global.others')</b></th>
                <th><b>@lang('global.created_at')</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach($routes as $index => $route)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $route->fromCity->name }}</td>
                <td>{{ $route->toCity->name }}</td>
                <td>{{ $route->amount }}</td>
                <td>
                    @foreach ($route->cities as $city)
                    <span>{{ $city->name }}</span>,
                    @endforeach
                </td>
                <td>{{ $route->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>