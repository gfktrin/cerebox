@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel">
            <h4 class="panel-heading">Meus projetos</h4>
            <div class="panel-body">
                <h4>Envios Pendentes</h4>
                <table class="table table-hover">
                    <thead>
                    <th>Concurso</th>
                    <th>Arte</th>
                    <th>Status do Pagamento</th>
                    </thead>

                    <tbody>
                        @php($pending_projects = $projects->filter(function($item){ return !$item->approved ? $item : null; }))
                        @if(count($pending_projects))
                            @foreach($pending_projects as $project)
                                <tr>
                                    <td>{{ $project->contest->title }}</td>
                                    <td>
                                        <a href="{{ asset('project_images/'.$project->filename) }}"
                                           data-lightbox="{{ $project->filename }}"
                                           data-title="{{ $project->contest->title }}">
                                            <i class="material-icons">image</i>
                                        </a>
                                    </td>
                                    <td>
                                        @php($invoice = $project->invoices()->fromUser(Auth::user()->id)->get()->first())
                                        @if(!is_null($invoice))
                                            {{ $invoice->getStatus() }}
                                            @if($invoice->status == 0)
                                                <a href="{{ $invoice->paymentUrl() }}" title="Efetuar pagamento">
                                                    <i class="material-icons">payment</i>
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                @php($approved_projects = $projects->filter(function($item){ return $item->approved ? $item : null; }))
                <h4>Aprovados</h4>
                <table class="table table-hover">
                    <thead>
                        <th>Concurso</th>
                        <th>Arte</th>
                        <th>Votos</th>
                    </thead>
                    <tbody>
                    @foreach($approved_projects as $project)
                        <tr>
                            <td>{{ $project->contest->title }}</td>
                            <td>
                                <a href="{{ asset('project_images/'.$project->filename) }}"
                                   data-lightbox="{{ $project->filename }}"
                                   data-title="{{ $project->contest->title }}">
                                    <i class="material-icons">image</i>
                                </a>
                            </td>
                            <td>{{ $project->votes->count() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop