<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Http\Requests\Contact\SendMessageRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }

    public function sendMessage(SendMessageRequest $request){

    }
}
