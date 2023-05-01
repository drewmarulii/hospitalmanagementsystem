@extends('layout')


@section('title')
  @include('layout.dashboard.title')
@endsection

@section('breadcrumb')

@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">

      @if($user->level=='R001')
        @include('layout.dashboard.admin')
      @elseif($user->level=='R002')
      <h1><span class="text-success h1">| </span>Receptionist Dashboard</h1>
      @elseif($user->level=='R003')
      <h1><span class="text-success h1">| </span>Physician Dashboard</h1>
      @elseif($user->level=='R004')
      <h1><span class="text-success h1">| </span>Pharmacy Dashboard</h1>
      @elseif($user->level=='R005')
      <h1><span class="text-success h1">| </span>Finance Dashboard</h1>
      @endif

      </div>
    </div>
  </div>
</div>
@endsection