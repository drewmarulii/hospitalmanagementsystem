@extends('layout')

@section('title')
<h1><span class="text-success h1">| </span>Invoice Record</h1>
@endsection

@section('breadcrumb')

@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">

            @if(session('status'))
            <div class="alert alert-success">
            {{ session('status') }}
            </div>
            @endif

            


            </div>
        </div>
    </div>
</div>
@endsection