<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Http\Requests\User\EditRequest;
use Cerebox\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(EditRequest $request, User $user){
        $inputs = $request->except('_token');

        if(!isset($inputs['admin']))
            $inputs['admin'] = 0;

        $user->update($inputs);

        return $user;
    }
}
