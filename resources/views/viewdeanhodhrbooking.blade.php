@extends('layouts.app')


@section('content')
<div class="card  ">
<h5 class="card-header bg-secondary text-white">Nest Booking Details</h5>
<div class="card-body ">

<div class="table-responsive">
    <table  class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Guest Name </td>
        <td>Room Type </td>
        <!-- <td>EventName</td> -->
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <!-- <td>Number Of Adults</td>
        <td>Number Of Children</td> -->
        <!-- <td>Number Of Units</td> -->
        <td>Guest Tye</td>
        <!-- <td>Description</td> -->
        <!-- <td>Request VC Approval</td> -->
        <td>Status</td>
        <td>Option</td>
        
        
        
        
         
    </tr>
    @foreach ($hrbookings as $hrbookings)
    <tr>
        <td>{{ $hrbookings->BookingId  }}</td>
        <td>{{ $hrbookings->GuestName  }}</td>
        <td>{{ $hrbookings->Type    }}</td>
        <td>{{ $hrbookings->CheckInDate }}</td>
        <td>{{ $hrbookings->CheckOutDate }}</td>
        <!-- <td>{{ $hrbookings->NoOfAdults }}</td>
        <td>{{ $hrbookings->NoOfChildren  }}</td> -->
        <!-- <td>{{ $hrbookings->NoOfUnits }}</td> -->
        <td>{{ $hrbookings->BookingType }}</td>
        <!-- <td>{{ $hrbookings->Description }}</td> -->
        <!-- @if($hrbookings->VCApproval == 0)
        <td>Not Request</a></td>
        @else
        <td>Requested</a></td>
        @endif -->
        
        <td>{{ $hrbookings->Status }}</td>
       
        <td>
        <a href = 'showhrdean/{{ $hrbookings->BookingId }}'>View</a></br>
        <a href = 'hrrecommend/{{ $hrbookings->BookingId }}'>Recommend</a> </br>
        <a href = 'hrnotrecommend/{{ $hrbookings->BookingId }}'>Reject</a>
        </td>
       
    </tr>
    @endforeach
    </table>

</div>
 </div>
</div>


@endsection