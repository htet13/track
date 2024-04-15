<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ကြိုထုတ်မှတ်တမ်း</title>
</head>
<body style="font-family: 'Pyidaungsu'">
<table id="order-listing" class="table">
  <thead>
    <tr class="bg-primary text-white">
      <th><b>@lang('global.no')</b></th>
      <th><b>@lang('global.date')</b></th>
      <th><b>@lang('global.name')</b></th>
      <th><b>@lang('global.position')</b></th>
      <th><b>@lang('global.amount')</b></th>
      <th><b>@lang('global.reason')</b></th>
      <th><b>@lang('global.remarks')</b></th>
    </tr>
  </thead>
  <tbody>
    @foreach($advance_employees as $index => $advance_employee)
    <tr>
      <td>{{ $index+1 }}</td>
      <td>{{ $advance_employee->date }}</td>
      <td>{{ $advance_employee->employee->name }}</td>
      <td>{{ $advance_employee->employee->position }}</td>                
      <td>{{ $advance_employee->amount }}</td>
      <td>{!! $advance_employee->reason !!}</td>                
      <td>{!! $advance_employee->remark !!}</td>                
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>