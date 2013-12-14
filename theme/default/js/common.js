var userType = -1;//not login
$(function(){
    setInterval(function(){
        checkstatus();
    }, 10000);
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
        $('#login_pop').stop().show();
    },function(){
        $('#login_pop').stop().hide();
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

});
var checkstatus = function() {
    var ajax=$.getJSON(base_url + 'user/checkstatus', {},
        function() {

        });
}
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

function show_pop_message(){
    $('.pop-mark').fadeIn();
    $('.pop-message').fadeIn();

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
    function changeIndustry(thisO, next_element) {
        var name = $(thisO).val();
        $.post(site_url + 'jobseeker/ajaxchangeindustry',
            { ind_name: name },
            function(result,status) {
                var position_htm = '<option value="">All Positions</option>';

                if(status == 'success'){
                    var obj = eval('('+result+')');
                    for ( var i = 0; i < obj.data.length; i++) {
                        position_htm += "<option value=\""+obj.data[i].name+"\">"+obj.data[i].name+"</option>";
                    }
                }
                if(next_element) {
                    $(thisO).next('select').html(position_htm);
                } else {
                    $(thisO).parent().parent().next().find('select').html(position_htm);
                }
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
$(document).ready(function() {
/**
 * POST JOB / TYPE OF JOB 
 */
$('#jobtype_box').tagit({
        select:true, 
        sortable:true,
        tagsChanged:function () {
            var tags = $('#jobtype_box').tagit('tags');
            var tagString = [];
                                    
            //Pull out only value
            for (var i in tags){
              tagString.push(tags[i].value);
            }
            $('#jobtype_tag').val(tagString.join(','));
        }
    });
    $('.tagit-input').attr('disabled','disabled');
    $('#employment_type').change(function() {
    	var slabel = $('#employment_type').find("option:selected").text();
    	var sval = $('#employment_type').val();
        if (sval != '')
            addTypeTag(slabel, sval);
        else if (sval == '') {
            $('#jobtype_box').tagit('reset');
        }
    });
});
var addTypeTag = function(label, tag) {
    $('#jobtype_box').tagit("add", {label: label, value: tag});
}

function selectMultiple(id, str_id)
{
    var o = document.getElementById(id);
    var str = "";
    for(i=0;i<o.length;i++){
        if(o.options[i].selected){
            str+=o.options[i].value+",";
        }
    }

    $('#' + str_id).val(str.substr(0,str.length-1));
}

function changeFilterType(thisO) {
    var v = $(thisO).attr('title');
    $('#filter_type_str').val(v);
}

function submitFilterBookmarkForm() {
    var type = $('#filter_type_str').val();

    if(type == 'jobs') {
        $('#jobsForm').submit();
    } else {
        $('#companiesForm').submit();
    }
}

function uploadFile(btn_id, upload_btn, error_id,input_id) {
    var oBtn = document.getElementById(btn_id);
    var upload_button = document.getElementById(upload_btn);
    var oRemind = document.getElementById(error_id);
    new AjaxUpload(oBtn,{
        action:site_url+"jobseeker/ajaxuploadfile",
        name:"workexample",
        data: {},
        onSubmit:function(file,ext){
        },
        onComplete:function(file,response){
            oBtn.disabled = "";
            var response = response.split("|");
            if ( response[0] == 'success') {
                oRemind.style.color = "green";
                oRemind.innerHTML = "Upload successful.";

                var filename = response[1];
                $('#'+input_id).val(filename);
            } else {
                oRemind.style.color = "red";
                oRemind.innerHTML = response;
            }

        }
    });
}

function getUploadedFileType(filename){
    var type = -1;
    if(filename.length > 4){
        var filenames = filename.split(".");
        var extension = filenames[filenames.length - 1];
        if($.inArray(extension, ['txt','doc','docx','ppt','pptx','xls','xlsx','pdf']) >= 0){
            type = 0;
        }
        else if($.inArray(extension, ['png','gif','jpg','jpeg']) >= 0){
            type = 1;
        }
        else if($.inArray(extension, ['mp3','wav']) >= 0){
            type = 2;
        }
        else if($.inArray(extension, ['avi','mpg']) >= 0){
            type = 3;
        }
        else if($.inArray(extension, ['rar','zip']) >= 0){
            type = 4;
        }
    }
    else
        alert("Wrong file name");

    return type;

}
