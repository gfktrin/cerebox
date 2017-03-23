<?php

namespace Cerebox;

use Cerebox\Vote;
use Cerebox\VoteCategory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades';

    protected $guarded = [];

    public function vote()
    {
    	return $this->belongsTo(Vote::class,'vote_id','id');
    }

    public function vote_category()
    {
    	return $this->belongsTo(VoteCategory::class,'vote_category_id','id');
    }

    public function scopeCategory($query,$vote_category)
    {
    	if($vote_category instanceof VoteCategory)
    		$vote_category = $vote_category->id;

    	return $query->where('vote_category_id',$vote_category);
    }
}
