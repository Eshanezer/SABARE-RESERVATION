<table  class="table table-striped">
    <tr>
        <td>Booking Id </td>
        <td>Guest Name</td>
        <td>Room Type </td>
        <td>Check In Date</td>
        <td>Check Out Date</td>
        <td>Number Of Units</td>
        <td>Request VC Approval</td>
        <td>Status</td>
    </tr>
    @foreach ($nestbookings as $nestbooking)
    <tr>
        <td>{{ $nestbooking->BookingId  }}</td>
        <td>{{ $nestbooking->GuestName  }}</td>
        <td>{{ $nestbooking->Type    }}</td>
        <td>{{ $nestbooking->CheckInDate }}</td>
        <td>{{ $nestbooking->CheckOutDate }}</td>
        <td>{{ $nestbooking->NoOfUnits }}</td>
        @if($nestbooking->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif
        
        <td>{{ $nestbooking->Status }}</td>
       
       
    </tr>
    @endforeach
    </table>