$(function(){
    //Pop mark
    var popMark =$('.pop-mark'),
        popViewPortfolio = $('.view_portfolio_pop');

    $('.portfolio_item').click(function(){
        popMark.fadeIn();
        popViewPortfolio.fadeIn();
    });

    $('.view_portfolio_pop_close').click(function(){
        popMark.fadeOut();
        popViewPortfolio.fadeOut();
    });

})