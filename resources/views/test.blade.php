@extends('layout')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">

            <table class="table table-bordered" id="dynamicAddRemove1">
                <tr>
                    <th style="width:10px;"><button type="button" name="add" id="dynamic-ar1" class="btn btn-primary btn-sm"><i class="fa fa-plus"></button></th>
                    <th style="width:35%;">Medicine Item<span class="text-danger"> *</span></th>
                    <th style="width:7%;">QTY<span class="text-danger"> *</span></th>
                    <th>Instruction<span class="text-danger"> *</span></th>
                    <th style="width:10%;">Instock<span class="text-danger"> *</span></th>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <select class="form-select mySelect" name="MEDICINE_ID[0]" id="category">
                        <option hidden>Choose Medicine</option>
                        @foreach ($mdclist as $item)
                        <option value="{{ $item->MEDICINE_ID }}">{{ $item->MEDICINE_NAME }}</option>
                        @endforeach
                    </select>     
                    </td>
                    <td>
                      <div class="input-group">
                        <input type="text" name="QUANTITY[0]" id="addMoreInputFields[0][quantity]" class="form-control" aria-describedby="basic-addon1" required>
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <textarea name="INSTRUCTION[0]" id="addMoreInputFields[0][instruction]" class="form-control" aria-describedby="basic-addon1" rows="1" required></textarea>
                      </div>
                    </td>
                    <td>
                      <p class="result"></p>
                    </td>
                </tr>
              </table>


            </div>
        </div>
    </div>
</div>

<script>
  
</script>

<script type="text/javascript">
    var j = 0;
    $("#dynamic-ar1").click(function () {
        ++j; 
        $("#dynamicAddRemove1").append(
            '<tr>'+
            '<td><button type="button" class="btn btn-danger btn-sm remove-input-field"><i class="fa fa-trash"></button></td>'+
              '<td>'+
              '<select class="form-select mySelect" name="MEDICINE_ID['+ j +']" id="category['+ j +']">'+
                  '<option hidden>Choose Medicine</option>'+
                  '@foreach ($mdclist as $item)'+
                  '<option value="{{ $item->MEDICINE_ID }}">{{ $item->MEDICINE_NAME }}</option>'+
                  '@endforeach'+
              '</select>' +    
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
              '<td><p class="result"></p></td>'+
          '</tr>'
        );  
    
      });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });

    var selects = document.getElementsByClassName("mySelect");

    for (var j = 0; j < selects.length; j++) {
        selects[j].addEventListener("change", function() {
            var selectedOption = this.value;
            var index = Array.prototype.indexOf.call(selects, this); // get index of the current select element
            var resultCell = this.parentNode.nextElementSibling; // get the corresponding result cell element
            var xmlhttp = new XMLHttpRequest();
        
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    resultCell.innerHTML = this.responseText;
                }
            };
            
            xmlhttp.open("GET", "getInstock/" + selectedOption, true);
            xmlhttp.send();
        });
    }
</script>
@endsection