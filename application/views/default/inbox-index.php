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
          <?php if ($chat_unread != 0) : ?>
          <a href="<?php echo $site_url.'inbox'; ?>" class="png square_btn jingchat_inbox_btn jingchat_inbox_btn_current"></a>
          <span class="bubble jingchat_inbox_bubble"><?php echo $chat_unread; ?></span>
          <?php else: ?>
          <a href="<?php echo $site_url.'inbox'; ?>" class="png square_btn jingchat_inbox_btn"></a>
          <?php endif; ?>
          <a href="#" class="png square_btn saved_bookmarks_btn"></a>
          <a href="#" class="png square_btn view_my_interviews_btn"></a>
         </div>
    </div>
    <div class="inbox_content">
        <div class="inbox_multi_actions_bar">
            <!--<img src="<?php echo $theme_path;?>/style/btns/btn_inbox_multi_edit_on.png" alt=""/>-->
            <img id="multi_delete" src="<?php echo $theme_path;?>/style/btns/btn_inbox_multi_delete_on.png" alt=""/>
        </div>
      <div class="sresult-tab-hd-m">
          <span class="fxui-tab-tit-m <?php if($mode == ''): ?>curr<?php endif; ?>" onclick="refresh('');">JingChat</span>
          <span class="fxui-tab-tit-m <?php if($mode == 'sent'): ?>curr<?php endif; ?>" onclick="refresh('sent');">Sent</span>
          <span class="fxui-tab-tit-m <?php if($mode == 'trash'): ?>curr<?php endif; ?>" onclick="refresh('trash');">Trash</span>
      </div>
      <div class="sresult-tab-bd zoom">
          <div class="fxui-tab-nav">
              <div class="inbox_wrapper">
                  <div class="inbox_overview_list">
                      <?php foreach($messages as $msg): 
                      $id = $msg['id'];
                      $user2 = $msg['user1'];
                      ?>
                      <div class="inbox_overview_row" data-id='<?php echo $msg['id']; ?>' data-user="<?php echo $msg['user1']; ?>">
                          <div class="email_select_checkbox">
                              <input id="email_checkbox_1" value="0" class="kyo-checkbox" style="display:none;"/>
                              <i class="kyo-checkbox" data-id="email_checkbox_1" data-val="<?php echo $msg['id']; ?>"></i>
                          </div>
                          <div class="sender_avatar">
                              <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="50px" height="50px" class="round_img_border3"/>
                          </div>
                          <div class="email_short_description">
                              <div class="received_date"><?php echo time_elapsed_string($msg['timestamp']); ?></div>
                              <div class="from_name"><?php echo $msg['first_name']; ?> <?php echo $msg['last_name']; ?></div>
                              <div class="email_subject"><?php echo $msg['message']; ?></div>
                              <div class="email_actions_bar">
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_reply.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_delete.png" alt="" class="delete_msg" data-id="<?php echo $msg['id']; ?>"/>
                                  <img style="display:none" class="online_status" online-id="<?php echo $msg['user1']; ?>" src="<?php echo $theme_path;?>/style/btns/btn_jingchat_online_icon.png" alt=""/>
                              </div>
                          </div>
                          <div style="clear:both;"></div>
                      </div>
                      <?php endforeach; ?>
                  <input type="hidden" id="delete_ids" value="" />        
                  </div>
                  <div class="jingchat_log_content">

                      <div class="jingchat_wrapper">
                          <div class="jingchat_messages">
                              <div class="load_older_message">
                                  Load older messages
                              </div>
                              <div class="jingchat_messages_bd">
                                  <?php 
                                  $seq = 0;
                                  if (!empty($msg_detail)):
                                  foreach($msg_detail as $detail): 
                                    $seq = $detail['seq']; ?>
                                  <div class="<?php if ($detail['user1'] == $uid) echo "jingchat_message_row_me"; else echo "jingchat_message_row_other"; ?>" data-seq='<?php echo $seq; ?>'>
                                      <div class="jingchat_message_content">
                                          <img src="<?php echo $theme_path?>style/jingchat/me_jingchat_message_leftarrow.png" class="message_avatar_arrow"/>
                                          <div class="other_message_top"></div>
                                          <div class="other_message_content">
                                              <p class="sent_time"><?php echo time_elapsed_string($detail['timestamp']); ?></p>
                                              <p>
                                                  <?php echo $detail['message']; ?>
                                              </p>
                                          </div>
                                          <div class="other_message_bottom"></div>
                                      </div>
                                      <div class="jingchat_message_icon">
                                          <img src="<?php if ($detail['user1'] == $uid) echo $site_url.'attached/users/'.$userinfo['profile_pic']; else echo $site_url.'attached/users/'. $other_user['profile_pic']; ?>" alt=""/>
                                      </div>
                                      <div style="clear:both;"></div>
                                  </div>
                                  <?php endforeach; ?>
                                  <?php endif; ?>
                              </div>
                              <input type="hidden" id="msg_id" value="<?php echo $id; ?>"/>
                              <input type="hidden" id="user2" value="<?php echo $user2; ?>"/>
                          </div>
         
                          <?php if ($mode != 'trash') : ?>
                          <div class="jingchat_message_input">
                              <textarea id="message" rows="3" cols="" class="input-tip" data-tipval="Type your message here">Type your message here</textarea>
                          </div>
                          <?php endif; ?>
                      </div>
                  </div>
                  <div style="clear:both;"></div>
              </div>
          </div>
          
      </div>
    </div>
  </div>
</div>
<!--popmark-->
<div class="pop-mark"></div>
<!--pop box-->
<div class="box pop-box pop-apply">
    <div class="rel">
        <div class="pop-close pop-apply-close"></div>
        <div class="pop-nav pop-message-nav">
            <p>Are you sure you want to delete this conversation?</p>
        </div>
        <div class="pop-bar">
            <a href="#yes" class="pop-bar-btn delete-message-yes">Yes</a> <a href="#no" class="pop-bar-btn pop-btn-no">No</a>
        </div>
    </div>
</div>

<!--Other pop box-->
<div class="box pop-box pop-multi-delete">
    <div class="rel">
        <div class="pop-close pop-apply-close"></div>
        <div class="pop-nav pop-multi-delete-nav">
            <p>Are you sure you want to delete selected conversation(s)?</p>
        </div>
        <div class="pop-bar">
            <a href="#yes" class="pop-bar-btn delete-multi-message-yes">Yes</a> <a href="#no" class="pop-bar-btn pop-btn-no">No</a>
        </div>
    </div>
</div>

<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/inbox.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>