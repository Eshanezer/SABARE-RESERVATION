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

class ViewAFDBookingController extends Controller
{
    public function viewagridbooking() { 
      
        $agridbooking = DB::select('select * from agridbookings');
       
        return view('viewagridbooking',['agridbooking'=>$agridbooking]); 
   
       } 
       public function viewvcagridbooking() { 
      
        $agridbooking = DB::select('select * from agridbookings');
       
        return view('viewvcagridbooking',['agridbooking'=>$agridbooking]); 
   
       }
       


    public function viewdeanhodagridbooking() { 
        
        
        $Recommendation_From = Auth::id();

        //$Recommendation_From = '4';
        
        $agridbooking = DB::select('select * from agridbookings where Recommendation_From = ?', [$Recommendation_From]);
         
        
 
         return view('viewdeanhodagridbooking',['agridbooking'=>$agridbooking]); 
        } 

        public function confirm(Request $request,$BookingId) {

            $data = $BookingId;

            //$GuestId = DB::select('select GuestId from avubookings where BookingId = ?', [$data]);
            $GuestId = DB::table('agridbookings')->where('BookingId', [$BookingId])->value('GuestId');
            $email = DB::table('users')->where('id', [$GuestId])->value('email');
            //$email = DB::select('select email from users where id = ?', [$GuestId]);

            $Status = 'Confirmed';
            DB::update('update agridbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
            echo "Record updated successfully.";
            echo 'Click Here to go back.';

            Mail::to($email)->send(new ConfirmMail($data));
            return back()->with('success', 'Message Sent Successfuly!');
            }

        public function reject(Request $request,$BookingId) {
                $data = $BookingId;
                $Status = 'Rejected';
                $GuestId = DB::table('agridbookings')->where('BookingId', [$BookingId])->value('GuestId');
                $email = DB::table('users')->where('id', [$GuestId])->value('email');

                DB::update('update agridbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                echo "Record updated successfully.
                ";
                echo 'Click Here to go back.';

                Mail::to($email)->send(new RejectMail($data));
                return back()->with('success', 'Message Sent Successfuly!');
                }


                public function recommend(Request $request,$BookingId) {

                        $data = $BookingId;
        
                    $Status = 'Recommended';
                    DB::update('update agridbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                    echo "Record updated successfully.";
                    echo 'Click Here to go back.';
        
                   
                    return back()->with('success', 'Updated Successfuly!');
                    }
        
                public function notrecommend(Request $request,$BookingId) {
                        $data = $BookingId;
                        $Status = 'Not Recommended';
                        DB::update('update agridbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.
                        ";
                        echo 'Click Here to go back.';
        
                        
                        return back()->with('success', 'Updated Successfuly!');
                        }

                        public function afdapprove(Request $request,$BookingId) {

                            $data = $BookingId;
            
                        $Status = 'Approved By VC';
                        DB::update('update agridbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.";
                        echo 'Click Here to go back.';
            
                       
                        return back()->with('success', 'Updated Successfuly!');
                        }
            
                    public function afdnotapprove(Request $request,$BookingId) {
                            $data = $BookingId;
                            $Status = 'Not Approved';
                            DB::update('update agridbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                            echo "Record updated successfully.
                            ";
                            echo 'Click Here to go back.';
            
                            
                            return back()->with('success', 'Updated Successfuly!');
                            }
                        
                            public function showafdvc($id) {
                                $users = DB::select('select * from agridbookings where BookingId = ?',[$id]);
                                return view('afdvc_view',['users'=>$users]);
                                }

                        public function show($id) {
                            $users = DB::select('select * from agridbookings where BookingId = ?',[$id]);
                            return view('afd_view',['users'=>$users]);
                            }

                        

                            public function vcapprove(Request $request,$BookingId) {
                                $data = $BookingId;
                                $Status = 'Request VC Approval';
                                
                
                                DB::update('update agridbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                                echo "Record updated successfully.
                                ";
                                echo 'Click Here to go back.';
                
                                Mail::to('ashansawijeratne@gmail.com')->send(new SendMail($data));
                                return back()->with('success', 'Message Sent Successfuly!');
                                }
                            
                            

}
