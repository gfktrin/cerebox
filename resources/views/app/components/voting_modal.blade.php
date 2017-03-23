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
                        <p class="project_description"></p>
                    </div>
                    <div class="col-md-6">
                        <form id="voting-form" class="form-horizontal" action="{{ action('ProjectController@vote') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="project_id" value="">
                            
                            <p>Distribua 15 pontos entre essas categorias:</p>

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