@extends('layout')

@section('title')
  @foreach($appcard as $appointments)
  <a href="{{ url('/cancel/'.$appointments->APPOINTMENT_ID) }}" type="button" class="btn btn-primary"  onclick="return confirm('Cancel the Medical Treatement?');">Go Back</a>
  @endforeach
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
@endsection

@section('breadcrumb')
    @foreach($appcard as $appointments)
        <h1><span class="h5 text-success">{{$appointments->APPOINTMENT_ID}} ({{$appointments->APPOINTMENT_STATUS}}) /</span> Medical Record</h1>
    @endforeach
@endsection


@section('content')
  <div class="content" >
    <div class="container-fluid">
      <div class="row">
        <div class="col">

        <div class="row">
          <div class="col-10">

            <div class="card bg-warning">
              <div class="card-body">
              @foreach($appcard as $appointments) 
                  <div class="row">

                    <div class="col-3">
                      <b>{{$appointments->PATIENT_ID}}</b>
                    </div>
                    <div class="col">
                      <b>Name: </b>{{$appointments->PAT_FNAME}} {{$appointments->PAT_LNAME}} 
                    </div>
                    <div class="col">
                      <b>DOB:</b> <?php echo(date('d M Y', strtotime($appointments->PAT_DOB))); ?> 
                      (</b><?php $dob = $appointments->PAT_DOB;
                            $today = date("Y-m-d");
                            $age = date_diff(date_create($dob), date_create($today));
                            echo $age->format('%y'); ?> Years Old)
                    </div>
                    <div class="col-2">
                      <b>Gender:</b> {{$appointments->PAT_GENDER}} 
                    </div>

                  </div>
                @endforeach
              </div>
            </div>

          </div>
          <div class="col-2">
            
            <div class="card bg-info">
              <div class="card-body text-center">
                {{$appointments->APPOINTMENT_ID}}
              </div>
            </div>

          </div>
        </div>

        <form name="addmedicalrecord" id="myForm"  method="POST" enctype="multipart/form-data" action="{{ url('/medicaldone/'.$appointments->APPOINTMENT_ID) }}">  
        @csrf
        <!-- Medical Record -->
        <div class="card">
          <div class="card-header text-light" style="background-color: #5D9C59">
            1. Medical Record
          </div>

          <div class="card-body">

          <div class="row">

            <div class="col">
              <label for="field1">Weight<span class="text-danger"> *</span></label>
              <div class="input-group mb-3">
                <input type="text" name="VS_WEIGHT" id="VS_WEIGHT" class="form-control" autofocus required>
                <div class="input-group-append">
                  <span class="input-group-text">kg</span>
                </div>
              </div>
            </div>
            <div class="col">
              <label for="field1">Height<span class="text-danger"> *</span></label>
              <div class="input-group mb-3">
                <input type="text" name="VS_HEIGHT" id="VS_HEIGHT"  class="form-control" required>
                <div class="input-group-append">
                  <span class="input-group-text">cm</span>
                </div>
              </div>
            </div>
            <div class="col">
              <label for="field1">Temperature<span class="text-danger"> *</span></label>
              <div class="input-group mb-3">
                <input type="text" name="VS_TEMPERATURE" id="VS_TEMPERATURE"  class="form-control" required>
                <div class="input-group-append">
                  <span class="input-group-text">&#8451;</span>
                </div>
              </div>
            </div>
            <div class="col">
            <label for="field1">Heartrate<span class="text-danger"> *</span></label>
              <div class="input-group mb-3">
                <input type="text" name="VS_HEARTRATE" id="VS_HEARTRATE"  class="form-control" required>
                <div class="input-group-append">
                  <span class="input-group-text">/min</span>
                </div>
              </div>
            </div>
            <div class="col">
            <label for="field1">Blood Press.<span class="text-danger"> *</span></label>
              <div class="input-group mb-3">
                <input type="text" name="VS_SYSTOLIC" id="VS_SYSTOLIC"  class="form-control" required> 
                <input type="text" name="VS_DIASTOLIC" id="VS_DIASTOLIC" class="form-control" required>
                <div class="input-group-append">
                  <span class="input-group-text">mm</span>
                </div>
              </div>
            </div>
            <div class="col">
            <label for="field1">Respiration<span class="text-danger"> *</span></label>
              <div class="input-group mb-3">
                <input type="text" name="VS_RESPIRATION" id="VS_RESPIRATION"  class="form-control" required>
                <div class="input-group-append">
                  <span class="input-group-text">/min</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Complaint & Diagnosis -->
          <div class="row">
            <div class="col">
            <div class="form-group">
                  <label for="field1">Complaints<span class="text-danger"> *</span></label>
                  <!-- <textarea name="MEDREC_COMPLAINTS"  cols="30" rows="5"  required>
                  </textarea> -->
                  <textarea class="form-control" name="MEDREC_COMPLAINTS" cols="30" rows="5"></textarea>
              </div>
            </div>
            <div class="col">
            <div class="form-group">
                  <label for="field1">Diagnosis<span class="text-danger"> *</span></label>
                  <!-- <textarea name="MEDREC_DIAGNOSIS" cols="30" rows="5" required>
                  </textarea> -->
                  <textarea class="form-control" name="MEDREC_DIAGNOSIS" cols="30" rows="5"></textarea>
              </div>
            </div>
          </div>

          </div>
          <div class="card-footer">

          </div>
        </div>
        <!-- End Medical Record -->

        <div class="row">
          <div class="col">
            
          <!-- Treatment Received -->
          <div class="card">
            <div class="card-header text-light" style="background-color: #5D9C59">
              2. Treatment Received
            </div>
            <div class="card-body">
            
                  <table class="table table-bordered" id="dynamicAddRemove">
                      <tr>
                          <th style="width:10px;"><button type="button" name="add" id="dynamic-ar" class="btn btn-primary btn-sm"><i class="fa fa-plus"></button></th>
                          <th style="width:50%;">Treatment Received<span class="text-danger"> *</span></th>
                          <th style="width:50%;">Description</th>
                      </tr>
                      <tr>
                          <td></td>
                          <td>
                            <select class="form-select" name="TREATMENT_ID[0]" id="addMoreInputFields[0][treatment]" aria-label="Default select example">
                              <option selected disabled>Treatment Item</option>
                              @foreach($tlist as $treatmentlist)
                              <option value="{{$treatmentlist->TREATMENT_ID}}">{{$treatmentlist->TREATMENT_NAME}}</option>
                              @endforeach
                            </select>
                          </td>
                          <td>
                            <div class="input-group">
                              <textarea name="TREATMENT_DESC[0]" id="addMoreInputFields[0][treatmentdesc]" class="form-control" aria-describedby="basic-addon1" rows="1"></textarea>
                            </div>
                          </td>
                      </tr>
                  </table>

            </div>
            <div class="card-footer">

            </div>
          </div>
          <!-- End Treatment Received -->

          </div>
        </div>

          <!-- Medicine Request -->
          <div class="card">
            <div class="card-header text-light" style="background-color: #5D9C59">
              3. Medicine Request
            </div>
            <div class="card-body">

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
                    <select class="form-select" name="MEDICINE_ID[0]" id="category">
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
                      <div id="app">
                      </div>
                    </td>
                </tr>
              </table>

                          
            </div>
            <div class="card-footer">
              <!-- Temporary -->
              <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Are you sure you have completed medical treatment process?');">Submit</button>
              <a href="{{ url('/cancel/'.$appointments->APPOINTMENT_ID) }}" class="btn btn-danger mb-3 mr-2 float-right text-light" onclick="return confirm('Cancel the Medical Treatement?');">Cancel</a>
              </form>
              <!-- Temporary -->
            </div>
          </div>
          <!-- End Medicine Request -->
        <!-- Patient History -->
        <div class="card">
          <div class="card-header text-light bg-info">
            Medical History
          </div>

          <div class="row">
            <div class="col">
              <div class="card-body">

              @foreach($medRECORD as $record)
              <a type="button" data-toggle="modal" data-target="#medRecApp-{{$record->RECORD_ID}}">
              <div class="card mr-1" style="width: 12rem;">
                <div class="card-header bg-warning">
                  <h5 class="card-title mb-0">{{$record->RECORD_ID}}</h5>
                </div>
                <div class="card-body">
                  <p class="card-text mb-0">Dr. {{$record->user_fname}} {{$record->user_mname}} {{$record->user_lname}}</p>
                  <p class="card-text"><?php echo(date('d M Y', strtotime($record->APP_DATE))); ?></p>
                </div>
              </div>
              </a>
              @include('layout.modal')
              @endforeach

              </div>
            </div>
          </div>

        </div>
        <!-- End Patient History -->

      </div>
    </div>
  </div>
</div>




  <!-- JavaScript and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <!-- JavaScript for validations only -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  <!-- Our script! :) -->
  <script src="../dist/enchanter.js"></script>  


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        ++i;
        
        $("#dynamicAddRemove").append(
          '<tr>'+
            '<td><button type="button" class="btn btn-danger btn-sm remove-input-field"><i class="fa fa-trash"></button></td>'+
            '<td>'+
              '<select class="form-select" name="TREATMENT_ID['+ i +']" id="addMoreInputFields['+ i +'][treatment]" aria-label="Default select example">'+
                '<option selected disabled>Treatment Item</option>'+
                '@foreach($tlist as $treatmentlist)'+
                '<option value="{{$treatmentlist->TREATMENT_ID}}">{{$treatmentlist->TREATMENT_NAME}}</option>'+
                '@endforeach'+
              '</select>'+
            '</td>'+
            '<td>'+
              '<div class="input-group">'+
                '<textarea name="TREATMENT_DESC['+ i +']" id="addMoreInputFields['+ i +'][treatmentdesc]" class="form-control" aria-describedby="basic-addon1" rows="1"></textarea>'+
              '</div>'+
            '</td>'+
          '</tr>'
          );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>

<script type="text/javascript">
    var j = 0;
    $("#dynamic-ar1").click(function () {
        ++j; 
        $("#dynamicAddRemove1").append(
            '<tr>'+
            '<td><button type="button" class="btn btn-danger btn-sm remove-input-field"><i class="fa fa-trash"></button></td>'+
              '<td>'+
              '<select class="form-select" name="MEDICINE_ID['+ j +']" id="category['+ j +']">'+
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
              '<td>'+
                '<div id="app['+ j +']">'+
                '</div>'+
              '</td>'+
          '</tr>'
        );  
    
      });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>

<script>
$(document).ready(function() {
$('#category').on('change', function() {
  $('#app').empty();
    var categoryID = $(this).val();
    if(categoryID) {
        $.ajax({
            url: '/getInstock/'+categoryID,
            type: "GET",
            data : {"_token":"{{ csrf_token() }}"},
            dataType: "json",
            success:function(data)
            {
              if(data){
                $('#app').append('<p>'+ data.MED_INSTOCK + " " + data.MED_PACKTYPE+ '</p>'); 
            }else{
                $('#app').empty();
            }
          }
        });
    }else{
      $('#app').empty();
    }
    i++;
  });
});
</script>
        </div>
      </div>
    </div>
  </div>
  
@endsection