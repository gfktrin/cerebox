$(function(){
    $('#create-contest').submit(function(ev){
        ev.preventDefault();
        var form = $(this);

        var action = form.attr('action');

        var data = form.serialize();

        var submitButton = $('[type=submit]',form);
        submitButton.button('loading');

        //Reset errors
        $('.help-block.error',form).remove();
        $('.form-group.has-error').removeClass('has-error');

        $.post(action,data,function(response){
            alert('Concurso criado');
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
                        var error = $('<span></span>').addClass('help-block error').text(value[0]);
                        $('[name='+key+']',form).parents('.form-group').addClass('has-error').append(error);
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
