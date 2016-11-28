@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <form action="{{ action('UserController@edit') }}" class="form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="edit-user-name" class="control-label">Nome</label>
                                <input type="text" name="name" id="edit-user-name" class="form-control" value="{{ old('name',$user->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="edit-user-email" class="control-label">Email</label>
                                <input type="text" name="email" id="edit-user-email" class="form-control" value="{{ old('email',$user->email) }}">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Salvar" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop