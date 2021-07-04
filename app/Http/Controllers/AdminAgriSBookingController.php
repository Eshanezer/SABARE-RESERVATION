<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminAgriSBookingController extends Controller
{
    public function viewadminagribooking() { 
      
        $agrsbookings = DB::select('select * from agrsbookings');
       

        return view('viewadminagribooking',['agrsbookings'=>$agrsbookings]); 
       } 

    

        public function edit(Request $request,$BookingId) {
            $VCApproval = 1;
            DB::update('update agrsbookings set VCApproval = ? where BookingId = ?',[$VCApproval,$BookingId]);
            echo "Record updated successfully.
            ";
            echo 'Click Here to go back.';
            }
}
