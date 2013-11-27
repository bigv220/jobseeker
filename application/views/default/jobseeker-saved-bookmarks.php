<?php $this->load->view($front_theme.'/header-block');?>

<!--company login page body-->
<div class="company-page w770 clearfix rel">
  <div class="company-body box rel mb5">
    <div class="company-hd jobseeker-hd rel">
        <?php if (!empty($userinfo['profile_pic'])): 
        $pic = $site_url.'attached/users/'.$userinfo['profile_pic'];
        ?>
        <div class="people_icon">
          <img src="<?php echo $pic; ?>" alt="" width="128px" height="128px" class="jobseeker_icon"/>
        </div>

        <?php else: ?>
        <i class="abs face png"></i>
        <?php endif; ?>
      <div class="text">
        <h2><?php echo $userinfo['first_name'].' '.$userinfo['last_name']; ?></h2>
        <h4><?php echo $userinfo['city'].', '.$userinfo['country']; ?></h4>
        <p class="profile_views_num">4 Profile Views</p>
      </div>
      <div class="btnarea">
          <a href="#" class="png square_btn edit_profile_btn"></a>
          <a href="#" class="png square_btn jingchat_inbox_btn"></a>
          <span class="bubble jingchat_inbox_bubble">2</span>
          <a href="#" class="png square_btn saved_bookmarks_btn"></a>
          <a href="#" class="png square_btn view_my_interviews_btn"></a>
          <span class="bubble view_my_interviews_bubble">10</span>
         </div>
    </div>

  </div>
</div>

<div class="result-page w770 clearfix" style="margin-top:20px;">
<!--search-result condition-->
<div class="result-condition rel box"> <b>Filter Bookmarks</b>
    <div class="sresult-tab-hd">
        <span class="fxui-tab-tit">Jobs</span>
        <span class="fxui-tab-tit">Companies</span>
    </div>
    <div class="sresult-tab-bd zoom">
        <div class="fxui-tab-nav">
            <dl class="search-row">
                <dt class="search-row-tit">Key Words</dt>
                <dd class="search-row-nav">
                    <input type="text" class="kyo-input" data-tip="Enter Keywords" name="keywords" value="Enter Keywords" onfocus="clearHint(this)" onblur="showHint(this)" />
                </dd>
            </dl>
            <dl class="search-row">
                <dt class="search-row-tit">City</dt>
                <dd class="search-row-nav">
                    <select name="city" class="filter_key">
                        <?php if (empty($_POST['city'])): ?>
                            <option value="">All Cities</option>
                            <option value="Beijing">Beijing</option>
                        <?php else: ?>
                            <option value="<?php echo $_POST['city']; ?>"><?php echo $_POST['city']; ?></option>
                            <option value="">All Cities</option>
                        <?php endif; ?>
                    </select>
                </dd>
            </dl>
            <dl class="search-row">
                <dt class="search-row-tit">Industry</dt>
                <dd class="search-row-nav reg-row">
                    <select name="industry[]" class="industry_options">
                        <option value="">All Industries</option>
                        <?php foreach($industry as $key=>&$v) {
                            if(empty($v['name'])) continue;
                            ?>
                            <option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                        <?php } ?>
                    </select>

                </dd>
            </dl>
        </div>
        <div class="fxui-tab-nav">
            <dl class="search-row">
                <dt class="search-row-tit">Key Words</dt>
                <dd class="search-row-nav">
                    <input type="text" class="kyo-input" data-tip="Enter Keywords" name="keywords" value="Enter Keywords" onfocus="clearHint(this)" onblur="showHint(this)" />
                </dd>
            </dl>
            <dl class="search-row">
                <dt class="search-row-tit">City</dt>
                <dd class="search-row-nav">
                    <select name="city" class="filter_key">
                        <?php if (empty($_POST['city'])): ?>
                            <option value="">All Cities</option>
                            <option value="Beijing">Beijing</option>
                        <?php else: ?>
                            <option value="<?php echo $_POST['city']; ?>"><?php echo $_POST['city']; ?></option>
                            <option value="">All Cities</option>
                        <?php endif; ?>
                    </select>
                </dd>
            </dl>
            <dl class="search-row">
                <dt class="search-row-tit">Industry</dt>
                <dd class="search-row-nav reg-row">
                    <select name="industry[]" class="industry_options">
                        <option value="">All Industries</option>
                        <?php foreach($industry as $key=>&$v) {
                            if(empty($v['name'])) continue;
                            ?>
                            <option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                        <?php } ?>
                    </select>

                </dd>
            </dl>
        </div>
    </div>

    <div class="result-condition-btnwrap">
        <input type="submit" class="search_btn" value=""/>
    </div>
</div>

<!--search-result body-->
<div class="result-bd">
    <!-- THIS ROW IS FOR JOBS SAVED IN BOOKMARKS -->
<div class="box rel sresult-row">
    <div class="sresult-par1">
        <div class="span1 rel">
            <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="85px" height="85px" class="round_img"/>
        </div>
        <div class="span2">
            <h2>Job Title Here</h2>
            <h3>Company Name</h3>
            <p>Shanghai</p>
            <a href="#" class="job-viewmore">View More</a> </div>
        <div class="span3 text_align_right">
            <div class="zoom">
                <a href="#" class="square_btn delete_job_btn"></a>
                <a href="#" class="square_btn match_percentage_btn">99%</a>
            </div>
            <div><a href="#" class="job-btn-submit"></a></div>
        </div>
    </div>
    <div class="sresult-par2">
        <div class="sresult-tab-hd">
            <span class="fxui-tab-tit" style="padding-left:0px;">The Job</span>
            <span class="fxui-tab-tit">Other Jobs</span>
        </div>
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
                            <div><img src="style/search/map.gif" alt="" width="151" height="83" />Lee World, Room 301,
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
                <ul class="recent_applied_jobs">
                    <li><a href="#">Admin Assistant</a></li>
                    <li><a href="#">UI Designer</a></li>
                    <li><a href="#">Project Manager</a></li>
                    <li><a href="#">UI Designer</a></li>
                    <li><a href="#">Admin Assistant</a></li>
                    <li><a href="#">UI Designer</a></li>
                    <li><a href="#">Project Manager</a></li>
                    <li><a href="#">UI Designer</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- THIS ROW IS FOR COMPANY SAVED IN BOOKMARKS -->
<div class="box rel sresult-row">
    <div class="sresult-par1">
        <div class="span1 rel">
            <img src="<?php echo $theme_path;?>/style/search/job-img1.gif" alt="" width="85px" height="85px" class="round_img"/>
        </div>
        <div class="span2">
            <h2>Company Name</h2>
            <h3>Location</h3>
            <a href="#" class="job-viewmore">View More</a> </div>
        <div class="span3 text_align_right">
            <div class="zoom">
                <a href="#" class="square_btn delete_company_btn"></a>
            </div>
        </div>
    </div>
    <div class="sresult-par2">
        <div class="sresult-tab-hd">
            <span class="fxui-tab-tit" style="padding-left:0px;">The Compnay</span>
            <span class="fxui-tab-tit">Jobs</span> </div>
        <div class="sresult-tab-bd zoom">
            <div class="fxui-tab-nav ">
                <div class="text">Founded in 2003, REDSTAR Media is a fully integrated creative agency with offices in Beijing,
                    Qingdao and London specialising in graphic design, publishing and events management.
                    Creativity is the heart and soul of our organisation, with over 50% of the team
                    involved in the creative process. We believe that new ideas and their thoughtful
                    implementation moves the world forward. The REDSTAR team offers a wealth of client
                    experience and creative direction via a culture of personable, involved services
                    and out-of-the-box thinking.
                    <a href="#" class="orange_link">View Company Profile</a>
                </div>

            </div>
            <div class="fxui-tab-nav sresult-nav-job">
                <ul class="recent_applied_jobs">
                    <li><a href="#">Admin Assistant</a></li>
                    <li><a href="#">UI Designer</a></li>
                    <li><a href="#">Project Manager</a></li>
                    <li><a href="#">UI Designer</a></li>
                    <li><a href="#">Admin Assistant</a></li>
                    <li><a href="#">UI Designer</a></li>
                    <li><a href="#">Project Manager</a></li>
                    <li><a href="#">UI Designer</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

</div>
<!--backtop-->
<div class="backtop png" style="right:200px;"></div>
</div>

<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>