@extends('layouts.app')

@section('content')
    <!--Slider Home-->
    <section id="home">
        <div class="carousel slide" id="slider-home" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{ asset('images/A9U0Eex.png') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ asset('images/A9U0Eex.png') }}" width="100%" alt="">
                    <div class="carousel-caption">
                        Something Here
                    </div>
                </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="material-icons" aria-hidden="true">navigate_before</i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="material-icons" aria-hidden="true">navigate_next</i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <div class="col-md-8 col-md-offset-2">

        <!--Concursos-->
        <section class="row">
            @foreach($contests as $contest)
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="panel-img">
                                <img src="{{ asset('images/penguin2.jpg') }}" width="100%" alt="penguin">
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
        </section>

        <section class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <h2 class="text-center">Quem Somos</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque condimentum congue metus, at blandit nulla mollis quis. Aenean rutrum urna nunc, ut maximus nulla molestie vitae. Suspendisse molestie eros purus, vitae gravida sapien rutrum eu. Quisque lacinia ac tellus id venenatis. Praesent lorem risus, bibendum at tortor non, feugiat gravida nisl. Fusce nec lobortis libero, eu ultrices magna. Mauris at sodales lacus. Suspendisse sed libero cursus, malesuada nisi nec, efficitur turpis. Proin lobortis feugiat odio, at vestibulum tellus feugiat at. Nunc id mi ipsum.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop