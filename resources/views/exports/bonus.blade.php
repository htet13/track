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
      <th><b>@lang('global.date')</b></th>
      <th><b>@lang('global.name')</b></th>
      <th><b>@lang('global.position')</b></th>
      <th><b>@lang('global.bonus_type')</b></th>
      <th><b>@lang('global.amount')</b></th>
    </tr>
  </thead>
  <tbody>
    @foreach($bonuses as $index => $bonus)
    <tr>
      <td>{{ $index+1 }}</td>
      <td>{{ $bonus->date }}</td>
      <td>{{ $bonus->employee->name }}</td>
      <td>@lang("cruds.".$bonus->employee->position.".title_singular")</td>                
      <td>@lang("global.".$bonus->bonus_type)</td>                
      <td>{{ $bonus->amount }}</td>                
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>