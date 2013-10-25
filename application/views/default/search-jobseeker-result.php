<?php $this->load->view($front_theme.'/header-block');?>

<!--top search area-->
<div class="top-search w70 rel">
  <input type="text" class="abs top-search-input input-tip" value="Search our job database" data-tipval="Search our job database"/>
  <input type="submit" class="abs top-search-btn " value=""  title="search"   />
  <a href="#" class="abs top-search-a">More Options</a> </div>

<!--search-result body-->
<div class="result-page w770 rel clearfix"> 
  <!--search-result condition-->
  <div class="result-condition rel box"> <b>Alert Search</b>
    <dl class="search-row">
      <dt class="search-row-tit">Key Words</dt>
      <dd class="search-row-nav">
        <input type="text" class="kyo-input" data-tip="Enter Keywords" value="Enter Keywords"/>
      </dd>
    </dl>
    <dl class="search-row">
      <dt class="search-row-tit">City</dt>
      <dd class="search-row-nav">
        <select name="" class="after-select">
          <option value="0" selected="selected">All Cities</option>
          <option value="1">Shanghai</option>
          <option value="2">Beijing</option>
        </select>
          <div class="search-row-tip">Hold down 'Command' to select a max of 3</div>
      </dd>
    </dl>  
    <dl class="search-row ">
      <dt class="search-row-tit">Type of employment</dt>
      <dd class="search-row-nav">
        <select name="" class="after-select">
          <option value="0" selected="selected">Full Time</option>
          <option value="1">Part Time</option>
        </select>
      </dd>
    </dl>
      <dl class="search-row ">
          <dt class="search-row-tit">Length of employment</dt>
          <dd class="search-row-nav">
              <select name="" class="after-select">
                  <option value="0" selected="selected">Short Term</option>
                  <option value="1">Long Term</option>
              </select>
          </dd>
      </dl>
    <dl class="search-row ">
      <dt class="search-row-tit">Industry</dt>
      <dd class="search-row-nav">
        <input type="text" id="sel-industry" value="" style="display:block;">
        <div class="search-row-tip">Hold down 'Command' to select a max of 3</div>
        <div id="sel-industry-val" class="show-selval"></div>
      </dd>
    </dl>
    <dl class="search-row ">
      <dt class="search-row-tit">Position</dt>
      <dd class="search-row-nav">
        <input type="text" id="sel-position" value="">
        <div class="search-row-tip">Hold down 'Command' to select a max of 10</div>
        <div id="sel-position-val" class="show-selval"></div>
      </dd>
    </dl>
      <dl class="search-row ">
          <dt class="search-row-tit">Language</dt>
          <dd class="search-row-nav">
              <input type="text" id="sel-language" value="1">
              <div class="search-row-tip">Hold down 'Command' to select multiple</div>
              <div id="sel-language-val" class="show-selval"></div>
          </dd>
      </dl>

      <dl class="search-row">
          <dt class="search-row-tit">Personal Skills</dt>
          <dd class="search-row-nav">
              <input type="text" class="kyo-input" data-tip="Start Typing" value="Start Typing"/>
          </dd>
      </dl>
      <dl class="search-row">
          <dt class="search-row-tit">Technical Skills</dt>
          <dd class="search-row-nav">
              <input type="text" class="kyo-input" data-tip="Start Typing" value="Start Typing"/>
          </dd>
      </dl>

    <div class="result-condition-btnwrap">
      <input type="submit" class="condition-btn" value=""/>
    </div>
  </div>
  
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
    <div class="box rel sresult-row">
      <div class="sresult-par1">
        <div class="span1 rel"> <img src="<?php echo $theme_path?>style/search/job-img1.gif" alt="" width="85" height="81"/> <i class="job-mark job-mark1 png abs"></i> </div>
        <div class="span2">
          <h2>Name Here</h2>
          <h3>Industry 1, Industry 2, Industry 3</h3>
          <p>Edinburgh, UK</p>
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
    <div class="box rel sresult-row">
      <div class="sresult-par1">
        <div class="span1 rel"> <img src="<?php echo $theme_path?>style/search/job-img1.gif" alt="" width="85" height="81"/> <i class="job-mark job-mark1 png abs"></i> </div>
        <div class="span2">
          <h2>Name Here</h2>
          <h3>Industry 1, Industry 2, Industry 3</h3>
          <p>Rome, Italy</p>
          <a href="#" class="job-viewmore">View More</a> </div>
        <div class="span3">
          <div class="zoom">
              <a href="#" class="job-btn jobseeker-btn-shortlisted"></a>
              <a href="#" class="job-btn job-btn-match">93%</a>
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
                    <div>Founded in 2003, REDSTAR Media is a fully integrated creative agency with offices in Beijing, Qingdao and London specialising in graphic design, publishing and events management. Creativity is the heart and soul of our organisation, with over 50% of the team involved in the creative process. We believe that new ideas and their thoughtful implementation moves the world forward. The REDSTAR team offers a wealth of client experience and creative direction via a culture of personable, involved services and out-of-the-box thinking.</div>
                    <p><a href="#">View Company Profile</a></p>
                </div>
                <div class="fxui-tab-nav sresult-jingchat">
                    <div>Founded in 2003, REDSTAR Media is a fully integrated creative agency with offices in Beijing, Qingdao and London specialising in graphic design, publishing and events management. Creativity is the heart and soul of our organisation, with over 50% of the team involved in the creative process. We believe that new ideas and their thoughtful implementation moves the world forward. The REDSTAR team offers a wealth of client experience and creative direction via a culture of personable, involved services and out-of-the-box thinking.</div>
                    <p><a href="#">View Company Profile</a></p>
                </div>
            </div>
        </div>
    </div>

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