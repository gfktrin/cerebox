<?php

namespace Cerebox;

use Illuminate\Database\Eloquent\Model;
use Cerebox\Project;
use Cerebox\Register;

class Contest extends Model
{
    protected $table = 'contests';

    protected $guarded = [];

    protected $dates = [ 'registration_begins_at', 'begins_at', 'ends_at' , 'voting_ends_at' ];

    //Scope
    public function scopeSubmitOpen($query)
    {
        return $query->where('begins_at', '<=', date('Y-m-d H:i:s'))
                     ->where('ends_at', '>=', date('Y-m-d H:i:s'));
    }

    public function scopeOpen($query)
    {
        return $this->scopeRegistrationOpen($query);
    }

    public function scopeVotingOpen($query)
    {
        $date = date('Y-m-d H:i:s');
        return $query->where('ends_at','<=',$date)
                     ->where('voting_ends_at','>=',$date);
    }

    public function scopeRegistrationOpen($query){
        return $query->where('registration_begins_at', '<=', date('Y-m-d H:i:s'))
            ->where('begins_at', '>=', date('Y-m-d H:i:s'));
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

    public function registers(){
        return $this->hasMany(Register::class,'contest_id');
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

    public function leastVotedProjects($limit = 3,$exclude = [])
    {
        return $this->projects()->withCount('votes')->whereNotIn('id',$exclude)->get()->sortBy('votes_count')->take($limit);
    }

    public function isOpenForVoting()
    {
        $time = time();

        return $this->ends_at->timestamp <= $time && $this->voting_ends_at->timestamp >= $time;
    }

    public function isOpenForSubmit()
    {
        $time = time();

        return $this->begins_at->timestamp <= $time && $this->ends_at->timestamp >= $time && $this->projects->count() < $this->max_users;
    }

    public function finalizeContest($projects)
    {
        foreach ($projects as $project) {
            $project->savePosition();
        }

        $this->is_finalized = 1;

        $this->save();
    }
    public function isOpenForRegistration(){
        $time = time();

        return $this->registration_begins_at->timestamp <= $time && $this->begins_at->timestamp >= $time && $this->projects->count() < $this->max_users;
    }

    public function bestProjects($limit = 3,$exclude = []){
        $ranking = $this->projects()->get()->sortBy('position')->take($limit);
        return $ranking;
    }
}
