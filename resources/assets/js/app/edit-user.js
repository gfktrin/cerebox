$(function(){
	$('#update-user [name=zipcode]').keyup(function(){
		var input = $(this);
		var value = input.val().replace('-','');

		if(value.length == 8){
			var url = 'https://viacep.com.br/ws/'+value+'/json/'
			$.get(url).done(function(response){
				$('#update-user [name=address]').val(response.logradouro);
				$('#update-user [name=city]').val(response.localidade);
				$('#update-user [name=state]').val(response.uf);
				
				$('#update-user [name=number]').val('');
				$('#update-user [name=complement]').val('');

			});
		}

	});
});