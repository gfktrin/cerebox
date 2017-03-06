<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Http\Requests\Project\CreateRequest;
use Cerebox\Http\Requests\Project\SubmitRequest;
use Cerebox\Http\Requests\Project\UpdateRequest;
use Cerebox\Invoice;
use Cerebox\Project;
use Cerebox\Vote;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function submit(SubmitRequest $request)
    {
        $inputs = $request->except('art','_token');

        $user = \Auth::user();

        $user->tickets -= Project::$entry_fee;

        //Tem q colocar essa lógica num lugar melhor
        if($user->tickets >= 0){
            \DB::table('user_ticket_log')->insert([
                'user_id' => $user->id,
                'message' => 'Usuário gastou '.Project::$entry_fee.' tickets para entrar no concurso de identificador '.$inputs['contest_id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $user->save();
        }else{
            \Session::flash('not-enough-tickets','Você não possui tickets suficientes para se inscrever');
            return redirect()->back();
        }

        $file = $request->file('art');

        $filename = $file->getFilename().'.'.$file->getClientOriginalExtension();
        $file->move('project_images',$filename);

        $inputs['filename'] = $filename;

        try{
            $project =  Project::create($inputs);
        }catch(QueryException $e){
            $user->tickets += Project::$entry_fee;

            \DB::table('user_ticket_log')->insert([
                'user_id' => $user->id,
                'message' => 'Restituição de '.Project::$entry_fee.' tickets por erro ao entrar no concurso de identificador '.$inputs['contest_id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $user->save();

            return response([ 'art' => ['Você já enviou uma arte para este concurso'] ],422);
        }

        return $project;
    }

    public function create(CreateRequest $request)
    {
        $inputs = $request->except('art','_token');

        $file = $request->file('art');

        $filename = $file->getFilename().'.'.$file->getClientOriginalExtension();
        $file->move('project_images',$filename);

        $inputs['filename'] = $filename;

        $project =  Project::create($inputs);

        return $project;
    }

    public function update(UpdateRequest $request, Project $project)
    {
        $inputs = $request->except('_token');

        if($request->hasFile('art')){
            $file = $request->file('art');

            $filename = $file->getFilename().'.'.$file->getClientOriginalExtension();
            $file->move('project_images',$filename);

            $inputs['filename'] = $filename;
        }

        $project->update($inputs);
    }

    public function approve(Request $request, Project $project)
    {
        $project->approve();

        return redirect()->action('AdminController@retrieveContest',['contest' => $project->contest->id]); //todo Temporary fix

        return $project;
    }

    public function refuse(Request $request, Project $project)
    {
        $project->refuse();

        return redirect()->action('AdminController@retrieveContest',['contest' => $project->contest->id]); //todo Temporary fix

        return $project;
    }

    //todo Remove daqui - acho que deveria estar em ContestController
    public function vote(Request $request, Project $project)
    {
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

    public function removeVote(Request $request, Project $project)
    {
        $user = \Auth::user();

        Vote::where([
            'user_id' => $user->id,
            'contest_id' => $project->contest->id
        ])->delete();

        if($request->ajax())
            return [];
        else
            return redirect()->back();
    }

    public function delete(Request $request, Project $project)
    {
        $project->delete();

        return redirect()->back();
    }
}
