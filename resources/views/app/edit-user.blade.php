@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        <form action="{{ action('UserController@edit',['user' => $user->id]) }}"
                              data-redirect="{{ action('HomeController@editUser') }}"
                              class="form"
                              id="update-user"
                              method="POST">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="edit-user-name" class="control-label">Nome</label>
                                <input type="text" name="name" id="edit-user-name" class="form-control" value="{{ old('name',$user->name) }}">
                                @if($errors->has('name'))
                                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="edit-user-email" class="control-label">Email</label>
                                <input type="text" name="email" id="edit-user-email" class="form-control" value="{{ old('email',$user->email) }}">
                                @if($errors->has('email'))
                                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group pull-right">
                                <input type="submit" value="Salvar" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop