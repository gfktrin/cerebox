
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./admin/load');
require('./app/load');

window.App = {

    init: function(){
        $.material.init();


        $('input[type=datetime]').datetimepicker({
            useCurrent : true,
            format : 'YYYY-MM-DD HH:mm:ss',
            sideBySide : true,
            showTodayButton : true
        });
    },

    Form: {
        submit : function(form, success_message, success_callback, error_callback){
            var action = form.attr('action');

            var data = form.serialize();

            var submitButton = $('[type=submit]',form);
            submitButton.button('loading');

            //Reset errors
            $('.help-block.error',form).remove();
            $('.form-group.has-error').removeClass('has-error');

            $.post(action,data,function(response){
                if(success_message instanceof Object){
                    swal(success_message,success_callback)
                }else{
                    swal({
                        title: success_message,
                        type: "success"
                    },success_callback);
                }
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

                if(error_callback)
                    error_callback();
            });
        }
    }
};

$(function(){

    App.init();

});