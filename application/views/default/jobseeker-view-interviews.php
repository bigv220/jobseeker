<?php $this->load->view($front_theme.'/header-block');?>

<!--company login page body-->
<div class="company-page w770 clearfix rel" xmlns="http://www.w3.org/1999/html">
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
      <div class="text_wrapper">
        <h2><?php echo $userinfo['first_name'].' '.$userinfo['last_name']; ?></h2>
        <h4><?php echo $userinfo['city'].', '.$userinfo['country']; ?></h4>
        <p class="profile_views_num"><?php echo $userinfo['visit_num']; ?> Profile Views</p>
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
          <a href="<?php echo $site_url; ?>jobseeker/savedBookmarks" class="png square_btn saved_bookmarks_btn"></a>
          <!-- INTERVIEW START -->
          <?php if (count($interviews) != 0) : ?>
          <a href="<?php echo $site_url; ?>jobseeker/viewInterviews" class="png square_btn view_my_interviews_btn view_my_interviews_btn_current"></a>
          <span class="bubble view_my_interviews_bubble">
              <?php echo count($interviews); ?>
          </span>
          <?php else: ?>
          <a href="<?php echo $site_url; ?>jobseeker/viewInterviews" class="png square_btn view_my_interviews_btn"></a>
          <?php endif; ?>
          <!-- INTERVIEW END -->
         </div>
    </div>

  </div>
</div>

<div class="result-page w770 clearfix view_interview_page" style="margin-top:20px;">
<!--search-result condition-->
<div class="result-condition rel box" style="padding:0;">
    <ul class="interview_types_navigator">
        <a href="<?php echo $site_url; ?>jobseeker/viewInterviews">
            <li <?php if($selected_tab == 1) echo 'class="current"'; ?>>Interview Requests</li>
        </a>
        <a href="<?php echo $site_url; ?>jobseeker/getInterviewsInTrash">
            <li <?php if($selected_tab == 2) echo 'class="current"'; ?>>Trash</li>
        </a>
    </ul>

    <div class="search_interviews">
        <label>Search Interview Requests</label>
        <form action="<?php echo $site_url; ?>jobseeker/viewInterviews" method="post">
            <input type="text" name="interview_keywords" class="kyo-input input-tip" style="width:203px;border:none;line-height:23px;height:23px;" data-tipval="Enter Keywords" value="Enter Keywords">
            <input type="submit" name="search_interview_btn" class="search_interview_btn" value=""/>
        </form>
    </div>
</div>

<!--search-result body-->
<div class="result-bd">
    <?php foreach($interviews as $int): ?>
    <div class="box rel sresult-row" id="int<?php echo $int['interview_id']; ?>">
        <div class="sresult-par1">
            <div class="span1 rel">
                <img src="<?php echo $site_url;?>attached/users/<?php echo $int['profile_pic']?$int['profile_pic']:'no-image.png';?>" alt="" width="90px" height="90px" class="round_corner10_img"/>
            </div>
            <div class="span2">
                <h2><?php echo $int['job_name']; ?></h2>
                <input type="hidden" id="interview_id" value="<?php echo $int['interview_id']; ?>" />
                <h3 id="company_name"><?php echo $int['username']; ?></h3>
                <p><?php echo $int['city']; ?>, <?php echo $int['country']; ?></p>
                <a href="#" class="job-viewmore">View More</a> </div>
            <div class="span3">
                <div class="interview_sent_date">
                    <?php echo date('d/m/Y', strtotime($int['insert_date'])); ?></div>
                <div class="interview_action_btns">
                    <img src="<?php echo $theme_path;?>style/btns/btn_email_reply.png" alt="<?php echo $int['interview_id']; ?>" class="reply_interview_function"/>
                    <img src="<?php echo $theme_path;?>style/btns/btn_email_delete.png" alt="<?php echo $int['interview_id']; ?>" class="delete_interview_function"/>
                </div>
            </div>
        </div>
        <div class="sresult-par2">
            <div class="interview_description">
                <div class="description_left">
                    <p>Position Title</p>
                    <p class="interview_field_content">
                        <?php foreach($int['position_arr'] as $pos): ?>
                        <?php echo $pos['position']." "; ?>
                        <?php endforeach; ?>
                    </p>
                    <p>Interview by</p>
                    <p class="interview_field_content"><?php echo $int['communication_type']; ?></p>
                    <a href="<?php echo $site_url; ?>job/jobDetails/<?php echo $int['job_id']; ?>">View full job listing &gt;</a>
                </div>
                <div class="description_right">
                    <p>Interview Date</p>
                    <p class="interview_field_content">
                        <?php echo date('l, F j',strtotime($int['date'])); ?></p>
                    <p>Interview Time</p>
                    <p class="interview_field_content"><?php echo $int['time']; ?> <?php echo $int['time_country']; ?>
                        <?php echo $int['time_city']; ?></p>
                    <a href="<?php echo $site_url; ?>company/companyInfo/<?php echo $int['company_id']; ?>">View company profile &gt;</a>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="intereview_letter" id="interview_msg">
                <?php echo $int['message']; ?>
            </div>
            <div class="reply_interview_request">
                <?php if(empty($int['reply_id'])) { ?>
                    <img src="<?php echo $theme_path;?>style/btns/btn_reply.png" alt="<?php echo $int['interview_id']; ?>" class="reply_interview_function"/>
                <?php } else { ?>
                <a href="<?php echo $site_url; ?>inbox">
                    <img src="<?php echo $theme_path;?>style/btns/btn_view_your_reply.png"/>
                </a>
                <?php } ?>
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
        <form action="<?php echo $site_url; ?>search/replyinterviewrequest" method="post" id="replyInterviewRequest">
        <div class="reply_message_pop_bd">
            <div class="reply_message_pop_bd_heder">
                <div>
                    <div class="title">To:</div>
                    <input type="hidden" id="interviewId" name="interviewId" />
                    <div class="content" id="reply_to"></div>
                    <div style="clear:both;"></div>
                </div>
                <div>
                    <div class="title">Subject:</div>
                    <div class="content">
                        <input name="message_subject" value="Re:Interview Request"/>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>
            <div class="reply_message_pop_bd_content">
                <textarea name="message" id="reply_msg"></textarea>
            </div>
            <div class="reply_message_pop_bd_action_bar">
                <img src="<?php echo $theme_path;?>/style/btns/btn_send_message.png" alt="" class="send_message_function"/>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="message_sent_pop png">
    <div class="message_sent_pop_wrap rel">
        <i class="message_sent_pop_close abs" title="close"></i>
        <div class="message_sent_pop_bd">
            <div class="message_title">Your message has been sent</div>
            <div class="message_content">
                <a href="<?php echo $site_url; ?>inbox">View in JingChat Inbox Now</a>
            </div>
        </div>
    </div>
</div>
<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/advsearch.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>