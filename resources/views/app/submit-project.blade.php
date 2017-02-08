@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel">
            <div class="panel-body">
                <form action="{{ action('ProjectController@submit') }}"
                      data-redirect="{{ action('HomeController@myProjects') }}"
                      id="submit-project"
                      class="form"
                      method="POST"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" name="contest_id" value="{{ $contest->id }}">
                    <input type="hidden" name="author_id" value="{{ $user->id }}">

                    <h4>Enviar projeto para o concurso: <span class="contest-title">{{ $contest->title }}</span></h4>

                    <div class="form-group">
                        <label for="submit-project-art" class="col-md-2 control-label">Arte:</label>

                        <div class="col-md-10">
                            <input type="text" readonly="" class="form-control" placeholder="Selecione um arquivo...">
                            <input type="file" name="art" id="submit-project-art" multiple="">
                            <div class="preview"></div>
                        </div>
                    </div>

                    <div class="form-group pull-right">
                        <input type="submit" value="Enviar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop