<?php $this->load->view($front_theme.'/header-block');?>
<link href="<?php echo $theme_path?>style/jquery.autocomplete.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/ajaxupload.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.autocomplete.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("input.date").jSelectDate({
            css:"date",
            yearBeign: 1995,
            disabled : false
        });

        uploadImage();

        $("#PersonalSkills_input").autocomplete("<?PHP echo $site_url; ?>/jobseeker/autocomplete",{
            delay:10,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectItem1,
            formatItem: formatItem,
            formatResult: formatResult
        });

        $("#ProfessionalSkills_input").autocomplete("<?PHP echo $site_url; ?>/jobseeker/autocomplete",{
            delay:10,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectItem2,
            formatItem: formatItem,
            formatResult: formatResult
        });

        $('#addIndustry').click(function() {
            var len = $("#industry_lists select").length;
            len = len/2 + 1;
            var industry_htm = '<select name="industry[]" id="industry_' + len + '" class="kyo-select">';
            var industry_lists = $('#industry_1').html();

            var position_htm = '<select id="position_' + len + '" class="kyo-select" name="position[]">';
            var position_lists = $('#position_1').html();
            $("#industry_lists").append('<br /><br />'+ industry_htm+industry_lists+'</select>' + position_htm + position_lists + '</select>');

            $('#industry_' + len).kyoSelect({
                width:'230',
                height:'25'
            });

            $('#position_' + len).kyoSelect({
                width:'230',
                height:'25'
            });
        });

        $('#addAnotherSchool').click(function() {
            var html = $('#every_school').html();

            $('#educationForm #addSchoolBtn').before(html);
        });

        $('#addAnotherJob').click(function() {
            var html = $('#every_job').html();

            $('#workhistoryForm #addJobBtn').before(html);
        });

        $('#addLanguageBtn').click(function() {
            var len = $("#language_lists select").length;
            len = len/2 + 1;
            var language_htm = '<div class="reg-row"><strong>Language<i class="star">*</i></strong><div>'+
                '<select name="language[]" id="language_' + len + '" class="kyo-select">';
            var language_lists = $('#language_1').html();

            var level_htm = '<div class="reg-row clearfix" style="clear:both;"> <strong>Proficiency</strong><div>'+
                '<select id="level_' + len + '" class="kyo-select" name="level[]">';
            var level_lists = $('#level_1').html();
            $("#language_lists").append(language_htm+language_lists+'</select></div></div>' +
                level_htm + level_lists + '</select></div></div>');

            $('#language_' + len).kyoSelect({
                width:'230',
                height:'25'
            });

            $('#level_' + len).kyoSelect({
                width:'230',
                height:'25'
            });
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

        addPersonalSkillAjax('PersonalSkills',uid, v);
        //makeSearchUrl(document.searchform);
    }

    function selectItem2(v){
        var uid = $('#uid').val();

        addPersonalSkillAjax('ProfessionalSkills',uid, v);
        //makeSearchUrl(document.searchform);
    }

    function uploadImage(old_avatar) {
        var oBtn = document.getElementById("image_profile");
        var upload_button = document.getElementById("upload_button");
        var oRemind = document.getElementById("errorRemind");
        new AjaxUpload(oBtn,{
            action:"<?php echo $site_url?>/../jobseeker/ajaxuploadimage",
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
                if ( response == 'success') {
                    oRemind.style.color = "green";
                    oRemind.innerHTML = "Upload successful.";

                    var reg = /\s/g;
                    file = file.replace(reg, "");

                    var img_path = "<?php echo $theme_path; ?>" + "users/" + file;
                    $('#avatar').val(file);
                    upload_button.innerHTML = "<img id='image_profile' src='" + img_path + "?" +  Math.floor(Math.random()*99999 + 1) + "' height='100' style='border:1px solid gray;' />";
                } else {
                    oRemind.style.color = "red";
                    oRemind.innerHTML = response;
                }

            }
        });
    }

    function delPersonalSkills(id_str,thisO,skill) {
        var uid = $('#uid').val();

        $.post(site_url + '/jobseeker/del' + id_str,
            {uid:uid, skill:skill},
            function(result,status){
                if(status == 'success'){
                    $(thisO).parent().remove();
                    alert('Save successful!');
                }
                else{
                    alert('Save failed!');
                }
        });
    }

    function addPersonalSkillAjax(id_str,uid, v) {
        $.post(site_url + '/jobseeker/add'+ id_str,
            { uid:uid, skill:v },
            function(result,status) {
                if(status == 'success'){
                    var htm = '<li data-val="2">'+ v +
                        '<i class="del" onclick="del'+ id_str + '(\''+ id_str + '\',this,\''+ v + '\');"></i></li>'

                    $('#'+ id_str).append(htm);
                    alert('Save successful!');
                }
                else{
                    alert('Save failed!');
                }
        });

        $('#'+ id_str + '_input').val('');
    }

    function addPersonalSkills(id_str,thisO) {
        var v = $(thisO).val();
        var uid = $('#uid').val();

        addPersonalSkillAjax(id_str,uid, v);

        return false;
    }

    function isPrivate(thisO, id_str) {
        if($(thisO).hasClass('kyo-checkbox-sel')) {
            $('#'+id_str).val(0);
        } else {
            $('#'+id_str).val(1);
        }
    }

    function selectItem(element_id, v) {
        var ele_id = "#" + element_id;
        $(ele_id).val(v);
    }
</script>

    <!--top search area-->
    <div class="top-search w70 rel">
        <input type="text" class="abs top-search-input input-tip" value="Search our job database" data-tipval="Search our job database"/>
        <input type="submit" class="abs top-search-btn " value=""  title="search"   />
        <a href="#" class="abs top-search-a">More Options</a>
    </div>

<!--Jobseeker registration page body-->
<div class="reg-page w770 clearfix rel">
    <div class="reg-left abs box mb20">
        <h2 class="reg-left-tit">NiHAO REDSTAR</h2>
        <ul class="reg-ul">
            <li class="curr"><a href="#reg1">Basic Information</a></li>
            <li><a href="#reg2">Contact Details</a></li>
            <li><a href="#reg3">Preferences</a></li>
            <li><a href="#reg4">Education</a></li>
            <li><a href="#reg5">Work History</a></li>
            <li><a href="#reg6">Languages</a></li>
            <li><a href="#reg7">Personal Skills</a></li>
            <li><a href="#reg8">Profesional Skills</a></li>
        </ul>
    </div>
    <div class="reg-right-wrap">
        <div class="reg-right box mb20">
            <p class="reg-right-text">
                Please fill out the mandatory fields to apply for jobs, to streamline your job search and highlight your profile to employers fill out all optional fields. <br/>
                <a href="#">Or start searching for jobs now </a></p>

            <!-- Basic information -->
            <div class="reg-area">
            <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="basicInfoForm">
                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('1', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>
                <div class="reg-area-tit <?php echo $cla; ?>">Basic Information</div>
                <div class="reg-row"> <strong>First Name <i class="star">*</i></strong>
                    <div>
                        <input type="text" name="first_name" class="reg-input" value="<?php echo $userinfo['first_name']; ?>" required />
                    </div>
                </div>
                <div class="reg-row clearfix"> <strong>Last Name <i class="star">*</i></strong>
                    <div>
                        <input type="text" name="last_name" class="reg-input" value="<?php echo $userinfo['last_name']; ?>" required />
                    </div>
                </div>
                <style>
				.location div.kyo-select, .location dl.kyo-select-list {width:145px !important;}
                </style>
                <div class="reg-row clearfix location"> <strong>Location <i class="star">*</i></strong>
                    <div>
                        <select class="kyo-select" name="country" required>
                            <option value="0">All Counties</option>
                            <?php foreach ($location as $k=>$v):?>
                            <option value="<?php echo $k ?>"><?php echo $k ?></option>
                            <?php endforeach;?>
                        </select>
                        <select class="kyo-select" name="province">
                            <option value="0">All Province</option>
                            <option value="Beijing">Beijing</option>
                            <!-- <?php foreach ($location['China'] as $k=>$v):?>
                            <option value="<?php echo $k ?>"><?php echo $k ?></option>
                            <?php endforeach;?>-->
                        </select>
                        <select class="kyo-select" name="city">
                            <option value="0">All City</option>
                            <option value="2">Beijing</option>
                            <option value="3">Shanghai</option>
                        </select>
                    </div>
                </div>
                <div class="reg-row clearfix"> <b>Profile Picture</b>
                    <div>
                        <input type="hidden" name="avatar" id="avatar" />
                        <div id="upload_button">
                            <img id="image_profile" src="<?php echo $theme_path?>style/reg/com-img.gif" class="reg-company-img" />
                        </div>
                        <span class="" id="errorRemind"></span>
                    </div>
                </div>
                <div class="reg-row clearfix"> <strong>Birthday<i class="star">*</i></strong>
                    <div>
                        <?php $birthday = $userinfo["birthday"];
                            $birthday = $birthday ? $birthday : '2013-1-1';
                        ?>
                        <input type="text" name="birthday" id="txtName" class="date" value="<?php echo $birthday; ?>" />
                    </div>
                </div>
                <div class="reg-row clearfix">
                    <input type="hidden" name="is_private" id="is_private" value="1" />
                    <?php $is_private = $userinfo["is_private"];
                           $check_sel = "";
                           if($is_private) {
                               $check_sel = "kyo-checkbox-sel";
                           }
                    ?>
                    <i class="kyo-checkbox <?php echo $check_sel; ?>" data-val="1" data-id="private" onclick="isPrivate(this,'is_private');">Keep this private</i>
                </div>
                <div class="reg-area-bar">
                    <input type="button" class="reg-save" data-index="1" onclick="basicInfoSubmit()" />
                </div>
            </form>
            </div>

            <!-- Contact details -->
            <div class="reg-area">
            <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="contactDetailsForm">
                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('2', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>
                <div class="reg-area-tit <?php echo $cla; ?>">Contact Details</div>
                <div class="reg-row"> <strong>Emial Address<i class="star">*</i></strong>
                    <div>
                        <input type="text" name="email" class="reg-input" value="<?php echo $userinfo['email']; ?>" required />
                    </div>
                </div>
                <div class="reg-row"> <strong>Phone Number<i class="star">*</i> <span>(including area code)</span></strong>
                    <div>
                        <input type="text" name="phone" class="reg-input" value="<?php echo $userinfo['phone']; ?>" required />
                    </div>
                </div>
                <div class="reg-row">Allow employers to contatct you by phone
                    <input type="hidden" name="is_allow_phone" id="is_allow_phone" value="1" />
                    <i data-val="0" data-id="phoneAllow" class="kyo-radio kyo-radio-sel" onclick="selectItem('is_allow_phone',1);">Yes</i>
                    <i id="phone_allow0" data-val="1" data-id="phoneAllow" class="kyo-radio" onclick="selectItem('is_allow_phone',0);">No</i>
                </div>
                <div class="reg-row"> <strong>Username for Jing Chat<i class="star">*</i></strong>
                    <div>
                        <input type="text" name="jingchat_username" class="reg-input" value="<?php echo $userinfo['jingchat_username']; ?>" required />
                    </div>
                </div>
                <div class="reg-row">Allow employers to contact you through online messager
                    <input type="hidden" name="is_allow_online_msg" id="is_allow_online_msg" value="1"  />
                    <i data-val="0" data-id="msgAllow" class="kyo-radio kyo-radio-sel" onclick="selectItem('is_allow_online_msg',1);">Yes</i>
                    <i id="online_msg_allow0" data-val="1" data-id="msgAllow" class="kyo-radio" onclick="selectItem('is_allow_online_msg',0);">No</i>
                </div>
                <div class="reg-row"> <b>Personal website</b>
                    <div>
                        <input type="text" name="website" class="reg-input" value="<?php echo $userinfo['personal_website']; ?>" />
                    </div>
                </div>
                <div class="reg-row"> <b>twitter Username</b>
                    <div>
                        <input type="text" name="twitter" class="reg-input" value="<?php echo $userinfo['twitter']; ?>" />
                    </div>
                </div>
               <div class="reg-row"> <b>linkedin Username</b>
                    <div>
                        <input type="text" name="linkedin" class="reg-input" value="<?php echo $userinfo['linkedin']; ?>" />
                    </div>
                </div>
                <div class="reg-row"> <b>wechat</b>
                    <div>
                        <input type="text" name="wechat" class="reg-input" value="<?php echo $userinfo['wechat']; ?>" />
                    </div>
                </div>
                <div class="reg-row"> <b>Other Social Network</b>
                    <div>
                        <input type="text" name="socialNetwork" id="reg-Network" value="">
                        <div id="reg-network-val" class="show-selval"></div>
                    </div>
                </div>
                <div class="reg-area-bar">
                    <input type="hidden" name="register_step" value="2" />
                    <input type="button" class="reg-save" data-index="1" onclick="contactDetailsSubmit();" />
                </div>
            </form>
            </div>

            <!-- Preferences -->
            <div class="reg-area">
                <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="preferencesForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <?php $step_arr = $step_arr;
                    $cla = '';
                    if(in_array('3', $step_arr)) {
                        $cla = 'reg-area-tit-curr';
                    }
                    ?>
                    <div class="reg-area-tit <?php echo $cla; ?>">Preferences</div>
                    <div class="reg-row"><strong>Prefered length of employment?<i class="star">*</i></strong>
                        <div>
                            <input type="hidden" name='employment_length' id="employment_length" value="1" />
                            <ul class="leng-radio">
                                <li><i data-val="0" data-id="emp_length" class="kyo-radio kyo-radio-sel" onclick="selectItem('employment_length',1);">Long term employment (1+ years)</i></li>
                                <li><i data-val="1" data-id="emp_length" class="kyo-radio" onclick="selectItem('employment_length',2);">Short term employment (-1 years)</i></li>
                                <li><i data-val="2" data-id="emp_length" class="kyo-radio" onclick="selectItem('employment_length',3);">No preference</i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="reg-row"><strong>Prefered type of employment?<i class="star">*</i></strong>
                        <div>
                            <input type="hidden" name="employment_type" id="employment_type" value="1" /><br />
                            <ul class="leng-radio">
                                <li><i data-val="1" data-id="type-employment" class="kyo-radio kyo-radio-sel" onclick="selectItem('employment_type',1);">Contract</i></li>
                                <li><i data-val="2" data-id="type-employment" class="kyo-radio" onclick="selectItem('employment_type',2);">Part Time</i></li>
                                <li><i data-val="3" data-id="type-employment" class="kyo-radio" onclick="selectItem('employment_type',3);">Full Time</i></li>
                                <li><i data-val="4" data-id="type-employment" class="kyo-radio" onclick="selectItem('employment_type',4);">Internship</i></li>
                                <li><i data-val="5" data-id="type-employment" class="kyo-radio" onclick="selectItem('employment_type',5);">Any</i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="reg-row"><strong>Do you require Visa assistance from employers?<i class="star">*</i></strong>
                            <input type="hidden" name="is_visa_assistance" id="is_visa_assistance" value="1" />
                            <i class="kyo-radio kyo-radio-sel" data-id="visa" data-val="1" onclick="selectItem('is_visa_assistance',1);">Yes</i>
                            <i class="kyo-radio" data-id="visa" data-val="2" onclick="selectItem('is_visa_assistance',0);">No</i>
                    </div>
                    <div class="reg-row"><strong>Do you require accomodation assistance from employer?<i class="star">*</i></strong>
                            <input type="hidden" name="is_accomodation_assistance" name="is_accomodation_assistance" value="1" />
                            <i class="kyo-radio kyo-radio-sel" data-id="assistance" data-val="1" onclick="selectItem('is_accomodation_assistance',1);">Yes</i>
                            <i class="kyo-radio" data-id="assistance" data-val="2" onclick="selectItem('is_accomodation_assistance',0);">No</i>
                    </div>
                    <div class="reg-row"><strong>What industry are you seeking employment in?<i class="star">*</i></strong>
                        <div id="industry_lists">
                            <select name="industry[]" class="kyo-select" id="industry_1">
                                <option value="0">Industry</option>
                                <option value="1">Doctor</option>
                                <option value="2">Teacher</option>
                            </select>
                            <select name="position[]" class="kyo-select" id="position_1">
                                <option value="0">Position</option>
                                <option value="1">professor</option>
                                <option value="2">boss</option>
                            </select>
                        </div>
                        <a id="addIndustry" class="reg-row-tip" href="javascript:void(0);">
                        + Add Another Industry</a>
                    </div>
                    <div class="reg-row"><b>What is your availability?</b>
                        <div>
                            <input type="hidden" name="availability" id="availability" value="1" />
                            <ul class="leng-radio">
                                <li><i class="kyo-radio kyo-radio-sel" data-id="availability" data-val="1" onclick="selectItem('availability',1);">Weekdays</i></li>
                                <li><i class="kyo-radio" data-id="availability" data-val="2" onclick="selectItem('availability',1);">Evenings</i></li>
                                <li><i class="kyo-radio" data-id="availability" data-val="3" onclick="selectItem('availability',1);">Weekends</i></li>
                                <li><i class="kyo-radio" data-id="availability" data-val="4" onclick="selectItem('availability',1);">Any</i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="3" />
                        <input type="button" class="reg-save" onclick="preferencesSubmit();"  data-index="1"/>
                    </div>
                </form>
            </div>

            <!-- Education -->
            <div class="reg-area">
                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('4', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>
                <div class="reg-area-tit <?php echo $cla; ?>">Educations</div>
                <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="educationForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div id="every_school">
                    <div class="reg-row"> <strong>School/Collage name<i class="star">*</i></strong>
                        <div>
                            <input type="text" class="reg-input" name="school_name[]" value="<?php if(count($education_info)) echo $education_info["school_name"]; ?>" required />
                        </div>
                    </div>
                    <div class="reg-row"> <strong>Dates Attended<i class="star">*</i></strong>
                        <div class="clearfix">
                            <select class="kyo-select" name="attended_from[]" required>
                                <option value="0">Year</option>
                                <option value="1970">1970</option>
                                <option value="1971">1971</option>
                                <option value="1972">1972</option>
                                <option value="1973">1973</option>
                                <option value="1974">1974</option>
                            </select>
                            <input type="text" class="reg-input input-tip" value="year" data-tipval="year" style="width:80px" disabled="disabled" />
                        </div>
                        <p class="p5">To</p>
                        <div class="clearfix">
                            <select class="kyo-select" name="attended_to[]" required>
                                <option value="0">Year</option>
                                <option value="1970">1970</option>
                                <option value="1971">1971</option>
                                <option value="1972">1972</option>
                                <option value="1973">1973</option>
                                <option value="1974">1974</option>
                            </select>
                            <input type="text" class="reg-input input-tip" value="year" data-tipval="year" style="width:80px" disabled="disabled" />
                        </div>

                        <br />or expected graduation year
                    </div>
                    <div class="reg-row"> <b>Degree title</b>
                        <div>
                            <input type="text" class="reg-input" name="degree[]" value="<?php if(count($education_info)) echo $education_info["degree"]; ?>" />
                        </div>
                    </div>
                    <div class="reg-row"> <b>Major</b>
                        <div>
                            <input type="text" class="reg-input" name="major[]" value="<?php if(count($education_info)) echo $education_info["major"]; ?>" />
                        </div>
                    </div>
                    <div class="reg-row"> <b>Achievements</b>
                        <div>
                            <textarea class="reg-textarea" name="achievements[]"><?php if(count($education_info)) echo $education_info["achievements"]; ?></textarea>
                        </div>
                    </div>
                    </div>

                    <div id="addSchoolBtn">
                        <a class="reg-row-tip" id="addAnotherSchool" href="javascript:void(0);">+ Add Another School</a>
                    </div>

                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="4" />
                        <input type="button" class="reg-save" onclick="educationSubmit();"  data-index="0"/>
                    </div>

                </form>
            </div>

            <!-- work history -->
            <div class="reg-area">
                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('5', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>
                <div class="reg-area-tit <?php echo $cla; ?>">Work History</div>
                <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="workhistoryForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div id="every_job">
                    <div class="reg-row"> <b>Introduce yourself</b>
                        <div>
                            <textarea class="reg-textarea" name="introduce[]"><?php if(count($work_history)) echo $work_history["introduce"]; ?></textarea>
                        </div>
                    </div>
                    <div class="reg-row"> <strong>Company name<i class="star">*</i></strong>
                        <div>
                            <input type="text" class="reg-input" name="company_name[]" value="<?php if(count($work_history)) echo $work_history["company_name"]; ?>" required />
                        </div>
                    </div>
                    <div class="reg-row"> <strong>Time period<i class="star">*</i></strong>
                        <div class="clearfix">
                            <select name="period_time_from[]" class="kyo-select" required>
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                            </select>
                            <input type="text" class="reg-input input-tip" value="year" data-tipval="year" style="width:80px" disabled="disabled" />
                        </div>
                        <p class="p5">To</p>
                        <div class="clearfix">
                            <select name="period_time_to[]" class="kyo-select" required>
                                <option value="2003">2003</option>
                                <option value="2004">2004</option>
                                <option value="2005">2005</option>
                            </select>
                            <input type="text" class="reg-input input-tip" value="year" data-tipval="year" style="width:80px" disabled="disabled" />
                            <input type="hidden" name="is_stillhere" value="0" id="is_stillhere" />
                            <?php $is_stillhere = $work_history["is_stillhere"];
                            $check_sel = "";
                            if($is_stillhere) {
                                $check_sel = "kyo-checkbox-sel";
                            }
                            ?>
                            <i data-val="1" data-id="stillwork" class="kyo-checkbox <?php echo $check_sel; ?>" onclick="isPrivate(this,'is_stillhere');">I still work here</i>
                        </div>
                    </div>
                    <div class="reg-row clearfix"> <strong>Industry<i class="star">*</i></strong>
                        <div class="clearfix">
                            <select class="kyo-select" name="industry[]" required>
                                <option value="0">select</option>
                                <option value="v1">v1</option>
                                <option value="v2">v2</option>
                            </select>
                        </div>
                    </div>
                    <div class="reg-row clearfix"> <strong>Position<i class="star">*</i></strong>
                        <div>
                            <input type="text" class="reg-input" name="position[]" value="<?php if(count($work_history)) echo $work_history["position"]; ?>" required />
                        </div>
                    </div>

                    <div class="reg-row clearfix"> <strong>Description</strong>
                        <div>
                            <?php
                            $v = '';
                            if(count($work_history)) {
                                $v = $work_history["description"];
                            }

                            $v = $v ? $v : "350 Characters";
                            ?>
                            <textarea class="reg-textarea input-tip" name="description[]" data-tipval="350 Characters"><?php echo $v; ?></textarea>
                        </div>
                    </div>
                    <div class="reg-row">
                        <p><a class="reg-row-tip" href="#">Upload examples of work</a></p>
                    </div>
                    </div>

                    <div id="addJobBtn">
                        <p><a class="reg-row-tip" href="javascript:void(0);" id="addAnotherJob">+ Add Another Job</a></p>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="5" />
                        <input type="button" class="reg-save" onclick="workhistorySubmit();" data-index="0"/>
                    </div>
                </form>
            </div>

            <!-- languages -->
            <div class="reg-area">
                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('6', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>
                <div class="reg-area-tit <?php echo $cla; ?>">Languages</div>
                <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="languageForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div id="language_lists">
                    <div class="reg-row"> <strong>Language<i class="star">*</i></strong>
                        <div>
                            <select name="language[]" class="kyo-select" id="language_1" required>
                                <option value="cn">China</option>
                                <option value="en">English</option>
                            </select>
                        </div>
                    </div>
                    <div class="reg-row clearfix" style="clear:both;"> <strong>Proficiency</strong>
                        <div>
                            <select name="level[]" class="kyo-select" id="level_1" required>
                                <option value="1">Level-1</option>
                                <option value="2">Level-2</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="reg-row">
                        <p><a class="reg-row-tip" href="javascript:void(0);" id="addLanguageBtn">+ Add another language</a></p>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="6" />
                        <input type="button" class="reg-save" onclick="languageSubmit();"  data-index="0"/>
                    </div>
                </form>
            </div>

            <!-- personal skills -->
            <div class="reg-area">
                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('7', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>

                <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="personalSkillsForm">
                    <input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>" />
                    <div class="reg-area-tit <?php echo $cla; ?>">Personal Skills</div>
                    <div class="reg-skills-text">
                        <b>Start typing to choose up to 5 personal skills that best suit you</b><span>
                        If you can't find a personal skill from our database just hit the return button to add it</span>
                    </div>
                    <div class="skills-vals clearfix">
                        <ul id="PersonalSkills">
                            <?php foreach($personal_skills as $v) { ?>
                            <li data-val="2"><?php echo $v["personal_skill"]; ?>
                                <i class="del" onclick="delPersonalSkills('PersonalSkills',this,'<?php echo $v['personal_skill']; ?>');"></i>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="reg-row">
                        <div>
                            <input type="text" size="24" maxlength="255" autocomplete="on" id="PersonalSkills_input" class="text skills-input" onkeypress="if(event.keyCode == 13){ addPersonalSkills('PersonalSkills',this); return false;}">
                        </div>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="7" />
                        <input type="button" class="reg-save" onclick="personalSkillsSubmit();"  data-index="0"/>
                    </div>
                </form>
            </div>

            <!-- professional skills -->
            <div class="reg-area">
                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('8', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>

                <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="professionalSkillsForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div class="reg-area-tit <?php echo $cla; ?>">Professional Skills</div>
                    <div class="reg-skills-text">
                        <b>Start typing to choose up to 5 professional skills that best suit you</b><span>
                        If you can't find a personal skill from our database just hit the return button to add it</span>
                    </div>
                    <div class="skills-vals clearfix">
                        <ul id="ProfessionalSkills">
                            <?php foreach($professional_skills as $v) { ?>
                            <li data-val="2"><?php echo $v["professional_skill"]; ?>
                                <i class="del" onclick="delPersonalSkills('ProfessionalSkills',this,'<?php echo $v['professional_skill']; ?>');"></i>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="reg-row">
                        <div>
                            <input type="text" size="24" maxlength="255" autocomplete="on" id="ProfessionalSkills_input" class="text skills-input" onkeypress="if(event.keyCode == 13){ addPersonalSkills('ProfessionalSkills',this); return false;}">
                        </div>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="8" />
                        <input type="button" class="reg-save" onclick="professionalSkillsSubmit();"  data-index="0"/>
                    </div>
                </form>
            </div>

    </div>
        <div class="reg-btns">
            <a href="javascript: void(0);" class="reg-btns-saveall png" onclick="saveAll();"></a>
            <a href="#" class="reg-btns-job png"></a>
        </div>
        <div class="backtop png" style="display: block; top: 564px; right:-80px"></div>
     </div>

</div>

<script type="text/javascript" src="<?php echo $theme_path?>js/reg.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jobseeker.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>