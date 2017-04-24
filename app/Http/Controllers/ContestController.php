<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Contest;
use Cerebox\Http\Requests\Contest\CreateRequest;
use Cerebox\Http\Requests\Contest\UpdateRequest;
use Cerebox\VoteCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function create(CreateRequest $request){
        $inputs = $request->except('_token');
        $inputs['themes'] = implode(",", $inputs['themes']);

        $contest = Contest::create($inputs);

        return $contest;
    }

    public function update(UpdateRequest $request, Contest $contest){
        $inputs = $request->except('_token');
        $inputs['themes'] = implode(",", $inputs['themes']);

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
}
