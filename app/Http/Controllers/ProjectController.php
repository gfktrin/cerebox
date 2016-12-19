<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Http\Requests\Project\CreateRequest;
use Cerebox\Http\Requests\Project\UpdateRequest;
use Cerebox\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create(CreateRequest $request){
        $inputs = $request->except('art','_token');

        $file = $request->file('art');

        $filename = $file->getFilename().'.'.$file->getClientOriginalExtension();
        $file->move('project_images',$filename);

        $inputs['filename'] = $filename;

        $project =  Project::create($inputs);

        return $project;
    }

    public function update(UpdateRequest $request, Project $project){
        $inputs = $request->except('_token');

        if($request->hasFile('art')){
            $file = $request->file('art');

            $filename = $file->getFilename().'.'.$file->getClientOriginalExtension();
            $file->move('project_images',$filename);

            $inputs['filename'] = $filename;
        }

        $project->update($inputs);
    }

    public function approve(Request $request, Project $project){
        $project->approve();

        return $project;
    }

    public function refuse(Request $request, Project $project){
        $project->refuse();

        return $project;
    }
}
