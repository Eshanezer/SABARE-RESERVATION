<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\holidayresort;

class HrController extends Controller
{
    public function gethr(){


        
        
        $hr = holidayresort::all();

        return view('hr')->with('hr',$hr);
    }
}
