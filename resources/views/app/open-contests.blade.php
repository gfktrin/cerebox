@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <!--<form action="#" method="POST">
            <div class="form-group label-floating">
                <label for="input-contest-search" class="control-label">Procurar...</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="search" id="input-contest-search">
                    <span class="input-group-addon">
                        <i class="material-icons">search</i>
                    </span>
                </div>
            </div>
        </form>-->
        @if($open_contests->count() > 0)
            <h2 class="text-primary">Concursos abertos para inscrição</h2>
            <div class="row">
                @foreach($open_contests as $contest)
                    <?php $themes = explode('/', $contest->themes)?>

                    <div class="col-md-4 col-xs-6 contest-card" data-search="{{ strtolower($contest->title) }}">
                        <a href="{{ action('HomeController@contest',['slug' => $contest->slug]) }}" style="text-decoration: none">
                            <div class="panel">
                                <div class="panel-body text-center" >
                                    <p class="text-capitalize"> {{ $contest->title }} </p>
                                    <hr>
                                    @foreach($themes as $theme)
                                        <ul style="list-style-type: circle" class="text-left text-capitalize"><li> {{ $theme }}</li></ul>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <h2 class="text-primary">Não há nenhum concurso aberto para inscrição</h2>
        @endif
        @if($submit_contests->count() > 0)
            <h2 class="text-primary">Concursos abertos para envio</h2>
            <div class="row">
                @foreach($submit_contests as $contest)

                    <?php $themes = explode('/', $contest->themes)?>

                    <div class="col-md-4 col-xs-6 contest-card" data-search="{{ strtolower($contest->title) }}">
                        <a href="{{ action('HomeController@contest',['slug' => $contest->slug]) }}" style="text-decoration: none">
                            <div class="panel">
                                <div class="panel-body text-center" >
                                    <p class="text-capitalize"> {{ $contest->title }} </p>
                                    <hr>
                                    @foreach($themes as $theme)
                                        <ul style="list-style-type: circle" class="text-left text-capitalize"><li> {{ $theme }}</li></ul>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else  
            <h2 class="text-primary">Não há nenhum concurso aberto para envio</h2>
        @endif
        
        @if($voting_contests->count() > 0)
            <h2 class="text-primary">Concursos aberto para votação</h2>
            <div class="row">
                @foreach($voting_contests as $contest)
                    <?php $themes = explode('/', $contest->themes)?>

                    <div class="col-md-4 col-xs-6 contest-card" data-search="{{ strtolower($contest->title) }}">
                        <a href="{{ action('HomeController@contest',['slug' => $contest->slug]) }}" style="text-decoration: none">
                            <div class="panel">
                                <div class="panel-body text-center" >
                                    <p class="text-capitalize"> {{ $contest->title }} </p>
                                    <hr>
                                    @foreach($themes as $theme)
                                        <ul style="list-style-type: circle" class="text-left text-capitalize"><li> {{ $theme }}</li></ul>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach               
            </div>
        @else
            <h2 class="text-primary">Não há nenhum concurso aberto para votação</h2>
        @endif 
    </div>
@stop