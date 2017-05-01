<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Contest;
use Cerebox\Invoice;
use Cerebox\Purchase;
use Cerebox\Project;
use Cerebox\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }

    public function users()
    {
        return view('admin.user.all')->with([
            'users' => User::all()
        ]);
    }

    public function retrieveUser(User $user)
    {
        return view('admin.user.retrieve')->with([
            'user' => $user
        ]);
    }

    public function contests()
    {
        return view('admin.contest.all')->with([
            'contests' => Contest::all()
        ]);
    }

    public function createTheme(Contest $contest)
    {
        return view('admin.theme.create');
    }


    public function createContest()
    {
        return view('admin.contest.create');
    }

    public function retrieveContest(Contest $contest)
    {
        $pending_projects = $contest->projects()->where('approved',0)->get();
        $approved_projects = $contest->projects()->where('approved',1)->get();

        return view('admin.contest.retrieve')->with([
            'contest' => $contest,
            'pending_projects' => $pending_projects,
            'approved_projects' => $approved_projects
        ]);
    }

    public function createInvoice()
    {
        return view('admin.invoice.create');
    }

    public function retrieveInvoice(Invoice $invoice)
    {
        return view('admin.invoice.retrieve')->with([
            'invoice' => $invoice
        ]);
    }

    public function purchases()
    {
        return view('admin.purchase.all')->with([
            'purchases' => Purchase::with('user','invoice','products')->orderBy('id','desc')->get()
        ]);
    }

    public function retrievePurchase(Purchase $purchase)
    {
        return view('admin.purchase.retrieve')->with([
            'purchase' => $purchase
        ]);
    }

    public function makePositions(Contest $contest)
    {
        $approved_projects = $contest->projects()->where('approved',1)->get();

        foreach ($approved_projects as $project) {
            $final_grade = 0;

            for ($i=1; $i < 5; $i++) { 
                $final_grade += $project->getAverage($i);                
            }
            $project->points = $final_grade;
        }


        $projects_in_order = $approved_projects->sortByDesc('points')->values();
    

        foreach ($projects_in_order as $key => $project) {
            $project->position = $key + 1;
        }

        $contest->finalizeContest($projects_in_order);


        return $this->retrieveContest($contest);
    }
}
