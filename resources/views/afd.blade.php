@extends('layouts.app')


@section('content')
<h1>Agri Farm Dinning Room</h1>


      

           <div class="card p-3 mb-2 bg-secondary text-white">
            <h5 class="card-header">Booking</h5>
            <div class="card-body">
            <div class="mb-3">

                        {!! Form::open(['url' => 'afd/submit']) !!}

                        
                        

                        <div class="form-group">
                        {{Form::label('CheckInDate', 'Booking Date') }}
                        {{ Form::date('CheckInDate', new \DateTime(), ['class' => 'form-control']) }}
                       
                        </div>

                        <div class="form-group">
                        {{Form::label('StartTime', 'Start Time') }}
                        {{ Form::time('StartTime', \Carbon\Carbon::now()) }}
                       
                        </div>
                        <div class="form-group">
                        {{Form::label('EndTime', 'End Time') }}
                        {{ Form::time('EndTime', \Carbon\Carbon::now()) }}
                        </div>

                         <div class="form-group">
                        {{Form::label('NoOfGuest', 'Number Of Guest') }}
                        {{Form::text('NoOfGuest', '',['class'=>'form-control','placeholder'=>'Number Of Guest'])}}
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

             </div>
        </div>
    </div>
@endsection



       
     