<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\holidayresort;
use App\Models\hrbooking;
use Auth;
class HrController extends Controller
{
    public function gethr(){


        
        
        $hr = holidayresort::all();

        return view('hr')->with('hr',$hr);
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
        $hrbooking = new hrbooking;
        $hrbooking-> CheckInDate = $request->input('CheckInDate');
        $hrbooking-> CheckOutDate = $request->input('CheckOutDate');
        $hrbooking-> NoOfAdults = $request->input('NoOfAdults');
        $hrbooking-> NoOfChildren = $request->input('NoOfChildren');
        $hrbooking-> Description = $request->input('Description');
        $hrbooking-> Date = '2021-06-08';
        $hrbooking-> GuestId = Auth::user()->id;
        $hrbooking-> HolodayResortId = '1';
        //$hrbooking-> UserId = '1';
     

        $hrbooking->save();

        return redirect('/')->with('success','Successfuly Booked!');
    }
}
