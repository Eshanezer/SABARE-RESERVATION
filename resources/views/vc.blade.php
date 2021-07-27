@extends('layouts.app')


@section('content')
<div class="card p-3 mb-2 bg-secondary text-white">
<h5 class="card-header">VC Page</h5>
<div class="card-body">
<a class="nav-link btn btn-info" href="/viewvcagribooking">View Agri Farm Booking Details</a></br>
<a class="nav-link btn btn-info" href="/viewvcagridbooking">View Agri Farm Dinning Room Booking Details</a></br>
<a class="nav-link btn btn-info" href="/viewvcnestbooking">View NEST Booking Details</a></br>
<a class="nav-link btn btn-info" href="/viewvchrbooking">View Holiday Resort Booking Details</a></br>
<!-- <a class="nav-link btn btn-info" href="/viewavubooking">View Audio Visual Unit Booking Details</a> -->

<!-- <button type="button" class="nav-link" href="/viewagribooking'"> View Agri Farm Booking Details </button> -->
<!-- <button type="button" href="{{ route('viewnestbooking') }}"> View NEST Booking Details </button>
<button type="button" href="{{ route('viewhrbooking') }}"> View Holiday Resort Booking Details </button>
<button type="button" href="{{ route('viewavubooking') }}"> View Audio Visual Unit Booking Details </button> -->
 </div>
</div>



@endsection