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


    //Find
    $('.pbn-find-block').hover(function(){
        var obj= $(this).find('.find-hover');
        obj.stop().fadeIn();
    },function(){
        var obj= $(this).find('.find-hover');
        obj.stop().fadeOut();
    })

    //Pop mark
    var popMark =$('.pop-mark'),
        popReg = $('.pop-reg');

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



   
})