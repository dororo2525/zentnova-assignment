@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="javascript: void(0);">Dashboards</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <div class="col-xl-8">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mini-stats-wid">
                        <div class="card-body">

                            <div class="d-flex flex-wrap">
                                <div class="me-3">
                                    <p class="text-muted mb-2">Total Links</p>
                                    <h5 class="mb-0">{{ $urls->count() }}</h5>
                                </div>

                                <div class="avatar-sm ms-auto">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                        <i class="bx bx-link"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card blog-stats-wid">
                        <div class="card-body">

                            <div class="d-flex flex-wrap">
                                <div class="me-3">
                                    <p class="text-muted mb-2">Total Clicks</p>
                                    <h5 class="mb-0">{{ $urls->sum('clicks_count') }}</h5>
                                </div>

                                <div class="avatar-sm ms-auto">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                        <i class='bx bxs-hand-up'></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-start">
                        <h5 class="card-title me-2">Clicks</h5>
                    </div>
                    <canvas id="barChart"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <!-- end col -->

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <img src="{{ asset('assets/skote/images/users/avatar-1.jpg') }}" alt=""
                                class="avatar-sm rounded-circle img-thumbnail">
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <div class="text-muted">
                                        <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                                        <p class="mb-0">{{ Auth::user()->userPackage->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="mt-3">
                                <p class="text-muted mb-1">Today</p>
                                <h5>{{ $clickToday->sum('clicks_count') }}</h5>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mt-3">
                                <p class="text-muted mb-1">This Month</p>
                                <h5>{{ $clickMonth->sum('clicks_count') }}</h5>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div>
                        <ul class="list-group list-group-flush">
                            @foreach($clickToday as $today)
                            <li class="list-group-item">
                                <div class="py-2">
                                    <h5 class="font-size-14">{{ request()->root() . '/' . $today->code }} <span class="float-end">{{ $today->clicks_count }}</span></h5>
                                    <div class="progress animated-progess progress-sm">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $today->clicks_count * 10 }}%" aria-valuenow="{{ $today->clicks_count }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- end col -->

    </div>
    <!-- end row -->
@endsection

@section('js')
    <script src="{{ asset('assets/skote/libs/chart.js/Chart.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var clickChart;
            var platformChart;
            var deviceChart;
            var browserChart;

            $.ajax({
                type: "GET",
                url: "{{ route('get-dashboard-by-year') }}",
                dataType: "json",
                success: function(response) {
                    var currentMonth = []
                    var currentData = []
                    var areaChartData = {
                        labels: month,
                        datasets: []
                    }
                    $.each(response, function(index, value) {     
                        areaChartData.datasets.push({
                            label: value.code,
                            backgroundColor: generateColorArray(response.length)[index],
                            borderColor: generateColorArray(response.length)[index],
                            pointRadius: false,
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data: value.months
                        })
                        // {
                        //     label: 'Clicks',
                        //     backgroundColor: 'rgba(60,141,188,0.9)',
                        //     borderColor: 'rgba(60,141,188,0.8)',
                        //     pointRadius: false,
                        //     pointColor: '#3b8bba',
                        //     pointStrokeColor: 'rgba(60,141,188,1)',
                        //     pointHighlightFill: '#fff',
                        //     pointHighlightStroke: 'rgba(60,141,188,1)',
                        //     data: currentData
                        // }
                    });

                    //-------------
                    //- BAR CHART -
                    //-------------
                    var barChartCanvas = $('#barChart').get(0).getContext('2d')
                    var barChartData = $.extend(true, {}, areaChartData)
                    barChartData.datasets = areaChartData.datasets
                    var barChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        datasetFill: false
                    }

                    clickChart = new Chart(barChartCanvas, {
                        type: 'bar',
                        data: barChartData,
                        options: barChartOptions
                    })
             
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
