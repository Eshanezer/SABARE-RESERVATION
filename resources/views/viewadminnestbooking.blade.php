@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2 ">
<h5 class="card-header bg-secondary text-white">NEST Booking Details</h5>
<div class="card-body ">


    <table border = "1" class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Guest Id </td>
        <td>NestId </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <td>Number Of Adults</td>
        <td>Number Of Children</td>
        <td>Description</td>
        <td>Status</td>
        
    </tr>
    @foreach ($nestbookings as $nestbookings)
    <tr>
        <td>{{ $nestbookings->BookingId  }}</td>
        <td>{{ $nestbookings->GuestId  }}</td>
        <td>{{ $nestbookings->NestId    }}</td>
        <td>{{ $nestbookings->CheckInDate }}</td>
        <td>{{ $nestbookings->CheckOutDate }}</td>
        <td>{{ $nestbookings->NoOfAdults }}</td>
        <td>{{ $nestbookings->NoOfChildren }}</td>
        <td>{{ $nestbookings->	Description }}</td>
        @if($nestbookings->VCApproval == 0)
        <td>Not Approved</td>
        @else
        <td>Approved</a></td>
        @endif
        
    </tr>
    @endforeach
    </table>


 </div>
</div>


@endsection