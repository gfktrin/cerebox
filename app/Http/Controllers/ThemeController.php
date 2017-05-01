<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Theme;
use Cerebox\Http\Requests\Theme\CreateRequest;
use Cerebox\Http\Requests\Theme\UpdateRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function create(CreateRequest $request){
        $themes = $request->except('_token');

        foreach ($themes as $theme) {
            Theme::create($theme);
            /*$theme_instance Theme::create($theme);*/
           // $contest->themes()->attach($theme_instance['theme_id']);
        }
    }

    public function update(UpdateRequest $request, Theme $theme){
        $inputs = $request->except('_token');

        $theme->update($inputs);
    }

    public function index(){
        return Theme::all();
    }

    public function delete(Theme $theme){
        $theme->delete();
    }
}
