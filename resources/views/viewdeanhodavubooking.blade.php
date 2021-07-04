@extends('layouts.app')


@section('content')
<div class="card  ">
<h5 class="card-header bg-secondary text-white">Audio Visual Unit Booking Details</h5>
<div class="card-body ">

<div class="table-responsive">
    <table  class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Guest Id </td>
        <td>Audio Visual Unit Id </td>
        <!-- <td>EventName</td> -->
        <td>Check In Date</td>
        <td>StartTime</td>
        <td>EndTime</td>
        <td>Event Name</td>
        <td>Description</td>
        <td>Status</td>
        <td>Confirm</td>
        
        
        
        
         
    </tr>
    @foreach ($avubookings as $avubookings)
    <tr>
        <td>{{ $avubookings->BookingId  }}</td>
        <td>{{ $avubookings->GuestId  }}</td>
        <td>{{ $avubookings->AVUId   }}</td>
        <!-- <td>{{ $avubookings->EventName }}</td> -->
        <td>{{ $avubookings->CheckInDate }}</td>
        <td>{{ $avubookings->StartTime }}</td>
        <td>{{ $avubookings->EndTime }}</td>
        <td>{{ $avubookings->EventName  }}</td>
        <td>{{ $avubookings->Description }}</td>
        <td>{{ $avubookings->Status }}</td>
       
        <td>
        <a href = 'avurecommend/{{ $avubookings->BookingId }}'>Recommended</a> </br>
        <a href = 'avunnotrecommend/{{ $avubookings->BookingId }}'>Not Recommend</a>
        </td>
       
    </tr>
    @endforeach
    </table>

</div>
 </div>
</div>


@endsection