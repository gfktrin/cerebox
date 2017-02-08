/**
 * Created by lucasgonzalez on 19/12/16.
 */
$(function(){
    //todo Não sei se coloco numa função separada
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

        App.Form.submit(this,{
            title: 'Projeto enviado',
            text: 'Para terminar o processo de envio de projeto, você será redirecionado para o pagamento da inscrição.',
            type: "success",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        },function(response){
            window.location = response.redirect_url;
        },function(){
            $(".help-block.error").css({position:'relative'}).show();
        });

        return false;
    });

});