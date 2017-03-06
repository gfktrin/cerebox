@extends('layouts.admin')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        	<div class="panel-heading">
        		Compras
        	</div>
        	<div class="panel-body">
        		<table class="table table-hover">
        			<thead>
        				<th>Identificador</th>
        				<th>Usuário</th>
        				<th>Quantidade de tickets</th>
        				<th>Status da fatura</th>
        			</thead>
        			<tbody>
        				@foreach($purchases as $purchase)
        					<tr>
        						<td>{{ $purchase->id }}</td>
        						<td>
        							<a href="{{ action('AdminController@retrieveUser',['user' => $purchase->user]) }}">{{ $purchase->user->name }}</a>
        						</td>
        						<td>
        							{{ $purchase->products->first()->pivot->quantity }}
        						</td>
        						<td>
        							@if(!is_null($purchase->invoice))
	        							<a href="{{ action('AdminController@retrieveInvoice',['invoice' => $purchase->invoice]) }}">
	        								{{ $purchase->invoice->getStatus() }}
	        							</a>
    								@else
    									Sem fatura
									@endif
        						</td>
        					</tr>
        				@endforeach
        			</tbody>
        		</table>
        	</div>
        </div>
    </div>
@stop	