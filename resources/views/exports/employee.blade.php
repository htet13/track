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
      <th><b>@lang('global.no')</b></th>
      <th><b>@lang('global.name')</b></th>
      <th><b>@lang('global.position')</b></th>
      <th><b>@lang('global.created_at')</b></th>
      <th><b>@lang('global.resign_date')</b></th>
    </tr>
  </thead>
  <tbody>
    @foreach($employees as $index => $employee)
    <tr>
      <td>{{ $index+1 }}</td>
      <td>{{ $employee->name }}</td>
      <td>@lang("cruds.$employee->position.title_singular")</td>
      <td>{{ $employee->created_at->format('Y-m-d') }}</td>                
      <td>{{ $employee->resign_date }}</td>                
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>