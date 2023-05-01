<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Adventist Hospital</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('dist/img/logo.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/stackpath.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
  
  <!-- <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script> -->

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js"> </script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


  <style>
    .mycontent-left {
  border-right: 1px solid gray;
    }

    #frame {
      border-radius: 50%;
    }

    #doctorcard{
      border-radius: 8px;
      border: 1px solid #cccccc;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 5px;
      box-sizing: border-box;
      width: 200px;
      height: 250px;
      transition: all linear 200ms;
    }
    #doctorcard:hover{
      transform: scale(1.1);
      transition: all linear 200ms;
      z-index: 1;
      box-shadow: 1px 1px 10px rgba(0,0,0,.3);
      cursor: pointer;
    }

  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    @include('layout.notification')
      <li class="nav-item ml-3 mr-0">
        <a href="{{ url('logout') }}" class="btn btn-danger" role="button">
          Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
    <img src="{{ asset('dist/img/logo.png') }} " class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">Adventist Hospital</span>
    </div>
    @include('layout.profilethumb')
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @include('layout.menu')
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('title')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li> -->
              @yield('breadcrumb')
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


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

</body>
</html>
