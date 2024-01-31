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
      <th><b>အမည်</b></th>
      <th><b>ဒေတာသွင်းသည့်နေ့</b></th>
    </tr>
  </thead>
  <tbody>
    @foreach($drivers as $index => $driver)
    <tr>
      <td>{{ $index+1 }}</td>
      <td>{{ $driver->name }}</td>
      <td>{{ $driver->created_at->format('Y-m-d') }}</td>                
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>