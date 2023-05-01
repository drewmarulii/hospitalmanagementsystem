@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Treatment Item</h1>
@endsection

@section('breadcrumb')
<a type="button" class="btn btn-primary btn-lg text-light" data-toggle="modal" data-target="#additem">
    Item <i class="fas fa-plus"></i>
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
            <div class="card">
            <div class="card-body">
            <table id="medicineOrder" class="table table-striped" style="width:100%">
                    <thead class="bg-light" style="width: 100%;">
                        <tr>
                            <th></th>
                            <th>ITEM ID</th>
                            <th>ITEM NAME</th>
                            <th>PRICE</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1 ?>
                    @foreach($invoiceitem as $item)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->ITEM_ID}}</td>
                            <td>{{$item->ITEM_NAME}}</td>
                            <td>@money($item->ITEM_PRICE)</td>
                            <td>
                                @if($item->is_active==1)
                                <a type="button" class="btn btn-primary btn-sm text-light" data-toggle="modal" data-target="#modal-{{$item->ITEM_ID}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a type="button" class="btn btn-warning btn-sm text-light" data-toggle="modal" data-target="#editModal-{{$item->ITEM_ID}}">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="{{url('/invoiceitem/'.$item->ITEM_ID.'/inactivate')}}" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fas fa-trash"></i></a>
                                @else
                                <a type="button" class="btn btn-primary btn-sm text-light mr-0" data-toggle="modal" data-target="#modal-{{$item->ITEM_ID}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{url('/invoiceitem/'.$item->ITEM_ID.'/setActive')}}" class="btn btn-success btn-sm" role="button" aria-pressed="true">Activate</a>
                                @endif
                            </td>
                        </tr>
                        <?php $i++ ?>  
                        @include('layout.modal-finance.modal-item')
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