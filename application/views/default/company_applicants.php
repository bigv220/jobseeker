<?php $this->load->view($front_theme.'/header-block');?>
<style type="text/css">
    input.text { width: 215px;}
    .jingchat_message_row_me .jingchat_message_content,.jingchat_message_row_other .jingchat_message_content {width:390px;}
    .jingchat_message_content .message_avatar_arrow {right:-14px;}
</style>
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
        <p class="profile_views_num"><?php echo $userinfo['visit_num']; ?> Profile Views</p>
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
          <a href="<?php echo $site_url?>company/shortlistCandidates" class="png combtn cand"></a>
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
    	<li style="background:none;"><a href="#">Select a job title to view applicants</a></li>
    	<?php foreach ($jobs as $job):?>
        <a href="<?php echo $site_url; ?>company/applicants/<?php echo $job['id']?>">
            <li <?php if($jobid == $job['id']) echo 'class="curr"'; ?>><?php echo $job['job_name']?></li>
        </a>
        <?php endforeach;?>
    </ul>
</div>

<!--search-result body-->
<div class="result-bd">
	<?php if ($jobid != -1) {?>
	<?php foreach ($users as $user):?>
	<div class="box rel sresult-row" id="sresult-user<?php echo $user['uid']; ?>">
        <div class="sresult-par1">
            <div class="span1 rel">
                <img src="<?php echo $site_url?>attached/users/<?php echo $user['profile_pic']?$user['profile_pic']:'no-image.png';?>" alt="" width="80px" height="80px" class="round_corner10_img"/>
            </div>
            <div class="span2">
                <h2><?php echo $user['first_name']. ' '. $user['last_name']; ?></h2>
                <h3> <?php
                                $industry_arr = $user['industry_arr'];
                                if (!empty($industry_arr)) {
                                    foreach ($industry_arr as $arr) {
										echo $arr['industry'].', ';
									}
                                }
                                ?></h3>
                <p><?php echo $user['city'].' '.$user['province'].' '.$user['country']; ?></p>
                <a href="#" class="job-viewmore">View More</a> </div>
            <div class="span3">
                <div class="zoom">
                    <a href="#" class="job-btn jobseeker-btn-delete-applicant" data-id="<?php echo $user['uid']; ?>"></a>
                    <a href="#" class="job-btn job-btn-match">93%</a>
                </div>
                <!-- <div><a href="#" class="jobseeker_request_interview"></a></div> -->

            </div>
        </div>
        <div class="sresult-par2">
            <div class="sresult-tab-hd">
                <span class="fxui-tab-tit">About me</span>
                <span class="fxui-tab-tit">Portfolio</span>
                <span class="fxui-tab-tit" onclick="getDetailMsgForSearchResult(this);" data-id="<?php echo empty($user['jingchat']['id'])?0:$user['jingchat']['id']; ?>" data-user="<?php echo $user['uid']; ?>">JingChat</span>
            </div>
            <div class="sresult-tab-bd zoom">
                <div class="fxui-tab-nav sresult-nav-job sresult_about_me">
                    <div class="sresult-nav-job-left">
                        <div class="text_r">
                            <p><?php echo $user['description']; ?></p>
                        </div>
                        <dl class="sresult-nav-job-dl">
                            <dt>Industry</dt>
                            <dd>
                                <?php
                                $industry_arr = $user['industry_arr'];
                                for($i=0; $i<count($industry_arr); $i++) {
                                    echo '<a href="#">'.$industry_arr[$i]['industry']."</a> ";
                                }
                                ?>
                            </dd>
                            <?php foreach($user['work_history'] as $v) {
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
                            <dd><?php
                            $arr = $user['personal_skills'];
                            for($i=0; $i<count($arr); $i++) {
                                if($i==0) {
                                    echo $arr[$i]['personal_skill'];
                                } else {
                                    echo ", " . $arr[$i]['personal_skill'];
                                }
                            }
                            ?><dd>
                            <dt>Technical Skills</dt>
                            <dd><?php
                                $arr = $user['professional_skills'];
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
                                <?php $languages = $user['languages'];
                                for($i=0; $i<count($languages); $i++) { ?>
                                    <div class="jobseeker_profile_language">
                                        <label><?php echo $languages[$i]["language"]; ?></label>
                                        <i><?php echo $languages[$i]["level"]; ?></i>
                                    </div>

                                <?php }?>
                            </dd>
                        </dl>
                    </div>
                    <div class="sresult-nav-job-right">
                        <dl class="sresult-nav-job-dl">
                            <dt>Birthday</dt>
                            <dd>
                                <p class="jobseeker_birthday"><?php echo date('M j Y',strtotime($user['birthday'])); ?></p>
                            </dd>
                            <dt>Education</dt>
                            <dd>
                                <?php $educations = $user['educations'];
                                for($i=0; $i<count($educations); $i++) { ?>
                                    <p class="school_name"><?php echo $educations[$i]['school_name']; ?></p>
                                    <p class="school_major"><?php echo $educations[$i]['major']; ?></p>
                                    <p class="school_period"><?php echo $educations[$i]['attend_date_from'] . ' - ' . $educations[$i]['attend_date_to']; ?></p>
                                    <?php }?>
                            </dd>
                            <dt>Elsewhere on Web</dt>
                            <dd>
                                <?php if (!empty($user['twitter'])):?>
                                <p><a href="<?php echo $user['twitter']?>">Twitter</a></p>
                                <?php endif;?>
                                <?php if (!empty($user['facebook'])):?>
                                <p><a href="<?php echo $user['facebook']?>">Facebook</a></p>
                                <?php endif;?>
                                <?php if (!empty($user['linkedin'])):?>
                                <p><a href="<?php echo $user['linkedin']?>">Linkedin</a></p>
                                <?php endif;?>
                                <?php if (!empty($user['weibo'])):?>
                                <p><a href="<?php echo $user['weibo']?>">Weibo</a></p>
                                <?php endif;?>
                            </dd>

                            <dt>Phone</dt>
                            <dd><p class="phone_number"><?php echo $user['phone']; ?></p></dd>
                            <dd class="industry">
                                <ul class="industry-ul">
                                    <li class="n1"><b>Type of Employment</b><span>Full Time</span></li>
                                    <li class="n2"><b>Length of Employment</b><span>Long Term (1+ year)</span></li>
                                    <!-- <li class="n3"><b>Visa Assistance</b><span>Visa will be provided</span></li>
                              <li class="n4"><b>Housing Assistance</b><span>Accomodation will be provided</span></li> -->
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="fxui-tab-nav sresult-portfolio">
                    <div class="portfolio_row"></div>
                </div>
                <div class="fxui-tab-nav sresult-jingchat">
                    <div class="jingchat_wrapper" id="message_list_<?php echo $user['uid']; ?>" data-id="<?php echo empty($user['jingchat']['id'])?0:$user['jingchat']['id']; ?>" data-user="<?php echo $user['uid']; ?>">
                        <div class="jingchat_messages" style="display:none;">
                            
                        </div>
                        <div class="jingchat_offline_message">
                            <p style="height:200px;"></p>
                            <p>Jobseeker is currently offline,</p>
                            <p>your message be sent to their Jingchat inbox</p>
                        </div>
                        <div class="jingchat_message_input">
                              <textarea data-user="<?php echo $user['uid']?>" id="message" rows="3" cols="" class="input-tip" data-tipval="Type your message here">Type your message here</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php endforeach;?>
	<?php if (empty($users)):?>
		<div class="sresult-par1">
	        <div class="box rel sresult-row id-4">
	        <div class="noresult">
	            Currently there are no applicants for this job.
	            </div>
	        </div>
	    </div>
	<?php endif;?>
	<?php } else {?>
		<div class="sresult-par1">
	        <div class="box rel sresult-row id-4">
	        <div class="noresult">
	            Please select a job title to view applicants.
	            </div>
	        </div>
	    </div>
	<?php } ?>
	<input type="hidden" id="msg_id" />
    <input type="hidden" id="user2" />
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
                    <div class="content">Company Name</div>
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
                    test...
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
<!--popmark-->
<div class="pop-mark"></div>
<!--pop box-->
<div class="box pop-box pop-apply">
    <div class="rel">
        <div class="pop-close pop-apply-close"></div>
        <div class="pop-nav pop-candidate-nav">
            <p>Are you sure you want to delete this applicant?</p>
        </div>
        <div class="pop-bar">
            <a href="#yes" class="pop-bar-btn delete-applicant-yes">Yes</a> <a href="#no" class="pop-bar-btn pop-btn-no">No</a>
        </div>
    </div>
</div>
<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/advsearch.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>