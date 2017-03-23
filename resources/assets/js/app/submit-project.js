/**
 * Created by lucasgonzalez on 19/12/16.
 */
$(function(){
    $('#submit-project [name*=multiplier]').change(function(){
        console.log('change');
        var select = $(this);
        var option_to_disable = $('option:selected',select);
        var options_to_enable = $('option:not(:selected)',select);

        $('option[value="'+option_to_disable.attr('value')+'"]',$('select[name*=multiplier]:not(#'+select.attr('id')+')')).prop('disabled',true);
        
        options_to_enable.each(function(key,value){
            var option = $(value);
            var this_select = option.parents('select');
            var other_selects =  $('select:not(#'+this_select.attr('id')+')');

            if($('option[value="'+option.attr('value')+'"]:selected',other_selects).length == 0)
                $('option[value="'+option.attr('value')+'"]').prop('disabled',false);
        });     
    });

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
            //text: '',
            type: "success",
        },function(response){
            window.location = form.data('redirect');
        },function(){
            $(".help-block.error").css({position:'relative'}).show();
        });

        return false;
    });

});