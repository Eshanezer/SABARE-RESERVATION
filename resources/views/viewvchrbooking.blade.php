@extends('layouts.app')


@section('content')
<div class="card">
<h5 class="card-header bg-secondary text-white">Holiday Resort Booking Details</h5>
<div class="card-body ">
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
    @foreach ($hrbookings as $hrbookings)
    <tr>
        <td>{{ $hrbookings->BookingId  }}</td>
        <td>{{ $hrbookings->GuestName  }}</td>
        <td>{{ $hrbookings->Type }}</td>
        <td>{{ $hrbookings->CheckInDate }}</td>
        <td>{{ $hrbookings->CheckOutDate }}</td>
        <td>{{ $hrbookings->NoOfUnits }}</td>
        @if($hrbookings->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif
        
        <td>{{ $hrbookings->Status }}</td>
       

        @if($hrbookings->VCApproval == 0)
        <td>
        <a href = 'showhrvc/{{ $hrbookings->BookingId }}'>View</a></br>
       
        </td>
        @else
        <td>
        <a href = 'showhrvc/{{ $hrbookings->BookingId }}'>View</a></br>
        <a href = 'hrapprove/{{ $hrbookings->BookingId }}'>Approve</a></br>
        <a href = 'hrnotapprove/{{ $hrbookings->BookingId }}'>Reject</a>
       
        </td>
        @endif
        
       
       
    </tr>
    @endforeach
    </table>

</div>
 </div>
</div>


@endsection