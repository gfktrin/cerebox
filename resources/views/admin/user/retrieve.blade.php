@extends('layouts.admin')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel">
            <h4 class="panel-heading">Usuário</h4>
            <div class="panel-body">
                <form action="{{ action('UserController@edit',['user' => $user]) }}"
                      data-redirect="{{ action('AdminController@retrieveUser', ['user' => $user]) }}"
                      class="form"
                      method="POST"
                      id="update-user">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="update-user-name" class="control-label">Nome:</label>
                        <input type="text" name="name" id="update-user-name" class="form-control" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="update-user-email" class="control-label">Email:</label>
                        <input type="text" name="email" id="update-user-email" class="form-control" value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <div class="togglebutton">
                            <label for="update-user-admin">
                                <input type="checkbox" name="admin" id="update-user-admin" value="1" @if($user->admin) checked @endif> Admin?
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <input type="submit" value="Salvar" class="btn btn-success pull-right">
                    </div>
                </form>
            </div>
        </div>

        <div class="panel">
            <h4 class="panel-heading">Projetos</h4>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Concurso</th>
                            <th>Arte</th>
                            <th>Status</th>
                            <th>Status do Pagamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($projects = $user->projects()->with('contest')->get())
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->contest->title }}</td>
                                <td>
                                    <a href="{{ asset('project_images/'.$project->filename) }}"
                                       data-lightbox="projects"
                                       data-title="{{ $project->author->name }}">
                                        <i class="material-icons">image</i>
                                    </a>
                                </td>
                                <td>{{ $project->getStatus() }}</td>
                                <td>
                                    @php($invoice = $user->invoices()->fromProject($project->author)->get()->first())
                                    <a href="{{ action('AdminController@retrieveInvoice',['invoice' => $invoice]) }}">
                                        {{ !is_null($invoice) ? $invoice->getStatus() : 'Sem Fatura' }}
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