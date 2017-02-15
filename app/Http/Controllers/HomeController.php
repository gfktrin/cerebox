<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Contest;
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
        return view('welcome')->with([
            'contests' => Contest::open()->get()->take(3),
        ]);;
    }

    public function howToParticipate(){
        return view('how-to-participate');
    }

    public function editUser(){
        return view('app.edit-user')->with([
            'user' => \Auth::user()
        ]);
    }

    public function submitProject(Contest $contest){
        return view('app.submit-project')->with([
            'contest' => $contest,
            'user' => \Auth::user()
        ]);
    }

    public function myProjects(){
        $user = \Auth::user();
        $projects = $user->projects()->with('contest')->withCount('votes')->get();

        return view('app.my-projects')->with([
            'user' => $user,
            'projects' => $projects
        ]);
    }

    public function contest($slug){
        $contest = Contest::where('slug',$slug)->get()->first();

        if(\Auth::check())
            $vote = \Auth::user()->votes()->where('contest_id',$contest->id)->get()->first();
        else
            $vote = null;

        if(is_null($contest))
            return abort(404);

        return view('app.contest')->with([
            'contest' => $contest,
            'vote' => $vote
        ]);
    }

    public function openContests(){
        return view('app.open-contests')->with([
            'contests' => Contest::open()->get()
        ]);
    }

    public function paymentReturn(){
        return view('app.payment-return');
    }
}
