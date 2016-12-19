<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Contest;
use Cerebox\Http\Requests\Contest\CreateRequest;
use Cerebox\Http\Requests\Contest\UpdateRequest;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function create(CreateRequest $request){
        $inputs = $request->except('_token');

        $contest = Contest::create($inputs);

        return $contest;
    }

    public function update(UpdateRequest $request, Contest $contest){
        $inputs = $request->except('_token');

        $contest->update($inputs);

        return $contest;
    }

    public function index(){
        return Contest::all();
    }

    public function delete(Contest $contest){
        $contest->delete();

        return $contest;
    }
}
