<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-6">
            <p for="exampleInputEmail1">Invoice ID:</p>
        </div>
        <div class="col-6">
            <p class="h5 text-right">{{$invoice->INVOICE_ID}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <p for="exampleInputEmail1">Bill:</p>
        </div>
        <div class="col-6">
            <p class="h5 text-right text-danger">@money($invoice->INVOICE_AMOUNT)</p>
        </div>
    </div>

<form name="addPayment" id="addPayment" method="POST" action="{{url('showInvoice/'.$invoice->PATIENTID.'/'.$invoice->INVOICE_ID.'/store')}}">
    @csrf
  <div class="form-group">
    <div class="row">
    <div class="col-6">
        <p for="exampleInputEmail1">Amount Paid:</p>
    </div>
    <div class="col-6">
        <input type="number" class="form-control text-right loan-input" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    </div>

    <div class="row mt-3">
    <div class="col-6">
        <p for="exampleInputEmail1">Payment Method:</p>
    </div>
    <div class="col-6">
    <select class="form-select" aria-label="Default select example">
        <option value="CASH">Cash</option>
        <option value="BANK-TRANSFER">Bank Transfer</option>
        <option value="DIGITAL-PAYMENT">Digital Payment (QRIS)</option>
    </select>
    </div>
    </div>

    <div class="row mt-3">
    <div class="col-6">
        <p for="exampleInputEmail1">Payment Proof:</p>
    </div>
    <div class="col-6">
        <input class="form-control" type="file" id="formFile" placeholder=" ">
    </div>
    </div>
   
  </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
<!-- End Modal -->