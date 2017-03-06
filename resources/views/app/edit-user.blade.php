@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Perfil</div>

                    <div class="panel-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        <form action="{{ action('UserController@edit',['user' => $user->id]) }}"
                              data-redirect="{{ action('HomeController@editUser') }}"
                              class="form form-horizontal"
                              id="update-user"
                              method="POST">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="edit-user-name" class="col-md-4 control-label">Nome</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" id="edit-user-name" class="form-control" value="{{ old('name',$user->name) }}">
                                    @if($errors->has('name'))
                                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="edit-user-email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input type="text" name="email" id="edit-user-email" class="form-control" value="{{ old('email',$user->email) }}">
                                    @if($errors->has('email'))
                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                                <label for="nickname" class="col-md-4 control-label">Apelido</label>

                                <div class="col-md-6">
                                    <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname',$user->nickname) }}" required>

                                    @if ($errors->has('nickname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nickname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Telefone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone',$user->phone) }}" data-mask="(00)0000-00009" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                <label for="state" class="control-label">Estado</label>

                                <select class="form-control" name="state" required id="state">
                                    <option>Escolha...</option>
                                    @foreach(Cerebox\State::all()->sortBy('name') as $state)
                                        @if(!is_null($user->city))
                                            <option value="{{ $state->id }}" @if(old('state',$user->city->state->id) == $state->id) selected @endif >{{ $state->name }}</option>
                                        @else   
                                            <option value="{{ $state->id }}" @if(old('state') == $state->id) selected @endif >{{ $state->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="control-label">Cidade</label>
                                
                                <select name="city_id" id="city" class="form-control" required>
                                    <option>Escolha...</option>
                                    @if(!is_null($user->city))
                                        @if(old('state',$user->city->state->id))
                                            @foreach(Cerebox\State::find(old('state',$user->city->state->id))->cities as $city)
                                                <option value="{{ $city->id }}" @if(old('city_id',$user->city->id) == $city->id) selected @endif>{{ $city->name }}</option>
                                            @endforeach
                                        @endif
                                    @else   
                                        @if(old('state'))
                                            @foreach(Cerebox\State::find(old('state'))->cities as $city)
                                                <option value="{{ $city->id }}" @if(old('city_id') == $city->id) selected @endif>{{ $city->name }}</option>
                                            @endforeach
                                        @endif
                                    @endif
                                </select>

                                @if ($errors->has('city_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">                            
                                    <input type="submit" value="Salvar" class="btn btn-success pull-right">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop