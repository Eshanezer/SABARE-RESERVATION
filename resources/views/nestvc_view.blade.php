
@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2 bg-secondary text-white">
    <h5 class="card-header">Details</h5>
    <div class="card-body">
     <div class="mb-4">
        <form action = "/show/<?php echo $users[0]->BookingId; ?>" method = "post">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <table>
        <tr>
        <td>
        Booking Id
        
        </td>
        <td>
        <input  class="form-control" type = 'text' name = 'BookingId'
        value = '<?php echo$users[0]->BookingId; ?>'readonly="readonly"/> </td>
        </tr>
        <tr>

        <td>Guest Id</td>
        <td>
        <input class="form-control" type = 'text' name = 'GuestId'
        value = '<?php echo$users[0]->GuestId; ?>'readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Nest Id</td>
        <td>
        <input class="form-control" type = 'text' name = 'NestId'
        value = '<?php echo$users[0]->NestId; ?>'readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Check In Date</td>
        <td>
        <input class="form-control" type = 'text' name = 'CheckInDate'
        value = '<?php echo$users[0]->CheckInDate; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Check Out Date</td>
        <td>
        <input class="form-control" type = 'text' name = 'CheckOutDate'
        value = '<?php echo$users[0]->CheckOutDate; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Number Of Adults</td>
        <td>
        <input class="form-control" type = 'text' name = 'NoOfAdults'
        value = '<?php echo$users[0]->NoOfAdults; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Number Of Children</td>
        <td>
        <input class="form-control" type = 'text' name = 'NoOfChildren'
        value = '<?php echo$users[0]->NoOfChildren; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Number Of Units</td>
        <td>
        <input class="form-control" type = 'text' name = 'NoOfUnits'
        value = '<?php echo$users[0]->NoOfUnits; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Guest Type</td>
        <td>
        <input class="form-control" type = 'text' name = 'BookingType'
        value = '<?php echo$users[0]->BookingType; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Description</td>
        <td>
        <input class="form-control" type = 'textarea' name = 'Description'
        value = '<?php echo$users[0]->Description; ?>' readonly="readonly"/>
        </td>
        </tr>
       
        <td>Status</td>
        <td>
        <input class="form-control" type = 'text' name = 'Status'
        value = '<?php echo$users[0]->Status; ?>' readonly="readonly"/>
        </td>
        </tr>
        
      
        </table>
        </form>
        
    </div>
    </div>
</div>

@endsection