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
});