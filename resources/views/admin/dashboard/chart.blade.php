<script>
    var tracks = @json($tracks->toArray());
    var data = []; var labels = [];
    tracks.map((track) => {
        data.push(parseFloat(track.total_expense));
        labels.push(track.issuer.name);
    });
    
    var optionsPieChart = {
        series: data,
        chart: {
            type: 'pie',
            height: 360,
        },
        theme: {
            monochrome: {
                enabled: true,
                color: '#031F63',
            }
        },
        labels: labels,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        tooltip: {
            fillSeriesColor: false,
            onDatasetHover: {
                highlightDataSeries: false,
            },
            theme: 'light',
            style: {
                fontSize: '12px',
                fontFamily: 'Inter',
            },
            y: {
                formatter: function (val) {
                    return val + " MMK"
                }
            }
        },
    };

    var optionsBarChart = {
        series: [{
            name: 'စရိတ်',
            data: data
        }],
        chart: {
            type: 'bar',
            width: "100%",
            height: 360,
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
                animateGradually: {
                    enabled: true,
                    delay: 150
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 350
                }
            }
        },
        theme: {
            monochrome: {
                enabled: true,
                color: '#031F63',
            }
        },
        dataLabels: {
          formatter: (val) => {
            return val / 1000 + 'K'
          }
        },
        plotOptions: {
            bar: {
                columnWidth: '20%',
                borderRadius: 5,
                radiusOnLastStackedBar: true,
                colors: {
                    backgroundBarColors: ['#F2F4F6', '#F2F4F6', '#F2F4F6', '#F2F4F6'],
                    backgroundBarRadius: 5,
                },
                dataLabels: {
                    position: 'top'
                }
            }
        },
        labels: [1, 2, 3, 4, 5, 6, 7],
        xaxis: {
            categories: labels,
            crosshairs: {
                width: 1
            },
        },
        yaxis: {
          labels: {
            formatter: (val) => {
              return val / 1000 + 'K'
            }
          }
        },
        tooltip: {
            fillSeriesColor: false,
            onDatasetHover: {
                highlightDataSeries: false,
            },
            theme: 'light',
            style: {
                fontSize: '12px',
                fontFamily: 'Inter',
            },
            y: {
                formatter: function (val) {
                    return val + " MMK"
                }
            }
        },
    };

    var optionsLineChart = {
        series: [{
            name: 'Expenses',
            data: data
        }],
        labels: labels,
        chart: {
            type: 'area',
            width: "100%",
            height: 360
        },
        theme: {
            monochrome: {
                enabled: true,
                color: '#31316A',
            }
        },
        tooltip: {
            fillSeriesColor: false,
            onDatasetHover: {
                highlightDataSeries: false,
            },
            theme: 'light',
            style: {
                fontSize: '12px',
                fontFamily: 'Inter',
            },
            y: {
                formatter: function (val) {
                    return val + " MMK"
                }
            }
        },
    };

    var lineChartEl = document.getElementById('lineChart');
    if (lineChartEl) {
        var lineChart = new ApexCharts(lineChartEl, optionsLineChart);
        lineChart.render();
    }

    var pieChartEl = document.getElementById('pieChart');
    if (pieChartEl) {
        var pieChart = new ApexCharts(pieChartEl, optionsPieChart);
        pieChart.render();
    }

    var barChartEl = document.getElementById('barChart');
    if (barChartEl) {
        var barChart = new ApexCharts(barChartEl, optionsBarChart);
        barChart.render();
    }
</script>
