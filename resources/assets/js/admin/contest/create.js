$(function(){

    $('#create-contest').submit(function(ev){
        ev.preventDefault();

        var form = $(this);

        App.Form.submit(this,{
            title: 'Concurso Criado',
            type: "success",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        },function(){
            window.location = form.data('redirect');
        });

        return false;
    });

});
