/**
 * Created by lucasgonzalez on 20/12/16.
 */
$(function(){
    $('#update-user').submit(function(ev){
        ev.preventDefault();

        var form = $(this);

        App.Form.submit(this,{
            title: 'Dados atualizados',
            type: "success",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        },function(){
            window.location = form.data('redirect');
        });

        return false;
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