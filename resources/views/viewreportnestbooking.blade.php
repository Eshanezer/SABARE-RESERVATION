@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Nest booking details from coordinator side -->
<h5 class="card-header bg-secondary text-white">Nest Booking Details</h5>
<div class="card-body ">


   <div class="mb-3">

    {!! Form::open(['url' => 'viewreportnestbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


    <div class="form-group">
    {{Form::label('CheckInDate', 'Check In Date') }}
    <input type="date" class="form-control" name="CheckInDate" value="{{request()->query('CheckInDate') != null ? request()->query('CheckInDate') : date('yyyy/mm/dd')}}">

    </div>


    </br>
    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
    </div>
    {!! Form::close() !!}
    <a class="nav-link btn btn-info " href="/download-pdf?CheckInDate={{request()->CheckInDate}}">Export Deatils</a></br>
    <a class="nav-link btn btn-info " href="/download-monthpdf?CheckInDate={{request()->CheckInDate}}">Export Monthly details </a></br>
    <a class="nav-link btn btn-info " href="/download-yearpdf?CheckInDate={{request()->CheckInDate}}">Export Year details </a></br>
    </div>

 </div>
</div>


@endsection