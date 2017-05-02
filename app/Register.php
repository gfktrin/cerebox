<?php

namespace Cerebox;

use Cerebox\Grade;
use Cerebox\VoteCategory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'registers';

    protected $guarded = [];

    public static $entry_fee = 1; //How many tickets to pay for an project entry
    //Relationships

    public function contest()
    {
        return $this->belongsTo(Contest::class, 'contest_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
