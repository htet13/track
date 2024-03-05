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
                <th rowspan="2">{{ trans('global.name') }}</th>
                <th colspan="2">ခေါက်ရေ</th>
                <th colspan="2">@lang('global.drive_fee')</th>
            </tr>
            <tr>
                <th>ရှင်းပြီး</th>
                <th>မရှင်း</th>
                <th>ရှင်းပြီး</th>
                <th>မရှင်း</th>
            </tr>
        </thead>
        <tbody class="text-center align-middle">
            @forelse ($spare_tracks as $index => $spare)
                <tr id="row{{ $spare->id }}">
                    <td>{{ $index+1 }}</td>
                    <td>{{ $spare->spare->name }}</td>
                    <td>{{ $spare->paid_track_count }}</td>
                    <td>{{ $spare->unpaid_track_count }}</td>
                    <td>{{ $spare->paid_fee_sum }}</td>
                    <td>{{ $spare->unpaid_fee_sum }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">
                        {{ trans('global.no_data_found') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>