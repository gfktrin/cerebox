<div class="modal fade" id="voting-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-primary">Distribua os pontos para concluir seu voto</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img class="project_art img-responsive" src="">
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#imgModal">Ver imagem completa</button>
                        <br>
                        <div class="description_container">
                        <p class="project_description"></p>
                        </div>
                        <br>
                        <p style="color: red"><strong>Incetivamos o uso de até duas casas decimais ex: 4,39; 2,1</strong></p>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <form id="voting-form" class="form-horizontal" action="{{ action('ProjectController@vote') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="project_id" value="">
                            
                            <p>Distribua entre 12 e 15 pontos nas categorias abaixo:</p>

                            @foreach(Cerebox\VoteCategory::all() as $vote_category)
                                <div class="form-group">
                                    <label class="control-label col-sm-8 text-primary">{{ $vote_category->name }}</label>
                                    <div class="col-sm-4">
                                        <input name="category_grade[{{ $vote_category->id }}]" data-id="{{ $vote_category->id }}" type="number" value="" min="2" max="5" class="form-control">
                                    </div>
                                </div>
                            @endforeach

                            {{-- <p class="points_to_distribute text-right">
                                Pontos faltantes: <span class="points"></span>
                            </p> --}}

                            <input type="submit" id="voting_submit" class="hidden">
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" id="voting-modal-submit" class="btn btn-primary">Concluir</button>
            </div>
        </div>
    </div>
</div>
<div id="imgModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 100%;height: 100%;margin: 0;padding: 0;">

    <!-- Modal content-->
    <div class="modal-content" style="height: auto;min-height: 100%;border-radius: 0;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Arte</h4>
      </div>
      <div class="modal-body">
        <img class="project_art" src="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Concluir</button>
      </div>
    </div>

  </div>
</div>