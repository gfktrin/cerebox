var updatePoints = function(){
	$('points_to_distribute .points').text(App.Voting.points_to_distribute);
}

$(function(){

	// App.Voting.init($('[name*=category_grade]'));

	$('#voting-form').submit(function(ev){
		ev.preventDefault();
		
		App.Form.submit(this,{
            title: 'Voto computado',
            //text: '',
            type: "success",
        },function(response){
            window.location.reload();
        },function(response){
        	var errors = response.responseJSON;
        
        	if(errors.alert){
	            swal({
	            	title: errors.alert[0],
	            	type: 'error'
	            });
        	}
        });

        return false;
	});

	$('#voting-modal-submit').click(function(){
		$('#voting-form').submit();
	});

	$('#voting-modal').on('show.bs.modal',function(ev){
		var project = $(ev.relatedTarget);

		var img = $('img',project).attr('src');
		var id = project.data('id');
		var description = project.data('description');
		var author = project.data('author');

		var form = $('#voting-form');

		$('[name=project_id]',form).val(id);
		$('.project_art').attr('src',img);
		$('.project_description').text(description);
		
		$('[name*=category_grade]').val(2);
		// $('.points_to_distribute .points').text(9);
		
		// App.Voting.resetPoints();
	});

	$('#voting-modal form [name*=category_grade]').change(function(ev){
		var input = $(ev.target);

		// App.Voting.validatePoints(input);

		// updatePoints();
	});

});