@extends('layouts.app')

@section('content')
    <!--Slider Home-->
    <section id="home">
        <div class="intro">
            <div class="text-center">
                {{-- <img src="{{ asset('images/logo.png') }}" width="200">
                <h1 class="text-primary">Cerebox</h1>
                <p class="caption">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p> --}}
                <img src="{{ asset('images/banner2.jpg') }}" width="100%">
            </div>
        </div>
        <div class="tutorial">
            <h2 class="text-center text-primary">Como funciona</h2>
            <br>
            <div class="col-md-2 col-md-offset-1 step">
                <img src="{{ asset('images/tutorial/1.png') }}" alt="Escolha um concurso aberto">
                <div class="caption">
                    Escolha um concurso aberto
                </div>
            </div>
            <div class="col-md-2 step">
                <img src="{{ asset('images/tutorial/2.png') }}" alt="Observe as palavras chaves">
                <div class="caption">
                    Observe as palavras chaves
                </div>
            </div>
            <div class="col-md-2 step">
                <img src="{{ asset('images/tutorial/3.png') }}" alt="Adquira seu ticket">
                <div class="caption">
                    Adquira seu ticket
                </div>
            </div>
            <div class="col-md-2 step">
                <img src="{{ asset('images/tutorial/4.png') }}" alt="Crie e envie sua arte">
                <div class="caption">
                    Crie e envie sua arte
                </div>
            </div>
            <div class="col-md-2 step">
                <img src="{{ asset('images/tutorial/5.png') }}" alt="Acompanhe os resultados">
                <div class="caption">
                    Acompanhe os resultados
                </div>
            </div>
        </div>
        {{-- <div class="carousel slide" id="slider-home" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{ asset('images/tutorial/1.png') }}" width="50%" alt="">
                    <div class="carousel-caption">
                        Escolha um concurso aberto
                    </div>
                </div>
                <div class="item">
                    <img src="{{ asset('images/tutorial/2.png') }}" width="50%" alt="">
                    <div class="carousel-caption">
                        Observe as palavras chaves
                    </div>
                </div>
                <div class="item">
                    <img src="{{ asset('images/tutorial/3.png') }}" width="50%" alt="">
                    <div class="carousel-caption">
                        Adquira seu ticket
                    </div>
                </div>
                <div class="item">
                    <img src="{{ asset('images/tutorial/4.png') }}" width="50%" alt="">
                    <div class="carousel-caption">
                        Crie e envie sua arte
                    </div>
                </div>
                <div class="item">
                    <img src="{{ asset('images/tutorial/5.png') }}" width="50%" alt="">
                    <div class="carousel-caption">
                        Acompanhe os resultados
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
        </div> --}}
    </section>

    <div class="col-md-8 col-md-offset-2">

        <!--Concursos-->
        {{-- <section class="row">
            @foreach($contests as $contest)
                <div class="col-md-4">
                    <div class="panel contest-card">
                        <div class="panel-body">
                            <a href="{{ action('HomeController@contest',['slug' => $contest->slug]) }}">
                                {{ $contest->title }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </section> --}}

        <section class="row">
            <div class="col-md-12">
                <h2 class="text-center text-primary">Quem Somos</h2>
                <p>
                    O Cerebox foi idealizado por uma única pessoa. Uma pessoa sem nenhuma maestria com o desenho ou a música (arrisco-me em um pouco muito pouco com a escrita), mas que talvez, por ser estudante de engenharia, percebeu um problema comum entre os seus amigos músicos, desenhistas, escritores, autores e artistas: o lapso criativo, que oscila e passa por longos períodos de seca. Problema este que silencia o talento de muitos e acaba por fazer com que, até mesmo quando em hobbie, artistas habilidosos desanimem ou passem a ser verdadeiras máquinas de cópia, reproduzindo conteúdo apenas para não “perder a prática”. O Cerebox possui a proposta de amenizar este mal cabal, oferecendo o randomizador, um “gerador de ideias” que te permite escolher categorias do seu interesse para oferecer-lhe palavras dentro destes tópicos. Conheça novas palavras, lapide suas ideias, exercite sua criatividade e tente dar asas à sua imaginação. Este é o desafio que eu, idealizador do Cerebox, uma única pessoa que teve o apoio de inúmeros amigos e colaboradores, lanço para vocês!
                </p>
            </div>
        </section>
    </div>
@stop