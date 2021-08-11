@extends('layouts.app')


@section('content')
<h1>Audio Visual Unit</h1>
<!-- Audio Visual Unit booking page -->
    <table class="table">
  <thead class="table-primary">
         <tr>
            <td>Type</td>
        
            <td>Description</td>
         </tr>
         
         
        
</thead>
<tbody>
        <tr>
        <td>Photography</td>
       
        <td>Only Photography</td>
         </tr>
        
    <tr>
    <td>Videography</td>
       
            <td>Only Videography</td>
         </tr>
         <tr>
         <td>Photography and Videography</td>
       
            <td>Both Photography and Videography</td>
         </tr>
 </tbody>
      </table>

           <div class="card p-3 mb-2 bg-secondary text-white">
            <h5 class="card-header">Booking</h5>
            <div class="card-body">
            <div class="mb-3">

                        {!! Form::open(['url' => 'avu/submit']) !!}

                        
                        <div class="form-group">
                        {{Form::label('AVUId', 'Booking Type') }}
                        {{Form::select('AVUId', [1 => 'Photography', 2 => 'Videography', 3 => 'Photography and Videography'], null, ['class'=>'form-control','placeholder' => 'Please select ...'])}}
                        
                        </div>

                        <div class="form-group">
                        {{Form::label('CheckInDate', 'Booking Date') }}
                        {{ Form::date('CheckInDate', new \DateTime(), ['class' => 'form-control']) }}
                       
                        </div>

                        <div class="form-group">
                        {{Form::label('StartTime', 'Start Time') }}
                        {{ Form::time('StartTime', \Carbon\Carbon::now(),['class'=>'form-control']) }}
                       
                        </div>
                        <div class="form-group">
                        {{Form::label('EndTime', 'End Time') }}
                        {{ Form::time('EndTime', \Carbon\Carbon::now(),['class'=>'form-control']) }}
                        </div>

                        <div hidden class="form-group">
                        {{Form::label('CurrentTime', 'Current Time') }}
                        {{ Form::time('CurrentTime', \Carbon\Carbon::now(),  ['class'=>'form-control']) }}
                        </div>

                         <div class="form-group">
                        {{Form::label('EventName', 'Event Name') }}
                        {{Form::text('EventName', '',['class'=>'form-control','placeholder'=>'Event Name'])}}
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
                        
                     
                        </br>
                        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                        </div>
                        {!! Form::close() !!}

             </div>
        </div>
    </div>
@endsection


