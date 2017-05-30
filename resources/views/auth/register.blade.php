    @extends('layouts.app')

@section('content')
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title" id="myModalLabel">Termos de uso</h4>

                </div>
                <div class="modal-body">
                    <div style="overflow:scroll; width:550px; height:600px;">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor consequat purus, eu rutrum ante. Praesent ac lorem eu magna dapibus feugiat sed non neque. Duis consequat mi tempus justo elementum iaculis. Nullam sed ligula sit amet dolor volutpat feugiat. Etiam in lobortis orci. Mauris laoreet lobortis accumsan. Etiam et porta eros. Nulla consectetur augue ut imperdiet malesuada. Aliquam interdum metus ultrices commodo venenatis. Pellentesque facilisis, arcu ac cursus commodo, odio est congue neque, in semper velit arcu nec risus. Nunc blandit maximus libero a luctus.

In ligula ligula, placerat ut ex vitae, tincidunt tempor ipsum. Mauris sit amet dui suscipit, commodo leo sed, dapibus justo. Nam sit amet leo quis dolor tristique venenatis. Quisque eu pulvinar purus, sed aliquam leo. Aliquam bibendum, odio vel efficitur varius, elit felis ornare orci, sit amet lobortis urna ex ut turpis. Ut at lectus volutpat, finibus felis id, tempus sem. Proin ultricies luctus diam nec condimentum.

Cras suscipit rhoncus elit, nec condimentum tellus finibus nec. Vivamus semper arcu vitae nisi porttitor, at scelerisque tellus consectetur. Nunc fermentum ligula eu lacus placerat, eget viverra sem vestibulum. Sed tincidunt, purus non ultrices pellentesque, est dolor rhoncus ligula, sit amet mollis ex mi vel libero. Cras tristique ipsum vitae lobortis bibendum. Etiam cursus congue sapien, at egestas purus bibendum eget. Pellentesque feugiat a purus ut rutrum. Vivamus elementum efficitur iaculis. Suspendisse tortor felis, suscipit ut augue eu, ullamcorper molestie tellus. Duis dapibus maximus ante, in porttitor enim ornare vel. Phasellus iaculis pharetra aliquet. Sed eu laoreet tortor. Phasellus luctus facilisis tortor ullamcorper volutpat. Sed scelerisque facilisis condimentum. Ut lacus neque, dictum non malesuada sit amet, consequat eu augue. In iaculis sollicitudin massa sit amet egestas.

Mauris iaculis convallis ultrices. Sed imperdiet nulla in arcu blandit ullamcorper. Nunc sit amet risus non nulla sollicitudin mattis ut eu est. Nunc mattis nec nisl eu eleifend. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed vitae diam vitae justo ultricies hendrerit. Curabitur vel neque non lacus viverra elementum. Integer turpis sem, dignissim sed enim at, blandit lobortis urna. Phasellus sed arcu suscipit, varius elit non, auctor turpis. Duis pharetra augue a tortor porttitor feugiat. Nullam congue tortor ut scelerisque laoreet. Morbi molestie id odio a consequat. Proin luctus sapien est, non feugiat nulla interdum quis. Ut viverra lectus vitae lectus dapibus finibus. Etiam id felis mattis, viverra tellus ut, facilisis quam. Nam pellentesque commodo ex in finibus.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin feugiat rutrum nibh nec imperdiet. Aenean sit amet auctor eros. Donec dictum fermentum nulla commodo placerat. Mauris et nisi vitae libero feugiat imperdiet. Suspendisse malesuada id libero et volutpat. Morbi venenatis sodales iaculis. Curabitur tincidunt rhoncus nunc a sodales. Donec ut lacus sit amet quam convallis maximus. Morbi porttitor sed eros a vestibulum. Nulla a molestie nulla, ut mollis erat. Sed faucibus, risus vel sodales rutrum, ante elit aliquet turpis, consectetur rhoncus ex turpis a velit.

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('/') }}" class="btn btn-default">Voltar</a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceito os termos</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro</div>
                <div class="panel-body">
                    <div class="row text-center">
                        <a href="{{ action('Auth\LoginController@redirectToFacebook') }}"
                           class="btn btn-social btn-facebook">
                            <span class="fa fa-facebook"></span>
                            Login com Facebook
                        </a>
                    </div>
                    <form class="form-horizontal" id="register-user-form" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                            <label for="nickname" class="col-md-4 control-label">Apelido</label>

                            <div class="col-md-6">
                                <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname') }}">

                                @if ($errors->has('nickname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirme a senha</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Telefone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" data-mask="(00)0000-00009" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                            <label for="zipcode" class="col-md-4 control-label">CEP</label>

                            <div class="col-md-6">
                                <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ old('zipcode') }}" data-mask="00000-000" required>

                                @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <!-- <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Endereço</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required readonly>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <!-- <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                            <label for="number" class="col-md-4 control-label">Número</label>

                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control" name="number" value="{{ old('number') }}" required>

                                @if ($errors->has('number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <!-- <div class="form-group{{ $errors->has('complement') ? ' has-error' : '' }}">
                            <label for="complement" class="col-md-4 control-label">Complemento</label>

                            <div class="col-md-6">
                                <input id="complement" type="text" class="form-control" name="complement" value="{{ old('complement') }}" required>

                                @if ($errors->has('complement'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('complement') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">Estado</label>

                            <div class="col-md-6">
                                <select class="form-control" name="state" required id="state">
                                    <option>Escolha...</option>
                                    @foreach(Cerebox\State::all()->sortBy('name') as $state)
                                        <option value="{{ $state->id }}" @if(old('state') == $state->id) selected @endif >{{ $state->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">Cidade</label>

                            <div class="col-md-6">
                                <select name="city_id" id="city" class="form-control" required>
                                    <option>Escolha...</option>
                                    @if(old('state'))
                                        @foreach(Cerebox\State::find(old('state'))->cities as $city)
                                            <option value="{{ $city->id }}" @if(old('city_id') == $city->id) selected @endif>{{ $city->name }}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @if ($errors->has('city_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
