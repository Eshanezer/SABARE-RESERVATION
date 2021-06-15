<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nest;
use App\Models\nestbooking;
use Auth;

class NestController extends Controller
{
    public function getnest(){


        
        
        $nest = nest::all();

        return view('nest')->with('nest',$nest);
    }

    function send(Request $request)
    {
     $this->validate($request, [
      
     ]);

     $data = array(
        'id'      =>  Auth::user()->id,
        'name'      =>  Auth::user()->name,
     
    );

            Mail::to('ashansawijeratne@gmail.com')->send(new SendMail($data));
            return back()->with('success', 'Successfuly sent!');

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
        $nestbooking-> GuestId = Auth::user()->id;
        $nestbooking-> 	NestId = '1';
       

        $nestbooking->save();

        return redirect('/')->with('success','Successfuly Booked!');
    }

}
