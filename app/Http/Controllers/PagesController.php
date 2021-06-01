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
}
