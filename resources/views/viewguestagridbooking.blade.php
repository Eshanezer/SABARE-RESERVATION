@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Agri Farm Dinning Room booking details from dean/hod side -->
<h5 class="card-header bg-secondary text-white">View Agri Farm Dinning Room Booking Details</h5>
<div class="card-body ">


   <div class="mb-3">

    {!! Form::open(['url' => 'viewguestagridbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


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
        <td>Create Date </td>
        <td>Guest Name </td>
        <td>Check In Date</td>
        <td>StartTime</td>
        <td>EndTime</td>
        <td>Number Of Guest</td>
        <td>Description</td>
        <td>Payment</td>
        <td>Status</td>
        <td></td>
        {{-- <td>Confirm</td> --}}
        
        
        
        
         
    </tr>
    @foreach ($agridbookings as $agridbooking)
    <tr>
        <td>{{ $agridbooking->BookingId  }}</td>
        <td>{{ $agridbooking->created_at  }}</td>
        <td>{{ $agridbooking->GuestName  }}</td>
        <td>{{ $agridbooking->CheckInDate }}</td>
        <td>{{ $agridbooking->StartTime }}</td>
        <td>{{ $agridbooking->EndTime }}</td>
        <td>{{ $agridbooking->NoOfGuest  }}</td>
        <td>{{ $agridbooking->Description }}</td>
        <td>{{ number_format($agridbooking->payment_amount,2) }}</td>
        <td>{{ $agridbooking->Status }}</td>
        <td>@if($agridbooking->Status=='Payment Requested')<a href="https://www.sab.ac.lk/payment-test/?event=reservation&paycategory=Agri Farm Dining Room&payname={{$agridbooking->GuestName}}&payid={{$agridbooking->BookingId}}&paramount={{$agridbooking->payment_amount}}&payother={{$agridbooking->BookingId}}&payemail={{auth()->user()->email}}" class="btn btn-primary">Pay Now</a>@endif</td>

        {{-- <td>
        
        <a href = 'showafddean/{{ $agridbooking->BookingId }}'>View</a></br>
        @if($agridbooking->Status == 'Send to Recommendation')
        <a href = 'afdrecommend/{{ $agridbooking->BookingId }}'>Recommend</a> </br>
        <a href = 'afdnotrecommend/{{ $agridbooking->BookingId }}'>Reject</a>
        @else
        
        @endif
       
        </td> --}}
       
    </tr>
    @endforeach
    </table>

{{ $agridbookings->links() }}
</div>
 </div>
</div>


@endsection