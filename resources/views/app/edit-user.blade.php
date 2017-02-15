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

                            <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                <label for="zipcode" class="col-md-4 control-label">CEP</label>

                                <div class="col-md-6">
                                    <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ old('zipcode',isset($user->address->zipcode) ? $user->address->zipcode : '' ) }}" data-mask="00000-000" required>

                                    @if ($errors->has('zipcode'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('zipcode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Endereço</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address',isset($user->address->address) ? $user->address->address : '') }}" required readonly>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                                <label for="number" class="col-md-4 control-label">Número</label>

                                <div class="col-md-6">
                                    <input id="number" type="text" class="form-control" name="number" value="{{ old('number',isset($user->address->number) ? $user->address->number : '') }}" required>

                                    @if ($errors->has('number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('complement') ? ' has-error' : '' }}">
                                <label for="complement" class="col-md-4 control-label">Complemento</label>

                                <div class="col-md-6">
                                    <input id="complement" type="text" class="form-control" name="complement" value="{{ old('complement',isset($user->address->complement) ? $user->address->complement : '') }}" required>

                                    @if ($errors->has('complement'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('complement') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">Cidade</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city" value="{{ old('city',isset($user->address->city) ? $user->address->city : '') }}" required readonly>

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                <label for="state" class="col-md-4 control-label">Estado</label>

                                <div class="col-md-6">
                                    <input id="state" type="text" class="form-control" name="state" value="{{ old('state',isset($user->address->state) ? $user->address->state : '') }}" required readonly>

                                    @if ($errors->has('state'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
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