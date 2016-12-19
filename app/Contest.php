<?php

namespace Cerebox;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $table = 'contests';

    protected $guarded = [ ];

    protected $dates = [ 'begins_at', 'ends_at' ];

    //Relationships
    public function projects(){
        return $this->hasMany(Project::class,'contest_id');
    }

    public function votes(){
        return $this->hasMany(Vote::class, 'contest_id');
    }
}
