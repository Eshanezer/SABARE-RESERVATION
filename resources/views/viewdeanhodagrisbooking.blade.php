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
        <td>Number Of Adults</td>
        <td>Number Of Children</td>
        <td>Number Of Units</td>
        <td>Guest Tye</td>
        <td>Description</td>
        <td>Request VC Approval</td>
        <td>Status</td>
        <td>Option</td>
        
        
        
        
         
    </tr>
    @foreach ($agrsbookings as $agrsbooking)
    <tr>
        <td>{{ $agrsbooking->BookingId  }}</td>
        <td>{{ $agrsbooking->GuestName  }}</td>
        <td>{{ $agrsbooking->CheckInDate }}</td>
        <td>{{ $agrsbooking->CheckOutDate }}</td>
        <td>{{ $agrsbooking->NoOfAdults }}</td>
        <td>{{ $agrsbooking->NoOfChildren  }}</td>
        <td>{{ $agrsbooking->NoOfUnits }}</td>
        <td>{{ $agrsbooking->BookingType }}</td>
        <td>{{ $agrsbooking->Description }}</td>
        @if($agrsbooking->VCApproval == 0)
        <td>Not Request</a></td>
        @else
        <td>Requested</a></td>
        @endif
        
        <td>{{ $agrsbooking->Status }}</td>
       
        <td>
        <a href = 'afrecommend/{{ $agrsbooking->BookingId }}'>Recommend</a> </br>
        <a href = 'afnotrecommend/{{ $agrsbooking->BookingId }}'>Reject</a>
        </td>
       
    </tr>
    @endforeach
    </table>

</div>
 </div>
</div>


@endsection