@extends('admin.layouts.master')
@section('css')
    <style>
        .chart-area {
            height: 300px;
        }

    </style>
@endsection
@section('content')
    <section class="content">
        <header class="content__title">
            <h1>Dashboard</h1>
        </header>
        <div class="row quick-stats">

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item" style="background-color: #e5e5e5;">
                    <div class="quick-stats__info">
                       <img src="{{ asset('admin/img/logocard.png') }}" style="width:100%">
                    </div>                
                </div>
            </div>     

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item bg-blue">
                    <div class="quick-stats__info">
                        <h2>{{ $tOrdes }}</h2>
                        <small>Total Reservations</small>
                    </div>

                    <div class="quick-stats__chart sparkline-bar-stats">6,4,8,6,5,6,7,8,3,5,9,5</div>
                </div>
            </div>          

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item bg-purple">
                    <div class="quick-stats__info">
                        <h2>PKR {{ $tSales }}</h2>
                        <small>Total Reservation Sales</small>
                    </div>
                    <div class="quick-stats__chart sparkline-bar-stats">9,4,6,5,6,4,5,7,9,3,6,5</div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item bg-red">
                    <div class="quick-stats__info">
                        <h2>PKR {{ $tPendingPay }}</h2>
                        <small>Unpaid Reservations</small>
                    </div>

                    <div class="quick-stats__chart sparkline-bar-stats">5,6,3,9,7,5,4,6,5,6,4,9</div>
                </div>
            </div>
        </div>

     


    </section>
@endsection
@section('js')
    <script src="{{ asset('admin/demo/js/flot-charts/dynamic.js') }}"></script>
    <script src="{{ asset('admin/js/Chart.min.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var r = document.querySelector(':root');

        function getCssVar(cssVar) {
            var rs = getComputedStyle(r);
            return rs.getPropertyValue('--' + cssVar);
        }
    </script>
    <script type="text/javascript">
        const url = "{{ route('admin.sales_chart') }}";
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito',
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");

        axios.get(url)
            .then(function(response) {
                const data_keys = Object.keys(response.data);
                const data_values = Object.values(response.data);
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data_keys, // ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        datasets: [{
                            label: "Earnings",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: getCssVar("{{ $config['CURRENTHEME'] ?? 'green' }}"),
                            pointRadius: 3,
                            pointBackgroundColor: getCssVar(
                                "{{ $config['CURRENTHEME'] ?? 'green' }}"),
                            pointBorderColor: getCssVar("{{ $config['CURRENTHEME'] ?? 'green' }}"),
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: getCssVar(
                                "{{ $config['CURRENTHEME'] ?? 'green' }}"),
                            pointHoverBorderColor: getCssVar(
                                "{{ $config['CURRENTHEME'] ?? 'green' }}"),
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: data_values, // [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'date'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    maxTicksLimit: 5,
                                    padding: 10,
                                    // Include a dollar sign in the ticks
                                    callback: function(value, index, values) {
                                        return '$' + number_format(value);
                                    }
                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                                }
                            }
                        }
                    }
                });
            })
            .catch(function(error) {
                //   vm.answer = 'Error! Could not reach the API. ' + error
                console.log(error)
            });
    </script>
    <script type="text/javascript">
        // $( document ).ready(function() {
        //     window.location.href = '/admin/config';
        // });
    </script>
@endsection
