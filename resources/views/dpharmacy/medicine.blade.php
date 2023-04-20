@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Medicine</h1>
@endsection

@section('breadcrumb')
<a type="button" class="btn btn-primary btn-lg text-light" data-toggle="modal" data-target="#addMedicine">
    Medicine <i class="fas fa-plus"></i>
</a>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">

            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

<!-- Summary Card -->
    <div class="row">

    <div class="col-sm">
        <div class="small-box bg-dark">
        <div class="inner">
        <h4>50 <span class="h6">Items</span></h4>
            <p>Medicine</p>
        </div>
        <div class="icon">
        <i class="ion ion-android-people"></i>
        </div>
        </div>
    </div>

    <div class="col-sm">
    <div class="small-box bg-success">
        <div class="inner">
        <h4>50 <span class="h6">Items</span></h4>
        <p>Safe Stock</p>
        </div>
        <div class="icon">
        <i class="ion ion-android-people"></i>
        </div>
    </div>
    </div>

    <div class="col-sm">
    <div class="small-box bg-warning">
        <div class="inner">
        <h4>50 <span class="h6">Items</span></h4>
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
        <h4>50 <span class="h6">Items</span></h4>
        <p>Finish Stock</p>
        </div>
        <div class="icon">
        <i class="ion ion-android-people"></i>
        </div>
    </div>
    </div>
    
    </div>
    <!-- End Summary Card -->

    <div class="card">
    <div class="card-body">
    <table id="medicineOrder" class="table table-striped" style="width:100%">
            <thead class="bg-light" style="width: 100%;">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Medicine</th>
                    <th class="text-right">Capacity</th>
                    <th>Pack</th>
                    <th class="text-right">Price</th>
                    <th class="text-center">Instock</th>
                    <th style="width: 120px;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=1 ?>
            @foreach($medicine as $item)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$item->MEDICINE_ID}}</td>
                    <td>{{$item->MEDICINE_NAME}}</td>
                    <td class="text-right">{{$item->QTY_PERPACK}} {{$item->QTY_UNIT}}</td>
                    <td>{{$item->MED_PACKTYPE}}</td>
                    <td class="text-right">@money($item->MED_PRICE)</td>
                    <td class="text-center">{{$item->MED_INSTOCK}}</td>
                    <td>
                        <a type="button" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#modal-{{$item->MEDICINE_ID}}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a type="button" class="btn btn-warning btn-sm text-light" data-toggle="modal" data-target="#editModal-{{$item->MEDICINE_ID}}">
                            <i class="fas fa-pen"></i>
                        </a>
                        <!-- <a href="{{url('/medInstock/'.$item->MEDICINE_ID.'/update')}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-pen"></i></a> -->
                        <a href="{{url('/medInstock/'.$item->MEDICINE_ID.'/delete')}}" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @include('layout.modal-pharmacy.modal-medicine')
                <?php $i++ ?>  
            @endforeach 
            </tbody>
        </table>
    </div>
    </div>
                

            </div>
        </div>
    </div>
</div>
          
@endsection