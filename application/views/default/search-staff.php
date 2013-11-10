<?php $this->load->view($front_theme.'/header-block');?>
<link href="<?php echo $theme_path?>style/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    input.text { width: 215px;}
</style>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.autocomplete.js"></script>

<!--search-result body-->
<div class="result-page w770 rel clearfix"> 
  <!--search-result condition-->
  <form action="<?php echo $site_url; ?>search/staff" method="post">
  <input type="hidden" name="top_search" value="0" />
  <div class="result-condition rel box"> <b>Alert Search</b>
    <dl class="search-row">
      <dt class="search-row-tit">Key Words</dt>
      <dd class="search-row-nav">
        <input type="text" name="keywords" class="kyo-input" data-tip="Enter Keywords" value="Enter Keywords" onfocus="clearHint(this)" onblur="showHint(this)" />
      </dd>
    </dl>
      <dl class="search-row">
          <dt class="search-row-tit">Country</dt>
          <dd class="search-row-nav">
              <select name="country" class="filter_key">
                  <option value="">All Counties</option>
                  <?php foreach ($location as $k=>$v):?>
                  <?php if ($k == $_POST['country']): ?>
                      <option value="<?php echo $k ?>" selected><?php echo $k ?></option>
                      <?php else: ?>
                      <option value="<?php echo $k ?>"><?php echo $k ?></option>
                      <?php endif; ?>
                  <?php endforeach;?>
              </select>
          </dd>
      </dl>
      <dl class="search-row">
          <dt class="search-row-tit">Province</dt>
          <dd class="search-row-nav">
              <select name="province" class="filter_key">
                  <option value="">All Province</option>
                  <?php foreach ($location['China'] as $k=>$v):?>
                  <?php if ($k == $_POST['province']): ?>
                      <option value="<?php echo $k ?>" selected><?php echo $k ?></option>
                      <?php else: ?>
                      <option value="<?php echo $k ?>"><?php echo $k ?></option>
                      <?php endif; ?>
                  <?php endforeach;?>
              </select>
          </dd>
      </dl>
      <dl class="search-row">
          <dt class="search-row-tit">City</dt>
          <dd class="search-row-nav">
              <select name="city" class="filter_key">
                  <?php if (empty($_POST['city'])): ?>
                  <option value="">All City</option>
                  <option value="Beijing">Beijing</option>
                  <?php else: ?>
                  <option value="<?php echo $_POST['city']; ?>"><?php echo $_POST['city']; ?></option>
                  <option value="">All City</option>
                  <?php endif; ?>
              </select>
          </dd>
      </dl>
      <dl class="search-row ">
          <dt class="search-row-tit">Type of employment</dt>
          <dd class="search-row-nav">
              <select id="employment_type" class="filter_key">
                  <option value="">All Type</option>
                  <?php $jobtype = jobtype();
                  foreach ($jobtype as $k => $v) {?>
                      <option value="<?php echo $v?>"><?php echo $v?></option>
                      <?php }?>
              </select>
              <input type="hidden" name="employment_type" id="jobtype_tag"/>
              <ul id="jobtype_box" data-name="nameOfSelect"></ul>
          </dd>
      </dl>
      <dl class="search-row ">
          <dt class="search-row-tit">Length of employment</dt>
          <dd class="search-row-nav">
              <select name="employment_length" class="filter_key">
                  <option value="">All Length</option>
                  <?php $empl = getEmploymentLength();
                  foreach($empl as $k => $v) { ?>
                      <option value="<?php echo $k+1; ?>"><?php echo $v; ?></option>
                      <?php } ?>
              </select>
          </dd>
      </dl>
      <div id="industry_list">
          <dl class="search-row">
              <dt class="search-row-tit">Industry</dt>
              <dd class="search-row-nav reg-row">
                  <select name="industry[]" class="industry_options" onchange="changeIndustry(this);">
                      <option value="">All Industries</option>
                      <?php foreach($industry as $key=>&$v) {
                      if(empty($v['name'])) continue;
                      ?>
                      <option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                      <?php } ?>
                  </select>
                  <div class="search-row-tip" style="display:none;">Hold down 'Command' to select a max of 3</div>

              </dd>
          </dl>
          <dl class="search-row ">
              <dt class="search-row-tit">Position</dt>
              <dd class="search-row-nav reg-row">
                  <select name="position[]" id="position" class="industry_options">
                      <option value="">All Positions</option>
                      <?php
                      foreach($position as $key=>&$v) {
                          ?>
                          <option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                          <?php } ?>
                  </select>
                  <div class="search-row-tip" style="display: none;">Hold down 'Command' to select a max of 10</div>
                  <div id="sel-position-val" class="show-selval"></div>
              </dd>
          </dl>
      </div>
      <dl class="search-row ">
          <p><a class="reg-row-tip" href="javascript:void(0);" onclick="addIndustryBtnClick(this);">+ Add another Industry</a></p>
      </dl>

      <dl class="search-row ">
          <dt class="search-row-tit">Language</dt>
          <dd class="search-row-nav">
              <select name="language" class="filter_key">
                  <option value="0" selected="selected">All Languages</option>
                  <?php $language = language_arr();
                  foreach($language as $v) {
                      ?>
                      <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                      <?php } ?>
              </select>
              <div class="search-row-tip" style="display: none;">Hold down 'Command' to select multiple</div>
              <div id="sel-language-val" class="show-selval"></div>
          </dd>
      </dl>
      <dl class="search-row ">
          <dt class="search-row-tit">Personal Skills</dt>
          <dd class="search-row-nav">
              <input type="hidden" id="PersonalSkills_str" name="PersonalSkills_str" />
              <input type="text" size="24" maxlength="255" autocomplete="on" id="PersonalSkills_input" class="text skills-input" onkeypress="if(event.keyCode == 13){ addSkills('PersonalSkills',this); return false;}">
              <div class="search-row-tip" style="display: none;">Hold down 'Command' to select multiple</div>
          </dd>
          <div class="skills-vals clearfix">
              <ul id="PersonalSkills"></ul>
          </div>
      </dl>
      <dl class="search-row ">
          <dt class="search-row-tit">Professional Skills</dt>
          <dd class="search-row-nav">
              <input type="hidden" id="ProfessionalSkills_str" name="ProfessionalSkills_str" />
              <input type="text" size="24" maxlength="255" autocomplete="on" id="ProfessionalSkills_input" class="text skills-input" onkeypress="if(event.keyCode == 13){ addSkills('ProfessionalSkills',this); return false;}">
              <div class="search-row-tip" style="display: none;">Hold down 'Command' to select multiple</div>
          </dd>
          <div class="skills-vals clearfix">
              <ul id="ProfessionalSkills"></ul>
          </div>
      </dl>
    <div class="result-condition-btnwrap">
      <input type="submit" class="condition-btn" value=""/>
    </div>
  </div>
  </form>
  
  <!--search-result sequence-->
  <div class="result-az">
      <form action="<?php echo $site_url; ?>search/filterStaff" method="post" id="search_form">
          <input type="hidden" name="staffIdStr" value="<?php echo $staff_id_str; ?>">
          <div class="result-az-from fl reg-row"> <b>View jobseekers from</b>
              <select id="post_date" onchange="searchJob()" style="width: 150px;" name="post_date">
                  <option value="0">--Select--</option>
                  <option value="60" <?php if($selected_date == 60) echo "selected"; ?>>Last 2 months</option>
                  <option value="30" <?php if($selected_date == 30) echo "selected"; ?>>Last month</option>
                  <option value="14" <?php if($selected_date == 14) echo "selected"; ?>>Last 2 weeks</option>
                  <option value="7" <?php if($selected_date == 7) echo "selected"; ?>>Last week</option>
              </select>
          </div>
          <div class="result-az-jobs fl reg-row"> <b>Sort jobseekers by</b>
              <select id="salary_sort" name="salary_sort" style="width: 150px;" onchange="searchJob()">
                  <option value="0">--Select--</option>
                  <option value="desc" <?php if($salary_sort == "desc") echo "selected"; ?>>Salary High - Low</option>
                  <option value="asc" <?php if($salary_sort == "asc") echo "selected"; ?>>Salary Low -High</option>
              </select>
          </div>
      </form>
  </div>
  
  <!--search-result body-->
  <div class="result-bd">
  <?php
      foreach($staff_arr as $staff): ?>
    <div class="box rel sresult-row">
      <div class="sresult-par1">
        <div class="span1 rel"> <img src="<?php echo $theme_path?>style/search/job-img1.gif" alt="" width="85" height="81"/> <i class="job-mark job-mark1 png abs"></i> </div>
        <div class="span2">
          <h2><?php echo $staff['username']; ?></h2>
          <h3>
              <?php
              for($i=0; $i<count($staff['industry_arr']); $i++) {
                  echo '<a href="#">'.$staff['industry_arr'][$i]['industry']."</a> ";
              }
              ?>
          </h3>
          <p><?php if(!empty($staff['city'])) echo $staff['city']. ", "; ?>
              <?php if(!empty($staff['province'])) echo $staff['province'],', '; ?>
              <?php if(!empty($staff['country'])) echo $staff['country']; ?></p>
          <a href="#" class="job-viewmore">View More</a> </div>
        <div class="span3">
          <div class="zoom"> <a href="#" class="job-btn job-btn-mark" style="display:none"></a> <a href="#" class="job-btn job-btn-marked"></a> <a href="#" class="job-btn job-btn-featured"  style="display:none"></a> <a href="#" class="job-btn job-btn-match">99%</a> </div>
          <div><a href="#" class="job-btn-submit"></a></div>
        </div>
      </div>
      <div class="sresult-par2">
        <div class="sresult-tab-hd"> <span class="fxui-tab-tit">About me</span>
            <span class="fxui-tab-tit">Portfolio</span>
            <span class="fxui-tab-tit">JingChat</span></div>
        <div class="sresult-tab-bd zoom">
          <div class="fxui-tab-nav sresult-nav-job">
            <div class="sresult-nav-job-left sresult_about_me">
              <div class="text_r">
                  <p><?php echo $staff['description']; ?></p>
              </div>
              <dl class="sresult-nav-job-dl">
                <dt>Industry</dt>
                <dd><?php
                    $industry_arr = $staff['industry_arr'];
                    for($i=0; $i<count($industry_arr); $i++) {
                        echo '<a href="#">'.$industry_arr[$i]['industry']."</a> ";
                    }
                    ?>
                </dd>

                <?php foreach($staff['work_history'] as $v) {
                  if($v['period_time_to'] == date('Y') || $v['is_stillhere'] == 1) {
                ?>
                      <dt>Current Employment</dt>
                  <?php } else { ?>
                      <dt>Previous Employment</dt>
                  <?php } ?>

                    <dd><p class="employment_title"><?php echo $v['introduce']; ?></p>
                    <p class="emploeyment_period">
                        <?php echo $v['period_time_from'] . ' - ' . $v['period_time_to']; ?>
                    </p>
                    <p class="employment_description"><?php echo $v['description']; ?></p></dd>
                  <?php } ?>

                <dt>Personal Skills</dt>
                <dd>
                    <?php
                    $arr = $staff['personal_skills'];
                    for($i=0; $i<count($arr); $i++) {
                        if($i==0) {
                            echo $arr[$i]['personal_skill'];
                        } else {
                            echo ", " . $arr[$i]['personal_skill'];
                        }
                    }
                    ?>
                </dd>

                <dt>Technical Skills</dt>
                <dd><?php
                    $arr = $staff['professional_skills'];
                    for($i=0; $i<count($arr); $i++) {
                        if($i==0) {
                            echo $arr[$i]['professional_skill'];
                        } else {
                            echo ", " . $arr[$i]['professional_skill'];
                        }
                    }
                    ?></dd>

                <dt>Language(s)</dt>
                <dd>
                    <?php $languages = $staff['languages'];
                    for($i=0; $i<count($languages); $i++) { ?>
                        <span class="required">
                            <b><?php echo $languages[$i]["language"]; ?></b>
                            <i><?php echo $languages[$i]["level"]; ?></i>
                        </span>
                    <?php }?>
                </dd>
              </dl>
            </div>
            <div class="sresult-nav-job-right">
              <dl class="sresult-nav-job-dl sresult_about_me">
                <dt>Birthday</dt>
                <dd>
                    <p class="jobseeker_birthday"><?php echo date('M j Y',strtotime($staff['birthday'])); ?></p>
                </dd>
                <dt>Education</dt>
                  <dd>
                <?php $educations = $staff['educations'];
                for($i=0; $i<count($educations); $i++) { ?>
                    <p class="school_name"><?php echo $educations[$i]['school_name']; ?></p>
                    <p class="school_major"><?php echo $educations[$i]['major']; ?></p>
                    <p class="school_period"><?php echo $educations[$i]['attend_date_from'] . ' - ' . $educations[$i]['attend_date_to']; ?></p>
                <?php }?>
                  </dd>

                <dt>Elsewhere on the Web</dt>
                  <dd>
                  <?php if (!empty($staff['twitter'])):?>
                  <p><a href="<?php echo $staff['twitter']?>">Twitter</a></p>
                  <?php endif;?>
                  <?php if (!empty($staff['facebook'])):?>
                  <p><a href="<?php echo $staff['facebook']?>">Facebook</a></p>
                  <?php endif;?>
                  <?php if (!empty($staff['linkedin'])):?>
                  <p><a href="<?php echo $staff['linkedin']?>">Linkedin</a></p>
                  <?php endif;?>
                  <?php if (!empty($staff['weibo'])):?>
                  <p><a href="<?php echo $staff['weibo']?>">Weibo</a></p>
                  <?php endif;?>
                  </dd>
                <dt>Phone</dt>
                <dd><p class="phone_number"><?php echo $staff['phone']; ?></p></dd>
                  <dd>
                      <ul class="industry-ul">
                          <li class="n1"><b>Type of Employment</b><span><?php if($staff['employment_type']) {if(is_numeric($staff['employment_type'])) echo getJobtypeByID($staff['employment_type']); else echo $staff['employment_type']; }?></span></li>
                          <li class="n2"><b>Length of Employment</b><span><?php if($staff['employment_length']) echo getEmploymentLengthByID($staff['employment_length']);?></span></li>
                          <li class="n3"><b>Visa Assistance</b><span><?php echo getVisaAssistanceByID($staff["is_visa_assistance"]); ?></span></li>
                          <li class="n4"><b>Housing Assistance</b><span>
                               <?php echo getHousingAssistanceByID($staff["is_accomodation_assistance"]); ?></span>
                          </li>
                      </ul>
                  </dd>
              </dl>
            </div>
          </div>
          <div class="fxui-tab-nav sresult-about">
            <div>Founded in 2003, REDSTAR Media is a fully integrated creative agency with offices in Beijing, Qingdao and London specialising in graphic design, publishing and events management. Creativity is the heart and soul of our organisation, with over 50% of the team involved in the creative process. We believe that new ideas and their thoughtful implementation moves the world forward. The REDSTAR team offers a wealth of client experience and creative direction via a culture of personable, involved services and out-of-the-box thinking.</div>
            <p><a href="#">View Company Profile</a></p>
          </div>
        </div>
      </div>
    </div>
        <?php endforeach; ?>

  </div>
  
  <!--backtop-->
  <div class="backtop png"></div>
</div>

<!--popmark-->
<div class="pop-mark"></div>

<!--pop box-->
<div class="box pop-box pop-apply">
	<div class="rel">
        <div class="pop-close pop-apply-close"></div>
        <div class="pop-nav pop-apply-nav">
        	<p>Are you sure you want to apply for this job?</p>      
        </div>
         <div class="pop-bar">
            	<a href="#yes" class="pop-bar-btn pop-btn-yes">Yes</a> <a href="#no" class="pop-bar-btn pop-btn-no">No</a>
            </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $theme_path?>js/reg.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/searchJobPage.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>