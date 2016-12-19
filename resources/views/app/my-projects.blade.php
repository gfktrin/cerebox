@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel">
            <h4 class="panel-heading">Meus projetos</h4>
            <div class="panel-body">
                @php($pending_projects = $projects->filter(function($item){ return !$item->approved ? $item : null; }))
                @if(count($pending_projects))
                    <h4>Pendentes</h4>
                    <table class="table table-hover">
                        <thead>
                            <th>Concurso</th>
                            <th>Arte</th>
                        </thead>
                        <tbody>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                @php($approved_projects = $projects->filter(function($item){ return $item->approved ? $item : null; }))
                <h4>Aprovados</h4>
                <table class="table table-hover">
                    <thead>
                        <th>Concurso</th>
                        <th>Arte</th>
                        <th>Votes</th>
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