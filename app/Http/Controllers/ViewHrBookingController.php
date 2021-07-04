<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ViewHrBookingController extends Controller
{
    public function viewhrbooking() { 
      
        $hrbookings = DB::select('select * from hrbookings');
       
        return view('viewhrbooking',['hrbookings'=>$hrbookings]); 
        
       } 

       public function edit(Request $request,$BookingId) {
        $VCApproval = 1;
        DB::update('update hrbookings set VCApproval = ? where BookingId = ?',[$VCApproval,$BookingId]);
        echo "Record updated successfully.
        ";
        echo 'Click Here to go back.';
        }
}
