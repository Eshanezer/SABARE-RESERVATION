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

class SendEmailVCController extends Controller
{
  
        public function viewagribooking() { 
        
            $agrsbookings = DB::select('select * from agrsbookings');
        

            return view('viewagribooking',['agrsbookings'=>$agrsbookings]); 
        } 
        
        public function viewvcagribooking() { 
        
            $agrsbookings = DB::select('select * from agrsbookings');
        
            return view('viewvcagribooking',['agrsbookings'=>$agrsbookings]); 
    
        }

        public function viewdeanhodagrisbooking() { 
            
            
            $Recommendation_From = Auth::id();

            //$Recommendation_From = '4';
            
            $agrsbookings = DB::select('select * from agrsbookings where Recommendation_From = ?', [$Recommendation_From]);
            
            
    
            return view('viewdeanhodagrisbooking',['agrsbookings'=>$agrsbookings]); 
            } 



            public function confirm(Request $request,$BookingId) {

                $data = $BookingId;

                //$GuestId = DB::select('select GuestId from avubookings where BookingId = ?', [$data]);
                $GuestId = DB::table('agrsbookings')->where('BookingId', [$BookingId])->value('GuestId');
                $email = DB::table('users')->where('id', [$GuestId])->value('email');
                //$email = DB::select('select email from users where id = ?', [$GuestId]);

                $Status = 'Confirmed';
                DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                echo "Record updated successfully.";
                echo 'Click Here to go back.';

                Mail::to($email)->send(new ConfirmMail($data));
                return back()->with('success', 'Message Sent Successfuly!');
                }



                public function reject(Request $request,$BookingId) {
                    $data = $BookingId;
                    $Status = 'Rejected';
                    $GuestId = DB::table('agrsbookings')->where('BookingId', [$BookingId])->value('GuestId');
                    $email = DB::table('users')->where('id', [$GuestId])->value('email');

                    DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                    echo "Record updated successfully.
                    ";
                    echo 'Click Here to go back.';

                    Mail::to($email)->send(new RejectMail($data));
                    return back()->with('success', 'Message Sent Successfuly!');
                    }

                    public function recommend(Request $request,$BookingId) {

                        $data = $BookingId;
        
                    $Status = 'Recommended';
                    DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                    echo "Record updated successfully.";
                    echo 'Click Here to go back.';
        
                
                    return back()->with('success', 'Updated Successfuly!');
                    }


                    public function notrecommend(Request $request,$BookingId) {
                        $data = $BookingId;
                        $Status = 'Not Recommended';
                        DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.
                        ";
                        echo 'Click Here to go back.';
        
                        
                        return back()->with('success', 'Updated Successfuly!');
                        }


                        public function afsapprove(Request $request,$BookingId) {

                            $data = $BookingId;
            
                        $Status = 'Approved By VC';
                        DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.";
                        echo 'Click Here to go back.';
            
                    
                        return back()->with('success', 'Updated Successfuly!');
                        }



                        public function afsnotapprove(Request $request,$BookingId) {
                            $data = $BookingId;
                            $Status = 'Not Approved';
                            DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                            echo "Record updated successfully.
                            ";
                            echo 'Click Here to go back.';
            
                            
                            return back()->with('success', 'Updated Successfuly!');
                            }
                        
                        public function showafsvc($id) {

                            $users =DB::table('agrsbookings')
                                    ->select('agrsbookings.*','users.name')
                                    ->join('users','users.id','=','agrsbookings.Recommendation_From')
                                    ->where(['agrsbookings.BookingId' => $id])
                                    ->get();

                                //$users = DB::select('select * from agrsbookings where BookingId = ?',[$id]);
                                return view('afsvc_view',['users'=>$users]);
                                }

                        public function showaf($id) {

                            $users =DB::table('agrsbookings')
                                    ->select('agrsbookings.*','users.name')
                                    ->join('users','users.id','=','agrsbookings.Recommendation_From')
                                    ->where(['agrsbookings.BookingId' => $id])
                                    ->get();

                            //$users = DB::select('select * from agrsbookings where BookingId = ?',[$id]);
                            return view('af_view',['users'=>$users]);
                            }


                            public function vcapprove(Request $request,$BookingId) {
                                $data = $BookingId;
                                $Status = 'Request VC Approval';
                                
                
                                DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                                echo "Record updated successfully.
                                ";
                                echo 'Click Here to go back.';
                
                                Mail::to('ashansawijeratne@gmail.com')->send(new SendMail($data));
                                return back()->with('success', 'Message Sent Successfuly!');
                                }

            // public function edit(Request $request,$BookingId) {
            //     $VCApproval = 1;
            //     DB::update('update agrsbookings set VCApproval = ? where BookingId = ?',[$VCApproval,$BookingId]);
            //     echo "Record updated successfully.
            //     ";
            //     echo 'Click Here to go back.';
            //     }
}
