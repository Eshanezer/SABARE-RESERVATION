<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\audiovisualunit;
use App\Models\avubooking;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestRecommendMail;
use DB;
use Carbon\Carbon;

//to hanlde audio visual unit details
class AVUController extends Controller
{
    public function getavu(){
       
        
        $avu = audiovisualunit::all();

        return view('avu')->with('avu',$avu);
    }


  


    public function dropDownShow()
{
  
        //$Users = User::all();
        $Users = User::where('roleNo','>=', 7)->get();
        $select = [];
        foreach($Users as $User){
            $select[$User->id] = $User->name;
        }
        return view('avu', compact('select'));
       // return view('avu')->with('select', $select);
}



    public function submit(Request $request){

        

        $this->validate($request,[
            'EventName'=>'required',
            'CheckInDate'=>'required|date|after:yesterday',
            'StartTime'=>'required|after:CurrentTime',
            'EndTime'=>'required|after:StartTime',
            'Description'=>'required',
        ],
        [
            'EventName.required' => 'Please Fill the Event Name',
            'CheckInDate.required' => 'Please Enter a Valid Date',
            'StartTime.required' => 'Please Enter a Valid Start Time',
        ]);
        
        ;
        $avubooking = new avubooking;
        $avubooking-> EventName = $request->input('EventName');
        $avubooking-> CheckInDate = $request->input('CheckInDate');
        $avubooking-> StartTime = $request->input('StartTime');
        $avubooking-> EndTime = $request->input('EndTime');
        $avubooking-> Description = $request->input('Description');
        $avubooking-> Status = 'Send to Recommendation';
        $avubooking-> Recommendation_from = $request->input('Recommendation_from');
        $avubooking-> GuestId = Auth::user()->id;
        $avubooking-> GuestName = Auth::user()->name;
        $avubooking-> AVUId = $request->input('AVUId');
        //$avubooking-> AVUId = $request->input('AVUId');
        //$avubooking-> UserId = '1';

        $data = array(
            'id'      =>  Auth::user()->id,
            'name'      =>  Auth::user()->name,
            'CheckInDate'=>$request->input('CheckInDate'),
            'StartTime'=>$request->input('StartTime'),
            'EndTime'=>$request->input('EndTime'),
            'EventName'=>$request->input('EventName'),
            'Description'=>$request->input('Description')
        );

        $Recommendation_From = $request->input('Recommendation_from');
        $email = DB::select('select email from users where id = ?', [$Recommendation_From]);
        //$email = 'pmakwije@gmail.com';

        //$CheckInDate = avubooking::where(['CheckInDate' => $request->input('CheckInDate'), 'Status' => 'Conformed'])->get();
       $CheckInDate = avubooking::where('CheckInDate', '=', $request->input('CheckInDate'))->first();
        
        if ($CheckInDate === null) {
        
            
                $avubooking->save();
                Mail::to($email)->send(new RequestRecommendMail($data));
                return back()->with('success', 'Request Sent Successfuly!');

                //return redirect('/')->with('success','Request Sent Successfuly !');
            
        }else{
            $CheckInDate = avubooking::whereTime('StartTime', '<', $request->input('StartTime'))->whereTime('EndTime', '>', $request->input('StartTime'))->where('CheckInDate', '=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
            $CheckInDate2 = avubooking::whereTime('StartTime', '>', $request->input('StartTime'))->whereTime('StartTime', '<', $request->input('EndTime'))->where('CheckInDate', '=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
           
            if(count($CheckInDate) > 0 || count($CheckInDate2) > 0){
               // dd("already booked");
                return redirect('/')->with('success','Sorry Allready Booked!');
            }else{
               // dd("available");
                $avubooking->save();
                Mail::to($email)->send(new RequestRecommendMail($data));
                return back()->with('success', 'Request Sent Successfuly!');
            }
        }
        
            return redirect('/')->with('success','Sorry Allready Booked!');
        
    }
}