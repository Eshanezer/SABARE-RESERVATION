@extends('layouts.app')


@section('content')
<h1>Holiday Resort</h1>

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
         @if(count($hr)>0)
    @foreach($hr as $hr)
         <tr>
            <td>{{ $hr->Type }}</td>
            <td>{{ $hr->NoOfUnits }}</td>
            <td>{{ $hr->NoOfAdults }}</td>
            <td>{{ $hr->NoOfChildren }}</td>
         </tr>
         @endforeach
         @endif
         </tbody>
      </table>

            <div class="card p-3 mb-2 bg-secondary text-white">
            <h5 class="card-header">Booking</h5>
            <div class="card-body">
            <div class="mb-3">

           <label for="exampleFormControlInput1" class="form-label">Check In Date</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Check In Date">
            <label for="exampleFormControlInput1" class="form-label">Check Out Date</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Check Out Date">
            <label for="exampleFormControlInput1" class="form-label">Number of Adults</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Number of Adults">

            <label for="exampleFormControlInput1" class="form-label">Number of Children</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Number of Children">

            <label for="exampleFormControlInput1" class="form-label">Description</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Description">
            </div>

            <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
            VC Approval
            </label>
            </div>
            <div class="mb-3">
            <a href="#" class="btn btn-primary">Book</a>
            </div>
            </div>
            </div>





      
@endsection

@section('sidebar')
@parent
<p>This is appended to the sidebar</p>
@endsection