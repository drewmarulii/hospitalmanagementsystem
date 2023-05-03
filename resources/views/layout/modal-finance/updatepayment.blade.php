<!-- Modal -->
<div class="modal fade" id="updatePayment-{{$payment->PAYMENT_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Payment</h5>
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

<form name="editPayment" id="editPayment" method="POST" action="{{url('payment/'.$payment->PAYMENT_ID.'/update')}}" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <div class="row">
    <div class="col-6">
        <p for="exampleInputEmail1">Amount Paid:</p>
    </div>
    <div class="col-6">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">IDR</span>
        </div>
            <input type="text" class="form-control text-right" name="AMOUNT_PAID" value="{{$payment->AMOUNT_PAID}}" id="money" aria-describedby="emailHelp">
        </div>
    </div>
    </div>

    <div class="row mt-3">
    <div class="col-6">
        <p for="exampleInputEmail1">Payment Method:</p>
    </div>
    <div class="col-6">
    <select class="form-select" id="my-dropdown" name="PAYMENT_METHOD" aria-label="Default select example">
        <option value="CASH" <?php if($payment->PAYMENT_METHOD=="CASH") echo 'selected="selected"'; ?>>Cash</option>
        <option value="BANK-TRANSFER" <?php if($payment->PAYMENT_METHOD=="BANK-TRANSFER") echo 'selected="selected"'; ?>>Bank Transfer</option>
        <option value="DIGITAL-PAYMENT" <?php if($payment->PAYMENT_METHOD=="DIGITAL-PAYMENT") echo 'selected="selected"'; ?>>Digital Payment (QRIS)</option>
    </select>
    </div>
    </div>

    <div class="row mt-3">
    <div class="col-6">
        <p for="exampleInputEmail1">Payment Proof:</p>
    </div>
    <div class="col-6">
        <div class="form-group">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="my-required-field" name="PAYMENT_PROOF_FILE">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
            <small>File Choosen: {{$payment->PAYMENT_PROOF_FILE}}</small>
        </div>
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

<script src="easy-number-separator.js"></script>

<script>
function updateTextView(_obj){
  var num = getNumber(_obj.val());
  if(num==0){
    _obj.val('');
  }else{
    _obj.val(num.toLocaleString());
  }
}
function getNumber(_str){
  var arr = _str.split('');
  var out = new Array();
  for(var cnt=0;cnt<arr.length;cnt++){
    if(isNaN(arr[cnt])==false){
      out.push(arr[cnt]);
    }
  }
  return Number(out.join(''));
}
$(document).ready(function(){
  $('#money').on('keyup',function(){
    updateTextView($(this));
  });
});
</script>

<script>
    $(document).ready(function() {
        $('#my-dropdown').change(function() {
            if ($(this).val() == 'BANK-TRANSFER') {
                $('#my-required-field').prop('required', true);
            } elseif ($(this).val() == 'DIGITAL-PAYMENT') {
                $('#my-required-field').prop('required', true);
            } else {
                $('#my-required-field').prop('required', false);
            }
        });
    });
</script>

