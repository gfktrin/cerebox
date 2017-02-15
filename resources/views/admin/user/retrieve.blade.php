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

                    <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                        <label for="zipcode" class=" control-label">CEP</label>

                        <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ old('zipcode',isset($user->address->zipcode) ? $user->address->zipcode : '' ) }}" data-mask="00000-000" required>

                        @if ($errors->has('zipcode'))
                            <span class="help-block">
                                <strong>{{ $errors->first('zipcode') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address" class=" control-label">Endereço</label>
                        
                        <input id="address" type="text" class="form-control" name="address" value="{{ old('address',isset($user->address->address) ? $user->address->address : '') }}" required readonly>

                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                        <label for="number" class=" control-label">Número</label>

                        <input id="number" type="text" class="form-control" name="number" value="{{ old('number',isset($user->address->number) ? $user->address->number : '') }}" required>

                        @if ($errors->has('number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('number') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('complement') ? ' has-error' : '' }}">
                        <label for="complement" class=" control-label">Complemento</label>

                        <input id="complement" type="text" class="form-control" name="complement" value="{{ old('complement',isset($user->address->complement) ? $user->address->complement : '') }}" required>

                        @if ($errors->has('complement'))
                            <span class="help-block">
                                <strong>{{ $errors->first('complement') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                        <label for="city" class=" control-label">Cidade</label>

                        <input id="city" type="text" class="form-control" name="city" value="{{ old('city',isset($user->address->city) ? $user->address->city : '') }}" required readonly>

                        @if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                        <label for="state" class="control-label">Estado</label>

                        <input id="state" type="text" class="form-control" name="state" value="{{ old('state',isset($user->address->state) ? $user->address->state : '') }}" required readonly>

                        @if ($errors->has('state'))
                            <span class="help-block">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                        @endif
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
                                    @php($invoice = $user->invoices()->fromProject($project)->get()->first())
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