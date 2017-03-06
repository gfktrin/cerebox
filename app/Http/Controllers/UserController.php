<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Http\Requests\User\EditRequest;
use Cerebox\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(EditRequest $request, User $user){
        $inputs = $request->except('_token','state');

        $user->update($inputs);

        // if(isset($inputs['zipcode']) && !empty($inputs['zipcode'])){
        //     $address = $user->address;
        //     if(is_null($address)){
        //         $user->address()->create($inputs);
        //     }else{
        //         $address->update($inputs);
        //     }
        // }

        //Only Super Admin
        $auth_user = \Auth::user();
        if($auth_user->admin){
            $user->admin = isset($inputs['admin']) ? $inputs['admin'] : false;

            $user->save();
        }

        return $user;
    }
}
