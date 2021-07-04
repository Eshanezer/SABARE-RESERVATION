<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminNestBookingController extends Controller
{
        public function viewadminnestbooking() { 
      
        $nestbookings = DB::select('select * from nestbookings');
       
        return view('viewadminnestbooking',['nestbookings'=>$nestbookings]); 
   
       } 

       public function edit(Request $request,$BookingId) {
        $VCApproval = 1;
        DB::update('update nestbookings set VCApproval = ? where BookingId = ?',[$VCApproval,$BookingId]);
        echo "Record updated successfully.
        ";
        echo 'Click Here to go back.';
        }
}
