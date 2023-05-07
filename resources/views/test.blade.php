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
                    <th style="width:10%;">Instock</th>
                    <th style="width:7%;">QTY<span class="text-danger"> *</span></th>
                    <th>Instruction<span class="text-danger"> *</span></th>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <select class="form-select mySelect" name="MEDICINE_ID[0]" id="category[0]">
                        <option hidden>Choose Medicine</option>
                        @foreach ($mdclist as $item)
                        <option value="{{ $item->MEDICINE_ID }}">{{ $item->MEDICINE_NAME }}</option>
                        @endforeach
                    </select>     
                    </td>
                    <td><p class="result"></p></td>
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
                </tr>
              </table>

            </div>
        </div>
    </div>
</div>
<script>
    var selects = document.getElementsByClassName("mySelect");
    var j = 0; 
    selects[j].addEventListener("change", function() {
        var selectedOption = this.value;
        var index = Array.prototype.indexOf.call(selects, this); 
        var resultCell = this.parentNode.nextElementSibling; 
        var xmlhttp = new XMLHttpRequest();
    
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                resultCell.innerHTML = this.responseText;
            }
        };
        
        xmlhttp.open("GET", "http://127.0.0.1:8000/getInstock/" + selectedOption, true);
        xmlhttp.send();
    });
</script>

<script type="text/javascript">
    function fetchInstock(selectedOption, resultCell) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                resultCell.innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "http://127.0.0.1:8000/getInstock/" + selectedOption, true);
        xmlhttp.send();
    }

    function addRow() {
        var table = document.getElementById("dynamicAddRemove1");
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        var index = rowCount - 1;
        
        row.insertCell(0).innerHTML = '<td><button type="button" class="btn btn-danger btn-sm remove-input-field"><i class="fa fa-trash"></button></td>';
        row.insertCell(1).innerHTML = '<td><select class="form-select mySelect" name="MEDICINE_ID['+ index +']" id="category['+ index +']"><option hidden>Choose Medicine</option>@foreach ($mdclist as $item)<option value="{{ $item->MEDICINE_ID }}">{{ $item->MEDICINE_NAME }}</option>@endforeach</select></td>';
        row.insertCell(2).innerHTML = '<td><p class="result"></p></td>';
        row.insertCell(3).innerHTML = '<td><div class="input-group"><input type="text" name="QUANTITY['+ index +']" id="addMoreInputFields['+ index +'][quantity]" class="form-control" aria-describedby="basic-addon1" required></div></td>';
        row.insertCell(4).innerHTML = '<td><div class="input-group"><textarea name="INSTRUCTION['+ index +']" id="addMoreInputFields['+ index +'][instruction]" class="form-control" aria-describedby="basic-addon1" rows="1" required></textarea></div></td>';

        
        var selects = row.getElementsByTagName("select");
        var resultCell = row.getElementsByClassName("result")[0];
        
        for (var i = 0; i < selects.length; i++) {
            selects[i].addEventListener("change", function() {
                var selectedOption = this.value;
                fetchInstock(selectedOption, resultCell);
            });
        }
    }

    $(document).on('click', '#dynamic-ar1', function () {
        addRow();
    });
    
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
    
</script>

@endsection