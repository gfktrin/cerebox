<?php

namespace Cerebox;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $guarded = [];

    protected $softDeletes = true;

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
