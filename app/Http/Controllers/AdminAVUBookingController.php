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

class AdminAVUBookingController extends Controller
{
    public function viewadminavubooking() { 
      
        //$avubookings = DB::select('select * from avubookings');
 
 
        $avubookings =DB::table('avubookings')
        ->select('avubookings.*','users.name','audiovisualunits.Type')
        ->join('users','users.id','=','avubookings.Recommendation_From')
        ->join('audiovisualunits','audiovisualunits.AVUId','=','avubookings.AVUId')
        ->get();
         
         // $avubookings = DB::table('avubookings')
         // ->join('users', 'avubookings.Recommendation_From', '=', 'users.id')
         // ->select('avubookings.*', 'users.name')
         // ->get();
 
         return view('viewadminavubooking',['avubookings'=>$avubookings]); 
        } 
 
    
 
         public function edit(Request $request,$BookingId) {
 
             $data = $BookingId;
 
             //$GuestId = DB::select('select GuestId from avubookings where BookingId = ?', [$data]);
             $GuestId = DB::table('avubookings')->where('BookingId', [$BookingId])->value('GuestId');
             $email = DB::table('users')->where('id', [$GuestId])->value('email');
             //$email = DB::select('select email from users where id = ?', [$GuestId]);
 
             $Status = 'Confirmed';
             DB::update('update avubookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
             echo "Record updated successfully.";
             echo 'Click Here to go back.';
 
             Mail::to($email)->send(new ConfirmMail($data));
             return back()->with('success', 'Message Sent Successfuly!');
             }
 
         public function reject(Request $request,$BookingId) {
                 $data = $BookingId;
                 $Status = 'Rejected';
                 $GuestId = DB::table('avubookings')->where('BookingId', [$BookingId])->value('GuestId');
                 $email = DB::table('users')->where('id', [$GuestId])->value('email');
 
                 DB::update('update avubookings set Status = ? where BookingId = ?',[$Status,$BookingId]);
                 echo "Record updated successfully.
                 ";
                 echo 'Click Here to go back.';
 
                 Mail::to($email)->send(new RejectMail($data));
                 return back()->with('success', 'Message Sent Successfuly!');
                 }
 
 
             
 }
 