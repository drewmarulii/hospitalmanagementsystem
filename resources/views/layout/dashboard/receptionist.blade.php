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
                <div class="col-4">
                    <div class="card">
                    <div class="card-body">
                    <h5>Patient Gender</h5>
                    <canvas id="myChart"  height="150px"></canvas>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script type="text/javascript">
                        var labels =  {{ Js::from($labels) }};
                        var users =  {{ Js::from($data) }};
                        const data = {
                            labels: labels,
                            datasets: [{
                                backgroundColor: ["Pink", "Blue"],
                                data: users,
                            }]
                        };
                        const config = {
                            type: 'doughnut',
                            data: data,
                            options: {

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
                    <div class="card-body">
                    <h5>Patient Marital Status</h5>
                    <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>

                    <script>
                    var xValues =  {{ Js::from($labels2) }};
                    var yValues =  {{ Js::from($data2) }};
                    var barColors = [
                    "#b91d47",
                    "#00aba9",
                    "#2b5797",
                    "#e8c3b9",
                    "#1e7145"
                    ];

                    new Chart("myChart2", {
                    type: "pie",
                    data: {
                        labels: xValues,
                        datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                        }]
                    },
                    options: {
                        title: {
                        display: true,
                        text: "World Wide Wine Production 2018"
                        }
                    }
                    });
                    </script>
                    
                    </div>
                </div>
                
                </div>
                <div class="col-4">

                <div class="small-box bg-dark">
                    <div class="inner">
                        <h4 class="mb-3">Total Patient:<span class="float-right h1 mr-3">{{$patient->count()}}</span></h4> 
                    </div>
                    <div class="icon">
                    <i class="ion ion-android-people"></i>
                    </div>
                </div>
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h4 class="mb-3">Today's Appointment:<span class="float-right h1 mr-3">{{$todayAppointment->count()}}</span></h4> 
                    </div>
                    <div class="icon">
                    <i class="ion ion-android-people"></i>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <h5>Patient Religion</h5>
                        <canvas id="myChart1"></canvas>
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
                            type: "bar",
                            data: {
                                labels: xValues,
                                datasets: [{
                                label:"Religion",
                                backgroundColor: barColors,
                                data: yValues
                                }]
                            },
                            options: {
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

            <div class="row">
            <div class="col-sm-4">
            <div class="row">
                <div class="col">
                    <div class="small-box bg-dark">
                    <div class="inner">
                        <h3>{{ $appointment->count() }}</h3>
                        <p>Total Appointment</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-android-people"></i>
                    </div>
                    </div>
                </div>
                <div class="col">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $new->count() }}</h3>
                        <p>New Appointment</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-android-people"></i>
                    </div>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $inProgress->count() }}</h3>
                        <p>In-Progress</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-android-people"></i>
                    </div>
                    </div>
                </div>
                <div class="col">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $todayAppointment->count() }}</h3>
                        <p>Today's Appointment</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-android-people"></i>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-sm-8">

            <!-- <div class="card">               
                <div class="card-body">
                    <table id="appointmentTableDash" class="table table-striped" style="width:100%">
                    <thead class="bg-dark" style="width: 100%;">
                        <tr>
                            <th></th>
                            <th>Appointment ID</th>a
                            <th>Status</th>
                            <th>Physician</th>
                            <th>Patient</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($todayAppointment as $appointments) 
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$appointments->APPOINTMENT_ID}}</td>
                            <td>{{$appointments->APPOINTMENT_STATUS}}</td>
                            <td>Dr. {{$appointments->user_fname}} {{$appointments->user_mname}} {{$appointments->user_lname}}</td>
                            <td>{{$appointments->PAT_FNAME}} {{$appointments->PAT_MNAME}} {{$appointments->PAT_LNAME}}</td>
                        </tr>
                        <?php $i++; ?>               
                        @endforeach
                    </tbody>
                </table>

                    </div>
                    </div> -->
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

