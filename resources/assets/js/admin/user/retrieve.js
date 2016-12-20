/**
 * Created by lucasgonzalez on 20/12/16.
 */
$(function(){
    $('#update-user').submit(function(ev){
        ev.preventDefault();
        var form = $(this);

        var action = form.attr('action');

        var data = form.serialize();

        var submitButton = $('[type=submit]',form);
        submitButton.button('loading');

        $.post(action,data,function(response){
            alert('Dados atualizados');
            window.location = form.data('redirect');
        }).fail(function(response){
            submitButton.button('reset');
            switch (response.status){
                case 400:
                    alert(response.responseText);
                    break;
                case 403:
                    alert(response.responseText);
                    break;
                case 422:
                    var errors = response.responseJSON;
                    $.each(errors, function(key,value){
                        var error = $('<div></div>').addClass('alert alert-danger').text(value[0]);
                        console.log(key);
                        $('[name='+key+']',form).parents('.form-group').append(error);
                    });
                    break;
                case 500:
                    alert(response.responseText);
                    break;
            }
        });

        return false;
    });
});