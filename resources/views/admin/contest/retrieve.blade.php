@extends('layouts.admin')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <h4 class="panel-heading">Concurso</h4>
            <div class="panel-body">
                <form action="{{ action('ContestController@update',['contest' => $contest->id]) }}"
                      data-redirect="{{ action('AdminController@retrieveContest',['contest' => $contest->id]) }}"
                      class="form"
                      id="update-contest"
                      method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="update-contest-title" class="control-label">Título:</label>
                        <input type="text" name="title" id="update-contest-title" class="form-control" value="{{ $contest->title }}">
                    </div>

                    <div class="form-group">
                        <label for="update-contest-slug" class="control-label">URL</label>
                        <div class="input-group">
                            <span class="input-group-addon">{{ url('concurso') }}/</span>
                            <input type="text" name="slug" id="update-contest-slug" class="form-control" value="{{ $contest->slug }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="update-contest-description" class="control-label">Descrição</label>
                        <textarea class="form-control" id="update-contest-description" name="description" rows="5">{{ $contest->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="update-contest-max_users" class="control-label">Máximo de inscritos</label>
                        <input type="number" name="max_users" id="update-contest-max_users" class="form-control" value="{{ $contest->max_users }}">
                    </div>

                    <div class="form-group">
                        <label for="update-contest-begins_at">Começa em:</label>
                        <input type="datetime" name="begins_at" id="update-contest-begins_at" class="form-control" value="{{ $contest->begins_at }}">
                    </div>

                    <div class="form-group">
                        <label for="update-contest-ends_at">Envio de projetos termina em:</label>
                        <input type="datetime" name="ends_at" id="update-contest-ends_at" class="form-control" value="{{ $contest->ends_at }}">
                    </div>

                    <div class="form-group">
                        <label for="update-contest-voting_ends_at">Votação termina em:</label>
                        <input type="datetime" name="voting_ends_at" id="update-contest-voting_ends_at" class="form-control" value="{{ $contest->voting_ends_at }}">
                    </div>

                    <div class="form-group row">
                        <input type="submit" value="Salvar" class="btn btn-success pull-right">
                        <label for="delete-contest-submit"
                               class="btn btn-danger btn-raised pull-left"
                               onclick="return confirm('Você realmente deseja apagar esse concurso?')">
                            Apagar Concurso
                        </label>
                    </div>

                </form>
                <form action="{{ action('ContestController@delete',['contest' => $contest]) }}"
                      data-redirect="{{ action('AdminController@contests') }}"
                      method="POST"
                      class="hidden"
                      id="delete-contest">
                    {{ csrf_field() }}
                    <input type="submit" value="Deletar" id="delete-contest-submit">
                </form>
            </div>
        </div>

        <div class="panel">
            <h4 class="panel-heading">Projetos</h4>
            <div class="panel-body">
                @if(count($pending_projects) > 0)
                    <h4>Pendentes</h4>
                    <table class="table table-hover">
                        <thead>
                            <th>Id</th>
                            <th>Autor</th>
                            <th>Arte</th>
                            <th></th>
                        </thead>
                        <tbody>
                        @foreach($contest->projects()->where('approved',0)->with('votes')->get() as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>
                                    <a href="{{ action('AdminController@retrieveUser', ['user' => $project->author->id]) }}">
                                        {{ $project->author->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ asset('project_images/'.$project->filename) }}"
                                       data-lightbox="pending_projects"
                                       data-title="{{ $project->author->name }}">
                                        <i class="material-icons">image</i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ action('ProjectController@approve', ['project' => $project->id]) }}"
                                       class="btn btn-raised btn-success btn-sm">
                                        <i class="material-icons">done</i>
                                    </a>
                                    <a href="{{ action('ProjectController@refuse', ['project' => $project->id]) }}"
                                       class="btn btn-raised btn-danger btn-sm">
                                        <i class="material-icons">clear</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                <h4>Aprovados</h4>
                @if($contest->voting_ends_at < new \DateTime() && $contest->is_finalized == 0)
                    <div class="center-block">
                        <a href="{{ action('AdminController@makePositions', ['contest' => $contest->id] )}}" class="btn btn-primary btn-raised">Computar Votação</a>
                    </div>
                @endif
                <table class="table table-hover">
                    <thead>
                        <th>Id</th>
                        <th>Autor</th>
                        <th>Arte</th>
                        <th>Votos</th>
                        <th></th>
                        <th>Posição</th>
                    </thead>
                    <tbody>
                    @foreach($contest->projects()->where('approved',1)->get()->sortBy('position') as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>
                                <a href="{{ action('AdminController@retrieveUser', ['user' => $project->author->id]) }}">
                                    {{ $project->author->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ asset('project_images/'.$project->filename) }}"
                                   data-lightbox="approved_projects"
                                   data-title="{{ $project->author->name }}">
                                    <i class="material-icons">image</i>
                                </a>
                            </td>

                            <td>
                                {{ $project->votes->count() }}
                            </td>

                            <td>
                                <a href="{{ action('ProjectController@delete',['project' => $project]) }}" class="btn btn-raised btn-danger" title="Remover Projeto">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                            <td>
                                {{ $project->position }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop