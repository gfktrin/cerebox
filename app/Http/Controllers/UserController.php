<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Http\Requests\User\EditRequest;
use Cerebox\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(EditRequest $request, User $user){
        $inputs = $request->except('_token');

        $user = User::find($inputs['user_id']);
        $user->update($inputs);

        if($request->ajax()) {
            return $user;
        }else{
            \Session::flash('success', trans('application-messages.UserController.edit.success'));
            return redirect()->action('HomeController@editUser');
        }
    }
}
