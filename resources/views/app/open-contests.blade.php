@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <form action="#" method="POST">
            <div class="form-group label-floating">
                <label for="input-contest-search" class="control-label">Procurar...</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="search" id="input-contest-search">
                    <span class="input-group-addon">
                        <i class="material-icons">search</i>
                    </span>
                </div>
            </div>
        </form>
        <h1>Concursos Abertos</h1>
        @foreach($contests as $contest)
            <div class="col-md-4 contest" data-search="{{ strtolower($contest->title) }}">
                <div class="panel">
                    <div class="panel-body">
                        <div class="panel-img">
                            <a href="{{ action('HomeController@contest',['slug' => $contest->slug]) }}">

                                <img src="{{ asset('images/penguin2.jpg') }}" width="100%" alt="penguin">
                            </a>
                        </div>
                        <h3>
                            <a href="{{ action('HomeController@contest',['slug' => $contest->slug]) }}">
                                {{ $contest->title }}
                            </a>
                        </h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop