@extends('layouts.admin')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel">
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
                        <label for="update-contest-begins_at">Começa em:</label>
                        <input type="datetime" name="begins_at" id="update-contest-begins_at" class="form-control" value="{{ $contest->begins_at }}">
                    </div>

                    <div class="form-group">
                        <label for="update-contest-ends_at">Termina em:</label>
                        <input type="datetime" name="ends_at" id="update-contest-ends_at" class="form-control" value="{{ $contest->ends_at }}">
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
                            <th>Status do Pagamento</th>
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
                                    @php($invoice = $project->invoices()->fromUser($project->author)->get()->first())
                                    <a href="{{ action('AdminController@retrieveInvoice',['invoice' => $invoice]) }}">
                                        {{ !is_null($invoice) ? $invoice->getStatus() : 'Sem Fatura' }}
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
                <table class="table table-hover">
                    <thead>
                        <th>Id</th>
                        <th>Autor</th>
                        <th>Arte</th>
                        <th>Status pagamento</th>
                        <th>Votos</th>
                        <th></th>
                    </thead>
                    <tbody>
                    @foreach($contest->projects()->where('approved',1)->get() as $project)
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
                                @php($invoice = $project->invoices()->fromUser($project->author)->get()->first())
                                <a href="{{ action('AdminController@retrieveInvoice',['invoice' => $invoice]) }}">
                                    {{ !is_null($invoice) ? $invoice->getStatus() : 'Sem Fatura' }}
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
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop