@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-body">
                @if(Session::has('not-enough-tickets'))
                    <div class="alert alert-danger">
                        {{ Session::get('not-enough-tickets') }}
                    </div>
                @endif
                <form action="{{ action('ProjectController@submit') }}"
                      data-redirect="{{ action('HomeController@myProjects') }}"
                      id="submit-project"
                      class="form"
                      method="POST"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" name="contest_id" value="{{ $contest->id }}">
                    <input type="hidden" name="author_id" value="{{ $user->id }}">

                    <h4 class="text-primary">Enviar projeto para o concurso: <span class="contest-title">{{ $contest->title }}</span></h4>

                    <div class="form-group">
                        <label for="submit-project-art" class="col-md-2 control-label">Arte:</label>

                        <div class="col-md-10">
                            <div class="col-md-6">
                                <input type="text" readonly="" class="form-control" placeholder="Selecione um arquivo...">
                                <input type="file" name="art" id="submit-project-art" multiple="">
                            </div>
                            <div class="col-md-6">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Descrição (opcional):</label>

                        <div class="col-md-10">            
                            <textarea class="form-control" name="description" rows="8" maxlength="500"></textarea>
                            <span class="helper-block">
                                Imagens muito complexas sem uma descrição podem ser mal interpretadas pelos usuários que julgarão as artes
                            </span>
                        </div>
                    </div>
                    <br>
                    @foreach(Cerebox\VoteCategory::all() as $vote_category)
                        <div class="form-group" style="margin-top: 20px;">
                            <label class="control-label col-md-2" for="multiplier-category-{{$vote_category->id}}">{{ $vote_category->name }}</label>
                            
                            <div class="col-md-10">
                                <select class="form-control" id="multiplier-category-{{$vote_category->id}}" name="multiplier[{{ $vote_category->id }}]">
                                    <option value="">Escolha um multiplicador</option>
                                    <option value="1.2">20%</option>
                                    <option value="1.15">15%</option>
                                    <option value="1.1">10%</option>
                                    <option value="1.05">5%</option>
                                </select>
                            </div>
                        </div>
                    @endforeach

                    <div class="form-group pull-right">
                        <input type="submit" value="Enviar" class="btn btn-primary" id="buttonProj" name="buttonProj" disabled="true">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop