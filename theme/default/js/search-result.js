
    function formatItem(row){
        return " <p>"+row +" </p>";
    }

    function formatResult(row){
        return row[0].replace(/(<.+?>)/gi, '');
    }

    function selectItem1(v){
        addSkillsAjax('PersonalSkills',v);
    }

    function selectItem2(v){
        addSkillsAjax('ProfessionalSkills', v);
    }

    function searchJob() {
        $('#search_form').submit();
    }

    function addSkills(id_str, thisO) {
        var v = $(thisO).val();

        addSkillsAjax(id_str, v);
    }

    function addSkillsAjax(id_str, v) {
        var htm = '<li data-val="2">'+ v +
            '<i class="del" onclick="delSkills' + '(\''+ id_str + '\',this,\''+ v + '\');"></i></li>'

        var str_key = '#'+ id_str + '_str';
        var str = $(str_key).val();

        if(str == '') {
            $(str_key).val(v);
        } else if(str.indexOf(v)==-1) {
            $(str_key).val(str+','+v);
        }
        $('#'+ id_str).append(htm);

        $('#'+id_str+'_input').val('');
    }

    function delSkills(id_str, thisO, v) {
        var str_key = '#'+ id_str + '_str';
        var str = $(str_key).val();

        var str_cop = str;
        if(str != '' && str.indexOf(v)>-1) {
            var new_str = str_cop.substring(0, str.indexOf(v)-1) + str.substr(str.indexOf(v)+v.length);
            $(str_key).val(new_str);
        }

        $(thisO).parent().remove();
    }

    function clearHint(thisO) {
        if($(thisO).val() == 'Enter Keywords') {
            $(thisO).val('');
        }
    }

    function showHint(thisO) {
        if($(thisO).val() == '') {
            $(thisO).val('Enter Keywords');
        }
    }
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
            {title:'Accounting',value:'Accounting'},
            {title:'HR',value:'HR'},
            {title:'Finance',value:'Finance'},
            {title:'Design',value:'Design'},
            {title:'Education',value:'Education'}
        ],
        showDiv:$('#sel-industry-val'),
        width:230,
        height:26,
        ismax:function(){alert('max 3!!!')}
    });


    //sel-position
    $('#sel-position').checkSelect({
        text:'All Positions',
        data:[
            {title:'Employee',value:'1'},
            {title:'Manager',value:'2'},
            {title:'Director',value:'3'},

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
            {title:'Chinese',value:'Chinese'},
            {title:'English',value:'English'},
            {title:'French',value:'French'},
            {title:'Spanish',value:'Spanish'}
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
    $('.sresult-par1').click(function(e){

        var abtn = $(this).parents('.sresult-row').find('.job-btn-submit');
        var abtn_submitted = $(this).parents('.sresult-row').find('.job-btn-submitted');
        var requestinterviewbtn = $(this).parents('.sresult-row').find('.jobseeker_request_interview');
        var oDom = $(this).parents('.sresult-row').find('.sresult-par2');
        var aMark = $(this).parents('.sresult-row').find('.job-mark');
        var aViewMore = $(this).find('.job-viewmore');
        if(oDom.css('display')=='none'){
            aMark.addClass('job-mark2').removeClass('job-mark1');
            oDom.slideDown();
            abtn.css({display:'block'}).show();
            abtn_submitted.css({display:'block'}).show();
            requestinterviewbtn.css({display:'block'}).show();
            aViewMore.html("View Less");
        }else{
            oDom.slideUp();
            abtn.hide();
            abtn_submitted.hide();
            requestinterviewbtn.hide();
            aMark.addClass('job-mark1').removeClass('job-mark2');
            aViewMore.html("View More");
        }

        e.stopPropagation();
        e.preventDefault();
    });

    //result-bd tab
    $('.sresult-par2').fxuiTab({
        evt:'click',
        eq:0
    });

    $('.result-condition').fxuiTab({
        evt:'click',
        eq:0
    });


     //Pop mark
    var popMark =$('.pop-mark'),
        popApply = $('.pop-apply'),
        popReg = $('.pop-reg'),
        signupApply = $('.signup-pop-apply');

    //Pop apply
    var rowObj;
    $('.job-btn-submit').bind('click',function apply(e) {
        if(userType != 0){
            popMark.fadeIn();
            signupApply.fadeIn();
        }
        else{
            rowObj = $(this).parents('.sresult-row');
            $('.pop-mark').height($('body').height());
            popMark.fadeIn();
            popApply.fadeIn();
            e.stopPropagation();
            e.preventDefault();
        }
    });

    $('.job-btn-submitted').bind('click',submitted);


    //Pop apply close
    $('.pop-apply-close').click(function(){
        popMark.fadeOut();
        popApply.fadeOut();
    });

    $('.signup-pop-apply-close').click(function(){
        popMark.fadeOut();
        signupApply.fadeOut();
    });

    $('.signup-pop-apply .signup-pop-btn').click(function(){
        signupApply.fadeOut();
        popReg.fadeIn();
    });

    //click Yes
    $('.pop-btn-yes').click(function(){
        popApply.fadeOut();
        popMark.fadeOut();

        var appBtn = rowObj.find('.job-btn-submit');
        var job_id = appBtn.attr('data-job-id');
        var email = appBtn.attr('data-job-email');
        // APPLY JOB
        $.post(site_url + 'job/apply', {job_id: job_id, email: email},
            function(result,status) {
                if (status=='success') {
                    appBtn.unbind('click');
                    appBtn.bind('click',submitted);
                    appBtn.removeClass('job-btn-submit').addClass('job-btn-submitted');
                    $(".id-"+job_id+" .comp_email").html("");
                } else if (status =='login') {
                    alert('Please Login to apply a job.');
                } else {
                    alert(status);
                }
            });
        
    });

    //click No
    $('.pop-btn-no').click(function(){
        popApply.fadeOut();
        popMark.fadeOut();
    });

});    function apply(e){
            rowObj = $(this).parents('.sresult-row');
            $('.pop-mark').height($('body').height());
            popMark.fadeIn();
            popApply.fadeIn();
            e.stopPropagation();
            e.preventDefault();
    }
    function submitted(e){
            $('.job-btn-submit').unbind('click',apply);
            alert('You have already applied this job.')
            return false;
            e.stopPropagation();
            e.preventDefault();
    }
