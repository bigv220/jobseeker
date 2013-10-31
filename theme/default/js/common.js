var userType = -1;//not login
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

var randNum = function(){
    var rnd = {};
    rnd.today = new Date();
    rnd.seed = rnd.today.getTime();
    rnd.seed = (rnd.seed * 9301 + 49297) % 233280;
    return rnd.seed / (233280.0);
}

function valid_email(email) {
    var patten = new RegExp(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/);
    return patten.test(email);
}

function show_login_user_menu(){
    var menu = $('#jobseeker_menu').html();
    $('#login_pop').html(menu);
}

function show_welcome_pop(usertype){
    //as we show welcome pop up after login, so we show the login user menu here
    show_login_user_menu();
    var lefttext = "Let us know your<br/>job preference";
    var righttext = "Start looking at<br/>jobs in China now";

    var lefthref = base_url + "jobseeker/register";
    var righthref = base_url + "search/findjob";
    if(usertype == 1){//employer
        var lefttext = "Tell us more about<br/> your company";
        var righttext = "Start looking at<br/> jobseekers";
        var lefthref = base_url + "company/register";
        var righthref = base_url + "search/findstaff";

    }

    $('.pop-welcome .left-span-text').html(lefttext);
    $('.pop-welcome .left-btn-link').attr('href', lefthref);
    $('.pop-welcome .right-span-text').html(righttext);
    $('.pop-welcome .right-btn-link').attr('href', righthref);
    $('.pop-welcome').fadeIn();
}
// change industry
    function changeIndustry(thisO) {
        var name = $(thisO).val();
        $.post(site_url + 'jobseeker/ajaxchangeindustry',
            { ind_name: name },
            function(result,status) {
                var position_htm = '<option value="">Position</option>';

                if(status == 'success'){
                    var obj = eval('('+result+')');
                    for ( var i = 0; i < obj.data.length; i++) {
                        position_htm += "<option value=\""+obj.data[i].name+"\">"+obj.data[i].name+"</option>";
                    }
                }
                $('#position_1').html(position_htm);
            });
    }

    // ajax localtion
    function change_location(this1, key, location) {

        var selected = this1.val();
        var html_option = "";

        if("country" == key) {
            var url = site_url + "jobseeker/ajaxlocation/" + key + "/" + selected;
            $.get(url, function(data){
                var obj = eval('('+data+')');
                for ( var i = 0; i < obj.length; i++) {
                    html_option += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                }
                $("select[name='province']").html(html_option);
            });
        }

        if("province" == key) {
            var country = $("select[name='country']").val();
            var url = site_url + "jobseeker/ajaxlocation/" + key + "/" + selected + "/" + country;
            $.get(url, function(data){
                var obj = eval('('+data+')');
                for ( var i = 0; i < obj.length; i++) {
                    html_option += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                }
                $("select[name='city']").html(html_option);
            });
        }

    }