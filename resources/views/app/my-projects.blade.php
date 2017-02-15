@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <h4 class="panel-heading">Meus projetos</h4>
            <div class="panel-body">
                <h4>Envios Pendentes</h4>
                <table class="table table-hover">
                    <thead>
                    <th width="50%">Concurso</th>
                    <th width="20%">Arte</th>
                    <th width="20%">Status do Pagamento</th>
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
                        <th width="50%">Concurso</th>
                        <th width="15%">Arte</th>
                        <th width="10%">Votos</th>
                        <th width="15%">Colocação</th>
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
                            <td>
                                {{ $project->contest->ranking($project->id) }}º
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop