@extends('layouts.admin')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
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

                    <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                        <label for="nickname" class=" control-label">Apelido</label>

                        
                        <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname',$user->nickname) }}" required>

                        @if ($errors->has('nickname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nickname') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class=" control-label">Telefone</label>

                        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone',$user->phone) }}" data-mask="(00)0000-00009" required>

                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
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

                    {{-- <div class="form-group">
                        <div class="togglebutton">
                            <label for="update-user-admin">
                                <input type="checkbox" name="admin" id="update-user-admin" value="1" @if($user->admin) checked @endif> Admin?
                            </label>
                        </div>
                    </div> --}}

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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop