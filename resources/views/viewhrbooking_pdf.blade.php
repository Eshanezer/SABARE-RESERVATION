
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
    @foreach ($hrbookings as $hrbooking)
    <tr>
        <td>{{ $hrbooking->BookingId  }}</td>
        <td>{{ $hrbooking->GuestName  }}</td>
        <td>{{ $hrbooking->Type   }}</td>
        <td>{{ $hrbooking->CheckInDate }}</td>
        <td>{{ $hrbooking->CheckOutDate }}</td>
        <td>{{ $hrbooking->NoOfUnits }}</td>
        @if($hrbooking->VCApproval == 0)
        <td>Not Request</td>
        @else
        <td>Requested</td>
        @endif
        
        <td>{{ $hrbooking->Status }}</td>
       
    
       
       
    </tr>
    @endforeach
    </table>

