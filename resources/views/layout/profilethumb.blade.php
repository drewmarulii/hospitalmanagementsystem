<div style="border-radius: 15px;">
    <div class="container text-center mt-3">
    <a role="button" href="{{url('/myprofile/')}}">
    @if($user->user_pp)
    <img src="{{ asset('uploads/users/'.$user->user_pp ) }}" alt="User Profile" class="img-thumbnail" style="width: 100px; height: 110px; border-radius: 10px;">        
    @else
    <img src="{{ asset('uploads/users/nopic.png') }}" alt="User Profile" class="img-thumbnail" style="width: 100px; height: 110px; border-radius: 10px;">
    @endif

    
    <div class="mt-2">
        <h5 class="mb-2 mt-2 text-light">{{$user->user_fname}} {{$user->user_lname}}</h5>
        <hr class="mb-1 bg-light">
    </div>
    </a>

    </div>
</div>
                                    