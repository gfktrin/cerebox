@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2 contest">
        <h1 class="text-primary">Concurso: {{ $contest->title }}</h1>

        <h4 class="text-primary">Artes: </h4>

        <div class="row">
            @if(Auth::guest() || Auth::user()->projects()->where('contest_id', $contest->id)->count() <= 0)
                @if(Auth::user()->tickets >= Cerebox\Project::$entry_fee)
                    <a href="{{ action('HomeController@submitProject', ['contest' => $contest]) }}"
                       class="btn btn-primary btn-raised pull-right">
                        Enviar projeto
                    </a>
                @else
                    <a href="{{ action('HomeController@acquireTickets') }}" class="btn btn-primary pull-right">
                        Você não possui tickets suficientes para entrar no concurso
                    </a>
                @endif
            @endif 
        </div>


        @foreach($contest->projects()->where('approved',1)->get() as $project)
            <div class="col-md-4">
                <div class="panel project-card">
                    <div class="panel-body">
                        <a href="{{ asset('project_images/'.$project->filename) }}"
                           data-lightbox="{{ $contest->id }}"
                           data-title="{{ $project->author->nickname or $project->author->name }}">
                            <img src="{{ asset('project_images/'.$project->filename) }}">
                        </a>
                        <div class="caption">{{ $project->author->nickname or $project->author->name }}</span>
                        <!--<div class="votes">
                            @if(!is_null($vote) && $vote->project_id == $project->id)
                                <a href="{{ action('ProjectController@removeVote',['project' => $project]) }}" disabled>
                                    <i class="material-icons active">favorite</i>
                                </a>
                            @else
                                <a href="{{ action('ProjectController@vote',['project' => $project]) }}">
                                    <i class="material-icons">favorite</i>
                                </a>
                            @endif
                            </a>
                            {{ $project->votes->count() }}
                        </div>-->
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop