$(function(){

    $('#update-contest').submit(function(ev){
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

    $('#delete-contest').submit(function(ev){
        ev.preventDefault();
        
        var form = $(this);

        App.Form.submit(form,{
            title: 'Concurso apagado',
            type: "success",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        },function(){
            window.location = form.data('redirect');
        });

        return false;
    });

});