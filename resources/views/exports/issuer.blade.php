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
      <th><b>@lang('global.created_at')</b></th>
    </tr>
  </thead>
  <tbody>
    @foreach($issuers as $index => $issuer)
    <tr>
      <td>{{ $index+1 }}</td>
      <td>{{ $issuer->name }}</td>
      <td>{{ $issuer->created_at->format('Y-m-d') }}</td>                
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>