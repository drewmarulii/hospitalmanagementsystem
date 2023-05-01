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
                <h4>{{$newOrder->count()}}</h4>
                <p>New Order</p>
                </div>
                <div class="icon">
                <i class="ion ion-android-people"></i>
                </div>
            </div>
            </div>

            <div class="col-sm">
            <div class="small-box bg-info">
            <div class="inner">
                <h4>{{$readyOrder->count()}}</h4>
                <p>Ready Order</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>
            <div class="col-sm">
            <div class="small-box bg-success">
            <div class="inner">
                <h4>{{$releasedOrder->count()}}</h4>
                <p>Completed Order</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>
            <div class="col-sm">
            <div class="small-box bg-primary">
            <div class="inner">
            <h4>{{$totalMedicine->count()}}</h4>
                <p>Total Medicine</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>
            <div class="col-sm">
            <div class="small-box bg-warning">
            <div class="inner">
            <h4>{{$warnMedicine->count()}}</h4>
                <p>Warning Stock</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>
            <div class="col-sm">
            <div class="small-box bg-danger">
            <div class="inner">
                <h4>{{$finishMedicine->count()}}</h4>
                <p>Finish Stock </p>
            </div>
            <div class="icon">
            <i class="ion ion-android-people"></i>
            </div>
            </div>
            </div>
            </div>
            <!-- End Summary Card -->


            <div class="row">
                <div class="col-sm-4">

                <div class="card">
                    <div class="card-body">
                    <h5>Medicine [Packaging]</h5>
                    <canvas id="myChart"  height="150px"></canvas>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script type="text/javascript">
                        var labels =  {{ Js::from($labels) }};
                        var users =  {{ Js::from($data) }};
                        const data = {
                            labels: labels,
                            datasets: [{
                                backgroundColor: ["Green", "Orange", "Yellow"],
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
                <a href="{{url('/medOrder')}}" type="button" class="btn btn-primary btn-lg btn-block">Medicine Order</a>
                <a href="{{url('/medInstock')}}"  type="button" class="btn btn-secondary btn-lg btn-block">Medicine Instock</a>
            </div>
                <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                    <h5 class="mb-3">Medicine Out of Stock</h5>
                    <table id="finMedicine" class="table table-striped" style="width:100%">
                    <thead class="bg-danger" style="width: 100%;">
                        <tr>
                            <th>ID</th>
                            <th>Medicine</th>
                            <th style="width: 15%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($finishMedicine as $medicine) 
                        <tr>
                            <td>{{$medicine->MEDICINE_ID}}</td>
                            <td>{{$medicine->MEDICINE_NAME}}</td>
                            <td>
                            <a type="button" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#modal-{{$medicine->MEDICINE_ID}}">
                            <i class="fas fa-eye"></i>
                            </a>
                            <a type="button" class="btn btn-warning btn-sm text-light" data-toggle="modal" data-target="#editModal-{{$medicine->MEDICINE_ID}}">
                                <i class="fas fa-pen"></i>
                            </a>
                            </td>
                        </tr>
                        @include('layout.modal-pharmacy.modal-medicine-dash')
                        @endforeach
                    </tbody>
                </table>
                </div>
                </div>

                <div class="card">
                    <div class="card-body">
                    <h5 class="mb-3">Medicine Almost Finish</h5>
                    <table id="warnMedicine" class="table table-striped" style="width:100%">
                    <thead class="bg-warning" style="width: 100%;">
                        <tr>
                            <th>ID</th>
                            <th>Medicine</th>
                            <th style="width: 15%;" class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($warnMedicine as $medicine) 
                        <tr>
                            <td>{{$medicine->MEDICINE_ID}}</td>
                            <td>{{$medicine->MEDICINE_NAME}}</td>
                            <td>
                            <a type="button" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#modal-{{$medicine->MEDICINE_ID}}">
                            <i class="fas fa-eye"></i>
                            </a>
                            <a type="button" class="btn btn-warning btn-sm text-light" data-toggle="modal" data-target="#editModal-{{$medicine->MEDICINE_ID}}">
                                <i class="fas fa-pen"></i>
                            </a>
                            </td>
                        </tr>
                        @include('layout.modal-pharmacy.modal-medicine-dash')
                        @endforeach

                    </tbody>
                </table>
                </div>
                </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>

@endsection

