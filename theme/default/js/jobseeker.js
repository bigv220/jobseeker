//basic information form ajax submit
function basicInfoSubmit(is_all) {

    var basicInfoForm = $('#basicInfoForm');

    basicInfoForm.validate();

    

    if (basicInfoForm.valid()) {

        $.post(site_url + 'jobseeker/basicInfo',

            basicInfoForm.serialize(),

            function(result,status){

                if(status == 'success'){

                    $('#basicInfoForm .reg-area-tit').addClass('reg-area-tit-curr');

                    if(is_all==null)

                        alert('Save successful!');

                }

                else{

                    alert('Save failed!');

                }

        });

    }

}



//contact details form ajax submit

function contactDetailsSubmit(is_all) {

    var contactDetailsForm = $('#contactDetailsForm');

    contactDetailsForm.validate();



    if (contactDetailsForm.valid()) {

        $.post(site_url + 'jobseeker/contactdetails',

            contactDetailsForm.serialize(),

            function(result,status){

                if(status == 'success'){

                    $('#step2').addClass('curr');

                    $('#contactDetailsForm .reg-area-tit').addClass('reg-area-tit-curr');

                    if(is_all==null)

                        alert('Save successful!');

                }

                else{

                    alert('Save failed!');

                }

        });

    }

}



//preferences form ajax submit

function preferencesSubmit(is_all) {

    var preferencesForm = $('#preferencesForm');

    preferencesForm.validate();



    if (preferencesForm.valid()) {

        $.post(site_url + 'jobseeker/preferences',

            preferencesForm.serialize(),

            function(result,status){

                if(status == 'success'){

                    $('#step3').addClass('curr');

                    $('#preferencesForm .reg-area-tit').addClass('reg-area-tit-curr');

                    if(is_all==null)

                        alert('Save successful!');

                }

                else{

                    alert('Save failed!');

                }

        });

    }

}



function setDefaultEducationFormValue(domId){

    $('#' + domId + ' input:enabled').val('');

    $('#' + domId + ' select').val('');

    $('#' + domId + ' textarea').val('');

}


//education form ajax submit
function educationSubmit(is_all) {
    var educationForm = $('#educationForm');
    educationForm.validate();

    if (educationForm.valid()) {

        $.post(site_url + 'jobseeker/education',
                educationForm.serialize(),
                function(result, status) {
                    if (status != 0) {
                        $('#step4').addClass('curr');
                        $('#educationForm .reg-area-tit').addClass('reg-area-tit-curr');

                        var edu_id = jQuery.parseJSON(result);

                        if ($('#hidden_education_history_id') != "") {
                            status = $('#hidden_education_history_id').val();
                            $('#education_history_tablerow_' + edu_id.status).remove();
                        }

                        var newRow = '<tr id="education_history_tablerow_' + edu_id.status + '"><td class="th_left_align">' + $('#education_school_field').val() + '</td>' +
                                '<td>' + $('#education_degree_field').val() + '</td>' +
                                '<td>' + $('#education_major_field').val() + '</td>' +
                                '<td>' + $('#education_year_from_field').val() + '</td>' +
                                '<td> - </td>' +
                                '<td>' + $('#education_year_to_field').val() + '</td>' +
                                '<td><a href="javascript:void(0);" class="edit_education_history_item" data_education_history="' + edu_id.status + '">Edit</a></td>' +
                                '<td><a href="javascript:void(0);" class="delete_education_history_item" data_education_history="' + edu_id.status + '">Del</a></td></tr>';

                        resetEducationForm();

                        if ($('#table_edit_education_history tr').length == 0) {
                            $('#table_edit_education_history').append(newRow);
                            $('#education_history_table_header').css('display', 'none');
                        } else {
                            $('#education_history_table_header').css('display', 'table-row');
                            $('#table_edit_education_history tr:last').after(newRow);
                        }
                        
                        if (is_all == null) {
                            window.location = '#reg4';
                        }

                    }
                    else {
                        alert('Save failed!');
                    }
                });
    }
}

function resetEducationForm() {
    $('#hidden_education_history_id').val(0);
    $('#education_school_field').val('');
    $('#education_degree_field').val('');
    $('#education_major_field').val('');
    $('#education_achievements_field').val('');

    $('#education_month_from_field').val('');
    $('#education_year_from_field').val('');
    $('#education_month_to_field').val('');
    $('#education_year_to_field').val('');
}



//work history form ajax submit
function workhistorySubmit(is_all) {
    var workhistoryForm = $('#workhistoryForm');
    workhistoryForm.validate();

    if (workhistoryForm.valid()) {

        $.post(site_url + 'jobseeker/workhistory',
                workhistoryForm.serialize(),
                function(result, status) {

                    if (status != 0) {
                        $('#step5').addClass('curr');
                        $('#workhistoryForm .reg-area-tit').addClass('reg-area-tit-curr');

                        var work_id = jQuery.parseJSON(result);

                        if ($('#hidden_work_history_id') != "") {
                            status = $('#hidden_work_history_id').val();
                            $('#work_history_tablerow_' + work_id.status).remove();

                        }

                        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                        var date_from = new Date($('#history_year_from_field').val(), $('#history_month_from_field').val(), 1);

                        var date_to = new Date($('#history_year_to_field').val(), $('#history_month_to_field').val(), 1);

                        var date_to_td;
                        if ($('#is_stillhere').val() == 0) {
                            date_to_td = '<td>' + monthNames[date_to.getMonth()] + ' ' + date_to.getFullYear() + '</td>';
                        } else {
                            date_to_td = '<td>present</td>';
                        }

                        var newRow = '<tr id="work_history_tablerow_' + work_id.status + '"><td class="th_left_align">' + $('#history_company_field').val() + '</td>' +
                                '<td>' + monthNames[date_from.getMonth()] + ' ' + date_from.getFullYear() + '</td>' +
                                '<td> - </td>' + date_to_td +
                                '<td><a href="javascript:void(0);" class="edit_work_history_item" data_work_history="' + work_id.status + '">Edit</a></td>' +
                                '<td><a href="javascript:void(0);" class="delete_work_history_item" data_work_history="' + work_id.status + '">Del</a></td></tr>';

                        resetWorkHistoryForm();
                        
                        if ($('#table_edit_work_history tr').length == 0) {
                            $('#table_edit_work_history').append(newRow);
                            $('#work_history_table_header').css('display', 'none');
                        } else {
                            $('#work_history_table_header').css('display', 'table-row');
                            $('#table_edit_work_history tr:last').after(newRow);
                        }

                        if (is_all == null) {
                            window.location = '#reg5';
                        }
                    }
                    else {
                        alert('Save failed!');
                    }
                });
    }
}

function resetWorkHistoryForm() {
    $('#hidden_work_history_id').val(0);
    $('#history_company_field').val('');
    $('#history_description_field').val('');

    $('#history_year_from_field').val('');
    $('#history_month_from_field').val('');
    $('#history_year_to_field').val('');
    $('#history_month_to_field').val('');

    $('.still_working_here').removeAttr('disabled');
    $('#history_checkbox_still_here').removeClass('kyo-checkbox-sel');
    $('#is_stillhere').val(0);

    $('#industry_position_id').val('');
    $('#industry_combobox').val('');
    changeIndustry($('#industry_combobox'), false, history.position);
}


//Edit history work items from the list 
//$(document).on("click", ".edit_work_history_item", function(e) {
//    
//});

$(function() {
    var popMark = $('.pop-mark');
    var popDeleteWork = $('.pop-delete-work-history');
    var popDeleteEducation = $('.pop-delete-education');

    //
    //Edit and delete Work history 
    //
    $(document).on("click", ".edit_work_history_item", function(e) {
        var work_id = $(this).attr('data_work_history');

        $.ajax({
            type: "POST",
            url: site_url + "jobseeker/getWorkHistoryRow",
            data: {work_id: work_id},
            success: function(result) {
                var history = jQuery.parseJSON(result);
                $('#history_company_field').val(history.company_name);

                var time_from = history.period_time_from.split("-");
                $('#history_year_from_field').val(time_from[0]);
                $('#history_month_from_field').val(time_from[1]);

                var time_to = history.period_time_to.split("-");
                $('#history_year_to_field').val(time_to[0]);
                $('#history_month_to_field').val(time_to[1]);

                $('#is_stillhere').val(history.is_stillhere);
                $('#history_description_field').val(history.description);

                if (history.is_stillhere == 1) {
                    $('#history_checkbox_still_here').addClass('kyo-checkbox-sel')
                    $('.still_working_here').prop('disabled', true);
                } else {
                    $('.still_working_here').removeAttr('disabled');
                    $('#history_checkbox_still_here').removeClass('kyo-checkbox-sel');
                }

                //If there is no industry/position in the db, another query will be executed which will change the ID 
                if (history.parent_id) {
                    $('#hidden_work_history_id').val(history.parent_id);
                    $('#industry_position_id').val(history.id);
                } else {
                    $('#industry_position_id').val('');
                    $('#hidden_work_history_id').val(history.id);
                }

                $('#industry_combobox').val(history.industry);
                changeIndustry($('#industry_combobox'), false, history.position);
            }});
    });

    $(document).on("click", ".delete_work_history_item", function(e) {
        popMark.fadeIn();
        popDeleteWork.fadeIn();

        var id = $(this).attr('data_work_history');

        $('#selected_work_id').val(id);
        e.stopPropagation();
        e.preventDefault();
    });

    $(document).on("click", ".pop-delete-work-history-yes", function(e) {
        popDeleteWork.fadeOut();
        popMark.fadeOut();

        var work_id = $('#selected_work_id').val();

        $.ajax({
            type: "POST",
            url: site_url + "jobseeker/deleteWorkHistoryItem",
            data: {work_id: work_id},
            success: function(html) {
                if (html) {
                    //$('#work_history_tablerow_' + work_id).css('display', 'none');
                    $('#work_history_tablerow_' + work_id).remove();

                    if ($('#table_edit_work_history tr').length == 1) {
                        $('#work_history_table_header').css('display', 'none');
                    }

                    resetWorkHistoryForm();
                } else {
                    alert(html);
                }
            }
        });
    });
    //
    //End edit and delete Work history 
    //

    //
    //Edit and delete Education history 
    //
    $(document).on("click", ".edit_education_history_item", function(e) {
        var edu_id = $(this).attr('data_education_history');

        $.ajax({
            type: "POST",
            url: site_url + "jobseeker/getEducationHistoryRow",
            data: {edu_id: edu_id},
            success: function(result) {
                var education = jQuery.parseJSON(result);
                $('#education_school_field').val(education.school_name);

                var time_from = education.attend_date_from.split("-");
                $('#education_year_from_field').val(time_from[0]);
                $('#education_month_from_field').val(time_from[1]);

                var time_to = education.attend_date_to.split("-");
                $('#education_year_to_field').val(time_to[0]);
                $('#education_month_to_field').val(time_to[1]);

                $('#education_degree_field').val(education.degree);
                $('#education_major_field').val(education.major);
                $('#education_achievements_field').val(education.achievements);
                
                $('#hidden_education_history_id').val(education.id);
            }
        });
    });

    $(document).on("click", ".delete_education_history_item", function(e) {
        popMark.fadeIn();
        popDeleteEducation.fadeIn();

        var id = $(this).attr('data_education_history');

        $('#selected_education_id').val(id);

        e.stopPropagation();
        e.preventDefault();
    });

    $(document).on("click", ".pop-delete-education-yes", function(e) {
        popDeleteEducation.fadeOut();
        popMark.fadeOut();

        var edu_id = $('#selected_education_id').val();

        $.ajax({
            type: "POST",
            url: site_url + "jobseeker/deleteEducationHistoryItem",
            data: {edu_id: edu_id},
            success: function(html) {
                if (html) {
                    $('#education_history_tablerow_' + edu_id).remove();

                    if ($('#table_edit_education_history tr').length == 1) {
                        $('#education_history_table_header').css('display', 'none');
                    }

                    resetEducationForm();
                } else {
                    alert(html);
                }
            }
        });
    });
    //
    //End edit and delete Education history 
    //


//Hide popus if "No" or "Close" are clicked. Used for deleting education and work history 
    $(document).on("click", ".pop-btn-no", function(e) {
        popDeleteWork.fadeOut();
        popDeleteEducation.fadeOut();
        popMark.fadeOut();
    });

    $(document).on("click", ".pop-apply-close", function(e) {
        popDeleteWork.fadeOut();
        popDeleteEducation.fadeOut();
        popMark.fadeOut();
    });
});



//language form ajax submit

function languageSubmit(is_all) {

    var languageForm = $('#languageForm');

    languageForm.validate();



    if (languageForm.valid()) {

        $.post(site_url + 'jobseeker/language',

            languageForm.serialize(),

            function(result,status){

                if(status == 'success'){

                    $('#step6').addClass('curr');

                    $('#languageForm .reg-area-tit').addClass('reg-area-tit-curr');

                    alert('Save successful!');

                }

                else{

                    alert('Save failed!');

                }

        });

    }

}



function personalSkillsSubmit() {

    $('#step7').addClass('curr'); ';'

    $('#PersonalSkillsForm .reg-area-tit').addClass('reg-area-tit-curr');

    alert('Save successful!');

}



function professionalSkillsSubmit() {

    $('#step8').addClass('curr');

    $('#ProfessionalSkillsForm .reg-area-tit').addClass('reg-area-tit-curr');

    alert('Save successful!');

}



function saveAll() {

    var basicInfoForm = $('#basicInfoForm');

    basicInfoForm.validate();



    var contactDetailsForm = $('#contactDetailsForm');

    contactDetailsForm.validate();



    var preferencesForm = $('#preferencesForm');

    preferencesForm.validate();



    var educationForm = $('#educationForm');

    educationForm.validate();



    var workhistoryForm = $('#workhistoryForm');

    workhistoryForm.validate();



    var languageForm = $('#languageForm');

    languageForm.validate();



    if(basicInfoForm.valid() && contactDetailsForm.valid() &&

        preferencesForm.valid() && educationForm.valid() && workhistoryForm.valid() &&languageForm.valid()) {



        basicInfoSubmit(true);

        contactDetailsSubmit(true);

        preferencesSubmit(true);

        educationSubmit(true);

        workhistorySubmit(true);
        languageSubmit();
    }
}

function addLanguageBtnClick(thisO)
{
    var num = $(thisO).prev().val();
    if(num>=8)
    {
        alert("The can only add 8 languages.");
        return;
    }
    $(thisO).prev().val(parseInt(num)+1);
    var html = '<div class="advsearch-row clearfix">';
    html += $('#language_lists').html();
    html += '<div class="span3"><i class="del" onclick="delNewLanguage(this);"></i></div></div>';
    $(thisO).parent().parent().before(html);
}



function delLanguage(thisO, language) {

    var uid = current_login_user_id; //actually the uid is useless we load it from session from server side



    $.post(site_url + 'jobseeker/delLanguage',

        {uid:uid, language:language},

        function(result,status){

            if(status == 'success'){

                delNewLanguage(thisO);

            }

            else{

                alert('Delete failed!');

            }

        });

}



function delNewLanguage(thisO) {

    var v = $(thisO).parent().parent().parent().find('input[name="grop_num[]"]').val();

    $(thisO).parent().parent().parent().find('input[name="grop_num[]"]').val(parseInt(v)-1);



    $(thisO).parent().parent().remove();

}



$(document).ready(function(){

    $("select[name='country']").change(function() {

        change_location($(this),'country');

    });

    $("select[name='province']").change(function() {

        change_location($(this), 'province');

    });



    $("input.date").jSelectDate({

        css:"date",

        yearBeign: 1960,

        disabled : false

    });



    $("#PersonalSkills_input").autocomplete(site_url+"jobseeker/personalskillsautocomplete",{

        delay:10,

        width: '414px',

        matchSubset:1,

        matchContains:1,

        cacheLength:10,

        onItemSelect:selectItem1,

        formatItem: formatItem,

        formatResult: formatResult

    });



    $("#ProfessionalSkills_input").autocomplete(site_url+"jobseeker/professionalskillsautocomplete",{

        delay:10,

        matchSubset:1,

        matchContains:1,

        cacheLength:10,

        onItemSelect:selectItem2,

        formatItem: formatItem,

        formatResult: formatResult

    });



    $('#addIndustry').click(function() {

        var num = $('select[name="industry_1[]"]').length;

        if(num >= 3) {

            alert("You can only add 3 industries.");

            return;

        }



        var html = $('#industry_lists').html();

        html += '<span class="delSeekingIndustry"><i class="del" onclick="delNewSeekingIndustry(this);"></i></span>';

        $("#addIndustry").before(html);

    });



    $('#addAnotherSchool').click(function() {

        var html = $('#every_school').html();

        var randnumstr = randNum().toString();

        randnumstr = randnumstr.replace('.', '_');

        var domId = 'school_info_' + randnumstr;

        $('#educationForm #addSchoolBtn').before('<div id="' + domId + '">' + html + '</div>');

        setDefaultEducationFormValue(domId);

    });



    $('#addAnotherJob').click(function() {

        var len = $("#workhistoryForm select").length;

        len = len/3 + 1;



        var html1 = $('#every_job_part1').html();



        var html_middle = '<input type="hidden" name="is_stillhere[]" value="0" id="is_stillhere'+len+'" />' +

            '<i data-val="1" data-id="stillwork" class="kyo-checkbox" onclick="isPrivate(this,\'is_stillhere'+len+'\');">I still work here</i>';



        var html2 = $('#every_job_part2').html();



        var input_id = "work_example"+len;

        var btn_id = 'image_example'+len;

        var upload_id = 'example_upload_button'+len;

        var error_id = 'exampleerrorRemind'+len;



        html = '<div class="new_added"><input type="hidden" name="id[]" value="" />'+

            html1+html_middle+html2 + '<div class="reg-row">'+

            '<input type="hidden" name="work_example[]" id="'+input_id+'" />'+

            '<div id="'+upload_id+'">'+

            '<span id="'+btn_id+'" class="reg-row-tip">Upload examples of work</span></div>'+

            '<span class="" id="'+error_id+'"></span></div></div>';



        $('#workhistoryForm #addJobBtn').before(html);



        uploadFile(btn_id,upload_id,error_id,input_id);

    });



});



function formatItem(row){

    return " <p>"+row +" </p>";

}



function formatResult(row){

    return row[0].replace(/(<.+?>)/gi, '');

}



function selectItem1(v){

    var uid = $('#uid').val();



    addPersonalSkillAjax('PersonalSkills',uid, v, 'step7');

}



function selectItem2(v){

    var uid = $('#uid').val();



    addPersonalSkillAjax('ProfessionalSkills',uid, v, 'step8');

}



function uploadImage(old_avatar) {

    var oBtn = document.getElementById("image_profile");

    var upload_button = document.getElementById("upload_button");

    var oRemind = document.getElementById("errorRemind");

    new AjaxUpload(oBtn,{

        action:site_url+"user/ajaxuploadimage",

        name:"avatar",

        data: {},

        onSubmit:function(file,ext){

            if(ext && /^(jpg|jpeg|png|gif)$/.test(ext)){

                oRemind.style.color = "orange";

                oRemind.innerHTML = "uploading...";

                oBtn.disabled = "disabled";

            }else{

                oRemind.style.color = "red";

                oRemind.innerHTML = "Sorry, we do not support this image type. Please use jpg or png.";

                return false;

            }

        },

        onComplete:function(file,response){

            oBtn.disabled = "";

            var response = response.split("|");

            if ( response[0] == 'success') {

                oRemind.style.color = "green";

                oRemind.innerHTML = "Upload successful.";



                //var reg = /\s/g;

                var filename = response[1];



                var img_path = site_url+"attached/users/" + filename;

                $('#avatar').val(filename);

                upload_button.innerHTML = "<img id='image_profile' src='" + img_path + "?" +  Math.floor(Math.random()*99999 + 1) + "' height='100' style='border:1px solid gray;' />";

            } else {

                oRemind.style.color = "red";

                oRemind.innerHTML = response[1];

            }

        }

    });

}





function delPersonalSkills(id_str,thisO,skill) {

    var uid = current_login_user_id;//$('#uid').val();



    if (uid == undefined && id_str != '') {

        if (id_str == 'ProfessionalSkills') {

            if($('input[name=preferred_technical_skills]') != undefined){

                $('input[name=preferred_technical_skills]').val($('input[name=preferred_technical_skills]').val().replace(skill+',',''));

                if ($('input[name=preferred_technical_skills]').val() == '') {

                    $('#ProfessionalSkills_input').attr('required','');

                }

            }

        } else {

            if($('input[name=preferred_personal_skills]') != undefined){

                $('input[name=preferred_personal_skills]').val($('input[name=preferred_personal_skills]').val().replace(skill+',',''));

                if ($('input[name=preferred_personal_skills]').val() == '') {

                    $('#PersonalSkills_input').attr('required','');

                }

            }

        }

    }



    $.post(site_url + 'jobseeker/del' + id_str,

        {uid:uid, skill:skill},

        function(result,status){

            if(status == 'success'){

                $(thisO).parent().remove();

            }

            else{

                alert('Delete failed!');

            }

        });

}



// ajax to adding personal skills

function addPersonalSkillAjax(id_str,uid, v, li_id) {

    if (uid == undefined && id_str != '') {

        if (id_str == 'ProfessionalSkills') {

            if($('input[name=preferred_technical_skills]') != undefined){

                $('input[name=preferred_technical_skills]').val(v+','+$('input[name=preferred_technical_skills]').val());

                $('#ProfessionalSkills_input').removeAttr('required');

            }

        } else {

            if($('input[name=preferred_personal_skills]') != undefined){

                $('input[name=preferred_personal_skills]').val(v+','+$('input[name=preferred_personal_skills]').val());

                $('#PersonalSkills_input').removeAttr('required');

            }

        }

    }



    $.post(site_url + 'jobseeker/add'+ id_str,

        { uid:uid, skill:v },

        function(result,status) {

            if(status == 'success'){

                var htm = '<li data-val="2">'+ v +

                    '<i class="del" onclick="delPersonalSkills' + '(\''+ id_str + '\',this,\''+ v + '\');"></i></li>'



                $('#'+ id_str).append(htm);

                $('#'+li_id).addClass('curr');

                $('#'+ id_str + 'Form div.reg-area-tit').addClass('reg-area-tit-curr');

            }

            else{

                alert('Add failed!');

            }

        });



    $('#'+ id_str + '_input').val('');

}



//add personal skills or professional skills, using the same function

function addPersonalSkills(id_str,thisO,li_id) {

    var v = $(thisO).val();

    var uid = current_login_user_id;



    addPersonalSkillAjax(id_str,uid, v, li_id);



    return false;

}



// change the background image of the checkbox & change the required/disabled attributes 

function isPrivate(thisO, id_str) {
    if($(thisO).hasClass('kyo-checkbox-sel')) {
        $('#'+id_str).val(0);
        $(thisO).prev().prev().find('.still_working_here').removeAttr('disabled');
        $(thisO).prev().prev().find('.still_working_here').prop('required', true);
    } else {
        $('#'+id_str).val(1); 
        $(thisO).prev().prev().find('.still_working_here').prop('disabled', true);  
        $(thisO).prev().prev().find('.still_working_here').removeAttr('required');
    }

}



// select an item in droplists of Personal skills and Professional skills

function selectItem(element_id, v) {

    var ele_id = "#" + element_id;

    $(ele_id).val(v);

}



// check the character length of description in Work history area

function checkLength(thisO, maxLen) {

    var taValue = $(thisO).val();

    var len = taValue.length;

    if (len > maxLen) {

        var val = taValue.substring(0, 347) + '...';

        $(thisO).val(val);

    }

}



function delSeekingIndustry(thisO,industry,position) {

    var uid = current_login_user_id;//$('#uid').val();

    $.post(site_url + 'jobseeker/delSeekingIndustry',

        {uid:uid, industry:industry, position:position},

        function(result,status){

            if(status == 'success'){

                delNewSeekingIndustry(thisO);

            }

            else{

                alert('Delete failed!');

            }

        });

}
function delNewSeekingIndustry(thisO) {

    $(thisO).parent().prev().remove();

    $(thisO).parent().prev().remove();

    $(thisO).parent().remove();

}