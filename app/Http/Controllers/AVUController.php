<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\audiovisualunit;
use App\Models\avubooking;
use Illuminate\Support\Facades\Auth;

class AVUController extends Controller
{
    public function getavu(){
       
        
        $avu = audiovisualunit::all();

        return view('avu')->with('avu',$avu);
    }


    public function submit(Request $request){

        $this->validate($request,[
            'EventName'=>'required',
            'CheckInDate'=>'required',
            'StartTime'=>'required',
            'EndTime'=>'required',
            'Description'=>'required',
        ]);
        
        ;
        $avubooking = new avubooking;
        $avubooking-> EventName = $request->input('EventName');
        $avubooking-> CheckInDate = $request->input('CheckInDate');
        $avubooking-> StartTime = $request->input('StartTime');
        $avubooking-> EndTime = $request->input('EndTime');
        $avubooking-> Description = $request->input('Description');
        $avubooking-> RecommendedBy = $request->input('RecommendedBy');
        $avubooking-> Date = '2021-06-01';
        $avubooking-> GuestId = '1';
        $avubooking-> AVUId = '1';
        $avubooking-> UserId = '1';

        $avubooking->save();

        return redirect('/')->with('success','Successfuly Booked!');
    }
}