<?php $this->load->view($front_theme.'/header-block');?>
<link href="<?php echo $theme_path?>style/jquery.autocomplete.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/ajaxupload.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.autocomplete.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("select[name='country']").change(function() {
            change_location($(this),'country');
        });
        $("select[name='province']").change(function() {
            change_location($(this), 'province');
        });
        
        select_location('country','<?php echo $userinfo['country'];?>');
        select_location('province','<?php echo $userinfo['province'];?>');
        $("input.date").jSelectDate({
            css:"date",
            yearBeign: 1960,
            disabled : false
        });

        //upload user avatar
        uploadImage();

        //upload work examples
        uploadFile("image_example",'example_upload_button','exampleerrorRemind','work_example');

        $("#PersonalSkills_input").autocomplete("<?PHP echo $site_url; ?>/jobseeker/personalskillsautocomplete",{
            delay:10,
            width: '414px',
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectItem1,
            formatItem: formatItem,
            formatResult: formatResult
        });

        $("#ProfessionalSkills_input").autocomplete("<?PHP echo $site_url; ?>/jobseeker/professionalskillsautocomplete",{
            delay:10,
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectItem2,
            formatItem: formatItem,
            formatResult: formatResult
        });

        $('#addIndustry').click(function() {
            var html = $('#industry_lists').html();
            $("#industry_lists").after("<br />" + html);
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

            html = html1+html_middle+html2 + '<div class="reg-row"><input type="hidden" name="work_example[]" id="'+input_id+'" />'+
                '<div id="'+upload_id+'">'+
                '<span id="'+btn_id+'" class="reg-row-tip">Upload examples of work</span></div>'+
                '<span class="" id="'+error_id+'"></span></div>';

            $('#workhistoryForm #addJobBtn').before(html);

            uploadFile(btn_id,upload_id,error_id,input_id);
        });

        $('#addLanguageBtn').click(function() {
            var html = $('#language_lists').html();
            $('#language_lists').after(html);
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
            action:"<?php echo $site_url?>user/ajaxuploadimage",
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

                    var img_path = "<?php echo $site_url; ?>attached/users/" + filename;
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
            action:"<?php echo $site_url?>user/ajaxuploadfile",
            name:"workexample",
            data: {},
            onSubmit:function(file,ext){
            },
            onComplete:function(file,response){
                oBtn.disabled = "";
                if ( response == 'success') {
                    oRemind.style.color = "green";
                    oRemind.innerHTML = "Upload successful.";

                    var reg = /\s/g;
                    file = file.replace(reg, "");

                    var img_path = "workExamples/" + file;
                    $('#'+input_id).val(img_path);
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
                }
                else{
                    alert('Delete failed!');
                }
        });
    }

    // ajax to adding personal skills
    function addPersonalSkillAjax(id_str,uid, v, li_id) {
        $.post(site_url + '/jobseeker/add'+ id_str,
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

    
</script>

<!--Jobseeker registration page body-->
<div class="reg-page w770 clearfix rel">
    <div class="reg-left abs box mb20">
        <h2 class="reg-left-tit">NiHAO <span title="<?php echo $userinfo['first_name'];?>"><?php echo substr($userinfo['first_name'],0,8);?></span></h2>
        <ul class="reg-ul">
            <li class="curr"><a href="#reg1">Basic Information</a></li>
            <?php $step_arr = $step_arr;
            $cla = '';
            if(in_array('2', $step_arr)) {
                $cla = ' class = "curr"';
            }
            ?>
            <li<?php echo $cla; ?> id="step2"><a href="#reg2">Contact Details</a></li>
            <?php $step_arr = $step_arr;
            $cla = '';
            if(in_array('3', $step_arr)) {
                $cla = ' class = "curr"';
            }
            ?>
            <li<?php echo $cla; ?> id="step3"><a href="#reg3">Preferences</a></li>
            <?php $step_arr = $step_arr;
            $cla = '';
            if(in_array('4', $step_arr)) {
                $cla = ' class = "curr"';
            }
            ?>
            <li<?php echo $cla; ?> id="step4"><a href="#reg4">Education</a></li>
            <?php $step_arr = $step_arr;
            $cla = '';
            if(in_array('5', $step_arr)) {
                $cla = ' class = "curr"';
            }
            ?>
            <li<?php echo $cla; ?> id="step5"><a href="#reg5">Work History</a></li>
            <?php $step_arr = $step_arr;
            $cla = '';
            if(in_array('6', $step_arr)) {
                $cla = ' class = "curr"';
            }
            ?>
            <li<?php echo $cla; ?> id="step6"><a href="#reg6">Languages</a></li>
            <?php $step_arr = $step_arr;
            $cla = '';
            if(in_array('7', $step_arr)) {
                $cla = ' class = "curr"';
            }
            ?>
            <li<?php echo $cla; ?> id="step7"><a href="#reg7">Personal Skills</a></li>
            <?php $step_arr = $step_arr;
            $cla = '';
            if(in_array('8', $step_arr)) {
                $cla = ' class = "curr"';
            }
            ?>
            <li<?php echo $cla; ?> id="step8"><a href="#reg8">Profesional Skills</a></li>
        </ul>
    </div>
    <div class="reg-right-wrap">
        <div class="reg-right box mb20">
            <p class="reg-right-text">
                Please fill out the mandatory fields (*) to apply for jobs.<br>
				To streamline your job search and highlight your profile to employers, please fill out all optional fields as well.<br>
				Feel free to come back and fill out your preferences later, you can search through our current job listings <a href="<?php echo $site_url?>search/findjob">HERE</a></p>

            <!-- Basic information -->

            <div class="reg-area" id="reg1">
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
				.location select, .location dl.kyo-select-list {width:145px !important;}
                </style>
                <div class="reg-row clearfix location"> <strong>Location <i class="star">*</i></strong>
                    <div>
                        <select name="country" required>
                            <option value="">All Counties</option>
                            <?php foreach ($location as $k=>$v):?>
                                <?php if ($k == $userinfo['country']): ?>
                                <option value="<?php echo $k ?>" selected><?php echo $k ?></option>
                                <?php else: ?>
                                <option value="<?php echo $k ?>"><?php echo $k ?></option>
                                <?php endif; ?>
                            <?php endforeach;?>
                        </select>
                        <select name="province">
                            <option value="">All Province</option>
                            <?php foreach ($location['China'] as $k=>$v):?>
                                <?php if ($k == $userinfo['province']): ?>
                                <option value="<?php echo $k ?>" selected><?php echo $k ?></option>
                                <?php else: ?>
                                <option value="<?php echo $k ?>"><?php echo $k ?></option>
                                <?php endif; ?>
                            <?php endforeach;?>
                        </select>
                        <select name="city">
                            <option value="">All City</option>
                            <option value="2">Beijing</option>
                            <option value="3">Shanghai</option>
                        </select>
                    </div>
                </div>
                <div class="reg-row clearfix"> <b>Profile Picture</b>
                    <div>
                        <input type="hidden" name="avatar" id="avatar" value="<?php echo $userinfo['profile_pic']; ?>" />
                        <div id="upload_button">
                            <?php if($userinfo['profile_pic']) {
                                        $pic = $site_url.'attached/users/'.$this->session->userdata('uid').'/'.$userinfo['profile_pic'];
                                   } else {
                                        $pic = $theme_path.'style/reg/com-img.gif';
                                   }
                            ?>
                            <img id="image_profile" height='100px' src="<?php echo $pic; ?>" class="reg-company-img" />
                        </div>
                        <span class="" id="errorRemind"></span>
                    </div>
                </div>
                <div class="reg-row clearfix"> <strong>Birthday<i class="star">*</i></strong>
                    <div>
                        <?php $birthday = $userinfo["birthday"];
                            $birthday = !empty($birthday) ? $birthday : '2013-1-1';
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

            <div class="reg-area" id="reg2">

            <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="contactDetailsForm">
                <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('2', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>
                <div class="reg-area-tit <?php echo $cla; ?>">Contact Details</div>
                <div class="reg-row"> <strong>Email Address<i class="star">*</i></strong>
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
                <div class="reg-row"> <b>Twitter Username</b>
                    <div>
                        <input type="text" name="twitter" class="reg-input" value="<?php echo $userinfo['twitter']; ?>" />
                    </div>
                </div>
               <div class="reg-row"> <b>Linkedin Username</b>
                    <div>
                        <input type="text" name="linkedin" class="reg-input" value="<?php echo $userinfo['linkedin']; ?>" />
                    </div>
                </div>
                <div class="reg-row"> <b>Wechat</b>
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

            <div class="reg-area" id="reg3">

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
                            <input type="text" name='employment_length' id="employment_length" value="<?php echo $userinfo['employment_length']; ?>" style="display:none" class="kyo-radio"/>
                            <ul class="leng-radio">
                                <li><i data-val="0" data-id="employment_length" class="kyo-radio" onclick="selectItem('employment_length',1);">Long term employment (1+ years)</i></li>
                                <li><i data-val="1" data-id="employment_length" class="kyo-radio" onclick="selectItem('employment_length',2);">Short term employment (-1 years)</i></li>
                                <li><i data-val="2" data-id="employment_length" class="kyo-radio" onclick="selectItem('employment_length',3);">No preference</i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="reg-row"><strong>Prefered type of employment?<i class="star">*</i></strong>
                        <div>
                            <input type="hidden" name="employment_type" id="employment_type" value="<?php echo $userinfo['employment_type'];?>" class="kyo-radio" />
                            <ul class="leng-radio">
                                <li><i data-val="1" data-id="employment_type" class="kyo-radio" onclick="selectItem('employment_type',1);">Contract</i></li>
                                <li><i data-val="2" data-id="employment_type" class="kyo-radio" onclick="selectItem('employment_type',2);">Part Time</i></li>
                                <li><i data-val="3" data-id="employment_type" class="kyo-radio" onclick="selectItem('employment_type',3);">Full Time</i></li>
                                <li><i data-val="4" data-id="employment_type" class="kyo-radio" onclick="selectItem('employment_type',4);">Internship</i></li>
                                <li><i data-val="5" data-id="employment_type" class="kyo-radio" onclick="selectItem('employment_type',5);">Any</i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="reg-row"><strong>Do you require Visa assistance from employers?<i class="star">*</i></strong>
                            <input type="hidden" name="is_visa_assistance" id="is_visa_assistance" value="<?php echo $userinfo['is_visa_assistance']; ?>" class="kyo-radio"/>
                            <i class="kyo-radio" data-id="is_visa_assistance" data-val="1" onclick="selectItem('is_visa_assistance',1);">Yes</i>
                            <i class="kyo-radio" data-id="is_visa_assistance" data-val="2" onclick="selectItem('is_visa_assistance',0);">No</i>
                    </div>
                    <div class="reg-row"><strong>Do you require accomodation assistance from employer?<i class="star">*</i></strong>
                            <input type="hidden" name="is_accomodation_assistance" id="is_accomodation_assistance" value="<?php echo $userinfo['is_accomodation_assistance'];?>" class="kyo-radio"/>
                            <i class="kyo-radio" data-id="is_accomodation_assistance" data-val="1" onclick="selectItem('is_accomodation_assistance',1);">Yes</i>
                            <i class="kyo-radio" data-id="is_accomodation_assistance" data-val="2" onclick="selectItem('is_accomodation_assistance',0);">No</i>
                    </div>
                    <div class="reg-row"><strong>What industry are you seeking employment in?<i class="star">*</i></strong>
                        <div id="industry_lists">
                            <select name="industry[]" id="industry_1" required="required" onchange="changeIndustry(this);">
                                <option value="">Industry</option>
                                <?php
                                $user_industry = $seekingIndustry["industry"];
                                foreach($industry as $key=>&$v) {
                                    $str = '';
                                    if($v['name'] == $user_industry) {
                                        $str = ' selected="selected"';
                                    }
                                ?>
                                <option value="<?php echo $v['name']; ?>"<?php echo $str;?>><?php echo $v['name']; ?></option>
                                <?php } ?>
                            </select>
                            <select name="position[]" id="position_1" required>
                                <option value="">Position</option>
                                <?php
                                $user_position = $seekingIndustry["position"];
                                foreach($position as $key=>&$v) {
                                    $str = '';
                                    if($v["name"] == $user_position) {
                                        $str = ' selected="selected"';
                                    }
                                ?>
                                <option value="<?php echo $v['name']; ?>"<?php echo $str; ?>><?php echo $v['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <a id="addIndustry" class="reg-row-tip" href="javascript:void(0);">
                        + Add Another Industry</a>
                    </div>
                    <div class="reg-row"><b>What is your availability?</b>
                        <div>
                            <input type="hidden" name="availability" id="availability" value="<?php echo $userinfo['availability'];?>" class="kyo-radio"/>
                            <ul class="leng-radio">
                                <li><i class="kyo-radio" data-id="availability" data-val="1" onclick="selectItem('availability',1);">Weekdays</i></li>
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

            <div class="reg-area" id="reg4">

                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('4', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>
                <div class="reg-area-tit <?php echo $cla; ?>">Education</div>
                <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="educationForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div id="every_school">
                    <div class="reg-row"> <strong>School/College name<i class="star">*</i></strong>
                        <div>
                            <input type="text" class="reg-input" name="school_name[]" value="<?php if(count($education_info)) echo $education_info["school_name"]; ?>" required />
                        </div>
                    </div>
                    <div class="reg-row"> <strong>Dates Attended<i class="star">*</i></strong>
                        <div class="clearfix">
                            <select name="attended_from[]" required>
                                <option value="">Year</option>
                                <?php
                                    $from_y = 0;

                                    if(count($education_info)) {
                                        $from_y = $education_info["attend_date_from"];
                                    }
                                    foreach($yearArray as $v) {
                                        $sel = '';

                                        if($v == $from_y) {
                                            $sel = ' selected="selected"';
                                        }
                                ?>
                                <option value="<?php echo $v; ?>"<?php echo $sel; ?>><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" class="reg-input input-tip" value="year" data-tipval="year" style="width:80px" disabled="disabled" />
                        </div>
                        <p class="p5">To</p>
                        <div class="clearfix">
                            <select name="attended_to[]" required>
                                <option value="">Year</option>
                                <?php
                                $from_y = 0;

                                if(count($education_info)) {
                                    $from_y = $education_info["attend_date_to"];
                                }
                                foreach($yearArray as $v) {
                                    $sel = '';

                                    if($v == $from_y) {
                                        $sel = ' selected="selected"';
                                    }
                                ?>
                                <option value="<?php echo $v; ?>"<?php echo $sel; ?>><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" class="reg-input input-tip" value="year" data-tipval="year" style="width:80px" disabled="disabled" />
                        </div>

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

            <div class="reg-area" id="reg5">

                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('5', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>
                <div class="reg-area-tit <?php echo $cla; ?>">Work History</div>
                <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="workhistoryForm" enctype="multipart/form-data">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div id="every_job_part1">
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
                            <select name="period_time_from[]" required>
                                <option value="">Year</option>
                                <?php
                                $from_y = 0;

                                if(count($work_history)) {
                                    $from_y = $work_history["period_time_from"];
                                }
                                foreach($yearArray as $v) {
                                    $sel = '';

                                    if($v == $from_y) {
                                        $sel = ' selected="selected"';
                                    }
                                ?>
                                <option value="<?php echo $v; ?>"<?php echo $sel; ?>><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" class="reg-input input-tip" value="year" data-tipval="year" style="width:80px" disabled="disabled" />
                        </div>
                        <p class="p5">To</p>
                        <div class="clearfix">
                            <select name="period_time_to[]" required>
                                <option value="">Year</option>
                                <?php
                                $from_y = 0;

                                if(count($work_history)) {
                                    $from_y = $work_history["period_time_to"];
                                }
                                foreach($yearArray as $v) {
                                    $sel = '';

                                    if($v == $from_y) {
                                        $sel = ' selected="selected"';
                                    }
                                ?>
                                <option value="<?php echo $v; ?>"<?php echo $sel; ?>><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" class="reg-input input-tip" value="year" data-tipval="year" style="width:80px" disabled="disabled" />
                        </div>
                    </div>
                    </div>
                            <input type="hidden" name="is_stillhere[]" value="0" id="is_stillhere" />
                            <?php
                            $check_sel = "";
                            $is_stillhere = 0;
                            if(count($work_history)) {
                                $is_stillhere = $work_history["is_stillhere"];
                            }

                            if($is_stillhere) {
                                $check_sel = "kyo-checkbox-sel";
                            }
                            ?>
                            <i data-val="1" data-id="stillwork" class="kyo-checkbox <?php echo $check_sel; ?>" onclick="isPrivate(this,'is_stillhere');">I still work here</i>

                    <div id="every_job_part2">
                    <div class="reg-row clearfix"> <strong>Industry<i class="star">*</i></strong>
                        <div class="clearfix">
                            <select name="industry[]" required>
                                <option value="">select</option>
                                <?php foreach($industry as $key=>&$v) {
                                    if(empty($v['name'])) continue;
                                    $str = "";
                                    if($v['name'] == $work_history["industry"]) {
                                        $str = ' selected="selected"';
                                    }
                                ?>
                                <option value="<?php echo $v['name']; ?>"<?php echo $str; ?>><?php echo $v['name']; ?></option>
                                <?php } ?>
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
                            <textarea class="reg-textarea input-tip" name="description[]" data-tipval="350 Characters" onkeypress="checkLength(this, 350);"><?php echo $v; ?></textarea>
                        </div>
                    </div>
                    </div>

                    <div class="reg-row">
                        <input type="hidden" name="work_example" id="work_example" />
                        <div id="example_upload_button">
                            <span id="image_example" class="reg-row-tip">Upload examples of work</span>
                        </div>
                        <span class="" id="exampleerrorRemind"></span>
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

            <div class="reg-area reg-row" id="reg6">

                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('6', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>

                <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="languageForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div class="reg-area-tit <?php echo $cla; ?>">Languages</div>
                    <div id="language_lists">
                    <div class="reg-row" style="float:left;width:240px;">
                        <strong>Language<i class="star">*</i></strong><br />
                        <select name="language[]" id="language_1" required>
                            <option value="">Language</option>
                            <?php
                            $lan = '';

                            if(count($language)) {
                                $lan = $language[0]["language"];
                            }
                            foreach($language_arr as $v) {
                                $str = '';
                                if($v == $lan) {
                                    $str = ' selected="selected"';
                                }
                            ?>
                            <option value="<?php echo $v; ?>"<?php echo $str; ?>><?php echo $v; ?></option>
                            <?php } ?>
                        </select>
                     </div>
                     <div style="float:left;width:220px;">
                        <strong>Proficiency</strong><br />
                        <select name="level[]" id="level_1" required>
                            <option value="">Level</option>
                            <?php
                            $lev = '';

                            if(count($language)) {
                                $lev = $language[0]["level"];
                            }
                            foreach($level_arr as $v) {
                                $str = '';
                                if($v == $lev) {
                                    $str = ' selected="selected"';
                                }
                                ?>
                                <option value="<?php echo $v; ?>"<?php echo $str; ?>><?php echo $v; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="clear"></div>
                    </div>
                    <div class="reg-row" style="clear: both;">
                        <p><a class="reg-row-tip" href="javascript:void(0);" id="addLanguageBtn">+ Add another language</a></p>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="6" />
                        <input type="button" class="reg-save" onclick="languageSubmit();"  data-index="0"/>
                    </div>
                </form>
            </div>

            <!-- personal skills -->

            <div class="reg-area" id="reg7">

                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('7', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>

                <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="PersonalSkillsForm">
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
                            <input type="text" size="24" maxlength="255" autocomplete="on" id="PersonalSkills_input" class="text skills-input" onkeypress="if(event.keyCode == 13){ addPersonalSkills('PersonalSkills',this,'step7'); return false;}">
                        </div>
                    </div>
                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="7" />
                        <input type="button" class="reg-save" onclick="personalSkillsSubmit();"  data-index="0"/>
                    </div>
                </form>
            </div>

            <!-- professional skills -->

            <div class="reg-area" id="reg8">

                <?php $step_arr = $step_arr;
                $cla = '';
                if(in_array('8', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>

                <form action="<?php echo $site_url; ?>/jobseeker/register" method="post" id="ProfessionalSkillsForm">
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
                            <input type="text" size="24" maxlength="255" autocomplete="on" id="ProfessionalSkills_input" class="text skills-input" onkeypress="if(event.keyCode == 13){ addPersonalSkills('ProfessionalSkills',this,'step8'); return false;}">
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
            <a href="<?php echo $site_url?>search/searchJob" class="reg-btns-job png"></a>
        </div>
        <div class="backtop png" style="display: block; top: 564px; right:-80px"></div>
     </div>

</div>

<script type="text/javascript" src="<?php echo $theme_path?>js/reg.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jobseeker.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>
