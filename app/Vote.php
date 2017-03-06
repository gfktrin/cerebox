<?php

namespace Cerebox;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'users_projects_votes';

    protected $guarded = [];

    //Relationships
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class, 'contest_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
