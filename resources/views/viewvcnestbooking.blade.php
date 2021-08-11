@extends('layouts.app')


@section('content')
<div class="card  ">
<!-- View Nest booking details from vc side -->
<h5 class="card-header bg-secondary text-white">Nest Booking Details</h5>
<div class="card-body ">

            <div class="mb-3">

        {!! Form::open(['url' => 'viewvcnestbooking',  'method' => 'GET',  'id' => 'booking_form']) !!}


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
        <td>Id </td>
        <td>Guest Name </td>
        <td>Room Type </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <td>Units</td>
        <td>Request VC Approval</td>
        <td>Status</td>
        <td>Option</td>
        
        
        
        
         
    </tr>
    @foreach ($nestbookings as $nestbooking)
    <tr>
        <td>{{ $nestbooking->BookingId  }}</td>
        <td>{{ $nestbooking->GuestName  }}</td>
        <td>{{ $nestbooking->Type   }}</td>
        <td>{{ $nestbooking->CheckInDate }}</td>
        <td>{{ $nestbooking->CheckOutDate }}</td>
        <td>{{ $nestbooking->NoOfUnits }}</td>
        @if($nestbooking->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif
        
        <td>{{ $nestbooking->Status }}</td>
       

        @if($nestbooking->VCApproval == 0)
        <td>
        <a href = 'shownestvc/{{ $nestbooking->BookingId }}'>View</a></br>
       
        </td>
        @else
        <td>
        <a href = 'shownestvc/{{ $nestbooking->BookingId }}'>View</a></br>
        <a href = 'nestapprove/{{ $nestbooking->BookingId }}'>Approve</a></br>
        <a href = 'nestnotapprove/{{ $nestbooking->BookingId }}'>Reject</a>
       
        </td>
        @endif
        
       
       
    </tr>
    @endforeach
    </table>

  {{ $nestbookings->links() }}
</div>
 </div>
</div>


@endsection