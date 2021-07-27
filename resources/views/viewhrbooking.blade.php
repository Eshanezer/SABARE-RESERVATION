@extends('layouts.app')


@section('content')
<div class="card  ">
<h5 class="card-header bg-secondary text-white">Holiday Resort Booking Details</h5>
<div class="card-body ">

<div class="table-responsive">
    <table  class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Guest Name</td>
        <td>Room Type </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <!-- <td>Number Of Units</td> -->
        <td>Request VC Approval</td>
        <td>Status</td>
        <td>Option</td>
        
        
        
        
         
    </tr>
    @foreach ($hrbookings as $hrbookings)
    <tr>
        <td>{{ $hrbookings->BookingId  }}</td>
        <td>{{ $hrbookings->GuestName  }}</td>
        <td>{{ $hrbookings->Type   }}</td>
        <td>{{ $hrbookings->CheckInDate }}</td>
        <td>{{ $hrbookings->CheckOutDate }}</td>
        <!-- <td>{{ $hrbookings->NoOfUnits }}</td> -->
        @if($hrbookings->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif
        
        <td>{{ $hrbookings->Status }}</td>
       
        <td>
        <a href = 'showhr/{{ $hrbookings->BookingId }}'>View</a></br>
        <a href = 'hrconfirm/{{ $hrbookings->BookingId }}'>Confirm</a></br>
        <a href = 'hrnotconfirm/{{ $hrbookings->BookingId }}'>Reject</a>
       
        </td>
       
       
    </tr>
    @endforeach
    </table>

</div>
 </div>
</div>


@endsection