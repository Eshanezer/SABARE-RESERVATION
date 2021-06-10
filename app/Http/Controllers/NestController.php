<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nest;
use App\Models\nestbooking;

class NestController extends Controller
{
    public function getnest(){


        
        
        $nest = nest::all();

        return view('nest')->with('nest',$nest);
    }


    public function submit(Request $request){

        $this->validate($request,[
            'CheckInDate'=>'required',
            'CheckOutDate'=>'required',
            'NoOfAdults'=>'required',
            'NoOfChildren'=>'required',
            'Description'=>'required',
        ]);
        
        ;
        $nestbooking = new nestbooking;
        $nestbooking-> CheckInDate = $request->input('CheckInDate');
        $nestbooking-> CheckOutDate = $request->input('CheckOutDate');
        $nestbooking-> NoOfAdults = $request->input('NoOfAdults');
        $nestbooking-> NoOfChildren = $request->input('NoOfChildren');
        $nestbooking-> Description = $request->input('Description');
        $nestbooking-> Date = '2021-06-01';
        $nestbooking-> GuestId = '1';
        $nestbooking-> 	NestId = '1';
        $nestbooking-> UserId = '1';
       // $user = Auth::user();
        //$id = Auth::id();
       // $agrsbooking-> GuestId = \Auth::user()->id;
        //$agrsbooking-> GuestId = $request->input($id);
       // $agrsbooking-> AgriFarmStayId = $request->input('AgriFarmStayId', '1');
       // $agrsbooking-> Date = $request->input('Date', '2021-06-01');

        $nestbooking->save();

        return redirect('/')->with('success','Successfuly Booked!');
    }

}
