<?php

namespace Cerebox;

use Cerebox\Invoice;
use Cerebox\Product;
use Cerebox\User;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';

    protected $fillable = [ 'user_id' ];

    protected $guarded = [  ];

    protected $amount = false;

    //Relationships
    public function products()
    {
    	return $this->belongsToMany(Product::class,'purchase_product','purchase_id','product_id')->withPivot(['quantity']);
    }

    public function invoice()
    {
    	return $this->belongsTo(Invoice::class,'invoice_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class,'user_id');
    }



    public function pay()
    {
    	$this->invoice->pay();
    }

    public function getAmount()
    {
    	if($this->amount !== false)
    		return $this->amount;

    	$amount = 0;

    	if(count($this->products) > 0){
    		foreach($this->products as $product){
    			$amount += $product->price * $product->pivot->quantity;
    		}
    	}

    	$this->amount = $amount;

    	return $amount;
    }

    public function approved(){
    	$tickets = $this->products()->where('name','Ticket')->get()->first();

    	if(!is_null($tickets)){
    		\DB::table('user_ticket_log')->insert([
    			'user_id' => $this->user->id,
    			'message' => 'Adicionando '.$tickets->pivot->quantity.' tickets devido a compra de identificador '.$this->id,
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => date('Y-m-d H:i:s')
			]);
    		$this->user->tickets += $tickets->pivot->quantity;

            \DB::table('users')->->where('id', $this->user->id)->increment('tickets', $tickets->pivot->quantity);
    	}
    }

   //  public function getAmountAttribute()
   //  {
   //  	if(!isset($this->attributes['amount'])){
			// $this->attributes['amount'] = $this->getAmount();    		
   //  	}

   //  	return $this->attributes['amount'];
   //  }
}
