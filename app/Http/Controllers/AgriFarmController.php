<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\agrifarmstay;
use App\Models\agrsbooking;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;
use Auth;
use App\Mail\RequestRecommendMail;
use DB;



// to handle agri farm booking details
class AgriFarmController extends Controller
{
    public function getagrifarm(){


        $Users = User::where('roleNo','>=', 7)->get();
        $select = [];
        foreach($Users as $User){
            $select[$User->id] = $User->name;
        }

        

        $af = agrifarmstay::all();

        return view('af', compact('select','af'));
        
    }





    public function submit(Request $request){

        $this->validate($request,[
            'BookingType' =>'required',
            'CheckInDate'=>'required|date|after:yesterday',
            'CheckOutDate'=>'required|date|after:CheckInDate',
            'NoOfAdults'=>'required|numeric|min:1',
            'NoOfChildren'=>'required|numeric|min:0',
            'NoOfUnits'=>'required|numeric|min:1',
            'Description'=>'required',   
            'VCApproval'=>"required_if:BookingType,==,Resource Person,SUSL Staff",
            'Recommendation_from'=>"required_if:BookingType,==,Resource Person,SUSL Staff",
            
        ]);
        
        
            $CheckInDate = agrsbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
            $CheckInDate2 = agrsbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('Status', 'Confirmed')->get();
            //dd($CheckInDate,$CheckInDate2);
            $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');
            
            if( $check_cndition1 > 3 || $check_cndition2 > 3 || $check_cndition3 > 3){
             //  dd("already booked");
                // return redirect('/')->with('danger','Sorry Allready Booked!');
                 return back()->with('success','Sorry Allready Booked!');
             }else{
              //dd("available");
                
              $agrsbooking = new agrsbooking;
              $agrsbooking-> BookingType = $request->input('BookingType');
              $agrsbooking-> CheckInDate = $request->input('CheckInDate');
              $agrsbooking-> CheckOutDate = $request->input('CheckOutDate');
              $agrsbooking-> NoOfAdults = $request->input('NoOfAdults');
              $agrsbooking-> NoOfChildren = $request->input('NoOfChildren');
              $agrsbooking-> NoOfUnits = $request->input('NoOfUnits');
              $agrsbooking-> Description = $request->input('Description');
              
              if($request->input('BookingType') == "Resource Person" || $request->input('BookingType') == "SUSL Staff"){
                $agrsbooking-> Recommendation_from = $request->input('Recommendation_from');
                $agrsbooking-> VCApproval = $request->input('VCApproval');
                $agrsbooking-> Status = 'Send to Recommendation';
              }
              else{
                $agrsbooking-> Recommendation_from = 13;
                $agrsbooking-> VCApproval = 0;
                $agrsbooking-> Status = 'Send to confermation';
              }
              
              $agrsbooking-> GuestId = Auth::user()->id;
              $agrsbooking-> GuestName = Auth::user()->name;
              $agrsbooking-> AgriFarmStayId = 1;
              $agrsbooking->save();
  
              $data = array(
                  'id'      =>  Auth::user()->id,
                  'name'      =>  Auth::user()->name,
                  'CheckInDate'=>$request->input('CheckInDate'),
                  'CheckOutDate'=>$request->input('CheckOutDate'),
                  'NoOfUnits'=>$request->input('NoOfUnits'),
                  'Description'=>$request->input('Description')
              );
      

              $Recommendation_From = $request->input('Recommendation_from');
              $email = DB::select('select email from users where id = ?', [$Recommendation_From]);

                    
                    Mail::to($email)->send(new RequestRecommendMail($data));
                    return back()->with('success', 'Request Sent Successfuly!');
             }
      
          
           
            
            
                return redirect('/')->with('success','Sorry Allready Booked!');
            
        }
    }