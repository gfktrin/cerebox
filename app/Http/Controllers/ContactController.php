<?php

namespace Cerebox\Http\Controllers;

use Cerebox\ContactMesssage;
use Cerebox\Http\Requests\Contact\SendMessageRequest;
use Cerebox\Mail\ContactMessageMail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }

    public function sendMessage(SendMessageRequest $request){
        $inputs = $request->except('_token');

        $contactMessage = new ContactMesssage($inputs);

        \Mail::to(config('mail.contact_to'))->send(new ContactMessageMail($contactMessage));

        if($request->ajax()) {
            return $contactMessage;
        }else{
            \Session::flash('contact-success', trans('application-messages.ContactController.sendMessage.success'));

            return redirect()->back();
        }

    }
}
