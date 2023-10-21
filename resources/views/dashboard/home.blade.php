@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Welcome {{ Session::get('name') }}!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ Session::get('name') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Students</h6>
                                    <h3>{{ $studentCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="assets/img/icons/dash-icon-01.svg" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Teachers</h6>
                                    <h3>{{ $teacherCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="assets/img/icons/teacher-icon-01.svg" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Department</h6>
                                    <h3>{{ $departmentCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="assets/img/icons/dash-icon-03.svg" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Revenue</h6>
                                    <h3>&#8358;{{ $revenueCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="assets/img/icons/dash-icon-04.svg" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-6">

                    <div class="card card-chart">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Overview</h5>
                                </div>
                                <div class="col-6">
                                    <ul class="chart-list-out">
                                        <li><span class="circle-blue"></span>Teacher</li>
                                        <li><span class="circle-green"></span>Student</li>
                                        <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="apexcharts-area"></div>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 col-lg-6">

                    <div class="card card-chart">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Number of Students</h5>
                                </div>
                                <div class="col-6">
                                    <ul class="chart-list-out">
                                        <li><span class="circle-blue"></span>Girls</li>
                                        <li><span class="circle-green"></span>Boys</li>
                                        <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="bar"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 d-flex">

                    {{-- <div class="card flex-fill student-space comman-shadow">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="card-title">Star Students</h5>
                            <ul class="chart-list-out student-ellips">
                                <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table star-student table-hover table-center table-borderless table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th class="text-center">Marks</th>
                                            <th class="text-center">Percentage</th>
                                            <th class="text-end">Year</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-nowrap">
                                                <div>PRE2209</div>
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="profile.html">
                                                    <img class="rounded-circle"src="{{ URL::to('assets/img/profiles/avatar-01.jpg') }}"
                                                        width="25" alt="Star Students"> Soeng Souy
                                                </a>
                                            </td>
                                            <td class="text-center">1185</td>
                                            <td class="text-center">98%</td>
                                            <td class="text-end">
                                                <div>2019</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">
                                                <div>PRE1245</div>
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="profile.html">
                                                    <img class="rounded-circle"src="{{ URL::to('assets/img/profiles/avatar-01.jpg') }}"
                                                        width="25" alt="Star Students"> Soeng Souy
                                                </a>
                                            </td>
                                            <td class="text-center">1195</td>
                                            <td class="text-center">99.5%</td>
                                            <td class="text-end">
                                                <div>2018</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">
                                                <div>PRE1625</div>
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="profile.html">
                                                    <img class="rounded-circle"src="{{ URL::to('assets/img/profiles/avatar-01.jpg') }}"
                                                        width="25" alt="Star Students"> Soeng Souy
                                                </a>
                                            </td>
                                            <td class="text-center">1196</td>
                                            <td class="text-center">99.6%</td>
                                            <td class="text-end">
                                                <div>2017</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">
                                                <div>PRE2516</div>
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="profile.html">
                                                    <img class="rounded-circle"src="{{ URL::to('assets/img/profiles/avatar-01.jpg') }}"
                                                        width="25" alt="Star Students"> Soeng Souy
                                                </a>
                                            </td>
                                            <td class="text-center">1187</td>
                                            <td class="text-center">98.2%</td>
                                            <td class="text-end">
                                                <div>2016</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-nowrap">
                                                <div>PRE2209</div>
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="profile.html">
                                                    <img class="rounded-circle"src="{{ URL::to('assets/img/profiles/avatar-01.jpg') }}"
                                                        width="25" alt="Star Students"> Soeng Souy
                                                </a>
                                            </td>
                                            <td class="text-center">1185</td>
                                            <td class="text-center">98%</td>
                                            <td class="text-end">
                                                <div>2015</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}

                </div>
                <div class="col-xl-12 d-flex">

                    <div class="card flex-fill comman-shadow">
                        <div class="card-header d-flex align-items-center">
                            <h5 class="card-title ">School Activity </h5>
                            <ul class="chart-list-out student-ellips">
                                <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="activity-groups">

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@section('script')
    <script>
        // Data from the controller
        var months = @json($months);
        var teacherCounts = @json($teacherCounts);
        var studentCounts = @json($studentCounts);

        if ($("#apexcharts-area").length > 0) {
            var options = {
                chart: {
                    height: 350,
                    type: "line",
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: "smooth"
                },
                series: [{
                        name: "Teachers",
                        color: "#3D5EE1",
                        data: teacherCounts,
                    },
                    {
                        name: "Students",
                        color: "#70C4CF",
                        data: studentCounts,
                    },
                ],
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
                },
            };
            var chart = new ApexCharts(
                document.querySelector("#apexcharts-area"),
                options
            );
            chart.render();
        }
        var year = @json($year);
        var maleStudentCounts = @json($maleStudentCounts);
        var femaleStudentCounts = @json($femaleStudentCounts);

        if ($("#bar").length > 0) {
            var optionsBar = {
                chart: {
                    type: "bar",
                    height: 350,
                    width: "100%",
                    stacked: false,
                    toolbar: {
                        show: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                plotOptions: {
                    bar: {
                        columnWidth: "55%",
                        endingShape: "rounded"
                    },
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"]
                },
                series: [{
                        name: "Boys",
                        color: "#70C4CF",
                        data: maleStudentCounts,
                    },
                    {
                        name: "Girls",
                        color: "#3D5EE1",
                        data: femaleStudentCounts,
                    },
                ],
                labels: [
                    2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018,
                    2019, 2020, 2021, 2022, 2023, 2024
                ],
                xaxis: {
                    categories: year,
                    labels: {
                        show: true
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: "#777"
                        }
                    },
                },
                title: {
                    text: "",
                    align: "left",
                    style: {
                        fontSize: "18px"
                    }
                },
            };

            var chartBar = new ApexCharts(
                document.querySelector("#bar"),
                optionsBar
            );
            chartBar.render();
        }
    </script>
    <script>
        $(document).ready(function() {
            var cardBody = $(".activity-groups");

            $.ajax({
                url: "{{ route('getevent/home') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var eventList = '';

                    data.forEach(function(event) {
                        var eventDate = moment(event.start); // Parse the event start date
                        var timeAgo = eventDate.fromNow(); // Calculate the time difference

                        eventList += '<div class="activity-awards">' +
                            '<div class="award-list-outs">' +
                            '<h4>' + event.title + '</h4>' +
                            '</div>' +
                            '<div class="award-time-list">' +
                            '<span>' + (eventDate.isBefore(moment()) ? timeAgo : event.start) +
                            '</span>' +
                            '</div>' +
                            '</div>';
                    });

                    cardBody.html(eventList);
                }
            });
        });
    </script>
@endsection
@endsection
