@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2 contest">
        <h1 class="text-primary">Concurso: {{ $contest->title }}</h1>

        @if($need_to_validate_vote)
            <h2 class="text-primary">Você deve validar seu voto. Vote em um desses projetos:</h2>
            @foreach($contest->leastVotedProjects(3,$votes->pluck('project_id')) as $project)
                <div class="col-md-4">
                    <div class="panel project-card">
                        <div class="panel-body text-center">
                            @if(Auth::check() && $contest->isOpenForVoting())
                                <a href="#voting-modal" 
                                   data-id="{{ $project->id }}" 
                                   data-author="{{ $project->author->nickname or $project->author->name }}"
                                   data-description="{{ $project->description }}"
                                   data-toggle="modal">
                                    <img src="{{ asset('project_images/'.$project->filename) }}">
                                </a>
                            @else
                                <a  href="{{ asset('project_images/'.$project->filename) }}"
                                    data-lightbox="{{ $contest->id }}"
                                    data-title="{{ $project->author->nickname or $project->author->name}}">
                                    <img src="{{ asset('project_images/'.$project->filename) }}">
                                </a>
                            @endif      
                            {{-- <a href="{{ asset('project_images/'.$project->filename) }}"
                               data-lightbox="{{ $contest->id }}"
                               data-title="{{ $project->author->nickname or $project->author->name}}">
                                <img src="{{ asset('project_images/'.$project->filename) }}">
                            </a> --}}
                            <div class="caption">{{ $project->author->nickname or $project->author->name }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>{{ $contest->description }}</p>
            <div class="row steps">
                @if($contest->ends_at->getTimestamp() >= time())
                    <div class="col-xs-4 active">
                        Envio de arte <b>( até {{ $contest->ends_at->format('d/m/Y') }})</b>
                    </div>
                @else
                    <div class="col-xs-4">Envio de arte</div>
                @endif
                @if($contest->ends_at->getTimestamp() <= time() && $contest->voting_ends_at->getTimestamp() >= time())
                    <div class="col-xs-4 active">
                        Votação <b>( até {{ $contest->voting_ends_at->format('d/m/Y') }}</b>
                    </div>
                @else
                    <div class="col-xs-4">
                        Votação
                    </div>
                @endif
                <div class="col-xs-4">Apuração</div>
            </div>
            <h4 class="text-primary">Artes: </h4>

            <div class="row">
                @if($contest->isOpenForSubmit() && Auth::check() && Auth::user()->projects()->where('contest_id', $contest->id)->count() <= 0)
                    @if(Auth::user()->tickets >= Cerebox\Project::$entry_fee)
                        <a href="{{ action('HomeController@submitProject', ['contest' => $contest]) }}"
                           class="btn btn-primary btn-raised pull-right">
                            Enviar projeto
                        </a>
                        <p class="pull-right text-primary" style="margin-right:10px;margin-top:15px;">
                            {{ $contest->projects->count() }} inscritos de {{ $contest->max_users }} vagas
                        </p>
                    @else
                        @if($contest->projects->count() >= $contest->max_users)
                            <button type="button" disabled class="btn btn-primary pull-right">Concurso lotado</button>
                        @else
                            <a href="{{ action('HomeController@acquireTickets') }}" class="btn btn-primary pull-right">
                                Você não possui tickets suficientes para entrar no concurso
                            </a>
                        @endif
                    @endif
                @endif 
            </div>

            @foreach($contest->projects()->where('approved',1)->get() as $project)
                <div class="col-md-4">
                    <div class="panel project-card">
                        <div class="panel-body text-center">
                            @if(Auth::check() && $contest->isOpenForVoting())
                                <a href="#voting-modal" 
                                   data-id="{{ $project->id }}" 
                                   data-author="{{ $project->author->nickname or $project->author->name }}"
                                   data-description="{{ $project->description }}"
                                   data-toggle="modal">
                                    <img src="{{ asset('project_images/'.$project->filename) }}">
                                </a>
                            @else
                                <a  href="{{ asset('project_images/'.$project->filename) }}"
                                    data-lightbox="{{ $contest->id }}"
                                    data-title="{{ $project->author->nickname or $project->author->name}}">
                                    <img src="{{ asset('project_images/'.$project->filename) }}">
                                </a>
                            @endif      
                            {{-- <a href="{{ asset('project_images/'.$project->filename) }}"
                               data-lightbox="{{ $contest->id }}"
                               data-title="{{ $project->author->nickname or $project->author->name}}">
                                <img src="{{ asset('project_images/'.$project->filename) }}">
                            </a> --}}
                            <div class="caption">{{ $project->author->nickname or $project->author->name }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@stop

@include('app.components.voting_modal')