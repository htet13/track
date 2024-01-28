<script>
    var sales = @json($track1);
    var purchases = @json($track2);
    var profits = @json($profits);

    document.addEventListener("DOMContentLoaded", () => {
      new ApexCharts(document.querySelector("#reportsChart"), {
        series: [{
          name: 'လမ်းကြောင်း ၁',
          data: sales.map(item => item.count),
        }, {
          name: 'လမ်းကြောင်း ၂',
          data: purchases.map(item => item.count),
        },{
          name: 'အမြတ်',
          data: profits.map(item => item.count)
        }],
        chart: {
          height: 350,
          type: 'area',
          toolbar: {
            show: false
          },
        },
        markers: {
          size: 4
        },
        colors: ['#4154f1', '#ff771d', '#2eca6a'],
        fill: {
          type: "gradient",
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.3,
            opacityTo: 0.4,
            stops: [0, 90, 100]
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
          width: 2
        },
        xaxis: {
          type: 'dateTime',
          categories: purchases.map(item => item.date), // Convert dates to timestamps
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy'
          },
        }
      }).render();
    });
  </script>
