//basic information form ajax submit
function basicInfoSubmit() {
    var basicInfoForm = $('#basicInfoForm');
    basicInfoForm.validate();
    
    if (basicInfoForm.valid()) {
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
}

//contact details form ajax submit
function contactDetailsSubmit() {
    var contactDetailsForm = $('#contactDetailsForm');
    contactDetailsForm.validate();

    if (contactDetailsForm.valid()) {
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
}

//preferences form ajax submit
function preferencesSubmit() {
    var preferencesForm = $('#preferencesForm');
    preferencesForm.validate();

    if (preferencesForm.valid()) {
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
}

//education form ajax submit
function educationSubmit() {
    var educationForm = $('#educationForm');
    educationForm.validate();

    if (educationForm.valid()) {
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
}

//work history form ajax submit
function workhistorySubmit() {
    var workhistoryForm = $('#workhistoryForm');
    workhistoryForm.validate();

    if (workhistoryForm.valid()) {
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
}

//language form ajax submit
function languageSubmit() {
    var languageForm = $('#languageForm');
    languageForm.validate();

    if (languageForm.valid()) {
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
}

function personalSkillsSubmit() {
    $('#personalSkillsForm .reg-area-tit').addClass('reg-area-tit-curr');
}

function professionalSkillsSubmit() {
    $('#PersonalSkills_input .reg-area-tit').addClass('reg-area-tit-curr');
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

        basicInfoSubmit();
        contactDetailsSubmit();
        preferencesSubmit();
        educationSubmit();
        workhistorySubmit();
        languageSubmit();
    }
}