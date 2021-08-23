<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\agrifarmdining;
use App\Models\agridbooking;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\agriemail;
use DB;
use Session;
use Illuminate\Support\Facades\Input;

//to handle Agri dinning booking details 
class AgriDinningController extends Controller
{


    public function getdinning(){
       
        $sessionData = [];

        // Check the availability session exist or not
        if(Session::has('CheckAvailabilityRequest')){
            $sessionData = (object)Session::get('CheckAvailabilityRequest');
            //dd(Session::all());
            if($sessionData->property !== "Agri Farm Dining Room"){
                Session::forget('CheckAvailabilityRequest');
                $sessionData=NULL;
            }
        }

        $afd = agrifarmdining::all();

        $afddetail = DB::select('select * from agrifarmstays');
        $afdfill = [];
        foreach($afddetail as $n){
            $afdfill[$n->AgriFarmStayId] = $n->Type;
        }
        $Users = User::where('roleNo','>=', 11)->get();
        $select = [];
        foreach($Users as $User){
            $select[$User->id] = $User->name;
        }

       // return view('afd')->with('afd',$afd);
        return view('afd', compact('select','afdfill','afd','sessionData'));
    }


  


//     public function dropDownShow()
// {
  
//         //$Users = User::all();
//         $Users = User::where('roleNo','>=', 11)->get();
//         $select = [];
//         foreach($Users as $User){
//             $select[$User->id] = $User->name;
//         }
//         return view('afd', compact('select'));
      
// }



    public function submit(Request $request){

        $this->validate($request,[
            'NoOfGuest'=>'required|numeric|min:1',
            'CheckInDate'=>'required|date|after:yesterday',
            'StartTime'=>'required|after:CurrentTime',
            'EndTime'=>'required|after:StartTime',
            'Description'=>'required',
            
        ],
        [
            'NoOfGuest.required' => 'Please Add the Number of Guests',
            'CheckInDate.after' => 'Please Enter a Valid Date',
            'StartTime.after' => 'Please Enter a Valid Start Time',
            'EndTime.after' => 'Please Enter a Valid End Time',
            'Description.required' => 'Please Add a Description',
            
        ]);
        

        							
        $agridbooking = new agridbooking;
        $agridbooking-> CheckInDate = $request->input('CheckInDate');
        $agridbooking-> StartTime = $request->input('StartTime');
        $agridbooking-> EndTime = $request->input('EndTime');
        $agridbooking-> NoOfGuest = $request->input('NoOfGuest');
        $agridbooking-> Description = $request->input('Description');
        $agridbooking-> Status = 'Request for Booking';
        $agridbooking-> Recommendation_from = $request->input('Recommendation_from');
        $agridbooking-> GuestId = Auth::user()->id;
        $agridbooking-> GuestName = Auth::user()->name;
        $agridbooking-> AgriFarmDiningId = '1';
        // $agridbooking-> VCApproval = $request->input('VCApproval');
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

        // $Recommendation_From = $request->input('Recommendation_from');
         $email = DB::select('select email from users where id = 11');
        //$email = 'pmakwije@gmail.com';

        //$CheckInDate = avubooking::where(['CheckInDate' => $request->input('CheckInDate'), 'Status' => 'Conformed'])->get();
       $CheckInDate = agridbooking::where('CheckInDate', '=', $request->input('CheckInDate'))->first();
        
        if ($CheckInDate === null) {
        
            
                $agridbooking->save();
                Mail::to($email)->send(new agriemail($data));
                return back()->with('success', 'Request Sent Successfuly!');

                //return redirect('/')->with('success','Request Sent Successfuly !');
            
        }else{
            $CheckInDate = agridbooking::whereTime('StartTime', '<', $request->input('StartTime'))->whereTime('EndTime', '>', $request->input('StartTime'))->where('CheckInDate', '=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
            $CheckInDate2 = agridbooking::whereTime('StartTime', '>', $request->input('StartTime'))->whereTime('StartTime', '<', $request->input('EndTime'))->where('CheckInDate', '=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
           
            if(count($CheckInDate) > 0 || count($CheckInDate2) > 0){
               // dd("already booked");
                return redirect('/')->with('success','Sorry Allready Booked!');
            }else{
               // dd("available");
                $agridbooking->save();
                Mail::to($email)->send(new agriemail($data));
                return back()->with('success', 'Request Sent Successfuly!');
            }
        }
        
        
            return redirect('/')->with('success','Sorry Allready Booked!');
        
    }
}
