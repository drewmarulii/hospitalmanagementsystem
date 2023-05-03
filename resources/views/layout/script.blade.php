<script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
<!-- <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>

<script src=
"https://d3js.org/d3.v4.min.js"></script>
<script src=
"https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.js"></script>
<link rel="stylesheet"
      href=
"https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.css" />


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script defer src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
$(document).ready(function () {
    $('#example').DataTable();
});
</script>

<script>
$(document).ready( function () {
    $('#roleTable').DataTable();
} );
</script>

<script>
$(document).ready( function () {
    $('#invoiceTable').DataTable();
} );
</script>

<script>
$(document).ready( function () {
    $('#polyTable').DataTable();
} );
</script>

<script>
$(document).ready( function () {
    $('#patientTable').DataTable();
} );
</script>

<script>
$(document).ready( function () {
    $('#medicineOrder').DataTable();
} );
</script>


<script>
$(document).ready( function () {
  var table = $('#patRecTable').DataTable( {
    pageLength : 3,
    lengthMenu: [[3, 5, 10, -1], [3, 5, 7, 10]]
  })
});
</script>

<script>
$(document).ready( function () {
  var table = $('#patAppTable').DataTable( {
    pageLength : 3,
    lengthMenu: [[3, 5, 10, -1], [3, 5, 7, 10]]
  })
});
</script>

<script>
$(document).ready( function () {
  var table = $('#patInvTable').DataTable( {
    pageLength : 3,
    lengthMenu: [[3, 5, 10, -1], [3, 5, 7, 10]]
  })
});
</script>

<script>
$(document).ready( function () {
  var table = $('#finMedicine').DataTable( {
    pageLength : 3,
    lengthMenu: [[3, 5, 10, -1], [3, 5, 7, 10]]
  })
  var table = $('#warnMedicine').DataTable( {
    pageLength : 3,
    lengthMenu: [[3, 5, 10, -1], [3, 5, 7, 10]]
  })
});
</script>

<script>
$(document).ready( function () {
    $('#phyAppTable').DataTable();
} );
</script>
<script>
$(document).ready( function () {
    $('#appointmentTableDash').DataTable();
} );
</script>

<script>
$(document).ready( function () {
    $('#appointmentTable').DataTable();
} );
</script>

<script>
    $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });

</script>

<script>
    $(document).ready(function() {
    $('#category').on('change', function() {
        var categoryID = $(this).val();
        if(categoryID) {
            $.ajax({
                url: '/getPhysician/'+categoryID,
                type: "GET",
                data : {"_token":"{{ csrf_token() }}"},
                dataType: "json",
                success:function(data)
                {
                  if(data){
                    $('#course').empty();
                    $('#course').append('<option hidden>Choose Physician</option>'); 
                    $.each(data, function(key, course){
                        $('select[id="course"]').append('<option value="'+ course.userid +'"> Dr. ' + course.user_fname +' '+ course.user_lname + '</option>');
                    });
                }else{
                    $('#course').empty();
                }
              }
            });
        }else{
          $('#course').empty();
        }
    });
    });
</script>