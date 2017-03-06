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

	$("#register-user-form [name=state]").change(function(){
		var input = $(this);
		var form = input.parents('form');

		$.get(window.webRoot+'estado/'+input.val()+'/cidades').done(function(response){
			var city_select = $('[name=city_id]',form);
			$('.cidade',city_select).remove();
			$.each(response,function(key,city){
				city_select.append($('<option>').addClass('cidade').attr('value',city.id).text(city.name));
			});
		});
	});
});