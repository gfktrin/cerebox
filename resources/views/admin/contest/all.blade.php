@extends('layouts.admin')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel">
            <h4 class="panel-heading">Concursos</h4>
            <div class="panel-body">
                <div class="pull-right">
                    <a href="{{ action('AdminController@createContest') }}" class="btn btn-info btn-raised">Criar concurso</a>
                </div>
                <table class="table table-hover table-responsive">
                    <thead>
                    <th>ID</th>
                    <th>Título</th>
                    <th>URL</th>
                    <th>Começa em</th>
                    <th>Termina em</th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($contests as $contest)
                        <tr>
                            <td>{{ $contest->id }}</td>
                            <td>{{ $contest->title }}</td>
                            <td><a href="{{ url("concurso/$contest->slug") }}">{{ url("concurso/$contest->slug") }}</a></td>
                            <td>{{ $contest->begins_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $contest->ends_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ action('AdminController@retrieveContest',['contest' => $contest->id]) }}" class="btn btn-sm">
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