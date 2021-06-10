<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\holidayresort;
use App\Models\hrbooking;
use Illuminate\Support\Facades\Auth;
class HrController extends Controller
{
    public function gethr(){


        
        
        $hr = holidayresort::all();

        return view('hr')->with('hr',$hr);
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
        $hrbooking-> GuestId = '1';
        $hrbooking-> HolodayResortId = '1';
        $hrbooking-> UserId = '1';
     

        $hrbooking->save();

        return redirect('/')->with('success','Successfuly Booked!');
    }
}
