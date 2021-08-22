@extends('layouts.app')


@section('content')
<div class="card  ">

<!-- View Holiday Resort booking details from coordinator side -->
<h5 class="card-header bg-secondary text-white">Holiday Resort Booking Details</h5>
<div class="card-body ">

   <div class="mb-3">

    {!! Form::open(['url' => 'viewhrbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


    <div class="form-group">
    {{Form::label('CheckInDate', 'Check In Date') }}
    <input type="date" class="form-control" name="CheckInDate" value="{{request()->query('CheckInDate') != null ? request()->query('CheckInDate') : date('yyyy/mm/dd')}}">

    </div>


    </br>
    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
    </div>
    {!! Form::close() !!}
    <a class="nav-link btn btn-info " href="/download-hrpdf?CheckInDate={{request()->CheckInDate}}">Export Deatils</a></br>
    <a class="nav-link btn btn-info " href="/download-hrmonthpdf?CheckInDate={{request()->CheckInDate}}">Export Monthly Details </a></br>
    <a class="nav-link btn btn-info " href="/download-hryearpdf?CheckInDate={{request()->CheckInDate}}">Export Year Details </a></br>
    
    </div>

<div class="table-responsive">
    <table  class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Guest Name</td>
        <td>Room Type </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <td>Number Of Units</td>
        <td>Status</td>
        <td>Option</td>
        
        
        
        
         
    </tr>
    @foreach ($hrbookings as $hrbooking)
    <tr>
        <td>{{ $hrbooking->BookingId  }}</td>
        <td>{{ $hrbooking->GuestName  }}</td>
        <td>{{ $hrbooking->Type   }}</td>
        <td>{{ $hrbooking->CheckInDate }}</td>
        <td>{{ $hrbooking->CheckOutDate }}</td>
        <td>{{ $hrbooking->NoOfUnits }}</td>
     
        
        <td>{{ $hrbooking->Status }}</td>
       
        <td>
        <a href = 'showhr/{{ $hrbooking->BookingId }}'>View</a></br>

         <a href = 'showrechr/{{ $hrbooking->BookingId }}'>HOD/Dean Approval</a></br>
        <a href = 'showvchr/{{ $hrbooking->BookingId }}'>VC Approval</a></br>
        <!-- <a href = 'hrregapprove/{{ $hrbooking->BookingId }}'>Registrar Approval </a></br> -->

        <a href = 'hrconfirm/{{ $hrbooking->BookingId }}'>Confirm</a></br>
        <a href = 'hrnotconfirm/{{ $hrbooking->BookingId }}'>Reject</a></br>
       
       
        </td>
       
       
    </tr>
    @endforeach
    </table>

{{ $hrbookings->links() }}
</div>
 </div>
</div>


@endsection