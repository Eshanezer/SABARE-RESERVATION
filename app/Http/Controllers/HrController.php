<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\holidayresort;
use App\Models\hrbooking;
use Auth;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestRecommendMail;
use DB;

//to handle holiday resort details
class HrController extends Controller
{
    public function gethr(){

        $hr = holidayresort::all();
        $hrdetail = DB::select('select * from holidayresorts');
        $hrfill = [];
        foreach($hrdetail as $n){
            $hrfill[$n->HolodayResortId] = $n->Type;
        }
        $Users = User::where('roleNo','>=', 7)->get();
        $select = [];
        foreach($Users as $User){
            $select[$User->id] = $User->name;
        }

        
        
        
        return view('hr', compact('select','hrfill','hr'));

        
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
            'HolodayResortId'=>'required',
        ]);

        //dd($request->input('HolodayResortId'));

        if($request->input('HolodayResortId') == 1){
            //Master bed room
            //$bookings1 = hrbooking::whereBetween('CheckInDate', [$request->input('CheckInDate'), $request->input('CheckOutDate')])->get();
            //$bookings2 = hrbooking::whereBetween('CheckOutDate', [$request->input('CheckInDate'), $request->input('CheckOutDate')])->get();

            $CheckInDate = hrbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
            $CheckInDate2 = hrbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('Status', 'Confirmed')->get();
            //dd($CheckInDate->sum('NoOfUnits'),$CheckInDate2);

            $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');
            
            if( $check_cndition1 > 3 || $check_cndition2 > 3 || $check_cndition3 > 3){
             //  dd("already booked");
                // return redirect('/')->with('danger','Sorry Allready Booked!');
                 return back()->with('success','Sorry Allready Booked!');
             }else{
              // dd("available");
                
                    $hrbooking = new hrbooking;
                    $hrbooking-> BookingType = $request->input('BookingType');
                    $hrbooking-> CheckInDate = $request->input('CheckInDate');
                    $hrbooking-> CheckOutDate = $request->input('CheckOutDate');
                    $hrbooking-> NoOfAdults = $request->input('NoOfAdults');
                    $hrbooking-> NoOfChildren = $request->input('NoOfChildren');
                    $hrbooking-> NoOfUnits = $request->input('NoOfUnits');
                    $hrbooking-> Description = $request->input('Description');
                    
                    if($request->input('BookingType') == "Resource Person" || $request->input('BookingType') == "SUSL Staff"){
                        $hrbooking-> Recommendation_from = $request->input('Recommendation_from');
                        $hrbooking-> VCApproval = $request->input('VCApproval');
                        $hrbooking-> Status = 'Send to Recommendation';
                      }
                      else{
                        $hrbooking-> Recommendation_from = 13;
                        $hrbooking-> VCApproval = 0;
                        $hrbooking-> Status = 'Send to confermation';
                      }
                      
                    $hrbooking-> GuestId = Auth::user()->id;
                    $hrbooking-> GuestName = Auth::user()->name;
                    $hrbooking-> HolodayResortId =  $request->input('HolodayResortId');
                    $hrbooking->save();


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
                    //$CheckInDate = hrbooking::where('CheckInDate', '=', $request->input('CheckInDate'))->first();

                    
                    Mail::to($email)->send(new RequestRecommendMail($data));
                    return back()->with('success', 'Request Sent Successfuly!');
             }
        }
        

        if($request->input('HolodayResortId') == 2){
            //Master bed room
            //$bookings1 = hrbooking::whereBetween('CheckInDate', [$request->input('CheckInDate'), $request->input('CheckOutDate')])->get();
            //$bookings2 = hrbooking::whereBetween('CheckOutDate', [$request->input('CheckInDate'), $request->input('CheckOutDate')])->get();

            $CheckInDate = hrbooking::whereDate('CheckInDate', '<=', $request->input('CheckInDate'))->whereDate('CheckOutDate', '>=', $request->input('CheckInDate'))->where('Status', 'Confirmed')->get();
            $CheckInDate2 = hrbooking::whereDate('CheckInDate', '>=', $request->input('CheckInDate'))->whereDate('CheckInDate', '<=', $request->input('CheckOutDate'))->where('Status', 'Confirmed')->get();
            //dd($CheckInDate->sum('NoOfUnits'),$CheckInDate2);

            $check_cndition1 = $CheckInDate->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition2 = $CheckInDate2->sum('NoOfUnits') + $request->input('NoOfUnits');
            $check_cndition3 = ($CheckInDate->sum('NoOfUnits') + $CheckInDate2->sum('NoOfUnits')) + $request->input('NoOfUnits');
            
            if( $check_cndition1 > 12 || $check_cndition2 > 12 || $check_cndition3 > 12){
             //  dd("already booked");
                // return redirect('/')->with('danger','Sorry Allready Booked!');
                return back()->with('success','Sorry Allready Booked!');
             }else{
              // dd("available");
                
                    $hrbooking = new hrbooking;
                    $hrbooking-> BookingType = $request->input('BookingType');
                    $hrbooking-> CheckInDate = $request->input('CheckInDate');
                    $hrbooking-> CheckOutDate = $request->input('CheckOutDate');
                    $hrbooking-> NoOfAdults = $request->input('NoOfAdults');
                    $hrbooking-> NoOfChildren = $request->input('NoOfChildren');
                    $hrbooking-> NoOfUnits = $request->input('NoOfUnits');
                    $hrbooking-> Description = $request->input('Description');
                    
                    if($request->input('BookingType') == "Resource Person" || $request->input('BookingType') == "SUSL Staff"){
                        $hrbooking-> Recommendation_from = $request->input('Recommendation_from');
                        $hrbooking-> VCApproval = $request->input('VCApproval');
                        $hrbooking-> Status = 'Send to Recommendation';
                      }
                      else{
                        $hrbooking-> Recommendation_from = 13;
                        $hrbooking-> VCApproval = 0;
                        $hrbooking-> Status = 'Send to confermation';
                      }
                      
                    $hrbooking-> GuestId = Auth::user()->id;
                    $hrbooking-> GuestName = Auth::user()->name;
                    $hrbooking-> HolodayResortId =  $request->input('HolodayResortId');
                    $hrbooking->save();


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
                    //$CheckInDate = hrbooking::where('CheckInDate', '=', $request->input('CheckInDate'))->first();

                    
                    Mail::to($email)->send(new RequestRecommendMail($data));
                    return back()->with('success', 'Request Sent Successfuly!');
             }
        }
            return redirect('/')->with('danger','Sorry Allready Booked!');
        
    }


    
    // function send(Request $request)
    // {
    //  $this->validate($request, [
      
    //  ]);

    //  $data = array(
    //     'id'      =>  Auth::user()->id,
    //     'name'      =>  Auth::user()->name,
     
    // );

    //         Mail::to('ashansawijeratne@gmail.com')->send(new SendMail($data));
    //         return back()->with('success', 'Successfuly sent!');

    // }
}