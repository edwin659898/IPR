<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use URL;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index()
     {
       $todos = auth()->user()->todo()->orderby('date_initiated','desc')->get();
       $referer =  URL::previous();
       if (strpos($referer,'login') == True) {
        Alert::success('Welcome Back 😁',auth()->user()->name)->toToast();
       }
       return view('user.home')->with(['todos' => $todos]);
     }
}
