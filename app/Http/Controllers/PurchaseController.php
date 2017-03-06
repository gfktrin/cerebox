<?php

namespace Cerebox\Http\Controllers;

use Cerebox\Http\Requests\Purchase\CreateRequest;
use Cerebox\Invoice;
use Cerebox\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function create(CreateRequest $request)
    {
    	$inputs = $request->except('_token');

    	$purchase = Purchase::create([
    		'user_id' => $inputs['user_id']
		]);

    	foreach($inputs['products'] as $product){
    		$purchase->products()->attach($product['id'],[ 'quantity' => $product['quantity'] ]);
    	}

    	$invoice = Invoice::create([
    		'amount' => $purchase->getAmount()
		]);

		$purchase->invoice()->associate($invoice);

		$purchase->save();

		return redirect()->action('InvoiceController@pay',['invoice' => $invoice]);

		// return $purchase;
    }

    public function pay(Purchase $purchase)
    {
    	return $purchase->pay();
    }
}
