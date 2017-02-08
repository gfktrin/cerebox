@extends('layouts.admin')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Fatura</h4>
            </div>
            
            <div class="panel-body">
                <div>
                    <a href="{{ action('InvoiceController@updateStatus',['invoice' => $invoice]) }}"
                       class="btn btn-raised btn-primary pull-right">
                        Sincronizar com Meio de Pagamento
                    </a>
                    <div class="clearfix"></div>
                </div>
                <form action="{{ action('InvoiceController@update',['invoice' => $invoice]) }}"
                      class="form"
                      id="update-invoice"
                      method="post">
                    <div class="form-group">
                        <label for="update-invoice-id" class="control-label">Identificador</label>
                        <input type="text" id="update-invoice-id" name="id" class="form-control" value="{{ $invoice->id }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="update-invoice-code" class="control-label">Código</label>
                        <input type="text" id="update-invoice-code" name="code" class="form-control" value="{{ $invoice->code }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="update-invoice-user-id" class="control-label">Usuário</label>
                        <input type="text" id="update-invoice-user-id" class="form-control" value="{{ $invoice->user->name }}" disabled>
                        <input type="hidden" name="user_id" value="{{ $invoice->user->id }}" disabled>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label for="update-invoice-project-id" class="control-label">Projeto</label>--}}
                        {{--<input type="text" id="update-invoice-project-id" class="form-control" value="{{ $invoice->project->title }}" disabled>--}}
                        {{--<input type="hidden" name="project_id" value="{{ $invoice->project->id }}" disabled>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <label for="update-invoice-created_at" class="control-label">Criada em</label>
                        <input type="text" id="update-invoice-created_at" class="form-control" value="{{ $invoice->created_at->format('H:i:s d/m/Y') }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="update-invoice-transaction_id" class="control-label">Identificador da Transação</label>
                        <input type="text" id="update-invoice-transaction_id" name="transaction_id" class="form-control" value="{{ $invoice->transaction_id }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="update-invoice-status" class="control-label">Status</label>
                        <select name="status" id="update-invoice-status" class="form-control" disabled>
                            @foreach(\Cerebox\Invoice::$status as $key => $status)
                                <option value="{{ $key }}" @if($key == $invoice->status) selected @endif>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="update-invoice-payment_method" class="control-label">Método de Pagamento</label>
                        <select name="payment_method" id="update-invoice-payment_method" class="form-control" disabled>
                            @foreach(\Cerebox\Invoice::$payment_methods as $key => $payment_method)
                                <option value="{{ $key }}" @if($key == $invoice->payment_method) selected @endif>{{ $payment_method }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="update-invoice-amount" class="control-label">Valor</label>
                        <input type="text" id="update-invoice-amount" name="amount" class="form-control" value="{{ $invoice->amount }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="update-invoice-net_amount" class="control-label">Valor Líquido</label>
                        <input type="text" id="update-invoice-net_amount" name="net_amount" class="form-control" value="{{ $invoice->net_amount }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="update-invoice-payed_at" class="control-label">Pago em</label>
                        <input type="text" id="update-invoice-payed_at" name="payed_at" class="form-control" value="{{ !is_null($invoice->payed_at) ? $invoice->payed_at : 'Não foi paga ainda' }}" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop