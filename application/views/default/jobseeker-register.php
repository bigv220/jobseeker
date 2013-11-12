<?php $this->load->view($front_theme.'/header-block');?>
<link href="<?php echo $theme_path?>style/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<style type="text/css">
   .advsearch-row .delete {width: 13px;float:right;margin-right: 0px;}
</style>

<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/ajaxupload.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.autocomplete.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jobseeker.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        select_location('country','<?php echo $userinfo['country'];?>');
        select_location('province','<?php echo $userinfo['province'];?>');

        //upload user avatar
        uploadImage();

        //upload work examples
        uploadFile("image_example",'example_upload_button','exampleerrorRemind','work_example');
    });
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
            <li<?php echo $cla; ?> id="step8"><a href="#reg8">Technical Skills</a></li>
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
            <form action="<?php echo $site_url; ?>jobseeker/register" method="post" id="basicInfoForm">
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
                            <option value="">All Countries</option>
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
                            <option value="1">Beijing</option>
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

            <form action="<?php echo $site_url; ?>jobseeker/register" method="post" id="contactDetailsForm">
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
                <div class="reg-row"> <b>Twitter</b>
                    <div>
                        <input type="text" name="twitter" class="reg-input" value="<?php echo $userinfo['twitter']; ?>" />
                    </div>
                </div>
               <div class="reg-row"> <b>Linkedin</b>
                    <div>
                        <input type="text" name="linkedin" class="reg-input" value="<?php echo $userinfo['linkedin']; ?>" />
                    </div>
                </div>
                <div class="reg-row"> <b>Weibo</b>
                    <div>
                        <input type="text" name="weibo" class="reg-input" value="<?php echo $userinfo['weibo']; ?>" />
                    </div>
                </div>
                <div class="reg-row"> <b>Facebook</b>
                    <div>
                        <input type="text" name="facebook" class="reg-input" value="<?php echo $userinfo['facebook']; ?>" />
                    </div>
                </div>
                <!-- <div class="reg-row"> <b>Other Social Network</b>
                    <div>
                        <input type="text" name="socialNetwork" id="reg-Network" value="">
                        <div id="reg-network-val" class="show-selval"></div>
                    </div>
                </div> -->
                <div class="reg-area-bar">
                    <input type="hidden" name="register_step" value="2" />
                    <input type="button" class="reg-save" data-index="1" onclick="contactDetailsSubmit();" />
                </div>
            </form>
            </div>

            <!-- Preferences -->

            <div class="reg-area" id="reg3">

                <form action="<?php echo $site_url; ?>jobseeker/register" method="post" id="preferencesForm">
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
                            	<?php $empl = getEmploymentLength();
                            	foreach ($empl as $k => $v) { ?>
                            	<li><i data-val="<?php echo $k+1?>" data-id="employment_length" class="kyo-radio" onclick="selectItem('employment_length',<?php echo $k+1?>);"><?php echo $v?></i></li>
								<?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="reg-row"><strong>Prefered type of employment?<i class="star">*</i></strong>
                        <div>
                            <input type="hidden" name="employment_type" id="employment_type" value="<?php echo $userinfo['employment_type'];?>" class="kyo-checkout" />
                            <ul class="leng-radio">
                            <?php $jobtype = jobtype();
                            	foreach ($jobtype as $k => $v) { ?>
                                <?php if (strpos($userinfo['employment_type'],$v) !== FALSE): ?>
                                    <li><i data-val="<?php echo $v?>" data-id="employment_type" class="kyo-checkbox kyo-checkbox-sel"><?php echo $v?></i></li>
                                <?php else: ?>
                                    <li><i data-val="<?php echo $v?>" data-id="employment_type" class="kyo-checkbox"><?php echo $v?></i></li>
                                <?php endif; ?>
                            <?php } ?>
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
                        <?php
                         $i = 0;
                        if (!count($seekingIndustry)) {
                            $seekingIndustry = array(array('industry'=>'none','position'=>'none'));
                        }
                        foreach($seekingIndustry as $v): ?>
                            <?php
                            $i++;
                            if($i == 1) {echo '<div id="industry_lists">';} ?>

                            <select name="industry_1[]" id="industry_1" required="required" onchange="changeIndustry(this, true);">
                                <option value="">Industry</option>
                                <?php
                                $user_industry = $v["industry"];
                                foreach($industry as $key=>&$val) {
                                    $str = '';
                                    if($val['name'] == $user_industry) {
                                        $str = ' selected="selected"';
                                    }
                                ?>
                                <option value="<?php echo $val['name']; ?>"<?php echo $str;?>><?php echo $val['name']; ?></option>
                                <?php } ?>
                            </select>
                            <select name="position_1[]" id="position_1" required>
                                <option value="<?php echo $v['position']; ?>"><?php echo $v['position']; ?></option>
                            </select>
                            <?php if($i==1) {echo "</div>";} ?>

                            <?php if($i>1): ?>
                            <span class="delSeekingIndustry"><i onclick="delSeekingIndustry(this,'<?php echo $v['industry']; ?>','<?php echo $v['position']; ?>');" class="del"></i></span>
                            <?php endif; ?>

                            <?php endforeach; ?>
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
                <form action="<?php echo $site_url; ?>jobseeker/register" method="post" id="educationForm">
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
                <form action="<?php echo $site_url; ?>jobseeker/register" method="post" id="workhistoryForm" enctype="multipart/form-data">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />

                    <div id="every_job_part1">
                        <input type="hidden" name="id[]" value="<?php if(count($work_history)) echo $work_history["id"]; ?>" />
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
                        <?php
                        //Load Model
                        $this->load->model('jobseeker_model');

                        if (empty($work_history['id'])) {
                            $userIndustry = array(array('industry'=>'none','position'=>'none'));
                        } else {
                            $userIndustry = $this->jobseeker_model->getUserIndustry($this->session->userdata('uid'), $work_history['id']);
                        }

                        $data['userIndustry'] = $userIndustry;
                        $data['industry'] = $industry;
                        $this->load->view($front_theme.'/industry_multi-select', $data);
                        ?>

                        <div class="reg-row" style="clear: both;">
                            <div>
                            <input type="hidden" name="grop_num[]" value="<?php echo count($userIndustry); ?>"/>
                            <a class="reg-row-tip" href="javascript:void(0);" onclick="addIndustryBtnClick(this);">+ Add another Industry</a>
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
                        <input type="hidden" name="work_example[]" id="work_example" value='<?php if(!empty($work_history["work_examples_url"])) echo $work_history["work_examples_url"]; ?>' />
                        <div id="example_upload_button">
                            <?php if(empty($work_history["work_examples_url"])): ?>
                                <span id="image_example" class="reg-row-tip">Upload examples of work</span>
                            <?php else: ?>
                                <span id="image_example" class="reg-row-tip" style="display: none;">Upload examples of work</span>
                                <span>Work Examples: <?php echo $work_history["work_examples_url"]; ?></span>
                            <?php endif; ?>
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

                <form action="<?php echo $site_url; ?>jobseeker/register" method="post" id="languageForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div class="reg-area-tit <?php echo $cla; ?>">Languages</div>
                    <?php
                    $i = 0;
                    if (empty($language)) {
						$language = array(array('language'=>'none','level'=>'none'));
					}
                    foreach($language as $lan):
                        if(++$i == 1) {echo '<div class="advsearch-row clearfix" id="language_lists">';}
                        else { echo '<div class="advsearch-row clearfix">';}
                    ?>

                    <div class="span1">
                        <strong>Language<i class="star">*</i></strong>
                        <div class="reg-row">
                            <select name="language[]" id="language_1" required>
                                <option value="">Language</option>
                                <?php
                                foreach($language_arr as $v) {
                                    $str = '';
                                    if($v == $lan['language']) {
                                        $str = ' selected="selected"';
                                    }
                                ?>
                                <option value="<?php echo $v; ?>"<?php echo $str; ?>><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                     </div>
                     <div class="span2">
                        <strong>Proficiency</strong>
                        <div class="reg-row">
                            <select name="level[]" id="level_1" required>
                            <option value="">Proficiency</option>
                            <?php $level = language_level();
                            foreach($level as $v) {
                                $str = '';
                                if($v == $lan['level']) {
                                    $str = ' selected="selected"';
                                }
                            ?>
                            <option value="<?php echo $v; ?>"<?php echo $str; ?>><?php echo $v; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php if($i>1) {?>
                    <div class="span3">
                        <i class="del" onclick="delLanguage(this, '<?php echo $lan['language']; ?>');"></i>
                    </div>
                    <?php }?>

                    </div>
                    <?php endforeach; ?>

                    <div class="advsearch-row clearfix">
                        <div class="span1">
                            <input type="hidden" name="grop_num[]" value="<?php echo count($language); ?>" />
                            <a class="reg-row-tip" href="javascript:void(0);" onclick="addLanguageBtnClick(this);">+ Add another language</a>
                        </div>
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

                <form action="<?php echo $site_url; ?>jobseeker/register" method="post" id="PersonalSkillsForm">
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

                <form action="<?php echo $site_url; ?>jobseeker/register" method="post" id="ProfessionalSkillsForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <div class="reg-area-tit <?php echo $cla; ?>">Technical Skills</div>
                    <div class="reg-skills-text">
                        <b>Start typing to choose up to 5 technical skills that best suit you</b><span>
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
            <a href="<?php echo $site_url?>jobseeker/profile" class="view_my_profile png"></a>
        </div>
        <div class="backtop png" style="display: block; top: 564px; right:-80px"></div>
     </div>

</div>

<script type="text/javascript" src="<?php echo $theme_path?>js/reg.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/findJobPage.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>
