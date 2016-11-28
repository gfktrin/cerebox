<?php

namespace Cerebox\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function loginRedirect(){
        if(\Auth::user()->admin)
            return redirect()->action('AdminController@home');
        else
            return redirect()->action('HomeController@index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function howToParticipate(){
        return view('how-to-participate');
    }

    public function editUser(){
        return view('app.edit-user')->with([
            'user' => \Auth::user()
        ]);
    }
}
