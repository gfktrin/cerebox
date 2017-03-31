<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Grade;
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
        $inputs = $request->except('art','multiplier','_token');

        $contest = Contest::find($inputs['contest_id']);

        if(!$contest->isOpenForSubmit())
            return response('Concurso Lotado ou fechado para envio de projeto',403);

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

            dd($e);

            return response([ 'art' => ['Você já enviou uma arte para este concurso'] ],422);
        }

        $multipliers = $request->get('multiplier');

        foreach($multipliers as $vote_category_id => $multiplier){
            $project->setMultiplier($vote_category_id,$multiplier);
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
    public function vote(Request $request)
    {
        //Check if user distributed correctly all the points
        $grades = $request->get('category_grade');

        $total_points = 0;
        foreach($grades as $grade){
            $total_points += $grade;
        }

        if($total_points != 15){
            if($total_points > 15)
                return response([ 'alert' => ['O máximo de pontos para distruibuir é 15'] ],422);
            else
                return response([ 'alert' => ['Você não distruibui todos os pontos'] ],422);
        }

        //Initializing variables
        $user = \Auth::user();
        $project = Project::find($request->get('project_id'));

        //Check if contest is open for voting
        $contest = $project->contest;
        
        if(!$contest->isOpenForVoting())
            return response([ 'alert' => ['Projeto não está aberto para votação'] ],422);

        //Checking if user already voted on this project
        $previous_vote = Vote::where([
            'user_id' => $user->id,
            'project_id' => $project->id
        ])->get();

        if($previous_vote->count() > 0)
            return response([ 'alert' => ['Você ja tem um voto cadastrado nesse papel'] ],422);

        //Save votes and grades
        $inputs = [
            'project_id' => $project->id,
            'user_id' => $user->id,
            'valid' => false,
        ];

        $vote = Vote::create($inputs);

        $grades_to_save =  [];

        foreach($grades as $vote_category_id => $grade){
            $grades_to_save[] = new Grade(['vote_category_id' => $vote_category_id, 'grade' => $grade]);
        }

        $vote->grades()->saveMany($grades_to_save);

        //Check if this is a valid vote
        $votes_on_contest = Vote::where('user_id',$user->id)
                                ->whereIn('project_id',$contest->projects->pluck('id'))
                                ->count();

        if($votes_on_contest >= 2)
            Vote::where('user_id',$user->id)
                ->whereIn('project_id',$contest->projects->pluck('id'))
                ->update(['valid' => true]);

        if($request->ajax())
            return response([
                'numberOfVotes' => $votes_on_contest,
                'vote' => $vote
            ]);
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
