$(function(){
     //pub input tips
    $('.input-tip')
    .focusin(function(event) {
        var val = $(this).val();
        var tipval = $(this).data('tipval');
        val == tipval &&  $(this).val('');
    })
    .focusout(function(event) {
        var val = $(this).val();
        var tipval = $(this).data('tipval');
        $.trim(val) == '' &&  $(this).val(tipval);
    });


    //pub top login 
    $('.phd-login').hover(function(){
        $('.phd-login-pop').stop().fadeIn();
    },function(){
        $('.phd-login-pop').stop().fadeOut();
    })
    $('.input-wrap input')
    .focusin(function(event) {
        var val = $(this).val();
        if(!val){
            $(this).addClass('has');
        }
    })
    .focusout(function(event) {
        var val = $(this).val();
         if(!val){
            $(this).removeClass('has');
        }
    });

    //pub pop mark
    $('.pop-mark').height($('body').height());

    

})