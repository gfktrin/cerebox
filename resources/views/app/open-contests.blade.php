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
        <h1 class="text-primary">Concursos Abertos</h1>
        @foreach($contests as $contest)
            <div class="col-md-4 contest-card" data-search="{{ strtolower($contest->title) }}">
                <div class="panel">
                    <div class="panel-body">
                        <a href="{{ action('HomeController@contest',['slug' => $contest->slug]) }}">
                            {{ $contest->title }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop