@extends('layouts.app')



@section('content')
<div class="card p-3 mb-2 bg-secondary text-white">
<h5 class="card-header">Check Availability</h5>
<div class="card-body">
<div class="mb-3">

<label for="exampleDataList" class="form-label">Place</label>
<input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
<datalist id="datalistOptions">
  <option value="Holiday Resort">
  <option value="NEST">
  <option value="Agri Farm">
  <option value="Agri Farm Dining Room">
  <option value="Audio Visual Unit">
</datalist>

  <label for="exampleFormControlInput1" class="form-label">Check-in Date</label>
  <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>

                  
                    <script type="text/javascript">

                    $('.date').datepicker({  

                    format: 'mm-dd-yyyy'

                    });  

                    </script>  

<label for="exampleFormControlInput1" class="form-label">Check-out Date</label>
  <div class='input-group date' id='datetimepicker2'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>

                     <script type="text/javascript">

                    $('.date').datepicker({  

                    format: 'mm-dd-yyyy'

                    });  

                    </script> 

                     <!-- <script type="text/javascript">
                $(function () {
                    $('#datetimepicker2').datepicker({
                        format: "mm/dd/yy",
                        weekStart: 0,
                        calendarWeeks: true,
                        autoclose: true,
                        todayHighlight: true, 
                        orientation: "auto"
                    });
                }); -->
            </script>
  <label for="exampleFormControlInput1" class="form-label">Number of Adults</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Number of Adults">

  <label for="exampleFormControlInput1" class="form-label">Number of Children</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Number of Children">
</div>
<div class="mb-3">
 <a href="#" class="btn btn-primary">Check</a>
 </div>
</div>
</div>
<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

@endsection

@section('sidebar')
@parent
<p>This is appended to the sidebar</p>
@endsection


