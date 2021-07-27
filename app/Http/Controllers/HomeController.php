<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\holidayresort;
use App\Models\hrbooking;

use App\Models\nest;
use App\Models\nestbooking;
use Auth;
use DB;

use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $hr = holidayresort::all();
        $hrdetail = DB::select('select * from holidayresorts');
        $hrfill = [];
        foreach($hrdetail as $n){
            $hrfill[$n->HolodayResortId] = $n->Type;
        }

        $nest = nest::all();
        $nestdetail = DB::select('select * from nests');
        $nestfill = [];
        foreach($nestdetail as $n){
            $nestfill[$n->NestId] = $n->Type;
        }

        return view('home', compact('hrfill','hr','nestfill','nest'));
    }

   
}
