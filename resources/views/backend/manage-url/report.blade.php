@extends('layouts.app')

@section('css')
    <!-- DataTables -->
    <link href="{{ asset('assets/skote/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/skote/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/skote/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
        <!-- Sweet Alert-->
        <link href="{{ asset('assets/skote/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.bootstrap.min.css">
@endsection
@section('content')
<div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Report</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
<div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-5 mt-2 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Start Date</span>
                                    </div>
                                    <input type="date" class="form-control" id="startDate" required>
                                </div>
                            </div>
                            <div class="col-lg-5 mt-2 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">End Date</span>
                                    </div>
                                    <input type="date" class="form-control" id="endDate" required>
                                </div>
                            </div>
                            <div class="col-lg-2 mt-2 mb-2">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary btn-block" id="btn-search" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title click-title">Click Current year</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-4">
                <!-- PIE CHART -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Platform</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="platformChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-4">
            <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Browser</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="browserChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-4">
            <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Device</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="deviceChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->                
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
   <!-- Chart JS -->
   <script src="{{ asset('assets/skote/libs/chart.js/Chart.bundle.min.js') }}"></script>
 <script>
                 $(document).ready(function() {
        var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var clickChart;
        var platformChart;
        var deviceChart;
        var browserChart;

        $.ajax({
            type: "POST",
            url: "{{ route('get-report-by-year') }}",
            data: {
                code: "{{ $url->code }}",
                _token : "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                var currentMonth = []
                var currentData = []
                var labelPlatform = []
                var labelBrowser = []
                var labelDevice = []
                var deviceData = []
                var platformData = []
                var browserData = []

                $.each(response.months, function(index, value) {
                    currentMonth.push(month[index]);
                    currentData.push(parseInt(value));
                });

                $.each(response.urlclicks, function(index, value) {

                    if (index == 'platform') {
                        $.each(value, function(k, v) {
                            labelPlatform.push(v.platform);
                            platformData.push(v.count_platform);
                        });
                    } else if (index == 'browser') {
                        $.each(value, function(k, v) {
                            labelBrowser.push(v.browser);
                            browserData.push(v.count_browser);
                        });
                    } else if (index == 'device') {
                        $.each(value, function(k, v) {
                            labelDevice.push(v.device);
                            deviceData.push(v.count_device);
                        });
                    }
                });

                var areaChartData = {
                    labels: currentMonth,
                    datasets: [{
                        label: 'Clicks',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: currentData
                    }, ]
                }

                var platform = {
                    labels: labelPlatform,
                    datasets: [{
                        data: platformData,
                        backgroundColor: generateColorArray(platformData.length),
                    }]
                }

                var device = {
                    labels: labelDevice,
                    datasets: [{
                        data: deviceData,
                        backgroundColor: generateColorArray(deviceData.length),
                    }]
                }

                var browser = {
                    labels: labelBrowser,
                    datasets: [{
                        data: browserData,
                        backgroundColor: generateColorArray(browserData.length),
                    }]
                }

                //-------------
                //- BAR CHART -
                //-------------
                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChartData = $.extend(true, {}, areaChartData)
                var temp0 = areaChartData.datasets[0]
                barChartData.datasets[0] = temp0

                var barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false
                }

              clickChart =  new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })

                 //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var platformChartCanvas = $('#platformChart').get(0).getContext('2d')
        var pieData = platform;
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        platformChart = new Chart(platformChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var deviceChartCanvas = $('#deviceChart').get(0).getContext('2d')
        var pieData = device;
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
         deviceChart =  new Chart(deviceChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var browserChartCanvas = $('#browserChart').get(0).getContext('2d')
            var pieData = browser;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
           browserChart = new Chart(browserChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            $('.overlay').fadeOut();
        }
        });

        $('#btn-search').click(function() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            if (startDate == '' || endDate == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select start date and end date',
                })
            } else {
                $('.overlay').fadeIn();
                $.ajax({
                    type: "POST",
                    url: "{{ route('get-report-by-date-range') }}",
                    data: {
                        code: "{{ $url->code }}",
                        startDate: startDate,
                        endDate: endDate,
                        _token : "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(response) {
                     console.log(response);
                var currentMonth = []
                var currentData = []
                var labelPlatform = []
                var labelBrowser = []
                var labelDevice = []
                var deviceData = []
                var platformData = []
                var browserData = []

                $.each(response.months, function(index, value) {
                    currentMonth.push(month[index]);
                    currentData.push(parseInt(value));
                });

                $.each(response.urlclicks, function(index, value) {

                    if (index == 'platform') {
                        $.each(value, function(k, v) {
                            labelPlatform.push(v.platform);
                            platformData.push(v.count_platform);
                        });
                    } else if (index == 'browser') {
                        $.each(value, function(k, v) {
                            labelBrowser.push(v.browser);
                            browserData.push(v.count_browser);
                        });
                    } else if (index == 'device') {
                        $.each(value, function(k, v) {
                            labelDevice.push(v.device);
                            deviceData.push(v.count_device);
                        });
                    }
                });

                

                //-------------
                //- BAR CHART -
                //-------------
                clickChart.data.labels = currentMonth;
                clickChart.data.datasets[0].data = currentData;
                clickChart.update();

                 //-------------

                platformChart.data.labels = labelPlatform;
                platformChart.data.datasets[0].data = platformData;
                platformChart.update();

                deviceChart.data.labels = labelDevice;
                deviceChart.data.datasets[0].data = deviceData;
                deviceChart.update();

                browserChart.data.labels = labelBrowser;
                browserChart.data.datasets[0].data = browserData;
                browserChart.update();

            $('.click-title').text('Click from ' + startDate + ' to ' + endDate);
            $('.overlay').fadeOut();
                    }
                });
            }
        });

        function generateColorArray(length) {
            var colorArray = [];
            var hueStep = 360 / length;

            for (var i = 0; i < length; i++) {
                var hue = i * hueStep;
                var color = 'hsl(' + hue + ', 70%, 50%)';
                colorArray.push(color);
            }

            return colorArray;
        }
    })
    </script>
@endsection
