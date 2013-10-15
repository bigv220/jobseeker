//basic information form ajax submit
function basicInfoSubmit(is_all) {
    var basicInfoForm = $('#basicInfoForm');
    basicInfoForm.validate();
    
    if (basicInfoForm.valid()) {
        $.post(site_url + '/jobseeker/basicInfo',
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
        $.post(site_url + '/jobseeker/contactdetails',
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
        $.post(site_url + '/jobseeker/preferences',
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
        $.post(site_url + '/jobseeker/education',
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
        $.post(site_url + '/jobseeker/workhistory',
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
        $.post(site_url + '/jobseeker/language',
            languageForm.serialize(),
            function(result,status){
                if(status == 'success'){
                    $('#step8').addClass('curr');
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
    $('#step7').addClass('curr');
    $('#PersonalSkillsForm .reg-area-tit').addClass('reg-area-tit-curr');
}

function professionalSkillsSubmit() {
    $('#step8').addClass('curr');
    $('#ProfessionalSkillsForm .reg-area-tit').addClass('reg-area-tit-curr');
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