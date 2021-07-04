
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
        <td>Check In Date</td>
        <td>
        <input class="form-control" type = 'text' name = 'CheckInDate'
        value = '<?php echo$users[0]->CheckInDate; ?>' readonly="readonly"/>
        </td>
        </tr>
     
        <tr>
        <td>Number Of Guest</td>
        <td>
        <input class="form-control" type = 'text' name = 'NoOfGuest'
        value = '<?php echo$users[0]->NoOfGuest; ?>' readonly="readonly"/>
        </td>
        </tr>
        
        <tr>
        <td>Description</td>
        <td>
        <input class="form-control" type = 'textarea' name = 'Description'
        value = '<?php echo$users[0]->Description; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Recommendation From</td>
        <td>
        <input class="form-control" type = 'textarea' name = 'Recommendation_From'
        value = '<?php echo$users[0]->Recommendation_From; ?>' readonly="readonly"/>
        </td>
        </tr>
        <tr>
        <td>Request VC Approval</td>
        @if( $users[0]->VCApproval == 1)
        <td>
        <label class="form-control" type = 'text' name = 'VCApproval'
         readonly="readonly"> Request Approval </label>
        </td>
        @else
        <td>
        <label class="form-control" type = 'text' name = 'VCApproval'
         readonly="readonly"> Not Request </label>
        </td>
        @endif
        
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