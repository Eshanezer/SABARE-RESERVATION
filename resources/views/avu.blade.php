@extends('layouts.app')


@section('content')
<h1>Audio Visual Unit</h1>

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
                        {{Form::label('CheckInDate', 'Check In Date') }}
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
                        {{Form::label('EventName', 'Event Name') }}
                        {{Form::select('EventName', ['Photography' => 'Photography', 'Videography' => 'Videography', 'Photography and Videography' => 'Photography and Videography'], null, ['placeholder' => 'Please select a value'])}}
                        
                        </div>
                        <div class="form-group">
                        {{Form::label('Description', 'Description') }}
                        {{Form::textarea('Description', '',['class'=>'form-control','placeholder'=>'Description'])}}
                        </div>
                        <div class="form-group">
                        
                        <div class="form-check">
                        {{Form::label('RecommendedBy','Recommended By') }}
                        {{Form::select('RecommendedBy', ['1' => 'Dean', '2' => 'HOD', '3' => 'Director'], null, ['placeholder' => 'Please select a value '])}}
                        
                        </div>
                        </br>
                        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                        </div>
                        {!! Form::close() !!}

             </div>
        </div>
    </div>
@endsection


