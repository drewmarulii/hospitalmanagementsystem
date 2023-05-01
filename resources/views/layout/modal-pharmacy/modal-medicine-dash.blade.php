<!-- Modal Read Medicine -->
<div class="modal fade bd-example-modal-lg" id="modal-{{$medicine->MEDICINE_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <h4>{{$medicine->MEDICINE_NAME}}</h4>
                </div>  
                
            <div class="col">
                <div class="row">
                    <div class="col-sm-3">
                    <p class="mb-0"><strong>ID</strong></p>
                    </div>
                    <div class="col-sm-9">
                    <p class="mb-0">: {{$medicine->MEDICINE_ID}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    <p class="mb-0"><strong>Capacity</strong></p>
                    </div>
                    <div class="col-sm-9">
                    <p class="mb-0">: {{$medicine->QTY_PERPACK}}  {{$medicine->QTY_UNIT}} /  {{$medicine->MED_PACKTYPE}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    <p class="mb-0"><strong>Instock</strong></p>
                    </div>
                    <div class="col-sm-9">
                    <p class="mb-0">: {{$medicine->MED_INSTOCK}} items</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    <p class="mb-0"><strong>Price</strong></p>
                    </div>
                    <div class="col-sm-9">
                    <p class="mb-0">: @money($medicine->MED_PRICE)</p>
                    </div>
                </div>
            </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    <!-- End Modal -->

<!-- Modal Create Medicine -->
<div class="modal fade bd-example-modal-lg" id="editModal-{{$medicine->MEDICINE_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
            <h5 class="modal-title" id="exampleModalLabel">Edit Medicine Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

            <form name="addNewMedicine" id="myForm"  method="POST" enctype="multipart/form-data" action="{{url('/medInstock/'.$medicine->MEDICINE_ID.'/update')}}">
            @csrf
            <div class="form-group">
                <label for="inputAddress">Medicine Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="MEDICINE_NAME" id="inputAddress" value="{{$medicine->MEDICINE_NAME}}" placeholder="Aminofilin tablet 150 mg" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                <label for="inputCity">Capacity <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="QTY_PERPACK" id="inputCity" value="{{$medicine->QTY_PERPACK}}" placeholder="50" required>
                </div>
                <div class="form-group col-md-4">
                <label for="inputState">Unit <span class="text-danger">*</span></label>
                <select id="inputState" name="QTY_UNIT" class="form-control" required>
                    <option disabled selected>Choose...</option>
                    <option value="Tablet" <?php if($medicine->QTY_UNIT=="Tablet") echo 'selected="selected"'; ?>>Tablet</option>
                    <option value="Gram" <?php if($medicine->QTY_UNIT=="Gram") echo 'selected="selected"'; ?>>Gram</option>
                    <option value="Milliliter"  <?php if($medicine->QTY_UNIT=="Milliliter") echo 'selected="selected"'; ?>>Milliliter</option>  
                    <option value="Capsule" <?php if($medicine->QTY_UNIT=="Capsule") echo 'selected="selected"'; ?>>Capsule</option></select>
                </div>
                <div class="form-group col-md-4">
                <label for="inputState">Pack <span class="text-danger">*</span></label>
                <select id="inputState" name="MED_PACKTYPE" class="form-control" required>
                    <option disabled selected>Choose...</option>
                    <option value="Tube" <?php if($medicine->MED_PACKTYPE=="Tube") echo 'selected="selected"'; ?>>Tube</option>
                    <option value="Box" <?php if($medicine->MED_PACKTYPE=="Box") echo 'selected="selected"'; ?>>Box</option>
                    <option value="Bottle" <?php if($medicine->MED_PACKTYPE=="Bottle") echo 'selected="selected"'; ?>>Bottle</option>
                </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                <label for="inputCity">Price <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text">IDR</div>
                    </div>
                    <input type="text" class="form-control text-right" name="MED_PRICE" id="inputCity" value="{{$medicine->MED_PRICE}}" placeholder="50000" required>
                </div>
                </div>
                <div class="form-group col-md-4">
                <label for="inputState">Instock <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="MED_INSTOCK" id="inputCity"  value="{{$medicine->MED_INSTOCK}}" placeholder="500" required>
                </div>
            </div>

 
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal Read Medicine -->
<div class="modal fade bd-example-modal-lg" id="finmodal-{{$medicine->MEDICINE_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <h4>{{$medicine->MEDICINE_NAME}}</h4>
                </div>  
                
            <div class="col">
                <div class="row">
                    <div class="col-sm-3">
                    <p class="mb-0"><strong>ID</strong></p>
                    </div>
                    <div class="col-sm-9">
                    <p class="mb-0">: {{$medicine->MEDICINE_ID}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    <p class="mb-0"><strong>Capacity</strong></p>
                    </div>
                    <div class="col-sm-9">
                    <p class="mb-0">: {{$medicine->QTY_PERPACK}}  {{$medicine->QTY_UNIT}} /  {{$medicine->MED_PACKTYPE}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    <p class="mb-0"><strong>Instock</strong></p>
                    </div>
                    <div class="col-sm-9">
                    <p class="mb-0">: {{$medicine->MED_INSTOCK}} items</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                    <p class="mb-0"><strong>Price</strong></p>
                    </div>
                    <div class="col-sm-9">
                    <p class="mb-0">: @money($medicine->MED_PRICE)</p>
                    </div>
                </div>
            </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    <!-- End Modal -->

<!-- Modal Create Medicine -->
<div class="modal fade bd-example-modal-lg" id="fineditModal-{{$medicine->MEDICINE_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
            <h5 class="modal-title" id="exampleModalLabel">Edit Medicine Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

            <form name="addNewMedicine" id="myForm"  method="POST" enctype="multipart/form-data" action="{{url('/medInstock/'.$medicine->MEDICINE_ID.'/update')}}">
            @csrf
            <div class="form-group">
                <label for="inputAddress">Medicine Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="MEDICINE_NAME" id="inputAddress" value="{{$medicine->MEDICINE_NAME}}" placeholder="Aminofilin tablet 150 mg" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                <label for="inputCity">Capacity <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="QTY_PERPACK" id="inputCity" value="{{$medicine->QTY_PERPACK}}" placeholder="50" required>
                </div>
                <div class="form-group col-md-4">
                <label for="inputState">Unit <span class="text-danger">*</span></label>
                <select id="inputState" name="QTY_UNIT" class="form-control" required>
                    <option disabled selected>Choose...</option>
                    <option value="Tablet" <?php if($medicine->QTY_UNIT=="Tablet") echo 'selected="selected"'; ?>>Tablet</option>
                    <option value="Gram" <?php if($medicine->QTY_UNIT=="Gram") echo 'selected="selected"'; ?>>Gram</option>
                    <option value="Milliliter"  <?php if($medicine->QTY_UNIT=="Milliliter") echo 'selected="selected"'; ?>>Milliliter</option>  
                    <option value="Capsule" <?php if($medicine->QTY_UNIT=="Capsule") echo 'selected="selected"'; ?>>Capsule</option></select>
                </div>
                <div class="form-group col-md-4">
                <label for="inputState">Pack <span class="text-danger">*</span></label>
                <select id="inputState" name="MED_PACKTYPE" class="form-control" required>
                    <option disabled selected>Choose...</option>
                    <option value="Tube" <?php if($medicine->MED_PACKTYPE=="Tube") echo 'selected="selected"'; ?>>Tube</option>
                    <option value="Box" <?php if($medicine->MED_PACKTYPE=="Box") echo 'selected="selected"'; ?>>Box</option>
                    <option value="Bottle" <?php if($medicine->MED_PACKTYPE=="Bottle") echo 'selected="selected"'; ?>>Bottle</option>
                </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                <label for="inputCity">Price <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text">IDR</div>
                    </div>
                    <input type="text" class="form-control text-right" name="MED_PRICE" id="inputCity" value="{{$medicine->MED_PRICE}}" placeholder="50000" required>
                </div>
                </div>
                <div class="form-group col-md-4">
                <label for="inputState">Instock <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="MED_INSTOCK" id="inputCity"  value="{{$medicine->MED_INSTOCK}}" placeholder="500" required>
                </div>
            </div>

 
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    <!-- End Modal -->