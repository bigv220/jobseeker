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
          <a href="<?php echo $site_url?>jobseeker/register" class="png square_btn edit_profile_btn"></a>
          <!-- JINGCHAT BEGIN -->
          <?php if ($chat_unread != 0) : ?>
          <a href="<?php echo $site_url.'inbox'; ?>" class="png square_btn jingchat_inbox_btn jingchat_inbox_btn_current"></a>
          <span class="bubble jingchat_inbox_bubble"><?php echo $chat_unread; ?></span>
          <?php else: ?>
          <a href="<?php echo $site_url.'inbox'; ?>" class="png square_btn jingchat_inbox_btn"></a>
          <?php endif; ?>
          <!-- JINGCHAT END -->
          <a href="<?php echo $site_url; ?>jobseeker/savedBookmarks" class="png square_btn saved_bookmarks_btn saved_bookmarks_btn_current"></a>
          <!-- INTERVIEW START -->
          <?php if ($interview_num != 0) : ?>
          <a href="<?php echo $site_url; ?>jobseeker/viewInterviews" class="png square_btn view_my_interviews_btn view_my_interviews_btn_current"></a>
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

<div class="result-page w770 clearfix" style="margin-top:20px;">
<!--search-result condition-->
<div class="result-condition rel box"> <b>Filter Bookmarks</b>
    <div class="sresult-tab-hd filter_type_tab">
        <span class="fxui-tab-tit curr" title="jobs" onclick="changeFilterType(this);">Jobs</span>
        <span class="fxui-tab-tit" title="companies" onclick="changeFilterType(this);">Companies</span>
    </div>
    <div class="sresult-tab-bd zoom">
        <form action="<?php echo $site_url; ?>jobseeker/savedBookmarks" method="post" id="jobsForm">
            <input type="hidden" name="filter_type" value="jobs" />
        <div class="fxui-tab-nav">
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
                        <option value="">All Countries</option>
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
        </form>

        <form action="<?php echo $site_url; ?>jobseeker/savedBookmarks" method="post" id="companiesForm">
            <input type="hidden" name="filter_type" value="companies" />
        <div class="fxui-tab-nav">
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
                        <option value="">All Countries</option>
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
        </form>
    </div>

    <div class="result-condition-btnwrap">
        <input type="hidden" name="filter_type_str" id="filter_type_str" value="jobs" />
        <input type="button" class="search_btn" onclick="submitFilterBookmarkForm()"/>
    </div>
</div>

<!--search-result body-->
<div class="result-bd">
    <!-- THIS ROW IS FOR JOBS SAVED IN BOOKMARKS -->
    <?php if (count($jobs)>0): ?>
    <?php foreach($jobs as $job): ?>
<div class="box rel sresult-row" id="jobdiv<?php echo $job['id']; ?>">
    <div class="sresult-par1">
        <div class="span1 rel">
            <img src="<?php echo $site_url;?>attached/users/<?php echo $job['profile_pic']?$job['profile_pic']:'no-image.png';?>" alt="" width="85px" height="85px" class="round_img"/>
        </div>
        <div class="span2">
            <h2><?php echo $job["job_name"]; ?></h2>
            <h3><?php echo $job['company_name']; ?></h3>
            <p><?php echo $job["city"]; ?></p>
            <a href="#" class="job-viewmore">View More</a> </div>
        <div class="span3 text_align_right">
            <div class="zoom">
                <a href="javascript:void(0);" data-job-id="<?php echo $job['id']; ?>" class="square_btn delete_job_btn"></a>
                <a href="#" class="square_btn match_percentage_btn">99%</a>
            </div>
            <div>
                <a data-job-email="<?php echo $userinfo['email']; ?>" data-job-id="<?php echo $job['id']; ?>" class="job-btn-submit" href="javascript:void(0);" style="display: none;"></a>
            </div>
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
                        <p><?php echo $job['job_desc'];?></p>
                    </div>
                    <dl class="sresult-nav-job-dl">
                        <dt>Preferred Years of Experience</dt>
                        <dd><?php echo getExperienceByID($job["preferred_year_of_experience"]); ?></dd>
                        <dt>Preferred Personal Skills</dt>
                        <dd><?php echo $job["preferred_personal_skills"]; ?></dd>
                        <dt>Preferred Technical Skills</dt>
                        <dd><?php echo $job["preferred_technical_skills"]; ?></dd>
                        <dt>Language(s) Required</dt>
                        <dd>
                            <div class="jobseeker_profile_language">
                                <label><?php echo getLanguageByID($job["language"]);?></label>
                                <i><?php echo getLanguageLevelByID($job["level"]);?></i>
                            </div>

                        </dd>
                    </dl>
                </div>
                <div class="sresult-nav-job-right">
                    <dl class="sresult-nav-job-dl">
                        <dt>Location</dt>
                        <dd>
                            <input type="hidden" id="address" value="<?php echo $job['location']; ?>" />
                            <strong><a href="<?php echo $site_url?>job/jobDetails/<?php echo $job['id'];?>">
                                <?php echo $job['location']; ?></a>
                            </strong>
                        </dd>
                        <dt>Salary</dt>
                        <dd><?php echo getSalaryByID($job["salary_range"]); ?></dd>
                        <dt>Industry</dt>
                        <dd class="industry">
                            <div>
                                <?php
                                for($i=0; $i<count($job['industry_arr']); $i++) {
                                    echo '<a href="#">'.$job['industry_arr'][$i]['industry']."</a> ";
                                }
                                ?>
                            </div>
                            <ul class="industry-ul">
                                <li class="n1"><b>Type of Employment</b>
                                    <span><?php if($job['employment_type']) {if(is_numeric($job['employment_type'])) echo getJobtypeByID($job['employment_type']); else echo $job['employment_type']; }?></span>
                                </li>
                                <li class="n2"><b>Length of Employment</b>
                                    <span><?php if($job['employment_length']) echo getEmploymentLengthByID($job['employment_length']);?></span>
                                </li>

                            </ul>
                        </dd>
                        <dt>Share This Job</dt>
                        <dd class="share-job"> <a href="#" class="n1"></a><a href="#" class="n2"></a><a href="#" class="n3"></a><a href="#" class="n4"></a><a href="#" class="n5"></a> </dd>
                    </dl>
                </div>
            </div>
            <div class="fxui-tab-nav sresult-about">
                <ul class="recent_applied_jobs">
                    <?php foreach($job['other_jobs'] as $v) {
                        if($v['id'] != $job['id']) {
                    ?>
                    <li><a href="<?php echo $site_url; ?>job/jobDetails/<?php echo $v['id']; ?>">
                        <?php echo $v['job_name']; ?></a>
                    </li>
                    <?php }} ?>
                </ul>
            </div>
        </div>
    </div>
</div>
    <?php endforeach; ?>
    <?php endif;?>

<?php if (count($companies)>0): ?>
    <?php foreach($companies as $com): ?>
<!-- THIS ROW IS FOR COMPANY SAVED IN BOOKMARKS -->
<div class="box rel sresult-row">
    <div class="sresult-par1" id="companydiv<?php echo $com['company_id']; ?>">
        <div class="span1 rel">
            <img src="<?php echo $site_url;?>attached/users/<?php echo $com['profile_pic']?$com['profile_pic']:'no-image.png';?>" alt="" width="85px" height="85px" class="round_img"/>
        </div>
        <div class="span2">
            <h2><?php echo $com['name']; ?></h2>
            <h3><?php echo $com['city']; ?></h3>
            <a href="#" class="job-viewmore">View More</a> </div>
        <div class="span3 text_align_right">
            <div class="zoom">
                <a href="javascript:void(0);" data-company-id="<?php echo $com['company_id']; ?>" class="square_btn delete_company_btn"></a>
            </div>
        </div>
    </div>
    <div class="sresult-par2">
        <div class="sresult-tab-hd">
            <span class="fxui-tab-tit" style="padding-left:0px;">The Compnay</span>
            <span class="fxui-tab-tit">Jobs</span> </div>
        <div class="sresult-tab-bd zoom">
            <div class="fxui-tab-nav ">
                <div class="text">
                    <?php echo $com['description']; ?>
                    <a href="#" class="orange_link">View Company Profile</a>
                </div>

            </div>
            <div class="fxui-tab-nav sresult-nav-job">
                <ul class="recent_applied_jobs">
                    <?php foreach($com['jobs'] as $v): ?>
                    <li><a href="<?php echo $site_url; ?>job/jobDetails/<?php echo $v['id']; ?>">
                        <?php echo $v['job_name']; ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
        <?php endforeach; ?>
    <?php endif;?>

<?php if(count($jobs) == 0 && count($companies) == 0) : ?>
    <div class="sresult-par1">
        <div class="box rel sresult-row id-4">
            <div class="noresult">
                Sorry, no matches were found, <br/>please alter your search and try again.
            </div>
        </div>
    </div>
<?php endif; ?>

</div>
<!--backtop-->
<div class="backtop png" style="right:200px;"></div>
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
            <a href="javascript:void(0);" class="pop-bar-btn pop-btn-yes">Yes</a> <a href="javascript:void(0);" class="pop-bar-btn pop-btn-no">No</a>
        </div>
    </div>
</div>

<div class="signup-pop-apply">
    <div class="rel">
        <div class="pop-close signup-pop-apply-close abs"></div>
        <div class="pop-nav signup-pop-apply-nav">
            <p>Please register as a jobseeker to apply for jobs.</p>
        </div>
        <div class="pop-bar">
            <button href="javascript:void(0);" class="signup-pop-btn"></button>
        </div>
    </div>
</div>

<!-- Delete bookmark job popup -->
<div class="box pop-box pop-delete-job">
    <div class="rel">
        <div class="pop-close pop-apply-close"></div>
        <div class="pop-nav pop-apply-nav">
            <p>Are you sure you want to delete this job?</p>
        </div>
        <div class="pop-bar">
            <input type="hidden" id="selected_job_id" />
            <a href="javascript:void(0);" class="pop-bar-btn pop-delete-job-yes">Yes</a>
            <a href="javascript:void(0);" class="pop-bar-btn pop-btn-no">No</a>
        </div>
    </div>
</div>

<!-- Delete bookmark company popup -->
<div class="box pop-box pop-delete-company">
    <div class="rel">
        <div class="pop-close pop-apply-close"></div>
        <div class="pop-nav pop-apply-nav">
            <p>Are you sure you want to delete this company?</p>
        </div>
        <div class="pop-bar">
            <input type="hidden" id="selected_company_id" />
            <a href="javascript:void(0);" class="pop-bar-btn pop-delete-company-yes">Yes</a>
            <a href="javascript:void(0);" class="pop-bar-btn pop-btn-no">No</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.onload = function() {
        var filter_type = '<?php echo $filter_type; ?>';

        $(".filter_type_tab .fxui-tab-tit").each(function(){
            if($(this).attr('title') == filter_type) {
                $(this).addClass('curr');
            } else {
                $(this).removeClass('curr');
            }
        });

        $('#filter_type_str').val(filter_type);
    }
</script>

<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/advsearch.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>