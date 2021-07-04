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
        <td>Check In Date</td>
        <td>StartTime</td>
        <td>EndTime</td>
        <td>Number Of Guest</td>
        <td>Description</td>
        <td>Status</td>
        <td>Confirm</td>
        
        
        
        
         
    </tr>
    @foreach ($agridbooking as $agridbooking)
    <tr>
        <td>{{ $agridbooking->BookingId  }}</td>
        <td>{{ $agridbooking->GuestId  }}</td>
        <td>{{ $agridbooking->CheckInDate }}</td>
        <td>{{ $agridbooking->StartTime }}</td>
        <td>{{ $agridbooking->EndTime }}</td>
        <td>{{ $agridbooking->NoOfGuest  }}</td>
        <td>{{ $agridbooking->Description }}</td>
        <td>{{ $agridbooking->Status }}</td>
       
        <td>
        <a href = 'afdrecommend/{{ $agridbooking->BookingId }}'>Recommended</a> </br>
        <a href = 'afdnotrecommend/{{ $agridbooking->BookingId }}'>Not Recommend</a>
        </td>
       
    </tr>
    @endforeach
    </table>

</div>
 </div>
</div>


@endsection