@extends('layouts.admin')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel">
            <h4 class="panel-heading">Escolha os temas do concurso</h4>
            <div class="panel-body">
                <form action="{{ action('ThemeController@create')}}"
                      data-reditect="{{ action('AdminController@contests') }}"
                      id="create-contest-themes"
                      class="form"
                      method="POST">
                    {{ csrf_field() }}

                    <div class="form-inline col-md-12">
                        <div class="form-group col-md-4">
                            <label for="create-contest-themes#1" class="control-label">1º Tema: </label>
                            <div class="input-group">
                                <input type="text" name="name[]" id="create-contest-themes#1" class="form-control">
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="create-contest-themes#2" class="control-label">2º Tema: </label>
                            <div class="input-group">
                                <input type="text" name="name[]" id="create-contest-themes#2" class="form-control">
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="create-contest-themes#3" class="control-label">3º Tema: </label>
                            <div class="input-group">
                                <input type="text" name="name[]" id="create-contest-themes#3" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group pull-right">
                        <input type="submit" value="Salvar" class="btn btn-success">
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop