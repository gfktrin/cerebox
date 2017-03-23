<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Contest;
use Cerebox\Product;
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

    public function howToParticipate()
    {
        return view('how-to-participate');
    }

    public function editUser()
    {
        return view('app.edit-user')->with([
            'user' => \Auth::user()
        ]);
    }

    public function submitProject(Contest $contest)
    {
        return view('app.submit-project')->with([
            'contest' => $contest,
            'user' => \Auth::user()
        ]);
    }

    public function myProjects()
    {
        $user = \Auth::user();
        $projects = $user->projects()->with('contest')->withCount('votes')->get();

        return view('app.my-projects')->with([
            'user' => $user,
            'projects' => $projects
        ]);
    }

    public function contest($slug)
    {
        $contest = Contest::where('slug',$slug)->get()->first();

        if(is_null($contest))
            return abort(404);

        return view('app.contest')->with([
            'contest' => $contest
        ]);
    }

    public function openContests()
    {
        return view('app.open-contests')->with([
            'submit_contests' => Contest::submitOpen()->get(),
            'voting_contests' => Contest::votingOpen()->get()
        ]);
    }

    public function paymentReturn()
    {
        return view('app.payment-return');
    }

    public function acquireTickets()
    {
        return view('app.acquire-tickets')->with([
            'user' => \Auth::user(),
            'product' => Product::where('name','Ticket')->get()->first()
        ]);
    }
}
