@extends('layout')

@section('title')
    @include('layout.dashboard.title')
@endsection

@section('breadcrumb')

@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">

            <div class="row">
                <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="small-box bg-primary">
                            <div class="inner">
                            <h4>{{$appointment->count()}}</h4>
                            <p>Total Appointment</p>
                            </div>
                            <div class="icon">
                            <i class="ion ion-android-people"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="small-box bg-info">
                            <div class="inner">
                            <h4>{{$new->count()}}</h4>
                            <p>New Appointment</p>
                            </div>
                            <div class="icon">
                            <i class="ion ion-android-people"></i>
                            </div>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4>{{$finish->count()}}</h4>
                                <p>Completed Appointment</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-people"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h4>{{$todayAppointment -> count()}}</h4>
                                <p>Today [<?php echo(date('d M Y', strtotime($today))); ?>]</p>
                            </div>
                            <div class="icon">
                            <i class="ion ion-android-people"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col">
                
                <div class="card">
                    <div class="card-body">
                    <h5>Appointment Graph</h5>
                        <canvas id="myChart1"></canvas>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
                            <script>
                                var xValues = {{ Js::from($labels) }};
                                var yValues = {{ Js::from($data) }};
                                var barColors = [
                                "#b91d47",
                                "#00aba9",
                                "#2b5797",
                                "#e8c3b9",
                                "#1e7145"
                                ];
                            new Chart("myChart1", {
                            type: "bar",
                            data: {
                                labels: xValues,
                                datasets: [{

                                backgroundColor: barColors,
                                data: yValues
                                }],
                            },
                            options: {
                                plugins: {
                                        legend: {
                                            display: false,
                                        }
                                    },
                                    scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 4
                                        }
                                    }
                                    },
                                }
                            });
                            </script>
                    </div>
                </div>
                
                </div>
            </div>  


            </div>
        </div>
    </div>
</div>

@endsection

