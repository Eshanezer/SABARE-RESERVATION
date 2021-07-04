<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\agrifarmstay;
use App\Models\agrsbooking;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Auth;

class AgriFarmController extends Controller
{
    public function getagrifarm(){


        $agrifarm = agrifarmstay::all();

        return view('af')->with('af',$agrifarm);
    }



    function send(Request $request)
    {
     $this->validate($request, [
        // 'CheckInDate'=>'required',
        // 'CheckOutDate'=>'required',
        // 'NoOfAdults'=>'required',
        // 'NoOfChildren'=>'required',
        // 'Description'=>'required',
     ]);

     $data = array(
        'id'      =>  Auth::user()->id,
        'name'      =>  Auth::user()->name,
        // 'CheckInDate'=>$request->CheckInDate,
        // 'CheckOutDate'=>$request->CheckOutDate,
        // 'NoOfAdults'=>$request->NoOfAdults,
        // 'NoOfChildren'=>$request->NoOfChildren,
        // 'Description'=>$request->Description
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
        $agrsbooking = new agrsbooking;
        $agrsbooking-> CheckInDate = $request->input('CheckInDate');
        $agrsbooking-> CheckOutDate = $request->input('CheckOutDate');
        $agrsbooking-> NoOfAdults = $request->input('NoOfAdults');
        $agrsbooking-> NoOfChildren = $request->input('NoOfChildren');
        $agrsbooking-> Description = $request->input('Description');
        //$agrsbooking-> Date = '2021-06-01';
        $agrsbooking-> GuestId = Auth::user()->id;
        $agrsbooking-> AgriFarmStayId = '1';

        $agrsbooking->save();

        return redirect('/')->with('success','Successfuly Booked!');
    }


  
}
