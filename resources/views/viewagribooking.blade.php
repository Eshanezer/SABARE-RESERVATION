@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2 ">
<h5 class="card-header bg-secondary text-white">Agri Farm Booking Details</h5>
<div class="card-body ">


    <table border = "1" class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Guest Id </td>
        <td>Agri Farm Stay Id </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <td>Number Of Adults</td>
        <td>Number Of Children</td>
        <td>Description</td>
        <td>Status</td>
        
    </tr>
    @foreach ($agrsbookings as $agrsbookings)
    <tr>
        <td>{{ $agrsbookings->BookingId  }}</td>
        <td>{{ $agrsbookings->GuestId  }}</td>
        <td>{{ $agrsbookings->AgriFarmStayId   }}</td>
        <td>{{ $agrsbookings->CheckInDate }}</td>
        <td>{{ $agrsbookings->CheckOutDate }}</td>
        <td>{{ $agrsbookings->NoOfAdults }}</td>
        <td>{{ $agrsbookings->NoOfChildren }}</td>
        <td>{{ $agrsbookings->	Description }}</td>
        @if($agrsbookings->VCApproval == 0)
        <td><a href = 'approve/{{ $agrsbookings->BookingId }}'>Approve</a></td>
        @else
        <td>Approved</a></td>
        @endif
    </tr>
    @endforeach
    </table>


 </div>
</div>


@endsection