<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@lang("month.".$salaries[0]->month)လ</title>
</head>
<body style="font-family: 'Pyidaungsu'">
<table id="order-listing" class="table">
  <thead>
    <tr class="bg-primary text-white">
      <th><b>{{ trans('global.no') }}</b></th>
      <th><b>{{ trans('global.name') }}</b></th>
      <th><b>{{ trans('global.position') }}</b></th>
      <th><b>{{ trans('global.month') }}</b></th>
      <th><b>{{ trans('global.year') }}</b></th>
      <th><b>{{ trans('global.paid') }}/ {{ trans('global.unpaid') }}</b></th>
      <th><b>{{ trans('global.payment_date') }}</b></th>
    </tr>
  </thead>
  <tbody>
    @foreach($salaries as $index => $salary)
    <tr>
      <td>{{ $index+1 }}</td>
      <td>{{ $salary->employee->name }} (@lang("global.".$salary->employee->salary_type))</td>
      <td>@lang("cruds.".$salary->employee->position.".title_singular")</td>
      <td>@lang("month.".$salary->month)</td>
      <td>{{ $salary->year }}</td>
      <td>@lang("global.".$salary->is_paid)</td>
      <td>{{ optional($salary->payment_date)->format('d-m-Y') }}</td>               
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>