@extends('layouts.app')

@section('content')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=1887887891430795";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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

        <div class="tutorial col-md-12">
            <h2 class="text-center text-primary">Como funciona</h2>
            <br>
            <div class="col-md-2 col-md-offset-1 col-xs-4 step">
                <img src="{{ asset('images/tutorial/1.png') }}" alt="Escolha um concurso aberto">
                <div class="caption">
                    Escolha um concurso aberto
                </div>
            </div>
            <div class="col-md-2 col-xs-4 step">
                <img src="{{ asset('images/tutorial/2.png') }}" alt="Observe as palavras chaves">
                <div class="caption">
                    Observe as palavras chaves
                </div>
            </div>
            <div class="col-md-2 col-xs-4 step">
                <img src="{{ asset('images/tutorial/3.png') }}" alt="Adquira seu ticket">
                <div class="caption">
                    Adquira seu ticket
                </div>
            </div>
            <div class="col-md-2 col-xs-4 col-xs-offset-2 col-md-offset-0 step">
                <img src="{{ asset('images/tutorial/4.png') }}" alt="Crie e envie sua arte">
                <div class="caption">
                    Crie e envie sua arte
                </div>
            </div>
            <div class="col-md-2 col-xs-4 step">
                <img src="{{ asset('images/tutorial/5.png') }}" alt="Acompanhe os resultados">
                <div class="caption">
                    Acompanhe os resultados
                </div>
            </div>
            <div class="clearfix"></div>
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
        <section class="row">
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
        </section>

        <section class="row">
            <div class="col-md-12">
                <h2 class="text-center text-primary">Quem Somos</h2>
                <p>
                    A equipe Cerebox surgiu de um sonho. Uma vontade de criar novas ideias e explorar novos conceitos, tentando implementar tudo isso em alguma atividade que funcionasse com artes, pessoas, hobbies, trabalhos profissionais e, ao mesmo tempo, diversão e criatividade. Eis que em 2016 conseguimos misturar todas essas coisas (ou pelo menos tentamos, de verdade!) e criamos o Random, que logo depois se extendeu para os concursos. Esperamos, como bons sonhadores que somos, que todos se divirtam e façam bom uso das ferramentas aqui contidas, frutos de muito trabalho (MUITO, 5 vezes trabalho), paixão e dedicação sem fim. Tendo isso em mente, podemos dar a largada para que o brainstorm mais doido de suas vidas comece!
                </p>
            </div>
        </section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"><a href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=cerebox.com.br','SiteLock','width=600,height=600,left=160,top=170');" ><img alt="SiteLock" title="SiteLock" src="//shield.sitelock.com/shield/cerebox.com.br" /></a></div>
                <div class="col-md-4"></div>
                <div class="fb-page col-md-4" data-href="https://www.facebook.com/Projeto-de-criatividade-710518912441861/" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Projeto-de-criatividade-710518912441861/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Projeto-de-criatividade-710518912441861/">Projeto de criatividade</a></blockquote></div>
            </div>
        </div>
    </div>
    
@stop