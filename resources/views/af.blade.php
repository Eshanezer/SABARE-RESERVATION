@extends('layouts.app')


@section('content')
<h1>Agri Farm</h1>

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
         @if(count($af)>0)
    @foreach($af as $af)
         <tr>
            <td>{{ $af->Type }}</td>
            <td>{{ $af->NoOfUnits }}</td>
            <td>{{ $af->NoOfAdults }}</td>
            <td>{{ $af->NoOfChildren }}</td>
         </tr>
         @endforeach
         @endif
         </tbody>
      </table>

      <div class="card p-3 mb-2 bg-secondary text-white">
            <h5 class="card-header">Booking</h5>
            <div class="card-body">
            <div class="mb-3">

                        {!! Form::open(['url' => 'af/submit']) !!}
                        <div class="form-group">
                        {{Form::label('CheckInDate', 'Check In Date') }}
                        {{Form::text('CheckInDate', '',['class'=>'form-control','placeholder'=>'Check In Date'])}}
                        </div>
                        <div class="form-group">
                        {{Form::label('CheckOutDate', 'Check Out Date') }}
                        {{Form::text('CheckOutDate', '',['class'=>'form-control','placeholder'=>'Check Out Date'])}}
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
                        {{Form::label('Description', 'Description') }}
                        {{Form::textarea('Description', '',['class'=>'form-control','placeholder'=>'Description'])}}
                        </div>
                        <div class="form-group">
                        
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                        VC Approval
                        </label>
                        </div>
                        </br>
                        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                        </div>
                        {!! Form::close() !!}

             </div>
        </div>
    </div>
@endsection


