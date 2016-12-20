<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Http\Requests\User\EditRequest;
use Cerebox\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(EditRequest $request, User $user){
        $inputs = $request->except('_token');

        $user->update($inputs);

        //Only Super Admin
        $auth_user = \Auth::user();
        if($auth_user->admin){
            $user->admin = isset($inputs['admin']) ? $inputs['admin'] : false;

            $user->save();
        }

        return $user;
    }
}
