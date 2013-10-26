<?php $this->load->view($front_theme.'/header-block');?>

<!--search-result body-->
<div class="result-page w770 rel clearfix"> 
  <!--search-result condition-->
  <form action="<?php echo $site_url; ?>search/searchJobseeker" id="searchForm" method="post">
  <div class="result-condition rel box"> <b>Alert Search</b>
        <dl class="search-row">
            <dt class="search-row-tit">Key Words</dt>
            <dd class="search-row-nav">
                <input type="text" class="kyo-input" data-tip="Enter Keywords" name="keywords" value="Enter Keywords" onfocus="clearHint(this)" onblur="showHint(this)" />
            </dd>
        </dl>
        <dl class="search-row">
            <dt class="search-row-tit">Country</dt>
            <dd class="search-row-nav">
                <select name="country" class="filter_key">
                            <option value="">All Counties</option>
                            <?php foreach ($location as $k=>$v):?>
                            <?php if ($k == $userinfo['country']): ?>
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
                <select name="country"  class="filter_key" >
                            <option value="">All Counties</option>
                            <?php foreach ($location as $k=>$v):?>
                            <?php if ($k == $userinfo['country']): ?>
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
                    <option value="0" selected="selected">All Cities</option>
                    <option value="1">Shanghai</option>
                    <option value="2">Beijing</option>
                </select>
            </dd>
        </dl>
        
        <dl class="search-row ">
            <dt class="search-row-tit">Type of employment</dt>
            <dd class="search-row-nav">
                <select name="employment_type" class="after-select">
                    <option value="1">Contract</option>
                    <option value="2">Part Time</option>
                    <option value="3">Full Time</option>
                    <option value="4">Internship</option>
                    <option value="5">Any</option>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Industry</dt>
            <dd class="search-row-nav reg-row">
                <select name="industry" class="industry_options">
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
            <dd class="search-row-nav">
                <input type="text" id="sel-position" name="position">
                <div class="search-row-tip" style="display: none;">Hold down 'Command' to select a max of 10</div>
                <div id="sel-position-val" class="show-selval"></div>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Length of employment</dt>
            <dd class="search-row-nav">
                <select name="employment_length" class="after-select">
                    <option value="1">Long term employment (1+ years)</option>
                    <option value="2">Short term employment (-1 years)</option>
                    <option value="3">No preference</option>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Salary</dt>
            <dd class="search-row-nav">
                <select name="salary" class="after-select">
                    <option value="0" selected="selected">Any Salary</option>
                    <option value="1">1500-2500</option>
                    <option value="2">2500-3500</option>
                    <option value="3">3500-5500</option>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Year of experience</dt>
            <dd class="search-row-nav">
                <select name="experience_year" class="after-select">
                    <option value="1" selected="selected">Less than 1 year</option>
                    <option value="2">2 years</option>
                    <option value="3">3 years</option>
                    <option value="4">4 years and more</option>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Language</dt>
            <dd class="search-row-nav">
                <select name="language" class="after-select">
                    <option value="0" selected="selected">All Languages</option>
                    <option value="1">English</option>
                    <option value="2">Chinese</option>
                    <option value="3">Japanese</option>
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
                <input type="hidden" id="ProfessionalSkills_str" name="PersonalSkills_str" />
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
    <div class="result-az-from fl"> <b>View jobseekers from</b>
      <select class="kyo-select">
        <option value="0">--Select--</option>
        <option value="60">Last 2 months</option>
        <option value="30">Last month</option>
        <option value="14">Last 2 weeks</option>
        <option value="7">Last week</option>
      </select>
    </div>
    <div class="result-az-jobs fl"> <b>Sort jobseekers by</b>
      <select class="kyo-select">
        <option value="a" selected="selected">Salary High - Low</option>
        <option value="b">Salary Low -High</option>
      </select>
    </div>
  </div>
  
  <!--search-result body-->
  <div class="result-bd">
    <?php foreach ($jobseekers as $user): 
    ?>
    <div class="box rel sresult-row">
      <div class="sresult-par1">
        <div class="span1 rel"> <img src="<?php echo $theme_path?>style/search/job-img1.gif" alt="" width="85" height="81"/> <i class="job-mark job-mark1 png abs"></i> </div>
        <div class="span2">
          <h2><?php echo $user['first_name']; ?></h2>
          <h3>
            Accounting
          </h3>
          <p><?php echo $user['city'].' '.$user['province'].' '.$user['country']; ?></p>
          <a href="#" class="job-viewmore">View More</a> </div>
        <div class="span3">
          <div class="zoom">
              <a href="#" class="job-btn jobseeker-btn-shortlisted"></a>
              <a href="#" class="job-btn job-btn-match">95%</a>
          </div>
          <div><a href="#" class="jobseeker_request_interview"></a></div>
        </div>
      </div>
      <div class="sresult-par2">
        <div class="sresult-tab-hd">
            <span class="fxui-tab-tit">About me</span>
            <span class="fxui-tab-tit">Portfolio</span>
            <span class="fxui-tab-tit">JingChat</span>
        </div>
        <div class="sresult-tab-bd zoom">
          <div class="fxui-tab-nav sresult-nav-job sresult_about_me">
            <div class="sresult-nav-job-left">
              <div class="text">
                <p>We have an exciting opportunity for a full time Graphic Designer to join our creative team.
                  We are a leading creative, events and media agency with offices in Beijing, London and Qingdao.</p>
               </div>
              <dl class="sresult-nav-job-dl">
                <dt>Industry</dt>
                <dd>
                    <a href="#">Graphic Design</a>
                    <a href="#">Media</a>
                    <a href="#">Publishing</a>
                    <a href="#">Marketing</a>
                </dd>
                <dt>Current Employement</dt>
                <dd>
                    <p class="employment_title">Clinical Nurse Speciallist for NHS London</p>
                    <p class="emploeyment_period">June 2011 - Present(2 years 3 months)</p>
                    <p class="employment_description">We have an exciting opportunity for a full time Graphic Designer to join our creative team.
                        We are a leading creative, events and media agency with offices in Beijing, London and Qingdao.</p>
                </dd>
                <dt>Previous Employment</dt>
                <dd>
                    <p class="employment_title">Clinical Nurse Speciallist for NHS London</p>
                    <p class="emploeyment_period">June 2011 - Present(2 years 3 months)</p>
                    <p class="employment_description">We have an exciting opportunity for a full time Graphic Designer to join our creative team.
                        We are a leading creative, events and media agency with offices in Beijing, London and Qingdao.</p>
                </dd>
                  <dt>Personal Skills</dt>
                  <dd>Time Management, Public Speaking, Networking, Leadership<dd>
                  <dt>Technical Skills</dt>
                  <dd>Branding, Adobe Creative Suite, Printing, Critical Thinking</dd>
                  <dt>Language(s)</dt>
                <dd> <span class="required"> <b>English</b> <i>Fluent</i> </span> <span class="required"> <b>French</b> <i>Fluent</i> </span> <span class="required"> <b>German</b> <i>Fluent</i> </span> </dd>
              </dl>
            </div>
            <div class="sresult-nav-job-right">
              <dl class="sresult-nav-job-dl">
                <dt>Birthday</dt>
                <dd>
                  <p class="jobseeker_birthday">May 15 1984</p>
                </dd>
                <dt>Education</dt>
                <dd>
                    <p class="school_name">The Robert Gordon University</p>
                    <p class="school_period">1997 - 2000</p>

                    <p class="school_name">Napier University</p>
                    <p class="school_major">Bsc, Nursing</p>
                    <p class="school_period">2005 - 2007</p>

                    <p class="school_name">The University of Edinburgh</p>
                    <p class="school_major">Stand alone post-grad module, Family Planing</p>
                    <p class="school_period">2009 - 2009</p>
                </dd>
                  <dt>Elsewhere on Web</dt>
                  <dd>
                      <p><a href="#">Twitter</a></p>
                      <p><a href="#">Facebook</a></p>
                      <p><a href="#">Pinterest</a></p>
                      <p><a href="#">Personal Website</a></p>
                  </dd>

                <dt>Phone</dt>
                <dd><p class="phone_number">(+44)0794 564 3328</p></dd>
                <dd class="industry">
                  <ul class="industry-ul">
                    <li class="n1"><b>Type of Employment</b><span>Full Time</span></li>
                    <li class="n2"><b>Length of Employment</b><span>Long Term (1+ year)</span></li>
                    <li class="n3"><b>Visa Assistance</b><span>Visa will be provided</span></li>
                    <li class="n4"><b>Housing Assistance</b><span>Accomodation will be provided</span></li>
                  </ul>
                </dd>
              </dl>
            </div>
          </div>
          <div class="fxui-tab-nav sresult-portfolio">
            <div class="portfolio_row"></div>
          </div>
            <div class="fxui-tab-nav sresult-jingchat">
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

<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>