function saveProfileDescription(thisObj){
    var description = $('#profile_description').val();
    $.post(site_url + 'jobseeker/updateDescription',
        {description:description},
        function(result){
            result = eval('('+result+')');
            if(result.status == 'success'){
                $(thisObj).parent().prev().html(description);
                $(thisObj).parent().prev().show();
                $(thisObj).parent().hide();
            }
            else{
                alert('Save failed!');
            }
        });
}

function savePersonalSkills(thisObj, ulID){
    var personalSkillsStr = "";
    $('#' + ulID + ' li').each(function(){
        personalSkillsStr = personalSkillsStr + $.trim($(this).text()) + ', ';
    });
    if(personalSkillsStr.length > 2){
        personalSkillsStr = personalSkillsStr.substr(0, personalSkillsStr.length -2);
    }
    $(thisObj).parent().prev().html(personalSkillsStr);
    $(thisObj).parent().prev().show();
    $(thisObj).parent().hide();
}

function saveProfileSeekingIndustry(thisObj){
    var editIndustryForm = $('#editIndustryForm');
    $.post(site_url + 'jobseeker/updateProfileSeekingIndustry',
        editIndustryForm.serialize(),
        function(result){
            result = eval('('+result+')');
            if(result.status == 'success'){
                var industryHtml = "";
                $('select[name="industry_1[]"]').each(function(){
                    industryHtml = industryHtml + '<a href="javascript:void(0);">' + $(this).find('option:selected').text() + '</a>'
                });
                $(thisObj).parent().prev().html(industryHtml);
                $(thisObj).parent().prev().show();
                $(thisObj).parent().hide();
            }
            else{
                alert('Save failed!');
            }
        });
}

function saveLanguage(thisObj) {
    var languageForm = $('#languageForm');
    languageForm.validate();

    if (languageForm.valid()) {
        $.post(site_url + 'jobseeker/language',
            languageForm.serialize(),
            function(result,status){
                if(status == 'success'){
                    var languages = new Array();
                    var levels = new Array();
                    $('select[name="language[]"]').each(function(){
                        languages.push($(this).find('option:selected').text());
                    });
                    $('select[name="level[]"]').each(function(){
                        levels.push($(this).find('option:selected').text());
                    });
                    var languagesStr = "";

                    for(var i= 0, len=languages.length; i<len;i++){
                        languagesStr = languagesStr + '<div class="jobseeker_profile_language"><label>'
                                        + languages[i] + '</label><i>'
                                        + levels[i] + '</i></div>';
                    }
                    $(thisObj).parent().prev().html(languagesStr);
                    $(thisObj).parent().prev().show();
                    $(thisObj).parent().hide();
                }
                else{
                    alert('Save failed!');
                }
            });
    }
}

function updateBirthday(){
    alert();
}
$(document).ready(function(){
    $('.edit_jobseeker_profile_birthday_link').click(function(){
        WdatePicker({el: 'jobseeker_birthday' ,
            vel:'jobseeker_birthday_input',
            dateFmt:'MMMM dd yyyy',
            lang:'en',
            onpicked:function(dp){

                //save this date to user's birthday in database;
                $.post(site_url + 'jobseeker/updateBirthday',
                    {birthday:$('#jobseeker_birthday_input').val()},
                    function(result){
                        result = eval('('+result+')');

                    });
            }
        });
    });

    $('.edit_profile_link_ajax').click(function(){
        $(this).parent().next().find('.show_content').hide();
        $(this).parent().next().find('.edit_content').show();
    });
    $('.edit_jobseeker_profile_about_me_link').click(function(){

    });

    $('.edit_jobseeker_profile_industry_link').click(function(){

    });

    $('.edit_jobseeker_profile_current_employment_link').click(function(){

    });

    $('.edit_jobseeker_profile_previous_employment_link').click(function(){

    });

    $('.edit_jobseeker_profile_personal_skills_link').click(function(){

    });

    $('.edit_jobseeker_profile_technical_skills_link').click(function(){

    });

    $('.edit_jobseeker_profile_languages_link').click(function(){

    });

    $('.edit_jobseeker_profile_birthday_link').click(function(){

    });

    $('.edit_jobseeker_profile_education_link').click(function(){

    });

    $('.edit_jobseeker_profile_sns_link').click(function(){

    });

    $('.edit_jobseeker_profile_phone_link').click(function(){

    });

});

