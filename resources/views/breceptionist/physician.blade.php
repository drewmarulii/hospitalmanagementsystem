@extends('layout')


@section('title')
<h1><span class="text-success h1">| </span>Physician Record</h1>
@endsection

@section('breadcrumb')
<input type="text" class="form-control" placeholder="Search Physician" aria-label="Search cards"
                        onkeyup="searchFilter()">
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">

          <div class="row" id="myItems">
            @foreach($physician as $physicians)
            <div class="col-2">

            <div class="d-flex flex-wrap align-items-center text-center">
                <a href="{{url('/physician/'.$physicians->userid)}}" style="text-decoration:none">
                    <div id="doctorcard" class="m-2 card card-con">
                    <div class="thumb-lg member-thumb mx-auto">
                            @if($physicians->user_pp)
                            <img src="{{ asset('uploads/users/'.$physicians->user_pp ) }}" alt="P_Picture"
                            class="rounded-circle img-thumbnail mb-2" style="width: 100px; height: 100px; ">
                            @else
                            <img src="{{ asset('uploads/users/nopic.png') }}" alt="P_Picture"
                            class="rounded-circle img-thumbnail mb-2" style="width: 100px; height: 100px; ">
                            @endif
                        
                        </div>
                        <div class="">
                            <p class="card-title">Dr. {{ $physicians->user_fname }} {{ $physicians->user_lname }}
                            <br><span class="text-muted">{{ $physicians->poly_name }}</span>
                            </p>
                        </div>
                        <div class="card-footer text-light bg-dark">
                            {{ $physicians->userid }}
                        </div>

                    </div>
                </a>
            </div>

            </div>
            @endforeach

		</div>
        <!-- end col -->

        <div class="row">
            <div class="col-12">
                <div class="text-right">
                    <ul class="pagination pagination-split mt-0 float-right">
                        <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span> <span class="sr-only">Previous</span></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span> <span class="sr-only">Next</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end row -->

		  
		  </div>
        </div>
      </div>
    </div>

    <!-- This is Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- this is javascript-->
    <script>
        var searchFilter = () => {
            const input = document.querySelector(".form-control");
            const cards = document.getElementsByClassName("col-2");
            console.log(cards[1])
            let filter = input.value
            for (let i = 0; i < cards.length; i++) {
                let title = cards[i].querySelector(".card-con");
                if (title.innerText.toLowerCase().indexOf(filter.toLowerCase()) > -1) {
                    cards[i].classList.remove("d-none")
                } else {
                    cards[i].classList.add("d-none")
                }
            }
        }

    </script>



@endsection