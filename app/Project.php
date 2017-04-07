<?php

namespace Cerebox;

use Cerebox\Grade;
use Cerebox\Purchase;
use Cerebox\Vote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

    protected $guarded = [];

    public static $entry_fee = 1; //How many tickets to pay for an project entry

    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class,'contest_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'project_id');
    }

    public function grades()
    {
        return $this->hasManyThrough(Grade::class,Vote::class);
    }

    public function multipliers()
    {
        return \DB::table('project_vote_categories_multipliers')->where('project_id',$this->id)->get();
    }

    public function getMultiplier($vote_category)
    {
        if($vote_category instanceof Cerebox\VoteCategory)
            $vote_category = $vote_category->id;

        $multiplier = \DB::table('project_vote_categories_multipliers')->select('multiplier')->where([
            'project_id' => $this->id,
            'vote_category_id' => $vote_category
        ])->get()->first();

        return $multiplier->multiplier;
    }

    public function setMultiplier($vote_category,$multiplier)
    {
        if($vote_category instanceof Cerebox\VoteCategory)
            $vote_category = $vote_category->id;

        return \DB::table('project_vote_categories_multipliers')->insert([
            'project_id' => $this->id,
            'vote_category_id' => $vote_category,
            'multiplier' => $multiplier
        ]); 
    }

    public function approve()
    {
        $this->approved = 1;
        $this->save();
    }

    public function refuse()
    {
        $this->delete();
    }

    public function getStatus()
    {
        if($this->approved){
            return  'aprovado';
        }else{
            if(is_null($this->deleted_at)){
                return 'pendente';
            }else{
                return 'recusado';
            }
        }
    }

    public function getAverage($vote_category)
    {

        $valid_votes_id = $this->votes->where('valid', 1)->pluck('id')->toArray();

        $valid_grades = $this->grades->whereIn('vote_id', $valid_votes_id);

        $sum = $this->grades->where('vote_category_id', $vote_category)->average('grade');

        $multiplier = $this->getMultiplier($vote_category);
        
        return $sum * $multiplier;
    }
}
