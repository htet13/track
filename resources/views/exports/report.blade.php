<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body style="font-family: 'Arial, Helvetica, sans-serif'">
<table id="order-listing" class="table">
  <thead>
    <tr class="bg-primary text-white">
      <th><b>စဉ်</b></th>
      <th><b>ဝယ်သူ</b></th>
      <th><b>အမျိုးအစား</b></th>
      <th><b>အရေအတွက်</b></th>
      <th><b>ကျသင့်ငွေ</b></th>
    </tr>
  </thead>
  <tbody>
    @foreach($reports as $index => $report)
    <tr>
      <td>{{ $index+1 }}</td>
      <td>{{ $report->supplier->name }}</td>
      <td>{{ $report->category->name }}</td>
      <td>{{ $report->quantity }}</td>
      <td>{{ $report->total }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>