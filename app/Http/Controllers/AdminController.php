<?php

namespace Cerebox\Http\Controllers;

use Cerebox\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home(){
        return view('admin.home');
    }

    public function users(){
        return view('admin.users')->with([
            'users' => User::all()
        ]);
    }
}
