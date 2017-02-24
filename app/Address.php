<?php

namespace Cerebox;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
    	'user_id', 'zipcode', 'address', 'number', 'complement', 'neighborhood', 'city', 'state'
    ];
}
