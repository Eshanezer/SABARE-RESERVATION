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
        <td>Request VC Approval</td>
        <td>Status</td>
        <td>Option</td>
        
        
        
        
         
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
        @if($agridbooking->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif
        <td>{{ $agridbooking->Status }}</td>
       
       
        @if($agridbooking->VCApproval == 0)
        <td>
        <a href = 'showafdvc/{{ $agridbooking->BookingId }}'>View</a></br>
       
        </td>
        @else
        <td>
        <a href = 'showafdvc/{{ $agridbooking->BookingId }}'>View</a></br>
        <a href = 'afdapprove/{{ $agridbooking->BookingId }}'>Approve</a></br>
        <a href = 'afdnotapprove/{{ $agridbooking->BookingId }}'>Not Approve</a>
       
        </td>
        @endif
       
       
       
       
    </tr>
    @endforeach
    </table>

</div>
 </div>
</div>


@endsection