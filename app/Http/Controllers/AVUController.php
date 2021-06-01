<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\audiovisualunit;

class AVUController extends Controller
{
    public function getavu(){
       
        
        $avu = audiovisualunit::all();

        return view('avu')->with('avu',$avu);
    }
}
