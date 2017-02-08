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
            <a class="left carousel-control" href="#slider-home" role="button" data-slide="prev">
                <i class="material-icons" aria-hidden="true">navigate_before</i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#slider-home" role="button" data-slide="next">
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
        </section>

        <section class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <h2 class="text-center">Quem Somos</h2>
                        <p>
                            O Cerebox foi idealizado por uma única pessoa. Uma pessoa sem nenhuma maestria com o desenho ou a música (arrisco-me em um pouco muito pouco com a escrita), mas que talvez, por ser estudante de engenharia, percebeu um problema comum entre os seus amigos músicos, desenhistas, escritores, autores e artistas: o lapso criativo, que oscila e passa por longos períodos de seca. Problema este que silencia o talento de muitos e acaba por fazer com que, até mesmo quando em hobbie, artistas habilidosos desanimem ou passem a ser verdadeiras máquinas de cópia, reproduzindo conteúdo apenas para não “perder a prática”. O Cerebox possui a proposta de amenizar este mal cabal, oferecendo o randomizador, um “gerador de ideias” que te permite escolher categorias do seu interesse para oferecer-lhe palavras dentro destes tópicos. Conheça novas palavras, lapide suas ideias, exercite sua criatividade e tente dar asas à sua imaginação. Este é o desafio que eu, idealizador do Cerebox, uma única pessoa que teve o apoio de inúmeros amigos e colaboradores, lanço para vocês!
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop