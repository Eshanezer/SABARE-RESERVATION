<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\agrifarmstay;
use App\Models\agrsbooking;
use Illuminate\Support\Facades\Auth;

class AgriFarmController extends Controller
{
    public function getagrifarm(){


        $agrifarm = agrifarmstay::all();

        return view('af')->with('af',$agrifarm);
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
        $agrsbooking = new agrsbooking;
        $agrsbooking-> CheckInDate = $request->input('CheckInDate');
        $agrsbooking-> CheckOutDate = $request->input('CheckOutDate');
        $agrsbooking-> NoOfAdults = $request->input('NoOfAdults');
        $agrsbooking-> NoOfChildren = $request->input('NoOfChildren');
        $agrsbooking-> Description = $request->input('Description');
        $agrsbooking-> Date = '2021-06-01';
        $agrsbooking-> GuestId = '1';
        $agrsbooking-> AgriFarmStayId = '1';
        $agrsbooking-> UserId = '1';
       // $user = Auth::user();
        //$id = Auth::id();
       // $agrsbooking-> GuestId = \Auth::user()->id;
        //$agrsbooking-> GuestId = $request->input($id);
       // $agrsbooking-> AgriFarmStayId = $request->input('AgriFarmStayId', '1');
       // $agrsbooking-> Date = $request->input('Date', '2021-06-01');

        $agrsbooking->save();

        return redirect('/')->with('success','Successfuly Booked!');
    }


  
}
