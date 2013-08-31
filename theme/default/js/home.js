$(function(){

    //sponsors rool
    $('.p-sponsors').roll({
        box:{
            width:990,   //整块的宽
            height:156,   //整块的高
            hspace:125    //两边空的间距
        },
        item:{
            width:168,    //小块的宽
            height:85,   //小块的高
            mr:22        //左边空的间距
        },
        speed:600       //滚动速度      
    });

    //login 
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

    //Find
    $('.pbn-find-block').hover(function(){
        var obj= $(this).find('.find-hover');
        obj.stop().fadeIn();
    },function(){
        var obj= $(this).find('.find-hover');
        obj.stop().fadeOut();
    })

    //Pop mark
    var height = $('body').height(),
        popMark =$('.pop-mark'),
        popReg = $('.pop-reg');
    popMark.height(height);

    //Pop Sing Up
    $('.pbn-singup-btn').click(function(){
        popMark.fadeIn();
        popReg.fadeIn();
    });
    $('.pop-reg-close').click(function(){
        popMark.fadeOut();
        popReg.fadeOut();
    });
    $('.reg-typep').click(function(){
        $('.pop-reg-personal').show().next().hide();
    });
    $('.reg-typec').click(function(){
        $('.pop-reg-company').show().prev().hide();
    });
    $('.pop-reg-submit-btn').click(function(){
        popReg.fadeOut();
        $('.pop-welcome').fadeIn();
    })
    $('.pop-welcome-close').click(function(){
        $('.pop-welcome').fadeOut();
        popMark.fadeOut();
    })
    $('#industry_box').tagit({select:true, sortable:true});
    $('.tagit-input').attr('disabled','disabled');
    $('#industry').change(function() {
        addTag($('#industry').val());
    });
    
})
var addTag = function(tag) {
    $('#industry_box').tagit("add", {label: tag, value: tag});

}
var doCompanySubmit = function() {
    var tags = $("#industry_box").tagit("tags");

    var string1 = "";
    for (var i in tags)
        string1 += "," + tags[i].value;
    $('#industry_tag').val(string1);
    $('#companyForm').submit();
}