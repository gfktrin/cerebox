<?php

namespace Cerebox;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $table = 'contests';

    protected $guarded = [ ];

    protected $dates = [ 'begins_at', 'ends_at' , 'voting_ends_at' ];

    //Scope
    public function scopeSubmitOpen($query)
    {
        return $query->where('begins_at', '<=', date('Y-m-d H:i:s'))
                     ->where('ends_at', '>=', date('Y-m-d H:i:s'));
    }

    public function scopeOpen($query)
    {
        return $this->scopeSubmitOpen($query);
    }

    public function scopeVotingOpen($query)
    {
        $date = date('Y-m-d H:i:s');
        return $query->where('ends_at','<=',$date)
                     ->where('voting_ends_at','>=',$date);
    }

    //Relationships
    public function projects()
    {
        return $this->hasMany(Project::class,'contest_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'contest_id');
    }

    public function ranking($project_id = null)
    {
        $projects = $this->projects()->withCount('votes')->get();
        
        $ranking = array_flip($projects->sortByDesc('votes_count')->pluck('id')->all());

        foreach($ranking as $key => $place){
            $ranking[$key] += 1;
        }

        return is_null($project_id) ? $ranking : $ranking[$project_id];
    }

    public function leastVotedProjects($limit = 3)
    {
        return $this->projects()->withCount('votes')->get()->sortBy('votes_count')->take($limit);
    }
}
