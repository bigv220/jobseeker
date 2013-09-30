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
        $('#login_pop').stop().fadeIn();
    },function(){
        $('#login_pop').stop().fadeOut();
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

function valid_email(email) {
    var patten = new RegExp(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/);
    return patten.test(email);
}

function show_welcome_pop(usertype){
    var lefttext = "Let us know your<br/>job preference";
    var righttext = "Start looking at<br/>jobs in China now";
    var lefthref = "#";
    var righthref = "#";
    if(usertype == 1){//employer
        var lefttext = "Tell us more about<br/> your company";
        var righttext = "Start looking at<br/> jobseekers";
        var lefthref = "#";
        var righthref = "#";
    }

    $('.pop-welcome .left-span-text').html(lefttext);
    $('.pop-welcome .left-btn-link').attr('href', lefthref);
    $('.pop-welcome .right-span-text').html(righttext);
    $('.pop-welcome .right-btn-link').attr('href', righthref);
    $('.pop-welcome').fadeIn();
}