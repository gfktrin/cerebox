
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

    Voting: { //Descontinuado por motivos de deadline e falta de café :(

        default_min_value : 2,

        default_points_to_distribute : 9,

        points_to_distribute : 9,

        grades : {},

        init : function(categories){
            categories.each(function(key,value){
                var category = $(value);
                this.grades[category.data('id')] = 2;
            });
        },

        validatePoints: function(input){
            var value = input.val();

            var old_grade = this.grades[input.data('id')];

            if(value <= this.points_to_distribute){
                this.points_to_distribute -= (value - old_grade);
                this.grades[input.data('id')] = value;          
            }else{
                input.val(this.default_min_value);
            }

        },

        resetPoints: function(){
            this.points_to_distribute = this.default_points_to_distribute;
        }

    },

    Form: {
        submit : function(form, success_message, success_callback, error_callback){
            var $form = $(form);

            var action = $form.attr('action');

            var data = new FormData(form);

            var submitButton = $('[type=submit]',$form);
            submitButton.button('loading');

            //Reset errors
            $('.help-block.error', $form).remove();
            $('.form-group.has-error').removeClass('has-error');

            $.post({
                url: action,
                data: data,
                processData: false,
                contentType: false,
                success: function(response){
                    if(success_message instanceof Object){
                        swal(success_message,function(){
                            success_callback(response)
                        })
                    }else{
                        swal({
                            title: success_message,
                            type: "success"
                        },function(){
                            success_callback(response);
                        });
                    }
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
                                $('[name='+key+']',$form).parents('.form-group').addClass('has-error');
                                $('[name='+key+']',$form).parent().append(error);
                            });
                            break;
                        case 500:
                            alert(response.responseText);
                            break;
                    }

                    if(error_callback)
                        error_callback(response);
                }
            });
        }
    }
};

$(function(){

    App.init();

});