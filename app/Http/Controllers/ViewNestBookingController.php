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

class ViewNestBookingController extends Controller
{
    public function viewnestbooking(Request $request) { 
      
        //$nestbookings = DB::select('select * from nestbookings');
        if($request->input('CheckInDate') != null){
            $nestbookings =DB::table('nestbookings')
            ->select('nestbookings.*','nests.Type')
            ->join('nests','nests.NestId','=','nestbookings.NestId')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->paginate(10);
                
        }else{
            $nestbookings =DB::table('nestbookings')
            ->select('nestbookings.*','nests.Type')
            ->join('nests','nests.NestId','=','nestbookings.NestId')
            ->paginate(10);
                
        }
      

        return view('viewnestbooking',['nestbookings'=>$nestbookings]); 
   
       } 
       public function viewvcnestbooking(Request $request) { 

        if($request->input('CheckInDate') != null){
            $nestbookings =DB::table('nestbookings')
            ->select('nestbookings.*','nests.Type')
            ->join('nests','nests.NestId','=','nestbookings.NestId')
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->paginate(10);
                
        }else{
            $nestbookings =DB::table('nestbookings')
            ->select('nestbookings.*','nests.Type')
            ->join('nests','nests.NestId','=','nestbookings.NestId')
            ->paginate(10);
                
        }
      
        //$nestbookings = DB::select('select * from nestbookings');
       
        return view('viewvcnestbooking',['nestbookings'=>$nestbookings]); 
   
       }
       

    //    public function edit(Request $request,$BookingId) {
    //     $VCApproval = 1;
    //     DB::update('update nestbookings set VCApproval = ? where BookingId = ?',[$VCApproval,$BookingId]);
    //     echo "Record updated successfully.
    //     ";
    //     echo 'Click Here to go back.';
    //     }

    public function viewdeanhodnestbooking(Request $request) { 
        
        
        $Recommendation_From = Auth::id();

        //$Recommendation_From = '4';
    
        if($request->input('CheckInDate') != null){
            $nestbookings =DB::table('nestbookings')
            ->select('nestbookings.*','nests.Type')
            ->join('nests','nests.NestId','=','nestbookings.NestId')
            ->where(['nestbookings.Recommendation_From' => $Recommendation_From])
            ->where('CheckInDate', $request->input('CheckInDate'))
            ->paginate(10);
                
        }else{
            $nestbookings =DB::table('nestbookings')
            ->select('nestbookings.*','nests.Type')
            ->join('nests','nests.NestId','=','nestbookings.NestId')
            ->where(['nestbookings.Recommendation_From' => $Recommendation_From])
            ->paginate(10);
                
        }
      

      
        
       // $nestbookings = DB::select('select * from nestbookings where Recommendation_From = ?', [$Recommendation_From]);
         
        
 
         return view('viewdeanhodnestbooking',['nestbookings'=>$nestbookings]); 
        } 

        public function confirm(Request $request,$BookingId) {

            $data = $BookingId;

            //$GuestId = DB::select('select GuestId from avubookings where BookingId = ?', [$data]);
            $GuestId = DB::table('nestbookings')->where('BookingId', [$BookingId])->value('GuestId');
            $email = DB::table('users')->where('id', [$GuestId])->value('email');
            //$email = DB::select('select email from users where id = ?', [$GuestId]);

            $Status = 'Confirmed';
            DB::update('update nestbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
            echo "Record updated successfully.";
            echo 'Click Here to go back.';

            Mail::to($email)->send(new ConfirmMail($data));
            return back()->with('success', 'Message Sent Successfuly!');
            }

        public function reject(Request $request,$BookingId) {
                $data = $BookingId;
                $Status = 'Rejected';
                $GuestId = DB::table('nestbookings')->where('BookingId', [$BookingId])->value('GuestId');
                $email = DB::table('users')->where('id', [$GuestId])->value('email');

                DB::update('update nestbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                echo "Record updated successfully.
                ";
                echo 'Click Here to go back.';

                Mail::to($email)->send(new RejectMail($data));
                return back()->with('success', 'Message Sent Successfuly!');
                }


                public function recommend(Request $request,$BookingId) {

                        $data = $BookingId;
        
                    $Status = 'Recommended';
                    DB::update('update nestbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                    echo "Record updated successfully.";
                    echo 'Click Here to go back.';
        
                   
                    return back()->with('success', 'Updated Successfuly!');
                    }
        
                public function notrecommend(Request $request,$BookingId) {
                        $data = $BookingId;
                        $Status = 'Not Recommended';
                        DB::update('update nestbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.
                        ";
                        echo 'Click Here to go back.';
        
                        
                        return back()->with('success', 'Updated Successfuly!');
                        }

                        public function nestapprove(Request $request,$BookingId) {

                            $data = $BookingId;
            
                        $Status = 'Approved By Vice Chancellor';
                        DB::update('update nestbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                        echo "Record updated successfully.";
                        echo 'Click Here to go back.';
            
                       
                        return back()->with('success', 'Updated Successfuly!');
                        }
            
                    public function nestnotapprove(Request $request,$BookingId) {
                            $data = $BookingId;
                            $Status = 'Not Approved';
                            DB::update('update nestbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                            echo "Record updated successfully.
                            ";
                            echo 'Click Here to go back.';
            
                            
                            return back()->with('success', 'Updated Successfuly!');
                            }
                        
                            public function shownestvc($id) {

                                $users =DB::table('nestbookings')
                                ->select('nestbookings.*','users.name','nests.Type')
                                ->join('users','users.id','=','nestbookings.Recommendation_From')
                                ->join('nests','nests.NestId','=','nestbookings.NestId')
                                ->where(['nestbookings.BookingId' => $id])
                                ->get();

                               // $users = DB::select('select * from nestbookings where BookingId = ?',[$id]);
                                return view('nestvc_view',['users'=>$users]);
                                }

                           public function shownestdean($id) {

                                $users =DB::table('nestbookings')
                                ->select('nestbookings.*','users.name','nests.Type')
                                ->join('users','users.id','=','nestbookings.Recommendation_From')
                                ->join('nests','nests.NestId','=','nestbookings.NestId')
                                ->where(['nestbookings.BookingId' => $id])
                                ->get();

                               // $users = DB::select('select * from nestbookings where BookingId = ?',[$id]);
                                return view('nestdean_view',['users'=>$users]);
                                }

                        public function shownest($id) {

                            $users =DB::table('nestbookings')
                            ->select('nestbookings.*','users.name','nests.Type')
                            ->join('users','users.id','=','nestbookings.Recommendation_From')
                            ->join('nests','nests.NestId','=','nestbookings.NestId')
                            ->where(['nestbookings.BookingId' => $id])
                            ->get();

                           // $users = DB::select('select * from nestbookings where BookingId = ?',[$id]);
                            return view('nest_view',['users'=>$users]);
                            }

                        

                            public function vcapprove(Request $request,$BookingId) {
                                $data = $BookingId;
                                $Status = 'Request Vice Chancellor Approval';
                                
                
                                DB::update('update nestbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                                echo "Record updated successfully.
                                ";
                                echo 'Click Here to go back.';

                                $email = DB::select('select email from users where roleNo = 2');
                
                                Mail::to($email)->send(new SendMail($data));
                                return back()->with('success', 'Message Sent Successfuly!');
                                }
                            
                            

}
