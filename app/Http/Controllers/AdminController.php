<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Contest;
use Cerebox\Invoice;
use Cerebox\Purchase;
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
}
