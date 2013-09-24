function basicInfoSubmit() {
    //basic information form ajax submit
    var basicInfoForm = $('#basicInfoForm');

    $.post(site_url + '/jobseeker/basicInfo',
        basicInfoForm.serialize(),
        function(result,status){
            if(status == 'success'){
                $('#basicInfoForm .reg-area-tit').addClass('reg-area-tit-curr');
                alert('Save successful!');
            }
            else{
                alert('Save failed!');
            }
        });
}

function contactDetailsSubmit() {
    //basic information form ajax submit
    var contactDetailsForm = $('#contactDetailsForm');

    $.post(site_url + '/jobseeker/contactdetails',
        contactDetailsForm.serialize(),
        function(result,status){
            if(status == 'success'){
                $('#contactDetailsForm .reg-area-tit').addClass('reg-area-tit-curr');
                alert('Save successful!');
            }
            else{
                alert('Save failed!');
            }
        });
}

function preferencesSubmit() {
    //basic information form ajax submit
    var preferencesForm = $('#preferencesForm');

    $.post(site_url + '/jobseeker/preferences',
        preferencesForm.serialize(),
        function(result,status){
            if(status == 'success'){
                $('#preferencesForm .reg-area-tit').addClass('reg-area-tit-curr');
                alert('Save successful!');
            }
            else{
                alert('Save failed!');
            }
        });
}

function educationSubmit() {
    //basic information form ajax submit
    var educationForm = $('#educationForm');

    $.post(site_url + '/jobseeker/education',
        educationForm.serialize(),
        function(result,status){
            if(status == 'success'){
                $('#educationForm .reg-area-tit').addClass('reg-area-tit-curr');
                alert('Save successful!');
            }
            else{
                alert('Save failed!');
            }
        });
}

function workhistorySubmit() {
    //basic information form ajax submit
    var workhistoryForm = $('#workhistoryForm');

    $.post(site_url + '/jobseeker/workhistory',
        workhistoryForm.serialize(),
        function(result,status){
            if(status == 'success'){
                $('#workhistoryForm .reg-area-tit').addClass('reg-area-tit-curr');
                alert('Save successful!');
            }
            else{
                alert('Save failed!');
            }
        });
}

function languageSubmit() {
    //basic information form ajax submit
    var languageForm = $('#languageForm');

    $.post(site_url + '/jobseeker/language',
        languageForm.serialize(),
        function(result,status){
            if(status == 'success'){
                $('#languageForm .reg-area-tit').addClass('reg-area-tit-curr');
                alert('Save successful!');
            }
            else{
                alert('Save failed!');
            }
        });
}

function personalSkillsSubmit() {
    $('#personalSkillsForm .reg-area-tit').addClass('reg-area-tit-curr');
    alert('Save successful!');
}

function professionalSkillsSubmit() {
    $('#PersonalSkills_input .reg-area-tit').addClass('reg-area-tit-curr');
    alert('Save successful!');
}

function saveAll() {
    basicInfoSubmit();
    contactDetailsSubmit();
    preferencesSubmit();
    educationSubmit();
    workhistorySubmit();
    languageSubmit();
    personalSkillsSubmit();
    professionalSkillsSubmit();
}