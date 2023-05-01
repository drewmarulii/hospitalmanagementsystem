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

            <!-- Summary Card -->
            <div class="row">

            <div class="col-sm">
            <div class="small-box bg-primary">
                <div class="inner">
                <h2>{{$user->count()}}</h2> 
                <p class="mb-0">Total Users</p>
                </div>
                <div class="icon">
                <i class="ion ion-android-people"></i>
                </div>
            </div>
            </div>

            <div class="col-sm">
            <div class="small-box bg-info">
            <div class="inner">
                <h2>{{$admin->count()}}</h2>
                <p class="mb-0">Admin</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>

            <div class="col-sm">
            <div class="small-box bg-warning">
            <div class="inner">
                <h2>{{$receptionist->count()}}</h2>
                <p class="mb-0">Receptionist</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>

            <div class="col-sm">
            <div class="small-box bg-success">
            <div class="inner">
            <h2>{{$physician->count()}}</h2>
                <p class="mb-0">Physician</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>

            <div class="col-sm">
            <div class="small-box bg-danger">
            <div class="inner">
            <h2>{{$pharmacy->count()}}</h2>
                <p class="mb-0">Pharmacy</p>
            </div>
            <div class="icon">
            <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>

            <div class="col-sm">
            <div class="small-box bg-dark">
            <div class="inner">
            <h2>{{$finance->count()}}</h2>
                <p class="mb-0">Finance</p>
            </div>
            <div class="icon">
            <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>
            </div>
            <!-- End Summary Card -->

            <div class="row">
                <div class="col-8">

                <div class="card">
                    <div class="card-body">
                        <h5>User Role Chart</h5>
                        <canvas id="myChart" height="138px"></canvas>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        
                        <script type="text/javascript">
                            var labels =  {{ Js::from($labels) }};
                            var users =  {{ Js::from($data) }};
                            const data = {
                                labels: labels,
                                datasets: [{
                                    label: "User By Role",
                                    backgroundColor: ["Brown", "blue", "green", "blue", "red", "blue"],
                                    data: users,
                                }]
                            };
                            const config = {
                                type: 'bar',
                                data: data,
                                options: {
                                    scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 10
                                        }
                                    }
                                    },
                                }
                            };
                            const myChart = new Chart(
                                document.getElementById('myChart'),
                                config
                            );
                        </script>
                </div>
            </div>
        </div>
                <div class="col-4">
                <div class="card">
                    <div class="card-body" style="align:center;">
                    <h5>Doctor Chart</h5>
                        <canvas id="myChart1" height="150px"></canvas>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
                            <script>
                                var xValues = {{ Js::from($labels1) }};
                                var yValues = {{ Js::from($data1) }};
                                var barColors = [
                                "#b91d47",
                                "#00aba9",
                                "#2b5797",
                                "#e8c3b9",
                                "#1e7145"
                                ];
                            new Chart("myChart1", {
                            type: "doughnut",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                            },
                            options: {
                                aspectRatio: 1,
                                title: {
                                display: true,
                                },
                            },
                            
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

