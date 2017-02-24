$(function(){
	$('#register-user-form [name=zipcode]').keyup(function(){
		var input = $(this);
		var value = input.val().replace('-','');

		if(value.length == 8){
			var url = 'https://viacep.com.br/ws/'+value+'/json/'
			$.get(url).done(function(response){
				$('#register-user-form [name=address]').val(response.logradouro);
				$('#register-user-form [name=city]').val(response.localidade);
				$('#register-user-form [name=state]').val(response.uf);
	
				$('#register-user-form [name=number]').val('');
				$('#register-user-form [name=complement]').val('');
			});
		}

	});
});