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

class AdminNestBookingController extends Controller
{
        public function viewadminnestbooking() { 
      
        //$nestbookings = DB::select('select * from nestbookings');
        $nestbookings =DB::table('nestbookings')
        ->select('nestbookings.*','nests.Type')
        ->join('nests','nests.NestId','=','nestbookings.NestId')
        ->get();

        return view('viewadminnestbooking',['nestbookings'=>$nestbookings]); 
   
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




                    public function shownest($id) {

                        $users =DB::table('nestbookings')
                        ->select('nestbookings.*','users.name','nests.Type')
                        ->join('users','users.id','=','nestbookings.Recommendation_From')
                        ->join('nests','nests.NestId','=','nestbookings.NestId')
                        ->where(['nestbookings.BookingId' => $id])
                        ->get();

                       // $users = DB::select('select * from nestbookings where BookingId = ?',[$id]);
                        return view('nest_adminview',['users'=>$users]);
                        }

                    

                        public function vcapprove(Request $request,$BookingId) {
                            $data = $BookingId;
                            $Status = 'Request VC Approval';
                            
            
                            DB::update('update nestbookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                            echo "Record updated successfully.
                            ";
                            echo 'Click Here to go back.';
            
                            Mail::to('ashansawijeratne@gmail.com')->send(new SendMail($data));
                            return back()->with('success', 'Message Sent Successfuly!');
                            }
                        
                        

}
