@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2 ">
<h5 class="card-header bg-secondary text-white">Agri Farm Booking Details</h5>
<div class="card-body ">


    <table border = "1" class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Guest Name </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <td>Number Of Unit</td>
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
        <td>{{ $agrsbookings->NoOfUnits }}</td>
        @if($agrsbookings->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif
        
        <td>{{ $agrsbookings->Status }}</td>
       
        <td>
        <a href = 'showaf/{{ $agrsbookings->BookingId }}'>View</a></br>
        <a href = 'afconfirm/{{ $agrsbookings->BookingId }}'>Confirm</a></br>
        <a href = 'afnotconfirm/{{ $agrsbookings->BookingId }}'>Reject</a>
       
        </td>
    </tr>
    @endforeach
    </table>


 </div>
</div>


@endsection