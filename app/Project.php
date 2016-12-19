<?php

namespace Cerebox;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

    protected $guarded = [];

    public function author(){
        return $this->belongsTo(User::class,'author_id');
    }

    public function contest(){
        return $this->belongsTo(Contest::class,'contest_id');
    }

    public function votes(){
        return $this->hasMany(Vote::class, 'project_id');
    }

    public function approve(){
        $this->approved = 1;
        $this->save();
    }

    public function refuse(){
        $this->delete();
    }
}
