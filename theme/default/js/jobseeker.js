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
            function(result,status){
                if(status == 'success'){
                    $('#step4').addClass('curr');
                    $('#educationForm .reg-area-tit').addClass('reg-area-tit-curr');
                    if(is_all==null)
                        alert('Save successful!');
                }
                else{
                    alert('Save failed!');
                }
        });
    }
}

//work history form ajax submit
function workhistorySubmit(is_all) {
    var workhistoryForm = $('#workhistoryForm');
    workhistoryForm.validate();

    if (workhistoryForm.valid()) {
        $.post(site_url + 'jobseeker/workhistory',
            workhistoryForm.serialize(),
            function(result,status){
                if(status == 'success'){
                    $('#step5').addClass('curr');
                    $('#workhistoryForm .reg-area-tit').addClass('reg-area-tit-curr');
                    if(is_all==null)
                        alert('Save successful!');
                }
                else{
                    alert('Save failed!');
                }
        });
    }
}

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

function addLanguageBtnClick(thisO) {
    var num = $(thisO).prev().val();

    if(num >= 3) {
        alert("The can only add 3 languages.");
        return;
    }
    $(thisO).prev().val(parseInt(num)+1);

    var html = '<div class="advsearch-row clearfix">';
    html += $('#language_lists').html();
    html += '<div class="span3"><i class="del" onclick="delNewLanguage(this);"></i></div></div>';
    $(thisO).parent().parent().before(html);
}

function delLanguage(thisO, language) {
    var uid = $('#uid').val();

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
            alert("The can only add 3 industries.");
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

        html = '<div class="new_added">'+html1+html_middle+html2 + '<div class="reg-row">'+
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
                oRemind.innerHTML = "Sorry, Do not support this image type.";
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

function delPersonalSkills(id_str,thisO,skill) {
    var uid = $('#uid').val();

    if (uid == undefined && id_str != '') {
        if (id_str == 'ProfessionalSkills') {
            $('input[name=preferred_technical_skills]').val($('input[name=preferred_technical_skills]').val().replace(skill+',',''));
            if ($('input[name=preferred_technical_skills]').val() == '') {
                $('#ProfessionalSkills_input').attr('required','');
            }
        } else {
            $('input[name=preferred_personal_skills]').val($('input[name=preferred_personal_skills]').val().replace(skill+',',''));
            if ($('input[name=preferred_personal_skills]').val() == '') {
                $('#PersonalSkills_input').attr('required','');
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
            $('input[name=preferred_technical_skills]').val(v+','+$('input[name=preferred_technical_skills]').val());
            $('#ProfessionalSkills_input').removeAttr('required');
        } else {
            $('input[name=preferred_personal_skills]').val(v+','+$('input[name=preferred_personal_skills]').val());
            $('#PersonalSkills_input').removeAttr('required');
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

    $('#'+ id_str + '_input').val('Start Typing');
}

//add personal skills or professional skills, using the same function
function addPersonalSkills(id_str,thisO,li_id) {
    var v = $(thisO).val();
    var uid = $('#uid').val();

    addPersonalSkillAjax(id_str,uid, v, li_id);

    return false;
}

// change the background image of the checkbox
function isPrivate(thisO, id_str) {
    if($(thisO).hasClass('kyo-checkbox-sel')) {
        $(thisO).removeClass('kyo-checkbox-sel');
        $('#'+id_str).val(0);
    } else {
        $(thisO).addClass('kyo-checkbox-sel');
        $('#'+id_str).val(1);
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
    var uid = $('#uid').val();

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

