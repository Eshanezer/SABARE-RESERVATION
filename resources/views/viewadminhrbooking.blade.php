@extends('layouts.app')


@section('content')
<div class="card  mb-2 ">
<h5 class="card-header bg-secondary text-white">Holiday Resort Booking Details</h5>
<div class="card-body ">


    <table border = "1" class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Guest Id </td>
        <td>Holoday Resort Id </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <td>Number Of Adults</td>
        <td>Number Of Children</td>
        <td>Description</td>
        <td>Status</td>
        
    </tr>
    @foreach ($hrbookings as $hrbookings)
    <tr>
        <td>{{ $hrbookings->BookingId  }}</td>
        <td>{{ $hrbookings->GuestId  }}</td>
        <td>{{ $hrbookings->HolodayResortId   }}</td>
        <td>{{ $hrbookings->CheckInDate }}</td>
        <td>{{ $hrbookings->CheckOutDate }}</td>
        <td>{{ $hrbookings->NoOfAdults }}</td>
        <td>{{ $hrbookings->NoOfChildren }}</td>
        <td>{{ $hrbookings->Description }}</td>
        @if($hrbookings->VCApproval == 0)
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