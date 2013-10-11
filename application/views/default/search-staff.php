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
      <dt class="search-row-tit">Location</dt>
      <dd class="search-row-nav">
        <select name="" class="after-select">
          <option value="0" selected="selected">All Cities</option>
          <option value="1">Shanghai</option>
          <option value="2">Beijing</option>
        </select>
      </dd>
    </dl>  
    <dl class="search-row ">
      <dt class="search-row-tit">Type of employment</dt>
      <dd class="search-row-nav">
        <select name="" class="after-select">
          <option value="0" selected="selected">Full Time</option>
          <option value="1">Shanghai</option>
          <option value="2">Beijing</option>
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
      <dt class="search-row-tit">Length of employment</dt>
      <dd class="search-row-nav">
        <select name="" class="after-select">
          <option value="1" selected="selected">Short Term</option>
          <option value="2">select2</option>
          <option value="2">select3</option>
          <option value="2">select4</option>
        </select>
      </dd>
    </dl>
    <dl class="search-row ">
      <dt class="search-row-tit">Salary</dt>
      <dd class="search-row-nav">
        <select name="" class="after-select">
          <option value="1" selected="selected">Any Salary</option>
          <option value="2">select2</option>
          <option value="2">select3</option>
          <option value="2">select4</option>
        </select>
      </dd>
    </dl>
    <dl class="search-row ">
      <dt class="search-row-tit">Year of experience</dt>
      <dd class="search-row-nav">
        <select name="" class="after-select">
          <option value="1" selected="selected">Less than 1 year</option>
          <option value="2">select2</option>
          <option value="2">select3</option>
          <option value="2">select4</option>
        </select>
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
    <div class="result-condition-btnwrap">
      <input type="submit" class="condition-btn" value=""/>
    </div>
  </div>
  
  <!--search-result sequence-->
  <div class="result-az">
    <div class="result-az-from fl"> <b>View Jobseekers from</b>
      <select class="kyo-select">
        <option value="0">--Select--</option>
        <option value="30">Last 30 Days</option>
        <option value="15">Last 15 Days</option>
        <option value="7">Last 7 Days</option>
        <option value="3">Last 3 Days</option>
        <option value="1">Last 1 Days</option>
      </select>
    </div>
    <div class="result-az-jobs fl"> <b>Sort Jobseekers by</b>
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
          <h3>Accounting, Programmer, Designer</h3>
          <p>Shanghai</p>
          <a href="#" class="job-viewmore">View More</a> </div>
        <div class="span3">
          <div class="zoom"> <a href="#" class="job-btn job-btn-mark" style="display:none"></a> <a href="#" class="job-btn job-btn-marked"></a> <a href="#" class="job-btn job-btn-featured"  style="display:none"></a> <a href="#" class="job-btn job-btn-match">99%</a> </div>
          <div><a href="#" class="job-btn-submit"></a></div>
        </div>
      </div>
      <div class="sresult-par2">
        <div class="sresult-tab-hd"> <span class="fxui-tab-tit">The Job</span> <span class="fxui-tab-tit">The Compnay</span> </div>
        <div class="sresult-tab-bd zoom">
          <div class="fxui-tab-nav sresult-nav-job">
            <div class="sresult-nav-job-left">
              <div class="text">
                <p>We have an exciting opportunity for a full time Graphic Designer to join our creative team.
                  We are a leading creative, events and media agency with offices in Beijing, London and Qingdao.</p>
                <p>We create and distribute amazing work for a variety of retailers and clients. You will be working on great brands such as Baccarat, Arcosteel, Alex Liddy and Marie Claire.</p>
                <p>We offer the opportunity to work with a great team on exciting, creative and challenging designs.</p>
                <p>Reporting to the marketing manager, you will be assisting on projects ranging from packaging, catalogues, theme and design concepts, product development, decals and surface decorations applied to a range of home products, flyers, ads, signage, posters, for a variety of brands and various brand style applications.</p>
              </div>
              <dl class="sresult-nav-job-dl">
                <dt>Preferred Years of Experience</dt>
                <dd>1 to 3 years</dd>
                <dt>Preferred Personal Skills</dt>
                <dd>Time Managment, Public Speaking, Networking, Leadership</dd>
                <dt>Preferred Technical Skills</dt>
                <dd>Branding, Adobe Creative Suite, Printing, Critical Thinking</dd>
                <dt>Language(s) Required</dt>
                <dd> <span class="required"> <b>English</b> <i>Fluent</i> </span> <span class="required"> <b>French</b> <i>Fluent</i> </span> <span class="required"> <b>German</b> <i>Fluent</i> </span> </dd>
              </dl>
            </div>
            <div class="sresult-nav-job-right">
              <dl class="sresult-nav-job-dl">
                <dt>Location</dt>
                <dd>
                  <div><img src="<?php echo $theme_path?>style/search/map.gif" alt="" width="151" height="83" />Lee World, Room 301,
                    Chayong District, Beijing</div>
                </dd>
                <dt>Salary</dt>
                <dd>10,000 CNY – 15,000 CNY</dd>
                <dt>Industry</dt>
                <dd class="industry">
                  <div> <a href="#">Graphic Design</a> <a href="#">Media</a> <a href="#">Publishing</a> <a href="#">Marketing</a> </div>
                  <ul class="industry-ul">
                    <li class="n1"><b>Type of Employment</b><span>Full Time</span></li>
                    <li class="n2"><b>Length of Employment</b><span>Long Term (1+ year)</span></li>
                    <li class="n3"><b>Visa Assistance</b><span>Visa will be provided</span></li>
                    <li class="n4"><b>Housing Assistance</b><span>Accomodation will be provided</span></li>
                  </ul>
                </dd>
                <dt>Share This Job</dt>
                <dd class="share-job"> <a href="#" class="n1"></a><a href="#" class="n2"></a><a href="#" class="n3"></a><a href="#" class="n4"></a><a href="#" class="n5"></a> </dd>
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
    <div class="box rel sresult-row">
      <div class="sresult-par1">
        <div class="span1 rel"> <img src="<?php echo $theme_path?>style/search/job-img1.gif" alt="" width="85" height="81"/> <i class="job-mark job-mark1 png abs"></i> </div>
        <div class="span2">
          <h2>Name Here</h2>
          <h3>Accounting, Programmer, Designer</h3>
          <p>Shanghai</p>
          <a href="#" class="job-viewmore">View More</a> </div>
        <div class="span3">
          <div class="zoom"> <a href="#" class="job-btn job-btn-mark" style="display:none"></a> <a href="#" class="job-btn job-btn-marked"></a> <a href="#" class="job-btn job-btn-featured"  style="display:none"></a> <a href="#" class="job-btn job-btn-match">99%</a> </div>
          <div><a href="#" class="job-btn-submit"></a></div>
        </div>
      </div>
      <div class="sresult-par2">
        <div class="sresult-tab-hd"> <span class="fxui-tab-tit">The Job</span> <span class="fxui-tab-tit">The Compnay</span> </div>
        <div class="sresult-tab-bd zoom">
          <div class="fxui-tab-nav sresult-nav-job">
            <div class="sresult-nav-job-left">
              <div class="text">
                <p>We have an exciting opportunity for a full time Graphic Designer to join our creative team.
                  We are a leading creative, events and media agency with offices in Beijing, London and Qingdao.</p>
                <p>We create and distribute amazing work for a variety of retailers and clients. You will be working on great brands such as Baccarat, Arcosteel, Alex Liddy and Marie Claire.</p>
                <p>We offer the opportunity to work with a great team on exciting, creative and challenging designs.</p>
                <p>Reporting to the marketing manager, you will be assisting on projects ranging from packaging, catalogues, theme and design concepts, product development, decals and surface decorations applied to a range of home products, flyers, ads, signage, posters, for a variety of brands and various brand style applications.</p>
              </div>
              <dl class="sresult-nav-job-dl">
                <dt>Preferred Years of Experience</dt>
                <dd>1 to 3 years</dd>
                <dt>Preferred Personal Skills</dt>
                <dd>Time Managment, Public Speaking, Networking, Leadership</dd>
                <dt>Preferred Technical Skills</dt>
                <dd>Branding, Adobe Creative Suite, Printing, Critical Thinking</dd>
                <dt>Language(s) Required</dt>
                <dd> <span class="required"> <b>English</b> <i>Fluent</i> </span> <span class="required"> <b>French</b> <i>Fluent</i> </span> <span class="required"> <b>German</b> <i>Fluent</i> </span> </dd>
              </dl>
            </div>
            <div class="sresult-nav-job-right">
              <dl class="sresult-nav-job-dl">
                <dt>Location</dt>
                <dd>
                  <div><img src="<?php echo $theme_path?>style/search/map.gif" alt="" width="151" height="83" />Lee World, Room 301,
                    Chayong District, Beijing</div>
                </dd>
                <dt>Salary</dt>
                <dd>10,000 CNY – 15,000 CNY</dd>
                <dt>Industry</dt>
                <dd class="industry">
                  <div> <a href="#">Graphic Design</a> <a href="#">Media</a> <a href="#">Publishing</a> <a href="#">Marketing</a> </div>
                  <ul class="industry-ul">
                    <li class="n1"><b>Type of Employment</b><span>Full Time</span></li>
                    <li class="n2"><b>Length of Employment</b><span>Long Term (1+ year)</span></li>
                    <li class="n3"><b>Visa Assistance</b><span>Visa will be provided</span></li>
                    <li class="n4"><b>Housing Assistance</b><span>Accomodation will be provided</span></li>
                  </ul>
                </dd>
                <dt>Share This Job</dt>
                <dd class="share-job"> <a href="#" class="n1"></a><a href="#" class="n2"></a><a href="#" class="n3"></a><a href="#" class="n4"></a><a href="#" class="n5"></a> </dd>
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
    <div class="box rel sresult-row">
      <div class="sresult-par1">
        <div class="span1 rel"> <img src="<?php echo $theme_path?>style/search/job-img1.gif" alt="" width="85" height="81"/> <i class="job-mark job-mark1 png abs"></i> </div>
        <div class="span2">
          <h2>Name Here</h2>
          <h3>Accounting, Programmer, Designer</h3>
          <p>Shanghai</p>
          <a href="#" class="job-viewmore">View More</a> </div>
        <div class="span3">
          <div class="zoom"> <a href="#" class="job-btn job-btn-mark" style="display:none"></a> <a href="#" class="job-btn job-btn-marked"></a> <a href="#" class="job-btn job-btn-featured"  style="display:none"></a> <a href="#" class="job-btn job-btn-match">99%</a> </div>
          <div><a href="#" class="job-btn-submit"></a></div>
        </div>
      </div>
      <div class="sresult-par2">
        <div class="sresult-tab-hd"> <span class="fxui-tab-tit">The Job</span> <span class="fxui-tab-tit">The Compnay</span> </div>
        <div class="sresult-tab-bd zoom">
          <div class="fxui-tab-nav sresult-nav-job">
            <div class="sresult-nav-job-left">
              <div class="text">
                <p>We have an exciting opportunity for a full time Graphic Designer to join our creative team.
                  We are a leading creative, events and media agency with offices in Beijing, London and Qingdao.</p>
                <p>We create and distribute amazing work for a variety of retailers and clients. You will be working on great brands such as Baccarat, Arcosteel, Alex Liddy and Marie Claire.</p>
                <p>We offer the opportunity to work with a great team on exciting, creative and challenging designs.</p>
                <p>Reporting to the marketing manager, you will be assisting on projects ranging from packaging, catalogues, theme and design concepts, product development, decals and surface decorations applied to a range of home products, flyers, ads, signage, posters, for a variety of brands and various brand style applications.</p>
              </div>
              <dl class="sresult-nav-job-dl">
                <dt>Preferred Years of Experience</dt>
                <dd>1 to 3 years</dd>
                <dt>Preferred Personal Skills</dt>
                <dd>Time Managment, Public Speaking, Networking, Leadership</dd>
                <dt>Preferred Technical Skills</dt>
                <dd>Branding, Adobe Creative Suite, Printing, Critical Thinking</dd>
                <dt>Language(s) Required</dt>
                <dd> <span class="required"> <b>English</b> <i>Fluent</i> </span> <span class="required"> <b>French</b> <i>Fluent</i> </span> <span class="required"> <b>German</b> <i>Fluent</i> </span> </dd>
              </dl>
            </div>
            <div class="sresult-nav-job-right">
              <dl class="sresult-nav-job-dl">
                <dt>Location</dt>
                <dd>
                  <div><img src="<?php echo $theme_path?>style/search/map.gif" alt="" width="151" height="83" />Lee World, Room 301,
                    Chayong District, Beijing</div>
                </dd>
                <dt>Salary</dt>
                <dd>10,000 CNY – 15,000 CNY</dd>
                <dt>Industry</dt>
                <dd class="industry">
                  <div> <a href="#">Graphic Design</a> <a href="#">Media</a> <a href="#">Publishing</a> <a href="#">Marketing</a> </div>
                  <ul class="industry-ul">
                    <li class="n1"><b>Type of Employment</b><span>Full Time</span></li>
                    <li class="n2"><b>Length of Employment</b><span>Long Term (1+ year)</span></li>
                    <li class="n3"><b>Visa Assistance</b><span>Visa will be provided</span></li>
                    <li class="n4"><b>Housing Assistance</b><span>Accomodation will be provided</span></li>
                  </ul>
                </dd>
                <dt>Share This Job</dt>
                <dd class="share-job"> <a href="#" class="n1"></a><a href="#" class="n2"></a><a href="#" class="n3"></a><a href="#" class="n4"></a><a href="#" class="n5"></a> </dd>
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