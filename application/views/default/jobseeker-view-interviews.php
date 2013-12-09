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
          <a href="#" class="png square_btn jingchat_inbox_btn"></a>
          <span class="bubble jingchat_inbox_bubble">2</span>
          <a href="#" class="png square_btn saved_bookmarks_btn"></a>
          <a href="#" class="png square_btn view_my_interviews_btn view_my_interviews_btn_current"></a>
          <span class="bubble view_my_interviews_bubble">10</span>
         </div>
    </div>

  </div>
</div>

<div class="result-page w770 clearfix view_interview_page" style="margin-top:20px;">
<!--search-result condition-->
<div class="result-condition rel box" style="padding:0;">
    <ul class="interview_types_navigator">
        <li class="current"><div><a href="#">Interview Requests</a></div></li>
        <li><div><a href="#">Trash</a></div></li>
    </ul>

    <div class="search_interviews">
        <label>Search Interview Requests</label>
        <form action="#">
            <input type="text" name="interview_keywords" class="kyo-input input-tip" style="width:203px;border:none;line-height:23px;height:23px;" data-tipval="Enter Keywords" value="Enter Keywords">
            <input type="submit" name="search_interview_btn" class="search_interview_btn" value=""/>
        </form>
    </div>
</div>

<!--search-result body-->
<div class="result-bd">
    <div class="box rel sresult-row">
        <div class="sresult-par1">
            <div class="span1 rel">
                <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="90px" height="90px" class="round_corner10_img"/>
            </div>
            <div class="span2">
                <h2>Job Title Here</h2>
                <h3>Company Name</h3>
                <p>Beijing, China</p>
                <a href="#" class="job-viewmore">View More</a> </div>
            <div class="span3">
                <div class="interview_sent_date">DD/MM/YY</div>
                <div class="interview_action_btns">
                    <img src="<?php echo $theme_path;?>/style/btns/btn_email_reply.png" alt="" class="reply_interview_function"/>
                    <img src="<?php echo $theme_path;?>/style/btns/btn_email_delete.png" alt="" class="delete_interview_function"/>
                </div>
            </div>
        </div>
        <div class="sresult-par2">
            <div class="interview_description">
                <div class="description_left">
                    <p>Position Title</p>
                    <p class="interview_field_content">Senior Graphic Designer</p>
                    <p>Interview by</p>
                    <p class="interview_field_content">Skype</p>
                    <a href="#">View full job listing &gt;</a>
                </div>
                <div class="description_right">
                    <p>Interview Date</p>
                    <p class="interview_field_content">Tuesday, August 27</p>
                    <p>Interview Time</p>
                    <p class="interview_field_content">13:30 GMT</p>
                    <a href="#">View company profile &gt;</a>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="intereview_letter">
                <p>Dear Sophie</p>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
                <p>
                I look forward to speaking with you on Tuesday,
                </p>
                <p>Joe Bloggs</p>
            </div>
            <div class="reply_interview_request"><img src="<?php echo $theme_path;?>/style/btns/btn_reply.png" class="reply_interview_function"/></div>
        </div>
    </div>

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