<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nest;
use App\Models\nestbooking;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestRecommendMail;
use DB;

class NestController extends Controller
{
    public function getnest(){
 
        $nest = nest::all();
        $nestdetail = DB::select('select * from nests');
        $nestfill = [];
        foreach($nestdetail as $n){
            $nestfill[$n->NestId] = $n->Type;
        }
        $Users = User::where('roleNo','>=', 7)->get();
        $select = [];
        foreach($Users as $User){
            $select[$User->id] = $User->name;
        }
        
        return view('nest', compact('select','nestfill','nest'));

        //return view('nest')->with('nest',$nest);
    }

  




    public function submit(Request $request){

        

        $this->validate($request,[
            'CheckInDate'=>'required',
            'CheckOutDate'=>'required',
            'NoOfAdults'=>'required',
            'NoOfUnits'=>'required',
            'NoOfChildren'=>'required',
            'Description'=>'required',
            'VCApproval'=>'required',
            'BookingType'=>'required',
            
        ]);
        
        ;

       

        $nestbooking = new nestbooking;
        $nestbooking-> CheckInDate = $request->input('CheckInDate');
        $nestbooking-> CheckOutDate = $request->input('CheckOutDate');
        $nestbooking-> NoOfAdults = $request->input('NoOfAdults');
        $nestbooking-> NoOfChildren = $request->input('NoOfChildren');
        $nestbooking-> NoOfUnits = $request->input('NoOfUnits');
        $nestbooking-> Description = $request->input('Description');
        $nestbooking-> BookingType = $request->input('BookingType');
        $nestbooking-> Status = 'Send to Recommendation';
        $nestbooking-> Recommendation_from = $request->input('Recommendation_from');
        $nestbooking-> VCApproval = $request->input('VCApproval');
        $nestbooking-> IS_Recommended = '0';
        $nestbooking-> IS_Vc_Approved = '0';
        $nestbooking-> GuestId = Auth::user()->id;
        $nestbooking-> GuestName = Auth::user()->id;
        $nestbooking-> NestId = $request->input('NestId');


        $data = array(
            'id'      =>  Auth::user()->id,
            'name'      =>  Auth::user()->name,
            'CheckInDate'=>$request->input('CheckInDate'),
            'CheckOutDate'=>$request->input('CheckOutDate'),
            'NoOfAdults'=>$request->input('NoOfAdults'),
            'NoOfChildren'=>$request->input('NoOfChildren'),
            'NoOfUnits'=>$request->input('NoOfUnits'),
            'Description'=>$request->input('Description'),
            'BookingType'=>$request->input('BookingType'),
            'NestId'=>$request->input('NestId'),
            
        );

        $Recommendation_From = $request->input('Recommendation_from');
        $email = DB::select('select email from users where id = ?', [$Recommendation_From]);
       

        $nestbooking->save();
        Mail::to($email)->send(new RequestRecommendMail($data));
        return back()->with('success', 'Request Sent Successfuly!');

        //return redirect('/')->with('success','Successfuly Booked!');
    }

}
