<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getHome(){
        return view('home');
    }


    public function getagrifarm(){
        return view('af');
    }

    public function getnest(){
        return view('nest');
    }

    public function gethr(){
        return view('hr');
    }

    public function getavu(){
        return view('avu');
    }

    public function getContact(){
        return view('contact');
    }

    public function admin(Request $req){
        return view('admin');
    }
    public function vc(Request $req){
        return view('vc');
       // return view('vc')->withMessage("Super Admin");
    }

    public function avucoordinator(Request $req){
        return view('avucoordinator');
    }
    
    public function nestcoordinator(Request $req){
        return view('nestcoordinator');
    }

    public function dean_hod(Request $req){
        return view('dean_hod');
    }
   
    public function agricoordinator(Request $req){
        return view('agricoordinator');
    }
    
    
}
