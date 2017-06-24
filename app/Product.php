<?php

namespace Cerebox;

use Cerebox\Purchase;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $guarded = [ 'id' ];

    //Relationships
    public function purchases()
    {
    	return $this->belongsToMany(Purchase::class,'purchase_product','product_id','purchase_id')->withPivot(['quantity']);
    }

}
