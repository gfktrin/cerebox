<?php

namespace Cerebox;

use Cerebox\Grade;
use Cerebox\VoteCategory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';

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

    public function grades()
    {
        return $this->hasMany(Grade::class,'vote_id','id');
    }


    public function scopeValid($query)
    {
        return $query->where('valid',1);
    }

}
