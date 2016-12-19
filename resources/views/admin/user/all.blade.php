@extends('layouts.admin')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <h4 class="panel-heading">Usuário</h4>
            <div class="panel-body">
                <table class="table table-responsive table-hover">
                    <thead>
                        <th>Identificador</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Admin?</th>
                        <th></th>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->admin ? 'Sim' : 'Não' }}</td>
                            <td>
                                <a href="{{ action('AdminController@retrieveUser', ['user' => $user]) }}" class="btn btn-sm">
                                    <i class="material-icons">edit</i>
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