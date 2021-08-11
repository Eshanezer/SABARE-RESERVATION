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

//to hanlde nest booking details
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
            'CheckInDate'=>'required|date|after:yesterday',
            'CheckOutDate'=>'required|date|after:CheckInDate',
            'NoOfAdults'=>'required|numeric|min:1',
            'NoOfUnits'=>'required|numeric|min:1',
            'NoOfChildren'=>'required|numeric|min:0',
            'Description'=>'required',
            'VCApproval'=>'required',
            'BookingType'=>'required',
            'VCApproval'=>'required',
            'Recommendation_from'=>'required',
            
        ]);
        
        if($request->input('NestId') == 1){
            //Master bed room
            
            $CheckInDate = nestbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
            $CheckInDate2 = nestbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('Status', 'Confirmed')->get();
           // dd($CheckInDate,$CheckInDate2);
            
           $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
           $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
           $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');
           
           if( $check_cndition1 > 1 || $check_cndition2 > 1 || $check_cndition3 > 1){
              // dd("already booked");
                 return redirect('/')->with('success','Sorry Allready Booked!');
             }else{
              // dd("available");
                
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
              $nestbooking-> GuestId = Auth::user()->id;
              $nestbooking-> GuestName = Auth::user()->name;
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
             }
        }

       

        if($request->input('NestId') == 2){
            //Master bed room
            
            $CheckInDate = nestbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
            $CheckInDate2 = nestbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('Status', 'Confirmed')->get();
           // dd($CheckInDate,$CheckInDate2);
            
           $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
           $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
           $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');
           
           if( $check_cndition1 > 4 || $check_cndition2 > 4 || $check_cndition3 > 4){
              // dd("already booked");
                 return redirect('/')->with('success','Sorry Allready Booked!');
             }else{
              // dd("available");
                
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
              $nestbooking-> GuestId = Auth::user()->id;
              $nestbooking-> GuestName = Auth::user()->name;
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
             }
        }

        //return redirect('/')->with('success','Successfuly Booked!');
    }

}
