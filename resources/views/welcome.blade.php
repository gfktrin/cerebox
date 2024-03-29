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
                <a href="{{ action('HomeController@openContests') }}" id="concursosAbertos">
                <img src="{{ asset('images/banner2.jpg') }}" width="100%">
                </a>
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
        <h2 class="text-center text-primary">Novos Concursos</h2>
        <br>
        <!--Concursos-->
        <section class="row">
            @foreach($contests as $contest)
                <?php $themes = explode('/', $contest->themes)?>

                    <div class="col-md-4 col-sm-6 col-xs-12 contest-card" data-search="{{ strtolower($contest->title) }}">
                        <a href="{{ action('HomeController@contest',['slug' => $contest->slug]) }}" style="text-decoration: none">
                            <div class="panel">
                                <div class="panel-body text-center" >
                                    <p class="text-capitalize" style="margin-bottom:-10px;"> {{ $contest->title }} </p>
                                    <hr>
                                    @foreach($themes as $theme)
                                        <ul style="list-style-type: circle;font-size:15px;" class="text-left text-capitalize"><li> {{ $theme }}</li></ul>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    </div>
            @endforeach
        </section>

        <section class="row">
            <div class="col-md-12">
                <h2 class="text-center text-primary">Últimos ganhadores</h2>
                <br>
                <div class="panel panel-default">
                    <!-- ranking -->
                    <table class="table table-hover" class="panel panel-default">
                        <thead>
                            <th class="text-center">#</th>
                            @foreach($finalized_contests as $finalized_contest)
                            <th class="text-center"><h4>{{ $finalized_contest->title }}</h4></th>
                            @endforeach
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>1º</td>
                                @foreach($finalized_contests as $finalized_contest)
                                    
                                    @if(!empty($finalized_contest->bestProjects()[0]))
                                    <td><strong>Nome:</strong> {{ $finalized_contest->bestProjects()[0]->author->name}}; <strong>Pontos:</strong>{{ number_format($finalized_contest->bestProjects()[0]->points, 3, ',', '') }}<br>
                                        <strong>Arte:</strong> 
                                    <a  href="{{ asset('project_images/'.$finalized_contest->bestProjects()[0]->filename) }}"
                                        data-lightbox="{{ $finalized_contest->id }}"
                                        data-title="{{ $finalized_contest->bestProjects()[0]->author->nickname or $finalized_contest->bestProjects()[0]->author->name}}">
                                        <i class="material-icons">image</i>
                                    </a>
                                        <strong>Descrição:</strong>
                                        <a href="#rankingModal" data-target="#rankingModal" data-toggle="modal" data-descricao="{{ $finalized_contest->bestProjects()[0]->description}}"><i class="material-icons">textsms</i>
                                        </a>
                                    </td>
                                    @elseif(!empty($finalized_contest->bestProjects()[1])&&empty($finalized_contest->bestProjects()[0]))
                                    <td><strong>Nome:</strong> {{ $finalized_contest->bestProjects()[1]->author->name}}; <strong>Pontos:</strong>{{ number_format($finalized_contest->bestProjects()[1]->points, 3, ',', '')}}<br>
                                        <strong>Arte:</strong>
                                        <a  href="{{ asset('project_images/'.$finalized_contest->bestProjects()[1]->filename) }}"
                                        data-lightbox="{{ $finalized_contest->id }}"
                                        data-title="{{ $finalized_contest->bestProjects()[1]->author->nickname or $finalized_contest->bestProjects()[1]->author->name}}">
                                        <i class="material-icons">image</i>
                                    </a>
                                        <strong>Descrição:</strong>
                                        <a href="#rankingModal" data-target="#rankingModal" data-toggle="modal" data-descricao="{{ $finalized_contest->bestProjects()[1]->description}}"><i class="material-icons">textsms</i>
                                        </a>
                                    </td>
                                    @elseif(!empty($finalized_contest->bestProjects()[2])&&empty($finalized_contest->bestProjects()[1])&&empty($finalized_contest->bestProjects()[0]))
                                        <td><strong>Nome:</strong> {{ $finalized_contest->bestProjects()[2]->author->name}}; <strong>Pontos:</strong>{{ number_format($finalized_contest->bestProjects()[2]->points, 3, ',', '')}}<br>
                                            <strong>Arte:</strong>
                                        <a  href="{{ asset('project_images/'.$finalized_contest->bestProjects()[2]->filename) }}"
                                        data-lightbox="{{ $finalized_contest->id }}"
                                        data-title="{{ $finalized_contest->bestProjects()[2]->author->nickname or $finalized_contest->bestProjects()[2]->author->name}}">
                                        <i class="material-icons">image</i>
                                    </a>
                                    <strong>Descrição:</strong>
                                        <a href="#rankingModal" data-target="#rankingModal" data-toggle="modal" data-descricao="{{ $finalized_contest->bestProjects()[2]->description}}"><i class="material-icons">textsms</i>
                                        </a>
                                    @else
                                        <td>||</td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <td>2º</td>
                                @foreach($finalized_contests as $finalized_contest)
                                    @if(!empty($finalized_contest->bestProjects()[0])&&!empty($finalized_contest->bestProjects()[1]))
                                    <td><strong>Nome:</strong> {{ $finalized_contest->bestProjects()[1]->author->name}}; <strong>Pontos:</strong>{{ number_format($finalized_contest->bestProjects()[1]->points, 3, ',', '')}}<br>
                                        <strong>Arte</strong>
                                    <a  href="{{ asset('project_images/'.$finalized_contest->bestProjects()[1]->filename) }}"
                                        data-lightbox="{{ $finalized_contest->id }}"
                                        data-title="{{ $finalized_contest->bestProjects()[1]->author->nickname or $finalized_contest->bestProjects()[1]->author->name}}">
                                        <i class="material-icons">image</i>
                                    </a>
                                    <strong>Descrição:</strong>
                                        <a href="#rankingModal" data-target="#rankingModal" data-toggle="modal" data-descricao="{{ $finalized_contest->bestProjects()[1]->description}}"><i class="material-icons">textsms</i>
                                        </a>
                                    </td>
                                    @elseif(!empty($finalized_contest->bestProjects()[1])&&!empty($finalized_contest->bestProjects()[2])&&empty($finalized_contest->bestProjects()[0]))
                                        <td><strong>Nome:</strong> {{ $finalized_contest->bestProjects()[2]->author->name}}; <strong>Pontos:</strong>{{ number_format($finalized_contest->bestProjects()[2]->points, 3, ',', '')}}<br>
                                            <strong>Arte</strong>
                                        <a  href="{{ asset('project_images/'.$finalized_contest->bestProjects()[2]->filename) }}"
                                        data-lightbox="{{ $finalized_contest->id }}"
                                        data-title="{{ $finalized_contest->bestProjects()[2]->author->nickname or $finalized_contest->bestProjects()[2]->author->name}}">
                                        <i class="material-icons">image</i>
                                    </a>
                                    <strong>Descrição:</strong>
                                        <a href="#rankingModal" data-target="#rankingModal" data-toggle="modal" data-descricao="{{ $finalized_contest->bestProjects()[2]->description}}"><i class="material-icons">textsms</i>
                                        </a>
                                        </td>
                                    @else
                                        <td>||</td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <td>3º</td>
                                @foreach($finalized_contests as $finalized_contest)
                                    @if(!empty($finalized_contest->bestProjects()[2])&&!empty($finalized_contest->bestProjects()[1])&&!empty($finalized_contest->bestProjects()[0]))
                                    <td><strong>Nome:</strong> {{ $finalized_contest->bestProjects()[2]->author->name}}; <strong>Pontos:</strong>{{ number_format($finalized_contest->bestProjects()[2]->points, 3, ',', '')}}<br>
                                        <strong>Arte</strong>
                                    <a  href="{{ asset('project_images/'.$finalized_contest->bestProjects()[2]->filename) }}"
                                        data-lightbox="{{ $finalized_contest->id }}"
                                        data-title="{{ $finalized_contest->bestProjects()[2]->author->nickname or $finalized_contest->bestProjects()[2]->author->name}}">
                                        <i class="material-icons">image</i>
                                    </a>
                                    <strong>Descrição:</strong>
                                        <a href="#rankingModal" data-target="#rankingModal" data-toggle="modal" data-descricao="{{ $finalized_contest->bestProjects()[2]->description}}"><i class="material-icons">textsms</i>
                                        </a>
                                    </td>
                                    @else
                                    <td>||</td>
                                    @endif
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <div id="rankingModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Descrição</h4>
              </div>
              <div class="modal-body">
                <textarea disabled name="descricao" class="form-control" rows="5" value="" style="border: 0;overflow: auto;cursor:default;"></textarea>
              </div>
            </div>
          </div>
        </div>

        <section class="row">
            <div class="col-md-12">
                <h2 class="text-center text-primary">Quem Somos</h2>
                <p class="text-justify">
                    A equipe Cerebox surgiu de um sonho. Uma vontade de criar novas ideias e explorar novos conceitos, tentando implementar tudo isso em alguma atividade que funcionasse com artes, pessoas, hobbies, trabalhos profissionais e, ao mesmo tempo, diversão e criatividade. Eis que em 2016 conseguimos misturar todas essas coisas (ou pelo menos tentamos, de verdade!) e criamos o Randomizador, que logo depois se extendeu para os concursos. Esperamos, como bons sonhadores que somos, que todos se divirtam e façam bom uso das ferramentas aqui contidas, frutos de muito trabalho (MUITO, 5 vezes trabalho), paixão e dedicação sem fim. Tendo isso em mente, podemos dar a largada para que o brainstorm mais doido de suas vidas comece!
                </p>
            </div>
        </section>
    </div>
@stop