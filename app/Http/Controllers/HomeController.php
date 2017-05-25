<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Contest;
use Cerebox\Product;
use Cerebox\Project;
use Cerebox\Vote;
use Illuminate\Http\Request;
use Session;
use Redirect;

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
        ]);
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
        $contest = Contest::where('slug',$slug)->with('projects')->get()->first();

        if(is_null($contest))
            return abort(404);
        if(\Auth::check()){
            $votes = Vote::where('user_id',\Auth::user()->id)
                                    ->whereIn('project_id',$contest->projects->pluck('id'))
                                    ->get();

            $need_to_validate_vote = $votes->count() == 1;

            $user = \Auth::user();
            $project = Project::where('author_id', $user->id)->where('contest_id', $contest->id)->get()->first();
        }

        return view('app.contest')->with([
            'slug' => $slug,
            'project' => isset($project) ? $project : [],
            'contest' => $contest,
            'need_to_validate_vote' => isset($need_to_validate_vote) ? $need_to_validate_vote : false,
            'votes' => isset($votes) ? $votes : []
        ]);
    }

    public function openContests()
    {
        return view('app.open-contests')->with([
            'open_contests' => Contest::registrationOpen()->get(),
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

    public function voteProject($slug ,$project_id){
        $contest = Contest::where('slug',$slug)->with('projects')->get()->first();
        //$user = \Auth::user();
        $project = Project::where('id', $project_id)->where('contest_id', $contest->id)->get()->first();

        //$info = Project::where('id', $project);
        
        return redirect::route('concurso.slug',['slug'=>$slug])->with([
            'project' => $project,
            'contest' => $contest,
            'code'=> 5,
        ]);
    }
}
