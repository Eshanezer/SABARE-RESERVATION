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
use App\Models\agridbooking;

class ViewAFDBookingController extends Controller
{
    public function viewagridbooking(Request $request) { 
      
        if($request->input('CheckInDate') != null){
            $agridbookings =DB::table('agridbookings')
            ->select('agridbookings.*','users.name')
            ->join('users','users.id','=','agridbookings.Recommendation_From')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->paginate(10);
        }else{
            $agridbookings =DB::table('agridbookings')
            ->select('agridbookings.*','users.name')
            ->join('users','users.id','=','agridbookings.Recommendation_From')
            ->paginate(10);
        }
        //$agridbooking = DB::select('select * from agridbookings');
       
        return view('viewagridbooking',['agridbookings'=>$agridbookings]); 
   
       } 
       public function viewvcagridbooking(Request $request) { 
      
        if($request->input('CheckInDate') != null){
            $agridbookings =DB::table('agridbookings')
            ->select('agridbookings.*','users.name')
            ->join('users','users.id','=','agridbookings.Recommendation_From')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->paginate(10);
        }else{
            $agridbookings =DB::table('agridbookings')
            ->select('agridbookings.*','users.name')
            ->join('users','users.id','=','agridbookings.Recommendation_From')
            ->paginate(10);
        }

    
       
        return view('viewvcagridbooking',['agridbookings'=>$agridbookings]); 
   
       }
       


    public function viewdeanhodagridbooking(Request $request) { 
        
        
        $Recommendation_From = Auth::id();

        if($request->input('CheckInDate') != null){
                
            $agridbookings = agridbooking::where('Recommendation_From', '=', [$Recommendation_From])->whereDate('CheckInDate', $request->input('CheckInDate'))->paginate(10);
       
        }else{
            
            $agridbookings = agridbooking::where('Recommendation_From', '=', [$Recommendation_From])->paginate(10);
       
        }
        
       // $agridbooking = DB::select('select * from agridbookings where Recommendation_From = ?', [$Recommendation_From]);
         
        
 
         return view('viewdeanhodagridbooking',['agridbookings'=>$agridbookings]); 
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
            
                        $Status = 'Approved By Vice Chancellor';
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
                               // $users = DB::select('select * from agridbookings where BookingId = ?',[$id]);
                               $users =DB::table('agridbookings')
                                ->select('agridbookings.*','users.name')
                                ->join('users','users.id','=','agridbookings.Recommendation_From')
                                ->where(['agridbookings.BookingId' => $id])
                                ->get();
                                return view('afdvc_view',['users'=>$users]);
                                }

                        public function show($id) {

                            $users =DB::table('agridbookings')
                            ->select('agridbookings.*','users.name')
                            ->join('users','users.id','=','agridbookings.Recommendation_From')
                            ->where(['agridbookings.BookingId' => $id])
                            ->get();

                           // $users = DB::select('select * from agridbookings where BookingId = ?',[$id]);
                            return view('afd_view',['users'=>$users]);
                            }

                        

                            public function vcapprove(Request $request,$BookingId) {
                                $data = $BookingId;
                                $Status = 'Request Vice Chancellor Approval';
                                
                
                                DB::update('update agridbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                                echo "Record updated successfully.
                                ";
                                echo 'Click Here to go back.';
                
                                $email = DB::select('select email from users where roleNo = 2');
                
                                Mail::to($email)->send(new SendMail($data));
                                return back()->with('success', 'Message Sent Successfuly!');
                                }
                            
                            

}
