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

class AdminAgriSBookingController extends Controller
{
    public function viewadminagribooking() { 
      
        $agrsbookings = DB::select('select * from agrsbookings');
       

        return view('viewadminagribooking',['agrsbookings'=>$agrsbookings]); 
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

               


                public function showaf($id) {

                    $users =DB::table('agrsbookings')
                            ->select('agrsbookings.*','users.name')
                            ->join('users','users.id','=','agrsbookings.Recommendation_From')
                            ->where(['agrsbookings.BookingId' => $id])
                            ->get();

                        //$users = DB::select('select * from agrsbookings where BookingId = ?',[$id]);
                    return view('af_adminview',['users'=>$users]);
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

}