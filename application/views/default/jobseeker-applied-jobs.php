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
        <p class="profile_views_num"><?php echo $userinfo['visit_num']; ?> Profile Views</p>
      </div>
      <div class="btnarea">
          <a href="#" class="png square_btn edit_profile_btn"></a>
          <a href="#" class="png square_btn jingchat_inbox_btn"></a>
          <?php if (!empty($unread_msg_num)): ?><span class="bubble jingchat_inbox_bubble"><?php echo $unread_msg_num; ?></span><?php endif; ?>
          <a href="#" class="png square_btn saved_bookmarks_btn"></a>
          <a href="#" class="png square_btn view_my_interviews_btn"></a>
          <?php if (!empty($my_interviews_num)): ?><span class="bubble view_my_interviews_bubble"><?php echo $my_interviews_num; ?></span><?php endif;?>
         </div>
    </div>

  </div>
</div>

<div class="result-page w770 clearfix view_applied_jobs_page" style="margin-top:20px;">
<!--search-result condition-->
<div class="result-condition rel box">
    <h2 class="applied_jobs_title">Applied Jobs</h2>

    <div class="search_interviews">
        <label>Search Applied Jobs</label>
        <form action="#">
            <input type="text" name="keywords" class="kyo-input input-tip" style="width:203px;border:none;line-height:23px;height:23px;" data-tipval="Enter Keywords" value="Enter Keywords">
            <input type="submit" class="search_interview_btn search_applied_jobs_btn" value=""/>
        </form>
    </div>
</div>

<!--search-result body-->
<div class="result-bd">
    <?php foreach($jobs as $job):?>
    <div class="box rel sresult-row">
        <div class="sresult-par1">
            <div class="span1 rel">
                <?php if (!empty($job['profile_pic']) && is_file($job['profile_pic'])) {
                $pic = $site_url.'attached/users/'.$job['profile_pic'];
                }
                else
                $pic = $site_url.'attached/users/no-image.png';
                ?>
                <img src="<?php echo $pic; ?>" alt="" width="90px" height="90px" class="round_corner10_img"/>
            </div>
            <div class="span2">
                <h2><?php echo $job['job_name']; ?></h2>
                <h3><?php echo $job['first_name']; ?></h3>
                <p><?php echo $job['province'].' '.$job['country']; ?></p>
                <a href="#" class="job-viewmore">View More</a> </div>
            <div class="span3">
                <div class="interview_sent_date"><div  align="center"><?php $date = explode('-',$job['post_date']); echo $date[2]."/".$date[1]."/".substr($date[0],2,2); ?></div></div>

            </div>
        </div>
        <div class="sresult-par2">

            <div class="zoom">
                <div class="sresult-nav-job">
                    <div class="sresult-nav-job-left">
                        <div class="text_r">
                            <p><?php echo $job['job_desc'];?></p>
                        </div>
                        <dl class="sresult-nav-job-dl">
                            <dt>Preferred Years of Experience</dt>
                            <dd><?php echo $job['preferred_year_of_experience'];?> <?php echo $job['preferred_year_of_experience'] > 1?"years":"year"; ?></dd>
                            <dt>Preferred Personal Skills</dt>
                            <dd><?php echo str_replace(',', ', ', substr($job['preferred_personal_skills'],0,-1));?></dd>
                            <dt>Preferred Technical Skills</dt>
                            <dd><?php echo str_replace(',', ', ', substr($job['preferred_technical_skills'],0,-1));?></dd>
                            <dt>Language(s) Required</dt>
                            <dd>
                                <div class="jobseeker_profile_language">
                                 <?php $languages = $job['languages'];
                                    for($i=0; $i<count($languages); $i++) { ?>
                                        <label><?php echo getLanguageByID($languages[$i]["language"]); ?></label>
                                        <i><?php echo getLanguageLevelByID($languages[$i]["level"]); ?></i>
                                <?php }?>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="sresult-nav-job-right">
                        <dl class="sresult-nav-job-dl">
                            <dt>Location</dt>
                            <dd>
                                <input type="hidden" id="address" value="address" />
                                <!--
                                <div id="map" style="width:149px;height:83px;border: 1px solid #DDDDDD"></div>
                                -->
                                <strong><a href="#"><?php echo $job['location']; ?></a></strong>
                            </dd>
                            <dt>Salary</dt>
                            <dd><?php echo getSalaryByID($job['salary_range']);?></dd>
                            <dt>Industry</dt>
                            <dd class="industry">
                                <div>
                                    <?php 
                                    if (!empty($job['industries'])):
                                    foreach($job['industries'] as $industry): ?>
                                    <a href="#"><?php echo $industry['industry']; ?></a>
                                    <?php 
                                    endforeach;
                                    endif; ?>
                                </div>
                                <ul class="industry-ul">
                                    <li class="n1"><b>Type of Employment</b><span><?php echo str_replace(',',', ',$job['employment_type']); ?></span></li>
                                    <li class="n2"><b>Length of Employment</b><span><?php if (!empty($job['employment_length'])) echo getEmploymentLengthByID($job['employment_length']); ?></span></li>
                                    <?php if($job['is_visa_assistance'] == 1) : ?><li class="n3"><b>Visa Assistance</b><span>Visa will be provided</span></li><?php endif;?>
                                    <?php if($job['is_housing_assistance'] == 1) : ?><li class="n4"><b>Housing Assistance</b><span>Accomodation will be provided</span><?php endif;?>
                                    </li>
                                </ul>
                            </dd>
                            <dt>Share This Job</dt>
                            <dd class="share-job"> <a href="#" class="n1"></a><a href="#" class="n2"></a><a href="#" class="n3"></a><a href="#" class="n4"></a><a href="#" class="n5"></a> </dd>
                        </dl>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
    <?php endforeach; ?>
</div>
<!--backtop-->
<div class="backtop png" style="right:200px;"></div>
</div>

<!--popmark-->
<div class="pop-mark"></div>

<div class="reply_message_pop png">
    <div class="reply_message_pop_wrap rel">
        <i class="reply_message_pop_close abs" title="close"></i>
        <b>Send JingChat Message</b>
        <div class="reply_message_pop_bd">
            <div class="reply_message_pop_bd_heder">
                <div>
                    <div class="title">To:</div>
                    <div class="content">Redstar Works Ltd.</div>
                    <div style="clear:both;"></div>
                </div>
                <div>
                    <div class="title">Subject:</div>
                    <div class="content"><input name="message_subject" value="Re:Interview Request"/></div>
                    <div style="clear:both;"></div>
                </div>
            </div>
            <div class="reply_message_pop_bd_content">
                <textarea>
                    On November 22, 2013 4:05 AM,  Redstar Works wrote:
                    --------------------

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

                    I look forward to speaking with you on Tuesday,

                    Joe Bloggs
                </textarea>
            </div>
            <div class="reply_message_pop_bd_action_bar">
                <img src="<?php echo $theme_path;?>/style/btns/btn_send_message.png" alt="" class="send_message_function"/>
            </div>
        </div>
    </div>
</div>

<div class="message_sent_pop png">
    <div class="message_sent_pop_wrap rel">
        <i class="message_sent_pop_close abs" title="close"></i>
        <div class="message_sent_pop_bd">
            <div class="message_title">Your message has been sent</div>
            <div class="message_content"><a href="#">View in JingChat Inbox Now</a></div>
        </div>
    </div>
</div>
<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/advsearch.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>