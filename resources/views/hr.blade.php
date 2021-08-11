@extends('layouts.app')


@section('content')
<h1>Holiday Resort</h1>
<!-- Holiday Resort booking page -->
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

<div class="card p-3 mb-2 bg-secondary text-white" id="holiday_resort_booking">
            <h5 class="card-header">Booking</h5>
            <div class="card-body">
            <div class="mb-3">

                        {!! Form::open(['url' => 'hr/submit', 'id' => 'booking_form']) !!}

                          <div class="form-group">
                        {{Form::label('BookingType', 'Booking for ') }}
                        {{Form::select('BookingType', ['Resource Person' => 'Resource Person', 'SUSL Staff' => 'SUSL Staff','Local Visitor' => 'Local Visitor', ' Foreigners' => 'Foreigners'], null, ['class'=>'form-control','v-model' => 'booking_type'])}}
                            
                        </div>

                         <div class="form-group ">
                            {!! Form::label('Room Type')!!}
                            {!! Form::select('HolodayResortId', $hrfill, null, ['class'=>'form-control', 'v-model' => 'room_type']) !!}
                    
                        </div>

                        <div class="form-group">
                        {{Form::label('NoOfUnits', 'Number Of Units') }}
                        {{Form::text('NoOfUnits', '',['class'=>'form-control','placeholder'=>'Number Of Units', 'v-model' => 'no_of_units', 'v-on:change'=>'checkUnitsCount'])}} 
                        </div>
                      
                        <div class="form-group">
                        {{Form::label('NoOfAdults', 'Number Of Adults') }}
                        {{Form::text('NoOfAdults', '',['class'=>'form-control','placeholder'=>'Number Of Adults', 'v-model' => 'no_of_adults'])}}
                        </div>
                        <div class="form-group">
                        {{Form::label('NoOfChildren', 'Number Of Children') }}
                        {{Form::text('NoOfChildren', '',['class'=>'form-control','placeholder'=>'Number Of Children', 'v-model' => 'no_of_children'])}}
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
                        {{Form::label('Description', 'Description') }}
                        {{Form::textarea('Description', '',['class'=>'form-control','placeholder'=>'Description'])}}
                        </div>

                        <div class="form-group" v-if="booking_type === `Resource Person` || booking_type === `SUSL Staff`">
                        {!! Form::label('Request Recommendation from')!!}
                        {!! Form::select('Recommendation_from', $select, null, ['class'=>'form-control', 'placeholder' => 'Please select ...']) !!}
                        </div>

                        <div class="form-group" v-if="booking_type === `Resource Person` || booking_type === `SUSL Staff`">
                        {{Form::label('VCApproval', 'Request VC Approval') }}
                        {{Form::select('VCApproval', [1 => 'Yes', 0 => 'No'], null, ['placeholder' => 'Please select ...','class'=>'form-control'])}}
                        
                        </div>

                        </br>
                        {{Form::button('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
                        </div>
                        {!! Form::close() !!}

             </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js"></script>

    <script>
        const holiday_resort = new Vue({
            el: '#holiday_resort_booking',
            data() {
                return {
                    booking_type:null,
                    room_type:null,
                    no_of_units:0,
                    no_of_adults:0,
                    no_of_children:0               
                }
            },

            methods:{

                checkUnitsCount(){
            
                    if(this.room_type == 1 &&  this.no_of_units > 3){
                        this.no_of_units = 0;
                        alert('Sorry, You can not book more than 3 units.')
                    }
                    if(this.room_type == 2 &&  this.no_of_units > 12){
                        this.no_of_units = 0;
                        alert('Sorry, You can not book more than 12 units.')
                    }
                   
                },

                formSubmit(){
                    if(this.room_type == 1){
                        if(this.no_of_adults > 2*this.no_of_units || this.no_of_children > 2*this.no_of_units){
                            alert("Sorry, the maximum number of people that can be accommodated has been exceeded.");
                        }else{
                            $("#booking_form").submit();
                        }
                    }else if(this.room_type == 2){
                        if(this.no_of_adults > 1*this.no_of_units || this.no_of_children > 0){
                            alert("Sorry, the maximum number of people that can be accommodated has been exceeded.");
                        }else{
                            $("#booking_form").submit();
                        }
                    }

                    
                }
            }
        });

    </script>    
      
@endsection

<!-- @section('sidebar')
@parent
<p>This is appended to the sidebar</p>
@endsection -->