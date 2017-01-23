/**
 * Created by luke on 22/01/17.
 */

$(function(){
    $('#input-contest-search').keyup(function(){
        var input = $(this);

        var value = input.val();

        $('.contest').hide();

        if(value == '')
            $('.contest').show()
        else
            $('.contest[data-search*='+value.toLowerCase()+']').show();

    });
});
