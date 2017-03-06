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

	$("#update-user [name=state]").change(function(){
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