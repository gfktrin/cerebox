@extends('layouts.app')

@section('content')
<style type="text/css">
    .row.steps { 
  border: 1px solid #DE972F; 
} 
 
.row.steps .col-xs-3 { 
  text-align: center; 
+
} 
 
.row.steps .col-xs-3.active { 
  color: white; 
  background-color: #DE972F; 
} 
 
.row.steps .col-xs-3:not(:last-child) { 
  border-right: 1px solid #DE972F; 
}

    .vertical-alignment-helper {
        display:table;
        height: 100%;
        width: 100%;
    }
    .vertical-align-center {
        /* To center vertically */
        display: table-cell;
        vertical-align: middle;
    }
    .modal-content {
        /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
        width:inherit;
        height:inherit;
        /* To center horizontally */
        margin: 0 auto;
    }
    #contestpage_description{
        margin-bottom: 30px;
    }
    
    div.description_container{
        word-break: break-all;
        max-width: 500px;
    }
    .modal-body {
    
        overflow-y: auto;
    }
    #voting-modal{
        overflow-y:scroll;
    }
</style>
    @if(!empty(Session::get('code')) && Session::get('code') == 5)
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="vertical-alignment-helper">
                <div class="modal-dialog vertical-align-center">
                    <div class="modal-content">
                    @if(Auth::check() && $contest->isOpenForVoting() && !empty(Session::get("project")))
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                            </button>
                            <h4 class="modal-title" id="myModalLabel">Votar</h4>

                        </div>
                        <div class="modal-body">
                            <p>Você está prestes a votar no seguinte projeto:</p>
                            <img src="{{ asset('project_images/'.Session::get("project")->filename) }}"
                            style="max-width:500px;max-height:500px;"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            {{--<button type="button" class="btn btn-primary">Prosseguir</button>--}}
                            <a href="#voting-modal" class="btn btn-primary"
                               data-id="{{Session::get("project")->id}}"
                               data-author="{{Session::get("project")->author->nickname or Session::get("project")->author->name}}"
                               data-description="{{ Session::get("project")->description }}"
                               data-toggle="modal" onclick="$('#myModal').modal('hide');">
                                Prosseguir
                                <img src="{{ asset('project_images/'.Session::get("project")->filename) }}" style="display: none;"/>

                            </a>
                        </div>
                    @elseif(Auth::check() && !$contest->isOpenForVoting() && !empty(Session::get("project")))
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                            </button>
                            <h4 class="modal-title" id="myModalLabel">Falha</h4>

                        </div>
                        <div class="modal-body">
                            <p>O concurso não está aberto para votação.</p>
                        </div>
                    @else
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                            </button>
                            <h4 class="modal-title" id="myModalLabel">Falha</h4>

                        </div>
                        <div class="modal-body">
                            <p>Falha ao tentar votar.</p>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-8 col-md-offset-2 contest">
        <h1 class="text-primary">{{ $contest->title }}</h1>
        <br>
        @if($need_to_validate_vote)
            <h3 class="text-primary"><span style="color: black">[APENAS NO PRIMEIRO VOTO]</span> Este é o seu primeiro voto no concurso. Para validá-lo, vote em outra arte.</h3>
            @foreach($contest->leastVotedProjects(3,$votes->pluck('project_id')) as $project)
                <div class="col-md-4 col-xs-6">
                    <div class="panel project-card">
                        <div class="panel-body text-center">
                            @if(Auth::check() && $contest->isOpenForVoting())
                                <a href="#voting-modal" 
                                   data-id="{{ $project->id }}" 
                                   data-author="{{ $project->author->nickname or $project->author->name }}"
                                   data-description="{{ $project->description }}"
                                   data-toggle="modal">
                                    <img src="{{ asset('project_images/'.$project->filename) }}">
                                </a>
                            @else
                                <a  href="{{ asset('project_images/'.$project->filename) }}"
                                    data-lightbox="{{ $contest->id }}"
                                    data-title="{{ $project->author->nickname or $project->author->name}}">
                                    <img src="{{ asset('project_images/'.$project->filename) }}">
                                </a>
                            @endif      
                            {{-- <a href="{{ asset('project_images/'.$project->filename) }}"
                               data-lightbox="{{ $contest->id }}"
                               data-title="{{ $project->author->nickname or $project->author->name}}">
                                <img src="{{ asset('project_images/'.$project->filename) }}">
                            </a> --}}
                            <div class="caption">{{ $project->author->nickname or $project->author->name }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <?php $themes = explode('/', $contest->themes)  ?>
                <h3 class="text-primary text-capitalize"> Temas </h3>
          <h4 class="text-primary text-capitalize">
                | 
              @foreach($themes as $theme)
                  {{ $theme  }} <?php echo ' | ' ?>
              @endforeach
          </h4>
          <br>
            <p id="contestpage_description">{{ $contest->description }}</p>
            <br>
            <div class="row steps">
                @if($contest->begins_at->getTimestamp() >= time())
                    <div class="col-xs-3 active">
                        Inscrição <br> <b>(até as 23:59 do dia {{ $contest->begins_at->format('d/m') }})</b>
                    </div>
                @else
                    <div class="col-xs-3"><p style="padding-top:11px">Inscrição</p></div>
                @endif
                @if($contest->ends_at->getTimestamp() >= time() && $contest->begins_at->getTimestamp() <= time())
                    <div class="col-xs-3 active">
                        Envio de arte <br> <b>(até as 23:59 do dia {{ $contest->ends_at->format('d/m') }})</b>
                    </div>
                @else
                    <div class="col-xs-3"><p style="padding-top:11px">Envio de arte</p></div>
                @endif
                @if($contest->ends_at->getTimestamp() <= time() && $contest->voting_ends_at->getTimestamp() >= time())
                    <div class="col-xs-3 active">
                        Votação <br> <b>(até as 23:59 do dia {{ $contest->voting_ends_at->format('d/m') }})</b>
                    </div>
                @else
                    <div class="col-xs-3">
                        <p style="padding-top:11px">Votação</p>
                    </div>
                @endif
                <div class="col-xs-3"><p style="padding-top:11px">Apuração</p></div>
            </div>
                @if($contest->isOpenForVoting() && Auth::check())
                    @if(!empty($project))
                        <div style="margin-top: 50px;">
                            <h3>Compartilhe o link para votação do seu projeto:</h3>
                            <input type="text" class="form-control" id="link" value="http://cerebox.com.br/votar/{{ $slug }}/{{ $project->id }}">
                        </div>
                    @endif
                @endif

            <div class="row">
                @if($contest->isOpenForRegistration() && Auth::check() && Auth::user()->registers()->where('contest_id', $contest->id)->count() <= 0)
                    @if(Auth::user()->tickets >= Cerebox\Project::$entry_fee)
                        <form method="post" action="{{ action('ContestController@enterContest', ['contest' => $contest]) }}" >
                            {{ csrf_field() }}
                            <input type="hidden" name="contest_id" value="{{ $contest->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <button type="submit" class="btn btn-primary btn-raised pull-right" style="margin-top: 25px;">Participar do concurso</button>

                        </form>
                        <p class="pull-right text-primary" style="margin-right:10px;margin-top:20px;">
                            {{ $contest->registers->count() }} inscritos de {{ $contest->max_users }} vagas
                        </p>
                    @else
                        @if($contest->projects->count() >= $contest->max_users)
                            <button type="button" disabled class="btn btn-primary pull-right">Concurso lotado</button>
                        @else
                            <a href="{{ action('HomeController@acquireTickets') }}" class="btn btn-primary pull-right">
                                Você não possui tickets suficientes para entrar no concurso
                            </a>
                        @endif
                    @endif
                @elseif($contest->isOpenForRegistration() && !Auth::check())
                    <a href="{{ url('/login') }}" class="btn btn-primary btn-raised pull-right" style="margin-top: 25px;">
                        Você deve estar logado para entrar no concurso
                    </a>
                    <p class="pull-right text-primary" style="margin-right:10px;margin-top:15px;">
                        {{ $contest->registers->count() }} inscritos de {{ $contest->max_users }} vagas
                    </p>
                @elseif($contest->isOpenForSubmit() && Auth::check() && Auth::user()->registers()->where('contest_id', $contest->id)->count() <= 0)
                    <h3>Você não está inscrito neste concurso</h3>
                @endif 
            </div>
            @if(!$contest->isOpenForSubmit() && Auth::check() && Auth::user()->projects()->where('contest_id', $contest->id)->count() <= 0 && Auth::user()->registers()->where('contest_id', $contest->id)->count() >= 1)
                <h3>Inscrição realizada com sucesso! Aguarde a liberação do período de envio.</h3><p class="pull-right text-primary" style="margin-right:10px;margin-top:20px;">
                            {{ $contest->registers->count() }} inscritos de {{ $contest->max_users }} vagas
                        </p>
            @endif
            @if($contest->isOpenForSubmit() && Auth::check() && Auth::user()->projects()->where('contest_id', $contest->id)->count() <= 0 && Auth::user()->registers()->where('contest_id', $contest->id)->count() >= 1)
                <a href="{{ action('HomeController@submitProject', ['contest' => $contest]) }}"
                   class="btn btn-primary btn-raised pull-right">
                    Enviar arte
                </a>
            @endif

            @if($contest->isOpenForVoting())
                @if(!Auth::check())
                    <br>
                    <p><strong><a href="{{ url('/register') }}">Cadastre-se</a> ou faça <a href="{{ url('/login') }}">login</a> para ter acesso à descrição e poder votar na sua arte preferida!</strong></p>
                @endif
                <h4 class="text-primary">Artes: </h4>
                @foreach($contest->projects()->where('approved',1)->get()->shuffle() as $key => $project)
                    @if($key % 3 == 0)
                        <div class="row">
                    @endif
                    <div class="col-md-4 col-xs-6">
                        <div class="panel project-card">
                            <div class="panel-body text-center">
                                @if(Auth::check() && $contest->isOpenForVoting())
                                    <a href="#voting-modal" 
                                       data-id="{{ $project->id }}" 
                                       data-author="{{ $project->author->nickname or $project->author->name }}"
                                       data-description="{{ $project->description }}"
                                       data-toggle="modal">
                                        <img src="{{ asset('project_images/'.$project->filename) }}">
                                    </a>
                                @else
                                    <a  href="{{ asset('project_images/'.$project->filename) }}"
                                        data-lightbox="{{ $contest->id }}"
                                        data-title="{{ $project->author->nickname or $project->author->name}}">
                                        <img src="{{ asset('project_images/'.$project->filename) }}">
                                    </a>
                                @endif      
                                {{-- <a href="{{ asset('project_images/'.$project->filename) }}"
                                   data-lightbox="{{ $contest->id }}"
                                   data-title="{{ $project->author->nickname or $project->author->name}}">
                                    <img src="{{ asset('project_images/'.$project->filename) }}">
                                </a> --}}
                                <div class="caption">{{ $project->author->nickname or $project->author->name }}</div>
                            </div>
                        </div>
                    </div>
                    @if($key % 3 == 2)
                        </div>
                    @endif
                @endforeach
            @endif
        @endif
    </div>
@stop

@include('app.components.voting_modal')