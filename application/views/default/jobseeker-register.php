<?php $this->load->view($front_theme.'/header-block');?>
<link href="<?php echo $theme_path?>style/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<style type="text/css">
   .advsearch-row .delete {width: 13px;float:right;margin-right: 0px;}
</style>

<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.autocomplete.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jobseeker.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        select_location('country','<?php echo $userinfo['country'];?>');
        select_location('province','<?php echo $userinfo['province'];?>');

        //upload user avatar
        //uploadImage(); OLD IMAGE Upload works. Details written in jobseeker.js file.

        //upload work examples
        //uploadFile("image_example",'example_upload_button','exampleerrorRemind','work_example');
        
        
      /* New Upload Image & crop works STARTS here. */       
     uploadImageAndCrop();

    /**
     * It hide the IMAGE AREA containers (in some cases, it is not closing automatically).
     * This is needed when user started cropping but stopped without completing all steps.
     */
    $(document).bind('close.facebox', function() {
            // close tinymce or whatever you need..
        $(".imgareaselect-selection").remove(); 
        $(".imgareaselect-border1").remove(); 
        $(".imgareaselect-border2").remove(); 
        $(".imgareaselect-border3").remove();
        $(".imgareaselect-border4").remove(); 
        $(".imgareaselect-handle").remove(); 
        $(".imgareaselect-outer").remove();
        
        $("#errorRemind").html('');
    });

    /**
     * Company Logo uploaded to Server via ajax.
     * Trigger Facebox for PopUp and shows the Image Preview (Resized version) for Cropping. 
     */
    function uploadImageAndCrop(old_avatar) {
            var oBtn = document.getElementById("image_profile");
            var upload_button = document.getElementById("upload_button");
            var oRemind = document.getElementById("errorRemind");
            new AjaxUpload(oBtn,{
                action:"<?php echo $site_url?>user/uploadimage",
                name:"image",
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
                        oRemind.style.color =   "green";
                        oRemind.innerHTML   =   "Now cropping image...";

                        // Trigger Facebox PopUp call.
                        // After successfull cropping, the thumbnailPreview() will be calledback.
                        jQuery.facebox({ ajax: '<?php echo $site_url; ?>user/cropimage' });

                    } else {
                        oRemind.style.color = "red";
                        oRemind.innerHTML = response[1];
                    }
                }
            });
        }       
    /* New Upload Image & crop works Ends here. */    
        
        
        
        
    });
    
/* New Upload Image & crop works STARTS here. */    
/**
 * Called from facebox popup page once the real IMAGE CROPPING is over.
 * 1. It hide the IMAGE AREA containers (in some cases, it is not closing automatically)
 * 2. Shows preview of new cropped image.
 * 3. Store the cropped image name into avatar for datbase updation.
 */                      
function thumbnailPreview(thumb_image_name_with_ext)
{ 
   $(".imgareaselect-outer").hide(); 
   $(".imgareaselect-selection").hide(); 
   $(".imgareaselect-border1").hide(); 
   $(".imgareaselect-border2").hide(); 
   
   var img_path = "<?php echo $site_url; ?>attached/users/profileimage/"+thumb_image_name_with_ext;
   
   $("#image_profile").attr( "src", img_path);
   $("#errorRemind").html('Image has been saved.');
   
    var profile_pic = "profileimage/"+thumb_image_name_with_ext;
    $('#avatar').val(profile_pic);
}
/* New Upload Image & crop works ENDS here. */  

</script>

<?php 
/**
 * Image Upload & Cropping: 
 * See the documentaion in user/uploadimage
 * 
 * URL http://defunkt.io/facebox/ [Popup Implementation]
 */
?>
<link href="<?php echo $theme_path?>cropimage/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php echo $theme_path?>cropimage/facebox.js" type="text/javascript"></script>

<!--Deletion Works. -->
<link href="<?php echo $theme_path?>style/delete.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $theme_path?>style/changepass.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $theme_path?>js/deletecompany.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/changepass.js"></script>
<!--Deletion Works. Ends here. -->


<!--Jobseeker registration page body-->
<div class="reg-page w770 clearfix rel">
    <div class="reg-left abs box mb20">
        <h2 class="reg-left-tit">Nihao <span title="<?php echo $userinfo['first_name'];?>"><?php echo substr($userinfo['first_name'],0,8);?></span></h2>
               <ul class="reg-ul-top">
            <li><a href="<?php echo $site_url?>jobseeker/viewprofile">View Profile</a></li>
            <li><a href="<?php echo $site_url?>search/searchJob">Find a Job</a></li>
        </ul>
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
                Please fill out the mandatory fields (*) to apply for jobs and/or appear in search results.<br>
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
                            <option value="">All Cities</option>
                            <option value="1">Beijing</option>
                        </select>
                    </div>
                </div>
                <div class="reg-row clearfix"> <b>Profile Picture</b>
                    <div>
                        <input type="hidden" name="avatar" id="avatar" value="<?php echo $userinfo['profile_pic']; ?>" />
                        <div id="upload_button">
                            <?php if($userinfo['profile_pic']) {
                                        $pic = $site_url.'attached/users/'.$userinfo['profile_pic'];
                                   } else {
                                        $pic = $theme_path.'style/reg/com-img.gif';
                                   }
                            ?>
                            <img id="image_profile" height='100px' src="<?php echo $pic; ?>" class="reg-company-img" />
                            <p><span>Select jpg, gif or png image with size less than 3MB.</span></p>
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
                <div class="reg-row clearfix"> <strong>Description <i class="star">*</i></strong>
                    <div>
                        <textarea class="reg-textarea" name="description" required><?php echo $userinfo['description']; ?></textarea>
                    </div>
                    Describe yourself in 300 words or less.
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
                    <div class="reg-row"><strong>Preferred length of employment?<i class="star">*</i></strong>
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
                    <div class="reg-row"><strong>Preferred type of employment?<i class="star">*</i></strong>
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
                    <div class="reg-row"><strong>Do you require visa assistance from employers?<i class="star">*</i></strong>
                            <input type="hidden" name="is_visa_assistance" id="is_visa_assistance" value="<?php echo $userinfo['is_visa_assistance']; ?>" class="kyo-radio"/>
                            <i class="kyo-radio" data-id="is_visa_assistance" data-val="1" onclick="selectItem('is_visa_assistance',1);">Yes</i>
                            <i class="kyo-radio" data-id="is_visa_assistance" data-val="2" onclick="selectItem('is_visa_assistance',0);">No</i>
                    </div>
                    <div class="reg-row"><strong>Do you require accommodation assistance from employer?<i class="star">*</i></strong>
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
                                <?php $avai_arr = explode(",", $userinfo['availability']); ?> 
                                <li><i class="kyo-checkbox <?php if (in_array("Weekdays", $avai_arr)) echo "kyo-checkbox-sel"; ?>" data-id="availability" data-val="Weekdays">Weekdays</i></li>
                                <li><i class="kyo-checkbox <?php if (in_array("Evenings", $avai_arr)) echo "kyo-checkbox-sel"; ?>" data-id="availability" data-val="Evenings">Evenings</i></li>
                                <li><i class="kyo-checkbox <?php if (in_array("Weekends", $avai_arr)) echo "kyo-checkbox-sel"; ?>" data-id="availability" data-val="Weekends">Weekends</i></li>
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

                <?php
                $step_arr = $step_arr;
                $cla = '';
                if (in_array('4', $step_arr)) {
                    $cla = 'reg-area-tit-curr';
                }
                ?>
                <div class="reg-area-tit <?php echo $cla; ?>">Education</div>
                <form action="<?php echo $site_url; ?>jobseeker/register" method="post" id="educationForm">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
					
					
			<!-- TABLE EDUCATION HISTORY --> 
			
		<div id="history_jobs_list">
			<table class="table_edit_profile_list" id="table_edit_education_history">
				<colgroup>
					<col width="140" />
					<col width="100" />
					<col width="165" />
					<col width="35" />
					<col width="10" />
					<col width="35" />
					<col width="35" />
					<col width="35" />
				</colgroup>
					<tr id="education_history_table_header"
					<?php if (count($education_history) == 0) { ?> 
                                    style="display:none;"
                                    <?php } ?>
					>
					<th class="th_left_align">School/College</th>
					<th>Degree</th>
					<th>Major</th>
					<th>From</th>
					<th></th>
					<th>Until</th>
					<th>Edit</th>
					<th>Delete</th>
					</tr>
				<?php foreach($education_history as $edu_h) { ?>
				<tr id="education_history_tablerow_<?php echo $edu_h["id"]; ?>">
					<td class="th_left_align"><?php echo $edu_h["school_name"]; ?></td>
					<td><?php echo $edu_h["degree"]; ?></td>
					<td><?php echo $edu_h["major"]; ?></td>
					<td><?php echo date("Y", strtotime($edu_h["attend_date_from"])); ?></td>
					<td> - </td>
					<td><?php echo date("Y", strtotime($edu_h["attend_date_to"])); ?></td>
					<td><a href="javascript:void(0);" class="edit_education_history_item" data_education_history="<?php echo $edu_h["id"]; ?>">Edit</a></td>
					<td><a href="javascript:void(0);" class="delete_education_history_item" data_education_history="<?php echo $edu_h["id"];  ?>">Del</a></td>
				</tr>	
		<?php } ?>
			</table>
		</div>
		
		<!-- END TABLE EDUCATION HISTORY -->			
					
                    <div id="every_school">
                        <div class="reg-row"> <strong>School/College name<i class="star">*</i></strong>
                            <div>
                                <input type="text" class="reg-input" name="school_name" id="education_school_field" required />
                            </div>
                        </div>
						
						<div class="reg-row"> <b>Degree title</b>
                            <div>
                                <input type="text" class="reg-input" name="degree" id="education_degree_field" required />
                            </div>
                        </div>
						
                        <div class="reg-row"> <b>Major</b>
                            <div>
                                <input type="text" class="reg-input" name="major" id="education_major_field" required />
                            </div>
                        </div>
						
                        <div class="reg-row"> <strong>Dates Attended<i class="star">*</i></strong>
                            <div class="clearfix">
                                <select name="attended_from" id="education_year_from_field" required>
                                    <option value="">Year</option>
                                    <?php foreach ($yearArray as $v) { ?>
                                        <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                    <?php } ?>
                                </select>
                                <select name="attended_from_month" id="education_month_from_field" required>
                                    <option value="">Month</option>
                                    <?php foreach ($monthArray as $v) { ?>
                                        <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <p class="p5">To</p>
                            <div class="clearfix">
                                <select name="attended_to" id="education_year_to_field" required>
                                    <option value="">Year</option>
                                    <?php foreach ($yearArray as $v) { ?>
                                        <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                    <?php } ?>
                                </select>
                                <select name="attended_to_month" id="education_month_to_field" required>
                                    <option value="">Month</option>
                                    <?php foreach ($monthArray as $v) { ?>
                                        <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
						
                        <div class="reg-row"> <b>Achievements</b>
                            <div>
                                <textarea class="reg-textarea" name="achievements" id="education_achievements_field"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="4" />
						<input type="hidden" name="hidden_education_history_id" id="hidden_education_history_id" value="0" />
						
                        <input type="button" class="reg-save" onclick="educationSubmit();"  data-index="0"/>
						<input type="button" value="Cancel" onclick="resetEducationForm();" data-index="0"/>
                    </div>

                </form>
            </div>
			
			<!-- popup delete confirmation --> 
            <div class="pop-mark"></div>
            <div class="box pop-box pop-delete-education">   
                <div class="rel">     
                    <div class="pop-close"></div>  
                    <div class="pop-nav pop-apply-nav">      
                        <p>Are you sure you want to delete this item?</p>    
                    </div>      
                    <div class="pop-bar">  
                        <input type="hidden" id="selected_education_id" />     
                        <a href="javascript:void(0);" class="pop-bar-btn pop-delete-education-yes">Yes</a>    
                        <a href="javascript:void(0);" class="pop-bar-btn pop-btn-no">No</a>     
                    </div>
                </div>
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

                    <input type="hidden" name="id" value="<?php if(count($work_history)) echo $work_history["id"]; ?>" />
                    
                    
                    <div id="history_jobs_list">
			<table class="table_edit_profile_list" id="table_edit_work_history">
				<colgroup>
					<col width="140" />
					<col width="115" />
					<col width="15" />
					<col width="115" />
					<col width="40" />
					<col width="40" />
				</colgroup>
					<tr id="work_history_table_header"
					<?php if (count($work_history) == 0) { ?> 
                                    style="display:none;"
                                    <?php } ?>
					>
					<th class="th_left_align">Company</th>
					<th>From</th>
					<th></th>
					<th>Until</th>
					<th>Edit</th>
					<th>Delete</th>
					</tr>
				<?php foreach($work_history as $work_h) { ?>
				<tr id="work_history_tablerow_<?php echo $work_h["id"]; ?>">
					<td class="th_left_align"><?php echo $work_h["company_name"]; ?></td>
					<td><?php echo date("F Y", strtotime($work_h["period_time_from"])); ?></td>
					<td> - </td>
					<td><?php
					if ($work_h["period_time_to"] != "-") { 
					    echo date("F Y", strtotime($work_h["period_time_to"])); 
					} else {
					    echo "present"; 
					}
					?></td>
					<td><a href="javascript:void(0);" class="edit_work_history_item" data_work_history="<?php echo $work_h["id"]; ?>">Edit</a></td>
					<td><a href="javascript:void(0);" class="delete_work_history_item" data_work_history="<?php echo $work_h["id"];  ?>">Del</a></td>
				</tr>	
		<?php } ?>
			</table>
		</div>

                    
                    
                    <div id="every_job_part1">

                     
                    <div class="reg-row"> <strong>Company name<i class="star">*</i></strong>
                            <div>
                                <input type="text" class="reg-input" id="history_company_field" name="company_name" required />
                            </div>
                        </div>
                        
                        <?php
                        //Load Model
                        $this->load->model('jobseeker_model');

                        
                        $userIndustry = array(array('industry'=>'none','position'=>'All Positions'));
                       

                        $data['userIndustry'] = $userIndustry;
                        $data['industry'] = $industry;
                        $this->load->view($front_theme.'/industry_multi-select', $data);
                        ?>
                        
                        <div class="reg-row"> <strong>Time period<i class="star">*</i></strong>
                            <div class="clearfix">
                                <select name="period_time_from" id="history_year_from_field" required>
                                    <option value="">Year</option>
                                    <?php foreach ($yearArray as $v) { ?>
                                        <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                    <?php } ?>
                                </select>
                                <select name="period_time_from_month" id="history_month_from_field" required>
                                    <option value="">Month</option>
                                    <?php foreach ($monthArray as $v) { ?>
                                        <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <p class="p5">To</p>
                            <div class="clearfix">
                                <select name="period_time_to" class="still_working_here" id="history_year_to_field" required>

                                    <option value="">Year</option>
                                    <?php foreach ($yearArray as $v) { ?>
                                        <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                    <?php } ?>
                                </select>
                                <select name="period_time_to_month" class="still_working_here" id="history_month_to_field" required>

                                    <option value="">Month</option>
                                    <?php foreach ($monthArray as $v) { ?>
                                        <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                            <input type="hidden" name="is_stillhere" value="0" id="is_stillhere" />
                            <?php
                            $check_sel = "";
                            $is_stillhere = 0;
                            
                            if($is_stillhere) {
                                $check_sel = "kyo-checkbox-sel";
                            }
                            ?>
                            <i data-val="1" data-id="stillwork" class="kyo-checkbox <?php echo $check_sel; ?>" id="history_checkbox_still_here" onclick="isPrivate(this,'is_stillhere');">I still work here</i>

                    <div id="every_job_part2">
                        

                    <div class="reg-row clearfix"> <strong>Description</strong>
                        <div>

                            <textarea class="reg-textarea input-tip" name="description" id="history_description_field" data-tipval="350 Characters" onkeypress="checkLength(this, 350);">350 Characters</textarea>
                        </div>
                    </div>
                    </div>

                    

                    <div class="reg-area-bar">
                        <input type="hidden" name="register_step" value="5" />
                        <input type="hidden" name="hidden_work_history_id" id="hidden_work_history_id" value="0" />
                        <input type="button" class="reg-save" onclick="workhistorySubmit();" data-index="0"/>
                        <input type="button" value="Cancel" onclick="resetWorkHistoryForm();" data-index="0"/>
                    </div>
                </form>
            </div>


	<!-- popup delete confirmation --> 
            <div class="pop-mark"></div>
            <div class="box pop-box pop-delete-work-history">   
                <div class="rel">     
                    <div class="pop-close"></div>   
                    <div class="pop-nav pop-apply-nav">      
                        <p>Are you sure you want to delete this item?</p>    
                    </div>      
                    <div class="pop-bar">  
                        <input type="hidden" id="selected_work_id" />     
                        <a href="javascript:void(0);" class="pop-bar-btn pop-delete-work-history-yes">Yes</a>    
                        <a href="javascript:void(0);" class="pop-bar-btn pop-btn-no">No</a>     
                    </div>
                </div>
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
                            <input type="text" size="24" maxlength="255" autocomplete="on" id="PersonalSkills_input" class="autocomplete_text skills-input" onkeypress="if(event.keyCode == 13){ addPersonalSkills('PersonalSkills',this,'step7'); return false;}">
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
                            <input type="text" size="24" maxlength="255" autocomplete="on" id="ProfessionalSkills_input" class="autocomplete_text skills-input" onkeypress="if(event.keyCode == 13){ addPersonalSkills('ProfessionalSkills',this,'step8'); return false;}">
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
            <p class="right reg-btns-down-page">
            <a href="javascript:void(0);" class="pbn-change-password-btn">Change Password</a>
            <a href="javascript:void(0);" class="pbn-delete-company-btn">Delete Account</a>
            <p>
        </div>
        <div class="backtop png" style="display: block; top: 564px; right:-80px"></div>
     </div>
</div>



<!-- Delete Company Account - starts here -->
<div class="pop-mark-company-delete"></div>

<!--First Pop Up window for Delete Account. -->
<div class="pop-reg-company-delete png">
    <div class="pop-reg-company-delete-wrap rel">
        <form id="signup_form" method="post" action="">
            <div class="pop-reg-company-delete-close abs" title="close"></div>
            
            <div class="pop-reg-company-delete-tit">
                Deleting your account can be done in 3 easy steps:
            </div>

            
            <div class="pop-reg-company-delete-personal">
                1. Type "DELETE" in all Caps. <br>
                <input type="text" id="delete_text" name="delete_text" class="kyo-input"/>
            </div>
            <div class="pop-reg-company-delete-agree">
               2. Check the box below to confirm that you know this is an irreversible action (there is no way to restore your account after it is deleted). <br>
               
                             
               <br> <input id="confirm_deletion" value="0" class="kyo-checkbox" style="display:none;"/>
                    <i class="kyo-checkbox" data-id="confirm_deletion" data-val="1"></i>

                
            </div>
            <div class="pop-reg-company-delete-mail">
                3. Click button below
            </div>
            
            <div class="pop-reg-company-delete-submit">
                <input type="text" id="pop-reg-company-delete-submit" class="pop-reg-company-delete-submit-btn" />
            </div>
        </form>
    </div>
    <div class="pop-reg-company-delete-footer"></div>
</div>
<!-- Delete Company Account - Ends here -->

<!-- Delete Company Account - Success window. -->
<div class="pop-message-delete-message png">
    <div class="pop-message-delete-message-wrap rel">
        <i class="pop-message-delete-message-close abs" title="close"></i>
        <b>Your account is deleted.</b>
        <div class="pop-message-delete-message-bd">
            <div class="message_title">Logout and redirecting you to Site Index....</div>
            <div class="message_content"></div>
        </div>
    </div>
</div>
<!-- Delete Company Account - Success window. Ends here -->

<!-- Edit Password - starts here -->
<div class="pop-mark-change-password"></div>

<!--First Pop Up window for Edit Password. -->
<div class="pop-reg-change-password png">
    <div class="pop-reg-change-password-wrap rel">
        <form id="change_pass_form" method="post" action="">
            <div class="pop-reg-change-password-close abs" title="close"></div>
            
            <div class="pop-reg-change-password-tit">
                Change Password:
            </div>

            
            <div class="pop-reg-change-password-agree">
                1. Old password. <br>
                <input type="password" id="old-pass" name="old-pass" class="kyo-input"/>
                <p id="wrong-old" class="red"></p>
            </div>
            <div class="pop-reg-change-password-agree">
                2. New password. <br>
                <input type="password" id="new-pass" name="new-pass" class="kyo-input"/>  
                <p id="wrong-new" class="red"></p>              
            </div>
            <div class="pop-reg-change-password-agree">
                3. Confirm new password. <br>
                <input type="password" id="conf-pass" name="conf-pass" class="kyo-input"/>
                <p id="wrong-conf" class="red"></p>
            </div>
            
            <div class="pop-reg-change-password-submit">
                <input type="text" id="pop-reg-change-password-submit" class="pop-reg-change-password-submit-btn" />
            </div>
        </form>
    </div>
    <div class="pop-reg-change-password-footer"></div>
</div>
<!-- change-password - Ends here -->

<!-- change-password - Success window. -->
<div class="pop-message-change-password-message png">
    <div class="pop-message-change-password-message-wrap rel">
        <i class="pop-message-change-password-message-close abs" title="close"></i>
        <b>Your password is changed.</b>
    </div>
</div>
<!-- change-password - Success window. Ends here -->



<script type="text/javascript" src="<?php echo $theme_path?>js/reg.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/findJobPage.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>