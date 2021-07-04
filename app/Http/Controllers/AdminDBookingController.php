<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminDBookingController extends Controller
{
    public function viewadminafdbooking() { 
      
        $agridbookings = DB::select('select * from agridbookings');
       
        return view('viewadminafdbooking',['agridbookings'=>$agridbookings]); 
   
       } 

       public function edit(Request $request,$BookingId) {
        $VCApproval = 1;
        DB::update('update agridbookings set VCApproval = ? where BookingId = ?',[$VCApproval,$BookingId]);
        echo "Record updated successfully.
        ";
        echo 'Click Here to go back.';
        }
}
