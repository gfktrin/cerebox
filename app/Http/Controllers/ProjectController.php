<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Http\Requests\Project\CreateRequest;
use Cerebox\Http\Requests\Project\UpdateRequest;
use Cerebox\Invoice;
use Cerebox\Project;
use Cerebox\Vote;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function submit(CreateRequest $request){
        $inputs = $request->except('art','_token');

        $file = $request->file('art');

        $filename = $file->getFilename().'.'.$file->getClientOriginalExtension();
        $file->move('project_images',$filename);

        $inputs['filename'] = $filename;

        $project =  Project::create($inputs);

        $invoice = Invoice::create([
            'user_id' => \Auth::user()->id,
            'project_id' => $project->id
        ]);

        return [
            'redirect_url' => $invoice->paymentUrl()
        ];
    }

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

        return redirect()->action('AdminController@retrieveContest',['contest' => $project->contest->id]); //todo Temporary fix

        return $project;
    }

    public function refuse(Request $request, Project $project){
        $project->refuse();

        return redirect()->action('AdminController@retrieveContest',['contest' => $project->contest->id]); //todo Temporary fix

        return $project;
    }

    public function vote(Request $request, Project $project){
        $user = \Auth::user();

        $previous_vote = Vote::where([
            'user_id' => $user->id,
            'contest_id' => $project->contest->id
        ])->delete();

        $inputs = [
            'project_id' => $project->id,
            'user_id' => $user->id,
            'contest_id' => $project->contest->id
        ];

        $vote = Vote::create($inputs);

        if($request->ajax())
            return $vote;
        else
            return redirect()->back();
    }
}
