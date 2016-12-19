
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./admin/load');
require('./app/load');

$(function(){
    $.material.init();


    $('input[type=datetime]').datetimepicker({
        useCurrent : true,
        format : 'YYYY-MM-DD HH:mm:ss',
        sideBySide : true,
        showTodayButton : true
    });
});