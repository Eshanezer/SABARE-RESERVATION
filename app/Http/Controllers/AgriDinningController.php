<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\agrifarmdining;
use App\Models\agridbooking;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestRecommendMail;
use DB;

class AgriDinningController extends Controller
{
    public function getdinning(){
       
        
        $afd = agrifarmdining::all();

        return view('afd')->with('afd',$afd);
    }


  


    public function dropDownShow()
{
  
        //$Users = User::all();
        $Users = User::where('roleNo','>=', 7)->get();
        $select = [];
        foreach($Users as $User){
            $select[$User->id] = $User->name;
        }
        return view('afd', compact('select'));
      
}



    public function submit(Request $request){

        $this->validate($request,[
            'NoOfGuest'=>'required',
            'CheckInDate'=>'required',
            'StartTime'=>'required',
            'EndTime'=>'required',
            'Description'=>'required',
        ]);
        
        ;

        							
        $agridbooking = new agridbooking;
        $agridbooking-> CheckInDate = $request->input('CheckInDate');
        $agridbooking-> StartTime = $request->input('StartTime');
        $agridbooking-> EndTime = $request->input('EndTime');
        $agridbooking-> NoOfGuest = $request->input('NoOfGuest');
        $agridbooking-> Description = $request->input('Description');
        $agridbooking-> Status = 'Send to Recommendation';
        $agridbooking-> Recommendation_from = $request->input('Recommendation_from');
        $agridbooking-> IS_Recommended = '0';
        $agridbooking-> GuestId = Auth::user()->id;
        $agridbooking-> GuestName = Auth::user()->id;
        $agridbooking-> AgriFarmDiningId = '1';
        $agridbooking-> VCApproval = $request->input('VCApproval');
        $agridbooking-> IS_Recommended = '0';
        $agridbooking-> IS_Vc_Approved = '0';
        $agridbooking-> BookingType = 'SUSL Staff';

        $data = array(
            'id'      =>  Auth::user()->id,
            'name'      =>  Auth::user()->name,
            'CheckInDate'=>$request->input('CheckInDate'),
            'StartTime'=>$request->input('StartTime'),
            'EndTime'=>$request->input('EndTime'),
            'NoOfGuest'=>$request->input('NoOfGuest'),
            'Description'=>$request->input('Description')
        );

        $Recommendation_From = $request->input('Recommendation_from');
        $email = DB::select('select email from users where id = ?', [$Recommendation_From]);
        //$email = 'pmakwije@gmail.com';

        //$CheckInDate = avubooking::where(['CheckInDate' => $request->input('CheckInDate'), 'Status' => 'Conformed'])->get();
       $CheckInDate = agridbooking::where('CheckInDate', '=', $request->input('CheckInDate'))->first();
        
        if ($CheckInDate === null) {
        
            
                $agridbooking->save();
                Mail::to($email)->send(new RequestRecommendMail($data));
                return back()->with('success', 'Request Sent Successfuly!');

                //return redirect('/')->with('success','Request Sent Successfuly !');
            
        }
        
        
            return redirect('/')->with('success','Sorry Allready Booked!');
        
    }
}
