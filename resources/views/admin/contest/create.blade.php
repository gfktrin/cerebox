@extends('layouts.admin')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel">
            <h4 class="panel-heading">Criar concurso</h4>
            <div class="panel-body">
                <form action="{{ action('ContestController@create')}}"
                      data-redirect="{{ action('AdminController@contests')}}"
                      id="create-contest"
                      class="form"
                      method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="create-contest-title" class="control-label">Título:</label>
                        <input type="text" name="title" id="create-contest-title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="create-contest-slug" class="control-label">URL</label>
                        <div class="input-group">
                            <span class="input-group-addon">{{ url('concurso') }}/</span>
                            <input type="text" name="slug" id="create-contest-slug" class="form-control" >
                        </div>
                    </div>

                    <div class="form-inline col-md-12">
                        <div class="form-group col-md-4">
                            <label for="create-contest-themes#1" class="control-label">1º Tema: </label>
                            <div class="input-group">
                                <input type="text" name="themes[]" id="create-contest-themes#1" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="create-contest-themes#2" class="control-label">2º Tema: </label>
                            <div class="input-group">
                                <input type="text" name="themes[]" id="create-contest-themes#2" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="create-contest-themes#3" class="control-label">3º Tema: </label>
                            <div class="input-group">
                                <input type="text" name="themes[]" id="create-contest-themes#3" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="create-contest-description" class="control-label">Descrição</label>
                        <textarea id="create-contest-description" class="form-control" name="description" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="update-contest-max_users" class="control-label">Máximo de inscritos</label>
                        <input type="number" name="max_users" id="update-contest-max_users" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="create-contest-begins_at" class="control-label">Inscrição começa em:</label>
                        <input type="datetime" name="registration_begins_at" id="create-contest-begins_at" class="form-control">
                    </div>


                    <div class="form-group">
                        <label for="create-contest-begins_at" class="control-label">Envio começa em:</label>
                        <input type="datetime" name="begins_at" id="create-contest-begins_at" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="create-contest-ends_at" class="control-label">Envio de projeto termina em:</label>
                        <input type="datetime" name="ends_at" id="create-contest-ends_at" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="create-contest-voting_ends_at" class="control-label">Votação termina em:</label>
                        <input type="datetime" name="voting_ends_at" id="create-contest-voting_ends_at" class="form-control">
                    </div>

                    <div class="form-group pull-right">
                        <input type="submit" value="Criar" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop