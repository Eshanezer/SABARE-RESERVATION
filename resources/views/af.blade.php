@extends('layouts.app')


@section('content')
<h1>Kabanas</h1>
<!-- Agri Farm booking page -->
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

      <div class="card p-3 mb-2 bg-secondary text-white" id="af_booking">
            <h5 class="card-header">Booking</h5>
            <div class="card-body">
            <div class="mb-3">

                        {!! Form::open(['url' => 'af/submit', 'id' => 'booking_form']) !!}

                    
                    <div class="form-group">
                    {{Form::label('BookingType', 'Booking for ') }}
                    {{Form::select('BookingType', ['Resource Person' => 'Resource Person', 'SUSL Staff' => 'SUSL Staff','Local Visitor' => 'Local Visitor', ' Foreigners' => 'Foreigners'], null, ['v-model' => 'booking_type','class'=>'form-control'])}}

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
                    {{Form::label('Description', 'Description') }}
                    {{Form::textarea('Description', '',['class'=>'form-control','placeholder'=>'Description'])}}
                    </div>
                    <div class="form-group">

 
                    <div class="form-group" v-if="booking_type === `Resource Person` || booking_type === `SUSL Staff`">
                    {!! Form::label('Request Recommendation from')!!}
                    {!! Form::select('Recommendation_from', $select, null, ['class'=>'form-control', 'placeholder' => 'Please select ...']) !!}
                    </div>

                    <div class="form-group" v-if="booking_type === `Resource Person` || booking_type === `SUSL Staff`">
                    {{Form::label('VCApproval', 'Request VC Approval') }}
                    {{Form::select('VCApproval', [1 => 'Yes', 0 => 'No'], null, ['placeholder' => 'Please select ...'])}}

                    </div>
                               

                  

                    </br>
                    {{Form::submit('Submit', ['class'=>'btn btn-primary', 'v-on:click'=>'formSubmit'])}}
                    </div>
                    {!! Form::close() !!}

             </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js"></script>

    <script>
        const holiday_resort = new Vue({
            el: '#af_booking',
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
            
                    if(  this.no_of_units > 3){
                        this.no_of_units = 0;
                        alert('Sorry, You can not book more than 3 units.')
                    }
                  
                   
                },

                formSubmit(){
                    
                        if(this.no_of_adults > 2*this.no_of_units || this.no_of_children > 2*this.no_of_units){
                            alert("Sorry, the maximum number of people that can be accommodated has been exceeded.  Please check the number of units and number of guests");
                        }else{
                            $("#booking_form").submit();
                        }
                   

                    
                }
            }
        });

    </script>    
      
@endsection


