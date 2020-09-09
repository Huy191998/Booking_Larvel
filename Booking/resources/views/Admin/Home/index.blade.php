@extends('layouts.main')
@section('title','Admin')
@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body" style="height: 664px">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Biểu đồ thống kê</h4>
                                <h5 class="card-subtitle"></h5>
                            </div>
                            <div class="ml-auto d-flex no-block align-items-center">
                                <ul class="list-inline font-12 dl m-r-15 m-b-0">

                                </ul>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 60px">
                            <!-- column -->
                            <div class="col-lg-12">
                                <div id="pie_chart" class="campaign ct-charts" style="width:750px; height:450px;"></div>
                            </div>
                            <!-- column -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Trạng thái</h4>
                        <div class="feed-widget">
                            <ul class="list-style-none feed-body m-0 p-b-20">
                                <li class="feed-item">
                                    <div class="feed-icon bg-warning"><i class="fa fa-cc-visa"></i></div>
                                    {{count($bookrooms)}}<span class="ml-auto font-12 text-muted">Thanh toán</span></li>
                                <li class="feed-item">
                                    <div class="feed-icon bg-info"><i class="fa fa-comments"></i></div>
                                    {{count($comments)}} <span class="ml-auto font-12 text-muted">Bình Luận</span>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-icon bg-success"><i class="fa fa-bed"></i></div>
                                    {{count($hotels)}}<span class="ml-auto font-12 text-muted">khách sạn</span>
                                </li>
                                <li class="feed-item">
                                    <div class="feed-icon bg-danger"><i class="fa fa-user-plus"></i></div>
                                    {{count($users)}}<span class="ml-auto font-12 text-muted">Quản trị viên</span></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Biều đồ thống kê</h4>
                                <h5 class="card-subtitle"></h5>
                            </div>
                            <div class="ml-auto d-flex no-block align-items-center">
                                <ul class="list-inline font-12 dl m-r-15 m-b-0">
                                    <li class="list-inline-item text-danger"><i class="fa fa-circle"></i> Nữ</li>
                                    <li class="list-inline-item text-primary"><i class="fa fa-circle"></i> Nam</li>
                                </ul>
                            </div>
                        </div>
                        <div class="feed-widget" style="margin-top: 10px">
                            <ul class="list-style-none feed-body m-0 p-b-20" id="chart_quang"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--colum chart -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var users =  <?php echo json_encode($users) ?>;
        var listDay = <?php echo json_encode($listDay) ?>;
        var arrRevenueTransactionMonth = <?php echo json_encode($arrRevenueTransactionMonth) ?>;
        Highcharts.chart('pie_chart', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Tăng trưởng doanh thu đặt phòng mới, 2020'
            },
            subtitle: {
                text: 'booking hotel'
            },
            xAxis: {
                categories: listDay
            },
            yAxis: {
                title: {
                    text: 'Tổng tiền'
                },
                labels: {
                    formatter: function () {
                        return this.value + 'đ';
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Doanh thu đặt phòng',
                marker: {
                    symbol: 'square'
                },
                data: arrRevenueTransactionMonth

            }]
        });
    </script>


    <!--analytics chart-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var analytics = <?php echo $Sex; ?>

        google.charts.load('current', {'packages': ['corechart']});

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(analytics);
            var options = {
                title: 'Tỷ lệ Người dùng Nam Nữ đăng ký dịch vụ',
                is3D: true,

            };
            var chart = new google.visualization.PieChart(document.getElementById('chart_quang'));
            chart.draw(data, options);
        }
    </script>

@endsection
