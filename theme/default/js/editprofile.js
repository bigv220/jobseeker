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

$(document).ready(function(){
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

