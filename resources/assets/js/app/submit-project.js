/**
 * Created by lucasgonzalez on 19/12/16.
 */
$(function(){
    $('#submit-project-art').change(function(ev){
        var input = this;
        var form_group = $(this).parents('.form-group');

        var preview  = $('.preview',form_group);

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = $('img',preview);
                if(img.length === 0){
                    var img = $('<img>').attr('src',e.target.result);
                    preview.append(img);
                }else{
                    img.attr('src',e.target.result);
                }

            }

            reader.readAsDataURL(input.files[0]);
        }
    });

    $('#submit-project').submit(function(ev){
        ev.preventDefault();
        var form = $(this);

        var action = form.attr('action');

        var data = new FormData(this);

        var submitButton = $('[type=submit]',form);
        submitButton.button('loading');

        //Reset errors
        $('.help-block.error',form).remove();
        $('.form-group.has-error').removeClass('has-error');

        $.post({
            url: action,
            data: data,
            processData: false,
            contentType: false,
            success: function(response){
                alert('Projeto enviado com sucesso');
                window.location = form.data('redirect');
            },
            error: function(response){
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
            }
        });

        return false;
    });
});