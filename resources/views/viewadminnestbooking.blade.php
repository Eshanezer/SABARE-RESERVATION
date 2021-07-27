@extends('layouts.app')


@section('content')
<div class="card  ">
<h5 class="card-header bg-secondary text-white">Nest Booking Details</h5>
<div class="card-body ">

<div class="table-responsive">
    <table  class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Guest Name</td>
        <td>Room Type </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <!-- <td>Number Of Adults</td>
        <td>Number Of Children</td> -->
        <!-- <td>Number Of Units</td> -->
        <!-- <td>Guest Tye</td>
        <td>Description</td> -->
        <td>Request VC Approval</td>
        <td>Status</td>
        <td>Option</td>
        
        
        
        
         
    </tr>
    @foreach ($nestbookings as $nestbookings)
    <tr>
        <td>{{ $nestbookings->BookingId  }}</td>
        <td>{{ $nestbookings->GuestName  }}</td>
        <td>{{ $nestbookings->Type    }}</td>
        <td>{{ $nestbookings->CheckInDate }}</td>
        <td>{{ $nestbookings->CheckOutDate }}</td>
        <!-- <td>{{ $nestbookings->NoOfAdults }}</td>
        <td>{{ $nestbookings->NoOfChildren  }}</td> -->
        <!-- <td>{{ $nestbookings->NoOfUnits }}</td> -->
        <!-- <td>{{ $nestbookings->BookingType }}</td>
        <td>{{ $nestbookings->Description }}</td> -->
        @if($nestbookings->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif
        
        <td>{{ $nestbookings->Status }}</td>
       
        <td>
        <a href = 'showadminnest/{{ $nestbookings->BookingId }}'>View</a></br>
        <a href = 'nestadminconfirm/{{ $nestbookings->BookingId }}'>Confirm</a></br>
        <a href = 'nestadminnotconfirm/{{ $nestbookings->BookingId }}'>Reject</a>
       
        </td>
       
       
    </tr>
    @endforeach
    </table>

</div>
 </div>
</div>


@endsection