@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Nest booking details from dean/hod side -->
<h5 class="card-header bg-secondary text-white">Nest Booking Details</h5>
<div class="card-body ">


        <div class="mb-3">

        {!! Form::open(['url' => 'viewguestnestbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


        <div class="form-group">
        {{Form::label('CheckInDate', 'Check In Date') }}
        <input type="date" class="form-control" name="CheckInDate" value="{{request()->query('CheckInDate') != null ? request()->query('CheckInDate') : date('yyyy/mm/dd')}}">

        </div>


        </br>
        {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
        </div>
        {!! Form::close() !!}

        </div>
<div class="table-responsive">
    <table  class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Create Date</td>
        <td>Guest Name </td>
        <td>Room Type </td>
        <!-- <td>EventName</td> -->
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <!-- <td>Number Of Adults</td>
        <td>Number Of Children</td>-->
        <td>Number Of Units</td> 
        {{-- <td>Guest Tye</td> --}}
        <!-- <td>Description</td>
        <td>Request VC Approval</td> -->
        <td>Payment</td>
        <td>Status</td>
        <td></td>

        
        
        
        
         
    </tr>
    @foreach ($nestbookings as $nestbooking)
    <tr>
        <td>{{ $nestbooking->BookingId  }}</td>
        <td>{{ $nestbooking->created_at  }}</td>
        <td>{{ $nestbooking->GuestName  }}</td>
        <td>{{ $nestbooking->Type    }}</td>
        <td>{{ $nestbooking->CheckInDate }}</td>
        <td>{{ $nestbooking->CheckOutDate }}</td>
         {{-- <td>{{ $nestbooking->NoOfAdults }}</td>
        <td>{{ $nestbooking->NoOfChildren  }}</td>--}}
        <td>{{ $nestbooking->NoOfUnits }}</td>  
        {{-- <td>{{ $nestbooking->BookingType }}</td> --}}
         {{-- <td>{{ $nestbooking->Description }}</td> --}}
        {{-- @if($nestbooking->VCApproval == 0)
        <td>Not Request</a></td>
        @else
        <td>Requested</a></td>
        @endif --}}
        
        <td>{{ number_format($nestbooking->payment_amount,2) }}</td>
        <td>{{ $nestbooking->Status }}</td>
        <td>@if($nestbooking->Status=='Payment Requested')<a class="btn btn-primary" href="https://www.sab.ac.lk/payment-test/?event=reservation&paycategory=NEST&payname={{$nestbooking->GuestName}}&payid={{$nestbooking->BookingId}}&paramount={{$nestbooking->payment_amount}}&payother={{$nestbooking->BookingId}}&payemail={{auth()->user()->email}}">Pay Now</a>@endif</td>


       
    </tr>
    @endforeach
    </table>

 {{ $nestbookings->links() }}
</div>
 </div>
</div>


@endsection