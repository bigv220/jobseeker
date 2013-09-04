$(function(){
    //search result page--------------

    //search-result sequence
    $('.kyo-select').kyoSelect({
        width:'145',
        height:'25'
    });

    //search-result after search
    $('.after-select').kyoSelect({
        width:'230',
        height:'25'
    });



    //sel-industry
    $('#sel-industry').checkSelect({
        text:'--Industries--',
        data:[
            {title:'value1',value:'1'},
            {title:'value2',value:'2'},
            {title:'value3',value:'3'},
            {title:'value4',value:'4'}
        ],
        showDiv:$('#sel-industry-val'),
        width:230,
        height:26,
        max:3,
        ismax:function(){alert('max 3!!!')}
    });


    //sel-position
    $('#sel-position').checkSelect({
        text:'--position--',
        data:[
            {title:'value1',value:'1'},
            {title:'value2',value:'2'},
            {title:'value3',value:'3'},
            {title:'value4',value:'4'},
            {title:'value5',value:'5'},
            {title:'value6',value:'6'},
            {title:'value7',value:'7'},
            {title:'value8',value:'8'},
            {title:'value9',value:'9'},
            {title:'value10',value:'10'},
            {title:'value11',value:'11'},
            {title:'value12',value:'12'},
            {title:'value13',value:'13'}
        ],
        showDiv:$('#sel-position-val'),
        width:230,
        height:26,
        max:10,
        ismax:function(){alert('max 10!!!')}
    });

    //sel-Language
    $('#sel-language').checkSelect({
        text:'Select Language',              //显示的文字
        data:[
            {title:'all language',value:'1'},
            {title:'value2',value:'2'},
            {title:'value3',value:'3'},
            {title:'value4',value:'4'},
            {title:'value5',value:'5'},
            {title:'value6',value:'6'},
            {title:'value7',value:'7'},
            {title:'value8',value:'8'},
            {title:'value9',value:'9'},
            {title:'value10',value:'10'},
            {title:'value11',value:'11'},
            {title:'value12',value:'12'},
            {title:'value13',value:'13'}
        ],
        showDiv:$('#sel-language-val'),       //值显示的div
        width:230,                            //宽度
        height:26,                            //高度
        max:999,                              //最多可以有几项
        ismax:function(){alert('max 999!!!')} //如果超出执行代码
    });

    //gotop
    $('.backtop').fxBacktop();


    //result-bd
    $('.job-viewmore,.sresult-par1').click(function(e){

        var abtn = $(this).parents('.sresult-row').find('.job-btn-submit');
        var oDom = $(this).parents('.sresult-row').find('.sresult-par2');
        var aMark = $(this).parents('.sresult-row').find('.job-mark');
        if(oDom.css('display')=='none'){
            aMark.addClass('job-mark2').removeClass('job-mark1');
            oDom.slideDown();
            abtn.css({display:'block'}).show();
            
        }else{
            oDom.slideUp();
            abtn.hide();
            aMark.addClass('job-mark1').removeClass('job-mark2');
        }

        e.stopPropagation();
        e.preventDefault();
    })

    //result-bd tab
    $('.sresult-par2').fxuiTab({
        evt:'click',
        eq:0
    })


     //Pop mark
    var popMark =$('.pop-mark'),
        popApply = $('.pop-apply');

    //Pop apply
    var rowObj;
    $('.job-btn-submit').bind('click',apply);
    function apply(e){
            rowObj = $(this).parents('.sresult-row');
            $('.pop-mark').height($('body').height());
            popMark.fadeIn();
            popApply.fadeIn();
            e.stopPropagation();
            e.preventDefault();
    }
    function submitted(e){
        alert('Submitted!!!')
        return false;
        e.stopPropagation();
        e.preventDefault();
    }

    //Pop apply close
    $('.pop-apply-close').click(function(){
        popMark.fadeOut();
        popApply.fadeOut();
    })

    //click Yes
    $('.pop-btn-yes').click(function(){
        popApply.fadeOut();
        popMark.fadeOut();

        var appBtn = rowObj.find('.job-btn-submit');
        appBtn.addClass('job-btn-submitted');
        appBtn.unbind('click',apply);
        appBtn.bind('click',submitted);
    })

    //click No
    $('.pop-btn-no').click(function(){
        popApply.fadeOut();
        popMark.fadeOut();
    })

})