@extends('layouts.app')

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				Adquirir Tickets
			</div>
			<div class="panel-body">
				Meus Tickets: {{ $user->tickets or 0 }}

				<form class="form" 
					  method="POST"
					  id="acquire-tickets-form" 
					  action="{{ action('PurchaseController@create') }}">
					  
					{{ csrf_field() }}
				  	<input type="hidden" name="products[0][id]" value="{{ $product->id }}">
					<input type="hidden" name="product_price" readonly disabled value="{{ $product->price }}">
					<input type="hidden" name="user_id" value="{{ $user->id }}">
					
					<div class="form-group @if($errors->has('products.0.quantity')) has-error @endif">
						<label class="col-md-6 control-label">Quantidade de tickets</label>
						<div class="input-group col-md-6">
							<input class="form-control" type="number" name="products[0][quantity]" value="1">
							@if($errors->has('products.0.quantity'))
								<div class="help-block">
									<strong>{{ $errors->first('products.0.quantity') }}</strong>
								</div>
							@endif	
						</div>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-success btn-raised pull-right">
							Comprar: R$<span class="amount">0</span>
						</button>
						<div class="clearfix"></div>
					</div>

			  	</form>
			</div>
		</div>
	</div>
@stop