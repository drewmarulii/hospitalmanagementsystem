<!-- Modal Read Medicine -->
<div class="modal fade bd-example-modal-lg" id="modal-{{$item->ITEM_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
    <div class="modal-content">
        <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalLabel">Invoice Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="col">
                <h4>{{$item->ITEM_NAME}}</h4>
            </div>  
            
        <div class="col">
            <div class="row">
                <div class="col-sm-3">
                <p class="mb-0"><strong>ID</strong></p>
                </div>
                <div class="col-sm-9">
                <p class="mb-0">: {{$item->ITEM_ID}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                <p class="mb-0"><strong>Price</strong></p>
                </div>
                <div class="col-sm-9">
                <p class="mb-0">: @money($item->ITEM_PRICE)</p>
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
<div class="modal fade bd-example-modal-lg" id="additem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
    <div class="modal-content">
        <div class="modal-header bg-dark">
        <h5 class="modal-title" id="exampleModalLabel">Add Invoice Item Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

        <form name="addNewItem" id="myForm"  method="POST" enctype="multipart/form-data" action="{{ url('/invoiceitem') }}">
        @csrf
        <div class="form-group">
            <label for="inputAddress">Item Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="ITEM_NAME" id="inputAddress"  placeholder="Administration Fee" required>
        </div>
        <label for="inputAddress">Item Price <span class="text-danger">*</span></label>    
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text">IDR</div>
                </div>
                <input type="text" class="form-control text-right" name="ITEM_PRICE" id="inputCity" placeholder="50000" required>
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

<!-- Modal Edit Medicine -->
<div class="modal fade bd-example-modal-lg" id="editModal-{{$item->ITEM_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
            <h5 class="modal-title" id="exampleModalLabel">Edit Treatment Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

            <form name="editTreatment" id="myForm"  method="POST" enctype="multipart/form-data" action="{{ url('/invoiceitem/'.$item->ITEM_ID.'/update') }}">
            @csrf
            <div class="form-group">
                <label for="inputAddress">Treatment Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="ITEM_NAME" id="inputAddress"   value="{{$item->ITEM_NAME}}" required>
            </div>
            <label for="inputAddress">Treatment Price <span class="text-danger">*</span></label>
            <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text">IDR</div>
                    </div>
                    <input type="text" class="form-control text-right" name="ITEM_PRICE" id="inputCity"  value="{{$item->ITEM_PRICE}}" required>
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