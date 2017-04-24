<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Contest;
use Cerebox\Http\Requests\Contest\CreateRequest;
use Cerebox\Http\Requests\Contest\UpdateRequest;
use Cerebox\VoteCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Cerebox\Http\Requests\Contest\EnterRequest;
use Illuminate\Database\QueryException;
use Cerebox\Register;
use Illuminate\Support\Facades\Redirect;

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

    public function rankingSpreadSheet(Contest $contest)
    {
        $vote_categories = VoteCategory::all();

        $projects = $contest->projects()->with([
            'votes' => function($query){
                $query->where('valid',1)->with('grades');
            }
        ])->get();

        $results = new Collection();

        foreach($projects as $project){
            $project_result = [
                'project_id' => $project->id
            ];
            foreach($vote_categories as $vote_category){
                $project_result[$vote_category->id] = $project->getAverage($vote_category);
            }

            $results->add($project_result);
        }

        dd($results);
    }

    public function enterContest(EnterRequest $request)
    {

        $inputs = $request->except('_token');
        $contest = Contest::find($inputs['contest_id']);

        if(!$contest->isOpenForRegistration())
            return response('Concurso Lotado ou fechado para envio de projeto',403);

        $user = \Auth::user();

        $user->tickets -= Register::$entry_fee;

        //Tem q colocar essa lógica num lugar melhor
        if($user->tickets >= 0){
            \DB::table('user_ticket_log')->insert([
                'user_id' => $user->id,
                'message' => 'Usuário gastou '.Register::$entry_fee.' tickets para entrar no concurso de identificador '.$inputs['contest_id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $user->save();
        }else{
            \Session::flash('not-enough-tickets','Você não possui tickets suficientes para se inscrever');
            return redirect()->back();
        }


        try{
            $register =  Register::create($inputs);
        }catch(QueryException $e){
            $user->tickets += Register::$entry_fee;

            \DB::table('user_ticket_log')->insert([
                'user_id' => $user->id,
                'message' => 'Restituição de '.Register::$entry_fee.' tickets por erro ao entrar no concurso de identificador '.$inputs['contest_id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $user->save();

            //return response($e);
            return response('Falha ao tentar se inscrever.' ,422);
        }

        //return $register;

        return Redirect::back();

    }
}
