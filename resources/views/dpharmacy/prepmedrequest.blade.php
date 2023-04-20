@extends('layout')

@section('title')
<a href="{{ url()->previous() }}" type="button" class="btn btn-primary">Go Back</a>
@endsection

@section('breadcrumb')
<h1><span class="text-success h5">201900190 / </span>Medicine Prescription [Preparing]</h1>
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

            <div class="row">
                <div class="col">

                <div class="card">
                <div class="card-body">
                    <div>
                        <img src="{{ asset('dist/img/logo.png') }} " class="brand-image">
                        <span class="brand-text font-weight-light"><strong> Adventist Hospital</strong> Medicine Prescription</span>
                    </div>
                    <hr class="hr hr-blurry" style="border: none; border-bottom: 2px solid gray;" />

                    <!-- Medicine Item -->
                    <div class="row">
                        <div class="col">

                        <div class="row">
                        @foreach($orderDetail as $detail)
                            <h5 class="card-title"><b>Medicine Prescription</b> 
                                <span class="h6">by Dr. {{$detail->user_fname}} {{$detail->user_mname}} {{$detail->user_lname}}</span>
                            </h5>
                        @endforeach
                        </div>

                        <table class="table table-bordered">
                            <tr>
                                <th style="width:15px;">No.</th>
                                <th style="width:20%;">Medicine Item</th>
                                <th style="width:7%;">QTY</th>
                                <th>Instruction</th>
                                <th class="text-right" style="width:12%;">Med. Price</th>
                                <th class="text-right" style="width:12%;">Sub-Total</th>
                                <th class="text-right" style="width:15px;">Instock</th>
                                <th class="text-center" style="width:100px;">Status</th>
                                <th class="text-center"  style="width:100px;">Action</th>
                            </tr>
                            <?php $i=1 ?>
                            @foreach($orderMed as $medicine)
                            <tr>
                                <td>{{$i}}</td><?php $i++ ?>
                                <td>{{$medicine->MEDICINE_NAME}}</td>
                                <td>{{$medicine->QUANTITY}} {{$medicine->MED_PACKTYPE}}</td>
                                <td>{{$medicine->INSTRUCTION}}</td>
                                <td class="text-right"><p>@money($medicine->MED_PRICE)</p></td>
                                <td class="text-right"><p>@money(($medicine->MED_PRICE)*($medicine->QUANTITY))</p></td>
                                <td class="text-right"><p>{{$medicine->MED_INSTOCK}}</p></td>
                                <td class="text-center"><p>{{$medicine->ORD_STATUS}}</p></td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-{{$medicine->MEDICINE_ID }}">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal" id="modal-{{ $medicine->MEDICINE_ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                        <h5 class="modal-title" id="exampleModalLabel">Medicine Item</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="col">
                                        <form name="bookedMed" id="bookedMed" method="POST" action="{{url('medOrderID/'. $medicine->MEDRECID .'/'. $medicine->MED_ORDER_ID .'/booked' )}}">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col">
                                                <p class="mb-0 h5" ><strong>{{$medicine->MEDICINE_NAME}}</strong></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0" ><strong>Quantity</strong></p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p class="mb-0" >{{$medicine->QUANTITY}} {{$medicine->MED_PACKTYPE}}</p>
                                            <div class="form-outline">
                                                @if($medicine->MED_INSTOCK>=100)
                                                <span class="text-success">* {{$medicine->MED_INSTOCK}} Items Available</span>
                                                @elseif($medicine->MED_INSTOCK<=100)
                                                <span class="text-danger">* {{$medicine->MED_INSTOCK}} Items Available</span>
                                                @endif
                                            </div>
                                            </p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                        <div class="col-sm-3">
                                                <p class="mb-0" ><strong>Instruction</strong></p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="mb-0" >{{$medicine->INSTRUCTION}}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                        <div class="col-sm-3">
                                                <p class="mb-0" ><strong>Set Status</strong></p>
                                            </div>
                                            <div class="col-sm-9">
                                            <select class="form-select" name="ORD_STATUS" aria-label="Default select example" required>
                                                <option value="BOOKED" <?php if($medicine->ORD_STATUS=="BOOKED") echo 'selected="selected"'; ?>>BOOKED</option>
                                                <option value="UNAVAILABLE" <?php if($medicine->ORD_STATUS=="UNAVAILABLE") echo 'selected="selected"'; ?>>NOT AVAILABLE</option>
                                            </select>
                                            </div>
                                        </div>


                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success    ">Save</button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            @endforeach
                        </table>
            

                        </div>
                    </div>
                    <!-- End Medicine Item -->

                </div>

            </div>

                </div>
            </div>


            </div>
        </div>
    </div>
</div> 

<script type="text/javascript">
    var j = 0;
    $("#dynamic-ar2").click(function () {
        ++j;
        
        $("#dynamicAddRemove2").append(
          '<tr>'+
          '<td><button type="button" class="btn btn-danger btn-sm remove-input-field"><i class="fa fa-trash"></button></td>'+
                  '<td>'+
                    '<select class="form-select" name="MEDICINE_ID['+ j +']" id="addMoreInputFields['+ j +'][medicine]" aria-label="Default select example" required>'+
                      '<option selected disabled>Medicine Item</option>'+
                      '<option value=""></option>'+
                    '</select>'+
                  '</td>'+
                  '<td>'+
                    '<div class="input-group">'+
                      '<input type="text" name="QUANTITY['+ j +']" id="addMoreInputFields['+ j +'][quantity]" class="form-control" aria-describedby="basic-addon1" required>'+
                    '</div>'+
                  '</td>'+
                  '<td>'+
                    '<div class="input-group">'+
                      '<textarea name="INSTRUCTION['+ j +']" id="addMoreInputFields['+ j +'][instruction]" class="form-control" aria-describedby="basic-addon1" rows="1" required></textarea>'+
                    '</div>'+
                  '</td>'+
              '</tr>'
        
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection