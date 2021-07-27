@extends('layouts.app')


@section('content')
<div class="card  ">
<h5 class="card-header bg-secondary text-white">Agri Farm Booking Details</h5>
<div class="card-body ">

<div class="table-responsive">
    <table  class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Guest Name </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <!-- <td>Number Of Adults</td>
        <td>Number Of Children</td> -->
        <td>Number Of Units</td>
        <!-- <td>Guest Tye</td>
        <td>Description</td> -->
        <td>Request VC Approval</td>
        <td>Status</td>
        <td>Option</td>
        
        
        
        
         
    </tr>
    @foreach ($agrsbookings as $agrsbookings)
    <tr>
        <td>{{ $agrsbookings->BookingId  }}</td>
        <td>{{ $agrsbookings->GuestName  }}</td>
        <td>{{ $agrsbookings->CheckInDate }}</td>
        <td>{{ $agrsbookings->CheckOutDate }}</td>
        <!-- <td>{{ $agrsbookings->NoOfAdults }}</td>
        <td>{{ $agrsbookings->NoOfChildren  }}</td> -->
        <td>{{ $agrsbookings->NoOfUnits }}</td>
        <!-- <td>{{ $agrsbookings->BookingType }}</td>
        <td>{{ $agrsbookings->Description }}</td> -->
        @if($agrsbookings->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif
        
        <td>{{ $agrsbookings->Status }}</td>
       

        @if($agrsbookings->VCApproval == 0)
        <td>
        <a href = 'showafsvc/{{ $agrsbookings->BookingId }}'>View</a></br>
       
        </td>
        @else
        <td>
        <a href = 'showafsvc/{{ $agrsbookings->BookingId }}'>View</a></br>
        <a href = 'afsapprove/{{ $agrsbookings->BookingId }}'>Approve</a></br>
        <a href = 'afsnotapprove/{{ $agrsbookings->BookingId }}'>Reject</a>
       
        </td>
        @endif
        
       
       
    </tr>
    @endforeach
    </table>

</div>
 </div>
</div>


@endsection