<?php

namespace Cerebox;

use Cerebox\Vote;
use Illuminate\Database\Eloquent\Model;

class VoteCategory extends Model
{
    protected $table = 'vote_categories';

    public $timestamps = false;

    public function grades()
    {
    	return $this->hasMany(VoteCategory::class,'vote_category_id','id');
    }
}
