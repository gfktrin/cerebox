@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2 class="text-center text-primary">Fale Conosco</h2>
                        @if(Session::has('contact-success'))
                            <div class="alert alert-success">{{ Session::get('contact-success') }}</div>
                        @endif
                        <address>
                            <strong style="font-size: 18px;">Cerebox</strong>
                            <br>
                            <a href="mailto:contato@cerebox.com.br" style="font-size: 15px;">contato@cerebox.com.br</a>
                        </address>
                        <form action="{{ action('ContactController@sendMessage') }}" class="form" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="contact-name" class="control-label">Nome</label>
                                <input type="text" name="name" id="contact-name" class="form-control" value="{{ old('name') }}">
                                @if($errors->has('name'))
                                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="contact-email" class="control-label">Email</label>
                                <input type="text" name="email" id="contact-email" class="form-control" value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="contact-message" class="control-label">Mensagem</label>
                                <textarea name="message" id="contact-message" class="form-control" rows="10">{{ old('message') }}</textarea>
                                @if($errors->has('message'))
                                    <div class="alert alert-danger">{{ $errors->first('message') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Enviar" class="btn btn-primary pull-right">
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop