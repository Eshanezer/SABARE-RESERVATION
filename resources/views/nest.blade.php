@extends('layouts.app')


@section('content')
<h1>NEST</h1>

    <table class="table">
  <thead class="table-primary">
         <tr>
            <td>Type</td>
            <td>Number Of Units</td>
            <td>Number Of Adults</td>
            <td>Number Of Children</td>
         </tr>
         
</thead>
<tbody>
         @if(count($nest)>0)
    @foreach($nest as $nest)
         <tr>
            <td>{{ $nest->Type }}</td>
            <td>{{ $nest->NoOfUnits }}</td>
            <td>{{ $nest->NoOfAdults }}</td>
            <td>{{ $nest->NoOfChildren }}</td>
         </tr>
         @endforeach
         @endif
         </tbody>
      </table>

          <div class="card p-3 mb-2 bg-secondary text-white">
            <h5 class="card-header">Booking</h5>
            <div class="card-body">
            <div class="mb-3">



                        {!! Form::open(['url' => 'nest/submit']) !!}

                        <div class="form-group ">
                            {!! Form::label('Room Type')!!}
                            {!! Form::select('NestId', $nestfill, null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                        {{Form::label('CheckInDate', 'Check In Date') }}
                        {{ Form::date('CheckInDate', new \DateTime(), ['class' => 'form-control']) }}
                       
                        </div>
                        <div class="form-group">
                        {{Form::label('CheckOutDate', 'Check Out Date') }}
                        {{ Form::date('CheckOutDate', new \DateTime(), ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                        {{Form::label('NoOfAdults', 'Number Of Adults') }}
                        {{Form::text('NoOfAdults', '',['class'=>'form-control','placeholder'=>'Number Of Adults'])}}
                        </div>
                        <div class="form-group">
                        {{Form::label('NoOfChildren', 'Number Of Children') }}
                        {{Form::text('NoOfChildren', '',['class'=>'form-control','placeholder'=>'Number Of Children'])}}
                        </div>

                        <div class="form-group">
                        {{Form::label('NoOfUnits', 'Number Of Units') }}
                        {{Form::text('NoOfUnits', '',['class'=>'form-control','placeholder'=>'Number Of Units'])}}
                        </div>

                        <div class="form-group">
                        {{Form::label('BookingType', 'Booking for Resource Person') }}
                        {{Form::select('BookingType', ['Resource Person' => 'Yes', ' SUSL Staff' => 'No'], null, ['placeholder' => 'Please select ...'])}}
                        
                        </div>
                        <div class="form-group">
                        {{Form::label('Description', 'Description') }}
                        {{Form::textarea('Description', '',['class'=>'form-control','placeholder'=>'Description'])}}
                        </div>
                        <div class="form-group">
                        
                        <div class="form-group ">
                            {!! Form::label('Request Recommendation from')!!}
                            {!! Form::select('Recommendation_from', $select, null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                        {{Form::label('VCApproval', 'Request VC Approval') }}
                        {{Form::select('VCApproval', [1 => 'Yes', 0 => 'No'], null, ['placeholder' => 'Please select ...'])}}
                        
                        </div>

                        </br>
                        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                        </div>
                        {!! Form::close() !!}

                        <!-- @if (count($errors) > 0)
                            <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        <form method="post" action="{{url('af/send')}}">
                            {{ csrf_field() }}
                            
                            <div class="form-group">
                            <input type="submit" name="send" class="btn btn-info" value="Request Vice Chancellor Approval" />
                            </div>
                        </form> -->

                        

             </div>
        </div>
    </div>
@endsection