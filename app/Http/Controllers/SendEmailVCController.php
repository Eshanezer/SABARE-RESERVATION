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
use App\Models\agrsbooking;

class SendEmailVCController extends Controller
{
  //view agri farm booking details from agri coordinator side
        public function viewagribooking(Request $request) { 
        
            if($request->input('CheckInDate') != null){
                $agrsbookings = agrsbooking::whereDate('CheckInDate', $request->input('CheckInDate'))->paginate(10);
            }else{
                $agrsbookings = agrsbooking::paginate(10);
            }
        

            return view('viewagribooking',['agrsbookings'=>$agrsbookings]); 
        } 
        
        //load agri booking details in vc page
        public function viewvcagribooking(Request $request) { 

            if($request->input('CheckInDate') != null){
                $agrsbookings = agrsbooking::whereDate('CheckInDate', $request->input('CheckInDate'))->paginate(10);
            }else{
                $agrsbookings = agrsbooking::paginate(10);
            }
    
        
           
        
            return view('viewvcagribooking',['agrsbookings'=>$agrsbookings]); 
    
        }

        //view agri booking details in dean/hod side
        public function viewdeanhodagrisbooking(Request $request) { 
            
            
            $Recommendation_From = Auth::id();

            
            if($request->input('CheckInDate') != null){
                
                $agrsbookings = agrsbooking::where('Recommendation_From', '=', [$Recommendation_From])->whereDate('CheckInDate', $request->input('CheckInDate'))->paginate(10);
           
            }else{
                
                $agrsbookings = agrsbooking::where('Recommendation_From', '=', [$Recommendation_From])->paginate(10);
           
            }
            
           
            
    
            return view('viewdeanhodagrisbooking',['agrsbookings'=>$agrsbookings]); 
            } 


//confirm booking
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


        //reject booking
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

                    //recomend the request by hod/dean
                    public function recommend(Request $request,$BookingId) {

                        $data = $BookingId;
        
                    $Status = 'Recommended';
                    DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                    echo "Record updated successfully.";
                    echo 'Click Here to go back.';
        
                
                    return back()->with('success', 'Updated Successfuly!');
                    }

                    //reject the request by dean/hod
                    public function notrecommend(Request $request,$BookingId) {
                        $data = $BookingId;
                        $Status = 'Not Recommended';
                        DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.
                        ";
                        echo 'Click Here to go back.';
        
                        
                        return back()->with('success', 'Updated Successfuly!');
                        }

                        //approve the booking by vc side
                        public function afsapprove(Request $request,$BookingId) {

                            $data = $BookingId;
            
                        $Status = 'Approved By Vice Chancellor';
                        DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.";
                        echo 'Click Here to go back.';
            
                    
                        return back()->with('success', 'Updated Successfuly!');
                        }


                        //reject the request by vc
                        public function afsnotapprove(Request $request,$BookingId) {
                            $data = $BookingId;
                            $Status = 'Not Approved';
                            DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                            echo "Record updated successfully.
                            ";
                            echo 'Click Here to go back.';
            
                            
                            return back()->with('success', 'Updated Successfuly!');
                            }
                        
                        //show selected booking details in vc side    
                        public function showafsvc($id) {

                            $users =DB::table('agrsbookings')
                                    ->select('agrsbookings.*','users.name')
                                    ->join('users','users.id','=','agrsbookings.Recommendation_From')
                                    ->where(['agrsbookings.BookingId' => $id])
                                    ->get();

                                
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

                            //request vc approve
                            public function vcapprove(Request $request,$BookingId) {
                                $data = $BookingId;
                                $Status = 'Request Vice Chancellor Approval';
                                
                
                                DB::update('update agrsbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                                echo "Record updated successfully.
                                ";
                                echo 'Click Here to go back.';
                
                                $email = DB::select('select email from users where roleNo = 2');
                
                                Mail::to($email)->send(new SendMail($data));
                                return back()->with('success', 'Message Sent Successfuly!');
                                }

            
}
