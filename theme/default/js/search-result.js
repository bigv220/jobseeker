function getDetailMsgForSearchResult(this1) {
       if ($(this1).attr('data-id') == 0) {
            return;
       }
       $.post(base_url + "inbox/getDetailMsg", { msg_id:$(this1).attr('data-id') },
            function(data){
                $('#msg_id').val($(this1).attr('data-id'));
                $('#user2').val($(this1).attr('data-user'));
                var jingchat = $(this1).parent().next().children().last();
                if (data.trim() != '') {
                    jingchat.find('.jingchat_messages').html(data);
                    jingchat.find('.jingchat_messages').show().css('opacity',0.5);
                    jingchat.find('.jingchat_offline_message').css('position','absolute').css('left','100px').css('top','160px');
                    jingchat.find('.jingchat_messages').scrollTop(jingchat.find('.jingchat_messages')[0].scrollHeight);
                } else {
                    jingchat.find('.jingchat_offline_message').show();
                }
                //if ($(this1).attr('data-user') != 0)
                //    checkonlinestatus($(this1).attr('data-user'), jingchat);
        });
        
    }
var checkonlinestatus = function(user_id, jingchat) {
        if ($('#ids').val()== '')
            return;
        var ajax=$.post(base_url + 'user/getstatus', {
            'userid': $('#ids').val()
        }, function(status){         
            if ( checkJson(status)) {
                $.each(status, function(i, data){
                    if (data.status == 1) {
                        $('#message_list_'+data.uid).find('.jingchat_messages').css('opacity',1);
                        $('#message_list_'+data.uid).find('.jingchat_offline_message').hide();
                    } else {
                        $('#message_list_'+data.uid).find('.jingchat_offline_message').show();    
                    }
                });
                
            }
        });
}
var getRealTimeMessage = function() {
     if ($('#msg_id').val() == 0 || $('#msg_id').val() == '') 
        return;
     
     $('.jingchat_messages:visible').each(function(index,data) {
        var seq = $(data).children().last().attr('data-seq');
        var msg_id = $(data).parent().attr('data-id');
        var user2 = $(data).parent().attr('data-user');
        if (seq==undefined) 
            return;
        $.post(base_url + "inbox/getRealTimeMessage", { msg_id:msg_id,user2:user2,seq:seq},
            function(html){
                $(data).append(html);
                
                $(data).scrollTop($(data)[0].scrollHeight);
            });
     });
     
}
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
/********DOCUMENT READY*****************/
$(function(){
    setInterval(function(){
        checkonlinestatus();
    }, 5000);
    setInterval(function(){
         getRealTimeMessage();
    }, 5000);
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
            if(window.location.href.indexOf('search/searchJobseeker') >0) {
                $.post(site_url + 'user/updateVisitNum',
                    {uid: aViewMore.attr('alt')},
                    function(result) {

                });
            }
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

    $('.inbox_content').fxuiTab({
        evt:'click',
        eq:0
    });

     //Pop mark
    var popMark =$('.pop-mark'),
        popApply = $('.pop-apply'),
        popReg = $('.pop-reg'),
        signupApply = $('.signup-pop-apply');
    var popDeleteJob = $('.pop-delete-job'),
    popDeleteCom = $('.pop-delete-company');

    var popBookmark = $('.pop-bookmark'),
        popBookmarkSignup = $('.signup-pop-bookmark');

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
        popDeleteJob.fadeOut();
        popDeleteCom.fadeOut();
        popBookmark.fadeOut();
    });

    $('.signup-pop-apply-close').click(function(){
        popMark.fadeOut();
        signupApply.fadeOut();
        popBookmarkSignup.fadeOut();
    });

    $('.signup-pop-apply .signup-pop-btn').click(function(){
        signupApply.fadeOut();
        popReg.fadeIn();
    });

    $('.signup-pop-bookmark .signup-pop-btn').click(function(){
        popBookmarkSignup.fadeOut();
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
        popDeleteJob.fadeOut();
        popDeleteCom.fadeOut();
        popDeleteCom.fadeOut();
        popBookmark.fadeOut();
    });

    // Delete bookmark job PopUp
    $('.delete_job_btn').bind('click',function apply(e) {
        popMark.fadeIn();
        popDeleteJob.fadeIn();
        var id = $(this).attr('data-job-id');
        $('#selected_job_id').val(id);

        e.stopPropagation();
        e.preventDefault();
    });

    //click delete job 'Yes'
    $('.pop-delete-job-yes').click(function(){
        popDeleteJob.fadeOut();
        popMark.fadeOut();

        var job_id = $('#selected_job_id').val();
        // Delete JOB
        $.post(site_url + 'job/deletebookmarkinfo', {id: job_id, type: 'job'},
            function(result) {
                result = eval('('+result+')');
                var status  = result.status;
                if (status=='success') {
                    $('#jobdiv'+job_id).css('display', 'none');
                } else if (status =='login') {
                    alert('Please Login to delete this job.');
                } else {
                    alert(status);
                }
            });
    });

    // delete bookmark company
    $('.delete_company_btn').bind('click',function apply(e) {
        popMark.fadeIn();
        popDeleteCom.fadeIn();
        var id = $(this).attr('data-company-id');
        $('#selected_company_id').val(id);

        e.stopPropagation();
        e.preventDefault();
    });

    //click delete job 'Yes'
    $('.pop-delete-company-yes').click(function(){
        popDeleteCom.fadeOut();
        popMark.fadeOut();

        var com_id = $('#selected_company_id').val();;
        // Delete JOB
        $.post(site_url + 'job/deletebookmarkinfo', {id: com_id, type: 'company'},
            function(result) {
                result = eval('('+result+')');
                var status  = result.status;
                if (status=='success') {
                    $('#jobdiv'+com_id).css('display', 'none');
                } else if (status =='login') {
                    alert('Please Login to delete this job.');
                } else {
                    alert(status);
                }
            });
    });

    // bookmark job PopUp
    $('.job-btn-mark').bind('click',function apply(e) {
        popMark.fadeIn();
        popBookmark.fadeIn();
        var id = $(this).attr('data-job-id');
        $('#selected_job_id').val(id);

        e.stopPropagation();
        e.preventDefault();
    });

    $('.job-btn-marked').bind('click',bookmarked);

    //click bookmark job 'Yes'
    $('.pop-bookmark-yes').click(function(){
        popBookmark.fadeOut();
        popMark.fadeOut();

        var job_id = $('#selected_job_id').val();
        // Delete JOB
        $.post(site_url + 'job/bookmark', {id: job_id, type: 'job'},
            function(result) {
                result = eval('('+result+')');
                var status  = result.status;
                if (status=='success') {
                    $('#job-mark'+job_id).removeClass('job-btn-mark');
                    $('#job-mark'+job_id).addClass('job-btn-marked');
                } else if (status =='login') {
                    popMark.fadeIn();
                    $('.signup-pop-bookmark').css('display', 'block');
                    //alert('Please Login to bookmark this job.');
                } else {
                    alert(status);
                }
            });
    });

    $('.jobseeker-btn-shortlisted').click(function(e) {
        var user_id = $(this).attr('data-id');
        
        $.post(site_url + 'company/addCandidate', {user_id:user_id},
            function(result,status) {
                if (status=='success') {
                    // TO check why $(this).addClass doesn't work.
                    if (!$('a[data-id='+user_id+']').hasClass('jobseeker-btn-shortlisted_current')) {
                        $('a[data-id='+user_id+']').addClass('jobseeker-btn-shortlisted_current');
                    } else {
                        $('a[data-id='+user_id+']').removeClass('jobseeker-btn-shortlisted_current');
                    }
                }
        });
        
        e.stopPropagation();
        e.preventDefault();
    });

    var user_id = 0;
    $('.jobseeker-btn-delete-candidate').click(function(e) {
        user_id = $(this).attr('data-id');
        popMark.fadeIn();
        popApply.fadeIn();
       
        
        e.stopPropagation();
        e.preventDefault();
    });

    $('.delete-candidate-yes').click(function(e) {
         $.post(site_url + 'company/addCandidate', {user_id:user_id},
            function(result,status) {
                if (status=='success') {
                    // TO check why $(this).addClass doesn't work.                  
                    $('#sresult-user'+user_id).remove();
                }
        });
        popMark.fadeOut();
        popApply.fadeOut();
    });

    // Send Message
    $('.sresult-par2 .jingchat_message_input textarea').keypress(function(event) {
        // Check the keyCode and if the user pressed Enter (code = 13) 
        if (event.keyCode == 13) {
            $.post(base_url + "inbox/sendmsg", { user2:$(this).attr('data-user'), message:$(this).val() },
            function(data){
                $('.jingchat_message_input textarea').val('');
                if ($(this).parent().parent().find('.jingchat_messages').is(':hidden')) 
                    alert('Your message has been sent to their Jingchat inbox.')
            });
        }
    });
});

function apply(e){
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
function bookmarked() {
    alert('You have already bookmarked this job.')
    return false;
}
