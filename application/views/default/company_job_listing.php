<?php $this->load->view($front_theme.'/header-block');?>
<link href="<?php echo $theme_path?>style/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.autocomplete.js"></script>

<!--company login page body-->
<div class="company-page w770 clearfix rel">
  <div class="company-body box rel mb5">
    <div class="company-hd jobseeker-hd rel">
        <?php if (!empty($userinfo['profile_pic'])): 
        $pic = $site_url.'attached/users/'.$userinfo['profile_pic'];
        ?>
        <div class="people_icon company_icon">
          <img src="<?php echo $pic; ?>" alt="" width="128px" height="128px" class="jobseeker_icon"/>
        </div>

        <?php else: ?>
        <i class="abs face png"></i>
        <?php endif; ?>
      <div class="text_wrapper">
        <h2><?php echo $userinfo['first_name'].' '.$userinfo['last_name']; ?></h2>
        <h4><?php echo $userinfo['city'].', '.$userinfo['country']; ?></h4>
        <p class="profile_views_num">4 Profile Views</p>
      </div>
      <div class="btnarea">
          <a href="<?php echo $site_url?>company/register" class="png square_btn edit_profile_btn"></a>
          <!-- JINGCHAT BEGIN -->
          <?php if ($chat_unread != 0) : ?>
          <a href="<?php echo $site_url.'inbox'; ?>" class="png square_btn jingchat_inbox_btn jingchat_inbox_btn_current"></a>
          <span class="bubble jingchat_inbox_bubble"><?php echo $chat_unread; ?></span>
          <?php else: ?>
          <a href="<?php echo $site_url.'inbox'; ?>" class="png square_btn jingchat_inbox_btn"></a>
          <?php endif; ?>
          <!-- JINGCHAT END -->
          <a href="<?php echo $site_url; ?>company/shortlistCandidates" class="png square_btn view_my_candidates_btn"></a>
          <!-- INTERVIEW START -->
          <?php if ($interview_num != 0) : ?>
          <a href="<?php echo $site_url; ?>jobseeker/viewInterviews" class="png square_btn view_my_interviews_btn"></a>
          <span class="bubble view_my_interviews_bubble">
              <?php echo $interview_num; ?>
          </span>
          <?php else: ?>
          <a href="<?php echo $site_url; ?>jobseeker/viewInterviews" class="png square_btn view_my_interviews_btn"></a>
          <?php endif; ?>
          <!-- INTERVIEW END -->
      </div>
    </div>

  </div>
</div>

<div class="result-page w770 clearfix view_applied_jobs_page" style="margin-top:20px;">
<!--search-result condition-->
<div class="result-condition rel box">
    <ul class="job-listing-ul">
        <a href="<?php echo $site_url; ?>company/joblisting">
            <li <?php if($selected_tab == 1) echo 'class="curr"'; ?>>Manage Job Listings</li>
        </a>
        <a href="<?php echo $site_url; ?>job/postjob">
            <li>Post a Job</li>
        </a>
    </ul>
    <div class="search_joblisting">
        <label <?php if($selected_tab == 3) echo 'class="curr"'; ?>>Search Job Listings</label>
        <form action="<?php echo $site_url; ?>company/joblisting" method="post">
            <input type="text" name="search_keywords" class="kyo-input input-tip" style="width:203px;border:none;line-height:23px;height:23px;" data-tipval="Enter Keywords" value="Enter Keywords">
            <input type="submit" name="search_saved_candidates_btn" class="search_interview_btn search_saved_candidates_btn" value=""/>
        </form>
    </div>
</div>

<!--search-result body-->
<div class="result-bd">
	<?php foreach ($jobs as $job):?>
        <form id="updateForm<?php echo $job['id']; ?>">
        <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>" />
    <div class="box rel sresult-row" id="jobdiv<?php echo $job['id']; ?>">
        <div class="sresult-par1">
            <div class="span1 rel">
                <img src="<?php echo $site_url;?>attached/users/<?php echo $job['profile_pic']?$job['profile_pic']:'no-image.png';?>" alt="" width="80px" height="80px" class="round_corner10_img"/>
            </div>
            <div class="span2">
                <h2><?php echo $job['job_name']; ?></h2>
                <h3><?php echo $job['username']; ?></h3>
                <p><?php echo $job['city']; ?>, <?php echo $job['country']; ?></p>
                <a href="#" class="job-edit">Edit</a> 
                | <a href="<?php echo $site_url;?>search/searchJobseeker/jobid/<?php echo $job['id'];?>" class="company-btn-find-staff">Find Staff</a>
            </div>
            <div class="span3 text_align_right">
                <div class="zoom">
                    <a href="#" data-job-id="<?php echo $job['id']; ?>" class="company-btn-delete-job"></a>
                </div>
            </div>
        </div>
        <div class="managejob-content sresult-par2">
            <div class="postjob-content-left-row clearfix">
                <div class="span1 job-listing">
                    <strong>Position Title *</strong>
                    <div><input type="text" name="job_name" value="<?php echo $job['job_name']; ?>" required></div>
                </div>
                <div class="span2">
                    <strong>Length of Job *</strong>
                    <div>
                        <select name="employment_length" required>
                            <option value="">All Length</option>
                            <?php $empl = getEmploymentLength();
                            foreach($empl as $k => $v) { ?>
                                <option value="<?php echo $k+1; ?>" <?php if($k+1 == $job['employment_length']) echo "selected" ?>><?php echo $v; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="postjob-content-left-row clearfix">
                <div class="span1 job-listing">
                    <strong>Location *</strong>
                    <div>
                        <input type="text" name="location" class="input-tip" value="<?php echo $job['location']?$job['location']:'Street Address'; ?>" data-tipval="Street Address" required>
                    </div>
                </div>
                <div class="span2">
                    <strong>&nbsp;</strong>
                    <div>
                        <select name="country" class="location-input" required>
                            <option value="">All Countries</option>
                            <?php foreach ($location as $k=>$v):?>
                                <option value="<?php echo $k ?>" <?php if($k == $job['country']) echo "selected"; ?>>
                                    <?php echo $k ?></option>
                            <?php endforeach;?>
                        </select>
                        <select name="province" class="location-input">
                            <option value="">All Province</option>
                            <?php foreach ($location['China'] as $k=>$v):?>
                                <option value="<?php echo $k ?>" <?php if($k == $job['province']) echo "selected"; ?>>
                                    <?php echo $k ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div>
                        <select class="location-input" name="city" >
                            <?php if($job['city']): ?>
                                <option value="<?php echo $job['city']; ?>"><?php echo $job['city']; ?></option>
                            <?php else: ?>
                                <option value="">City</option>
                            <?php endif; ?>
                        </select>
                        <input type="text" name="" class="location-input input-tip" value="Postal Code" data-tipval="Postal Code">
                    </div>
                </div>
            </div>

            <div class="postjob-content-left-row clearfix" id="language_item">
                <?php
                    $language_arr = $job['languages'];
                    if(count($language_arr) == 0) {
                        $language_arr = array('language'=>'0','level'=>'0');
                    }
                    foreach($language_arr as $lang): ?>
                <div class="span1 job-listing">
                    <strong>Language *</strong>
                    <div>
                        <input type="hidden" name="jobLangId[]" value="<?php echo $lang['id']; ?>" />
                        <select name="language[]" required>
                            <option value="">All Languages</option>
                            <?php $language = language_arr();
                            foreach($language as $k => $v) { ?>
                                <option value="<?php echo $k+1; ?>" <?php if($k+1 == $lang['language']) echo "selected"; ?>>
                                    <?php echo $v; ?></option>
                                <?php } ?>
                        </select>

                    </div>
                </div>
                <div class="span2">
                    <strong>Language Level</strong>
                    <div>
                        <select name="language_level[]" required>
                            <option value="">All Level</option>
                            <?php
                            $level = language_level();
                            foreach($level as $k => $v) {
                                ?>
                                <option value="<?php echo $k+1; ?>" <?php if($k+1 == $lang['level']) echo "selected"; ?>>
                                    <?php echo $v; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="postjob-content-left-row clearfix">
                <div class="span1">
                    <strong>Salary *</strong>
                    <div>
                        <select name="salary_range" required>
                            <?php $salary = getSalary();
                            foreach($salary as $k => $v) { ?>
                                <option value="<?php echo $k+1; ?>" <?php if($k+1 == $job['salary_range']) echo "selected"; ?>>
                                    <?php echo $v; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            

            <div class="postjob-content-left-row clearfix">
                <div class="span1 job-listing">
                    <strong>Type of Job *</strong>
                    <div>
                        <select id="employment_type" required>
                            <?php $jobtype = jobtype();
                            foreach ($jobtype as $k => $v) {?>
                                <option value="<?php echo $v?>" <?php if($v == $job['employment_type']) echo "selected"; ?>>
                                    <?php echo $v?></option>
                                <?php }?>
                        </select>
                        <input type="hidden" name="employment_type" id="jobtype_tag"/>
                        <ul id="jobtype_box" data-name="nameOfSelect"></ul>
                    </div>
                </div>
                <div class="span2">
                    <strong>Years of Experience</strong>
                    <div>
                        <select name="preferred_year_of_experience">
                            <?php $expe = getExperience();
                            foreach($expe as $k => $v) { ?>
                                <option value="<?php echo $k+1; ?>" <?php if($k+1 == $job['preferred_year_of_experience']) echo "selected"; ?>>
                                    <?php echo $v; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            

            <div class="postjob-content-left-row clearfix">
                <div class="span1 job-listing">
                    <strong>Visa Assistance *</strong>
                    <div>
                        <select id="is_visa_assistance" name="is_visa_assistance">
                         <option value="1" <?php if($job['is_visa_assistance'] == 1) echo "selected"; ?>>Yes</option>
                         <option value="2" <?php if($job['is_visa_assistance'] == 2 OR $job['is_visa_assistance'] == '') echo "selected"; ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="span2">
                    <strong>Accommodation Assistance *</strong>
                    <div>
                        <select name="is_housing_assistance">
                         <option value="1" <?php if($job['is_housing_assistance'] == 1) echo "selected"; ?>>Yes</option>
                         <option value="2" <?php if($job['is_housing_assistance'] == 2 OR $job['is_housing_assistance'] == '') echo "selected"; ?>>No</option>
                        </select>
                    </div>
                </div>
            </div>            

            <div class="postjob-content-left-row clearfix">
                <div class="span1 job-listing">
                    <strong>Technical Skills</strong>
                    <div class="reg-row">
                        <div>
                            <input type="hidden" name="preferred_technical_skills" id="ProfessionalSkills_str"  class="input-tip" value="<?php echo $job['preferred_technical_skills']; ?>" data-tipval="">
                            <input type="text" size="24" maxlength="255" autocomplete="on" id="ProfessionalSkills_input" class="skills-input input-tip" data-tipval="Start Typing" value="Start Typing" onkeypress="if(event.keyCode == 13){ addPersonalSkills('ProfessionalSkills',this,'step8'); return false;}" required>
                        </div>
                    </div>
                    <div class="skills-vals clearfix">
                        <ul id="ProfessionalSkills">
                            <?php
                                $skills_arr = array();
                                if (isset($job['preferred_technical_skills']) > 0) {
                                    $skills_arr = explode(',', $job['preferred_technical_skills']);
                            ?>
                            <?php foreach($skills_arr as $v) {
                                        if($v) {
                            ?>
                                <li data-val="2"><?php echo $v; ?>
                                    <i class="del" onclick="delPersonalSkills('ProfessionalSkills',this,'<?php echo $v; ?>');"></i>
                                </li>
                                <?php } } ?>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
                <div class="span2">
                    <strong>Personal Skills</strong>
                    <div class="reg-row">
                        <div>
                            <input type="hidden" name="preferred_personal_skills" id="PersonalSkills_str"  class="input-tip" value="<?php echo $job['preferred_personal_skills']; ?>" data-tipval="">
                            <input type="text" size="24" maxlength="255" autocomplete="on" id="PersonalSkills_input" class="skills-input input-tip" data-tipval="Start Typing" value="Start Typing" onkeypress="if(event.keyCode == 13){ addPersonalSkills('PersonalSkills',this,'step8'); return false;}" required>
                        </div>
                    </div>
                    <div class="skills-vals clearfix">
                        <ul id="PersonalSkills">
                            <?php
                                $skills_arr = array();
                                if (isset($job['preferred_personal_skills']) > 0) {
                                    $skills_arr = explode(',', $job['preferred_personal_skills']);
                                    ?>
                            <?php foreach($skills_arr as $v) {
                                   if($v) {
                             ?>
                                <li data-val="2"><?php echo $v; ?>
                                    <i class="del" onclick="delPersonalSkills('PersonalSkills',this,'<?php echo $v; ?>');"></i>
                                </li>
                                <?php }} ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="postjob-additional-information">
                <strong>Position Description or Addtional Information *</strong>
                <script type="text/javascript" src="<?php echo $theme_path?>js/jslib/xheditor/xheditor-1.1.14-en.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#job'+ '<?php echo $job['id']; ?>'+'_desc').xheditor({
                            tools:'Bold,Italic,Underline,|,Align,List,|,Link,Img,Table,|,Source,Fullscreen',
                            skin:'nostyle',
                            hoverExecDelay:-1,
                            forcePtag:false,
                            width: '475px',
                            submitID:'post'});
                    });
                </script>
                <div><textarea name="job_desc" id="job<?php echo $job['id']; ?>_desc" rows="21" cols=""><?php echo $job['job_desc']; ?></textarea></div>
            </div>

            <div class="adv-search-bar">
                <a href="javascript:void(0);" class="btn update-job-listing" onclick="updateJobListing(this)" alt="<?php echo $job['id']; ?>"></a>
            </div>

            <div class="clearfix"></div>
         </div>
      </div>
    </form>
	<?php endforeach;?>
</div>
<!--backtop-->
<div class="backtop png" style="right:200px;"></div>
</div>

<!--popmark-->
<div class="pop-mark"></div>

<!-- Delete bookmark job popup -->
<div class="box pop-box pop-company-delete-job">
    <div class="rel">
        <div class="pop-close pop-apply-close"></div>
        <div class="pop-nav pop-apply-nav">
            <p>Are you sure you want to delete this job?</p>
        </div>
        <div class="pop-bar">
            <input type="hidden" id="selected_job_id" />
            <a href="javascript:void(0);" class="pop-bar-btn pop-company-delete-job-yes">Yes</a>
            <a href="javascript:void(0);" class="pop-bar-btn pop-btn-no">No</a>
        </div>
    </div>
</div>
<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>

<script type="text/javascript">
    $(document).ready(function() {
        $("select[name='country']").change(function() {
            change_location($(this),'country');
        });
        $("select[name='province']").change(function() {
            change_location($(this), 'province');
        });
    });
</script>

<script type="text/javascript" src="<?php echo $theme_path?>js/jobseeker.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/reg.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>