@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2 contest">
        <h1>Concurso: {{ $contest->title }}</h1>

        <h4>Artes: </h4>

        <div class="row">
            @if(Auth::check() && Auth::user()->projects()->where('contest_id', $contest->id)->count() <= 0)
                <a href="{{ action('HomeController@submitProject', ['contest' => $contest]) }}"
                   class="btn btn-info btn-raised pull-right">
                    Enviar projeto
                </a>
            @endif
        </div>


        @foreach($contest->projects()->where('approved',1)->get() as $project)
            <div class="col-md-4">
                <div class="panel project-card">
                    <div class="panel-body">
                        <a href="{{ asset('project_images/'.$project->filename) }}"
                           data-lightbox="{{ $contest->id }}"
                           data-title="Autor: {{ $project->author->name }}">
                            <img src="{{ asset('project_images/'.$project->filename) }}">
                        </a>
                        <div class="caption">Autor: {{ $project->author->name }}</span>
                        <div class="votes">
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
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop