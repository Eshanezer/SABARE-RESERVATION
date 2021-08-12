<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\RejectMail;
use App\Mail\ConfirmMail;
use Auth;
use App\Mail\SendMail;
use App\Mail\RegistarMail;


class ViewHrBookingController extends Controller
{
    public function viewhrbooking(Request $request) { 
      
        //$hrbookings = DB::select('select * from hrbookings');
       
        if($request->input('CheckInDate') != null){
            $hrbookings =DB::table('hrbookings')
            ->select('hrbookings.*','holidayresorts.Type')
            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->paginate(10);
        }else{
            $hrbookings =DB::table('hrbookings')
            ->select('hrbookings.*','holidayresorts.Type')
            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
            ->paginate(10);
          
        }
        
        return view('viewhrbooking',['hrbookings'=>$hrbookings]); 
        
       } 

       public function viewreghrbooking(Request $request) { 
      
        //$hrbookings = DB::select('select * from hrbookings');
       
        if($request->input('CheckInDate') != null){
            $hrbookings =DB::table('hrbookings')
            ->select('hrbookings.*','holidayresorts.Type')
            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->paginate(10);
        }else{
            $hrbookings =DB::table('hrbookings')
            ->select('hrbookings.*','holidayresorts.Type')
            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
            ->paginate(10);
          
        }
        
        return view('viewreghrbooking',['hrbookings'=>$hrbookings]); 
        
       } 

       public function viewcthrbooking(Request $request) { 
      
        //$hrbookings = DB::select('select * from hrbookings');
       
        if($request->input('CheckInDate') != null){
            $hrbookings =DB::table('hrbookings')
            ->select('hrbookings.*','holidayresorts.Type')
            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->paginate(10);
        }else{
            $hrbookings =DB::table('hrbookings')
            ->select('hrbookings.*','holidayresorts.Type')
            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
            ->paginate(10);
          
        }
        
        return view('viewcthrbooking',['hrbookings'=>$hrbookings]); 
        
       } 

       public function viewvchrbooking(Request $request) 
       { 
      
        if($request->input('CheckInDate') != null){
            $hrbookings =DB::table('hrbookings')
            ->select('hrbookings.*','holidayresorts.Type')
            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->paginate(10);
        }else{
            $hrbookings =DB::table('hrbookings')
            ->select('hrbookings.*','holidayresorts.Type')
            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
            ->paginate(10);
          
        }
       
        return view('viewvchrbooking',['hrbookings'=>$hrbookings]); 
   
       }

       public function viewdeanhodhrbooking(Request $request) { 
        
        
        $Recommendation_From = Auth::id();

        if($request->input('CheckInDate') != null){
            $hrbookings =DB::table('hrbookings')
            ->select('hrbookings.*','holidayresorts.Type')
            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->where(['hrbookings.Recommendation_From' => $Recommendation_From])
            ->orderBy('hrbookings.BookingId')
            ->paginate(10);
        }else{
            $hrbookings =DB::table('hrbookings')
            ->select('hrbookings.*','holidayresorts.Type')
            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
            ->where(['hrbookings.Recommendation_From' => $Recommendation_From])
            ->orderBy('hrbookings.BookingId')
            ->paginate(10);
          
        }

      
        

        //$hrbookings = DB::select('select * from hrbookings where Recommendation_From = ?', [$Recommendation_From]);
         
        
 
         return view('viewdeanhodhrbooking',['hrbookings'=>$hrbookings]); 
        } 



        public function confirm(Request $request,$BookingId) {

            $data = $BookingId;

            //$GuestId = DB::select('select GuestId from avubookings where BookingId = ?', [$data]);
            $GuestId = DB::table('hrbookings')->where('BookingId', [$BookingId])->value('GuestId');
            $email = DB::table('users')->where('id', [$GuestId])->value('email');
            //$email = DB::select('select email from users where id = ?', [$GuestId]);

            $Status = 'Confirmed';
            DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
            echo "Record updated successfully.";
            echo 'Click Here to go back.';

            Mail::to($email)->send(new ConfirmMail($data));
            return back()->with('success', 'Message Sent Successfuly!');
            }



            public function reject(Request $request,$BookingId) {
                $data = $BookingId;
                $Status = 'Rejected';
                $GuestId = DB::table('hrbookings')->where('BookingId', [$BookingId])->value('GuestId');
                $email = DB::table('users')->where('id', [$GuestId])->value('email');

                DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                echo "Record updated successfully.
                ";
                echo 'Click Here to go back.';

                Mail::to($email)->send(new RejectMail($data));
                return back()->with('success', 'Message Sent Successfuly!');
                }

                public function regconfirm(Request $request,$BookingId) {

                    $data = $BookingId;
        
                    //$GuestId = DB::select('select GuestId from avubookings where BookingId = ?', [$data]);
                    $GuestId = DB::table('hrbookings')->where('BookingId', [$BookingId])->value('GuestId');
                    $email = DB::table('users')->where('id', [$GuestId])->value('email');
                    //$email = DB::select('select email from users where id = ?', [$GuestId]);
        
                    $Status = 'Approved By Registrar';
                    DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                    echo "Record updated successfully.";
                    echo 'Click Here to go back.';
        
                    //Mail::to($email)->send(new ConfirmMail($data));
                    return back()->with('success', 'Message Sent Successfuly!');
                    }
        
        
        
                    public function regreject(Request $request,$BookingId) {
                        $data = $BookingId;
                        $Status = ' Registrar Not Approved ';
                        $GuestId = DB::table('hrbookings')->where('BookingId', [$BookingId])->value('GuestId');
                        $email = DB::table('users')->where('id', [$GuestId])->value('email');
        
                        DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.
                        ";
                        echo 'Click Here to go back.';
        
                        //Mail::to($email)->send(new RejectMail($data));
                        return back()->with('success', 'Message Sent Successfuly!');
                        }

                public function recommend(Request $request,$BookingId) {

                    $data = $BookingId;
    
                $Status = 'Recommended';
                DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                echo "Record updated successfully.";
                echo 'Click Here to go back.';
    
               
                return back()->with('success', 'Updated Successfuly!');
                }


                public function notrecommend(Request $request,$BookingId) {
                    $data = $BookingId;
                    $Status = 'Not Recommended';
                    DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                    echo "Record updated successfully.
                    ";
                    echo 'Click Here to go back.';
    
                    
                    return back()->with('success', 'Updated Successfuly!');
                    }


                    public function hrapprove(Request $request,$BookingId) {

                        $data = $BookingId;
        
                    $Status = 'Approved By Vice Chancellor';
                    DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                    echo "Record updated successfully.";
                    echo 'Click Here to go back.';
        
                   
                    return back()->with('success', 'Updated Successfuly!');
                    }



                    public function hrnotapprove(Request $request,$BookingId) {
                        $data = $BookingId;
                        $Status = 'Not Approved';
                        DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.
                        ";
                        echo 'Click Here to go back.';
        
                        
                        return back()->with('success', 'Updated Successfuly!');
                        }
                    
                    public function showhrvc($id) {

                        $users =DB::table('hrbookings')
                        ->select('hrbookings.*','users.name','holidayresorts.Type')
                        ->join('users','users.id','=','hrbookings.Recommendation_From')
                        ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
                        ->where(['hrbookings.BookingId' => $id])
                        ->get();

                            //$users = DB::select('select * from hrbookings where BookingId = ?',[$id]);
                            return view('hrvc_view',['users'=>$users]);
                            }

                      public function showhrdean($id) {

                        $users =DB::table('hrbookings')
                        ->select('hrbookings.*','users.name','holidayresorts.Type')
                        ->join('users','users.id','=','hrbookings.Recommendation_From')
                        ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
                        ->where(['hrbookings.BookingId' => $id])
                        ->get();

                            //$users = DB::select('select * from hrbookings where BookingId = ?',[$id]);
                            return view('hrdean_view',['users'=>$users]);
                            }

                    public function showhr($id) {

                        $users =DB::table('hrbookings')
                        ->select('hrbookings.*','users.name','holidayresorts.Type')
                        ->join('users','users.id','=','hrbookings.Recommendation_From')
                        ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
                        ->where(['hrbookings.BookingId' => $id])
                        ->get();
                        //$users = DB::select('select * from hrbookings where BookingId = ?',[$id]);
                        return view('hr_view',['users'=>$users]);
                        }

                        public function showreghr($id) {

                            $users =DB::table('hrbookings')
                            ->select('hrbookings.*','users.name','holidayresorts.Type')
                            ->join('users','users.id','=','hrbookings.Recommendation_From')
                            ->join('holidayresorts','holidayresorts.HolodayResortId','=','hrbookings.HolodayResortId')
                            ->where(['hrbookings.BookingId' => $id])
                            ->get();
                            //$users = DB::select('select * from hrbookings where BookingId = ?',[$id]);
                            return view('hrreg_view',['users'=>$users]);
                            }


                        public function vcapprove(Request $request,$BookingId) {
                            $data = $BookingId;
                            $Status = 'Request Vice Chancellor Approval';
                            
                            // $users =DB::table('hrbookings')
                            // ->select('hrbookings.*','users.name','holidayresort.Type')
                            // ->join('users','users.id','=','hrbookings.Recommendation_From')
                            // ->join('holidayresort','holidayresort.HolodayResortId','=','hrbookings.HolodayResortId')
                            // ->where(['hrbookings.BookingId' => $BookingId])
                            // ->get();
                            DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                            echo "Record updated successfully.
                            ";
                            echo 'Click Here to go back.';
            
                            $email = DB::select('select email from users where roleNo = 2');
                
                             Mail::to($email)->send(new SendMail($data));
                            return back()->with('success', 'Message Sent Successfuly!');
                            }

                            public function regapprove(Request $request,$BookingId) {
                                $data = $BookingId;
                                $Status = 'Request Registrar Approval';
                                
                                DB::update('update hrbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                                echo "Record updated successfully.
                                ";
                                echo 'Click Here to go back.';
                
                                $email = DB::select('select email from users where roleNo = 7');
                    
                                 Mail::to($email)->send(new RegistarMail($data));
                                return back()->with('success', 'Message Sent Successfuly!');
                            }
                            public function addheadcomment(Request $request,$BookingId) {
          
                                $HODComment = $request->input('HODComment');
                                DB::update('update hrbookings set HODComment=? where BookingId = ?',[$HODComment,$BookingId]);
                                echo "Record updated successfully.
                                ";
                                echo 'Click Here to go back.';

                                return back()->with('success', 'Message Sent Successfuly!');
                                }

                                public function addvccomment(Request $request,$BookingId) {
          
                                    $VCComment = $request->input('VCComment');
                                    DB::update('update hrbookings set VCComment=? where BookingId = ?',[$VCComment,$BookingId]);
                                    echo "Record updated successfully.
                                    ";
                                    echo 'Click Here to go back.';
    
                                    return back()->with('success', 'Message Sent Successfuly!');
                                    }

                                public function addregcomment(Request $request,$BookingId) {
          
                                        $RegComment = $request->input('RegComment');
                                        DB::update('update hrbookings set RegComment=? where BookingId = ?',[$RegComment,$BookingId]);
                                        echo "Record updated successfully.
                                        ";
                                        echo 'Click Here to go back.';
            
                                        return back()->with('success', 'Message Sent Successfuly!');
                                }

    //    public function edit(Request $request,$BookingId) {
    //     $VCApproval = 1;
    //     DB::update('update hrbookings set VCApproval = ? where BookingId = ?',[$VCApproval,$BookingId]);
    //     echo "Record updated successfully.
    //     ";
    //     echo 'Click Here to go back.';
    //     }
}
