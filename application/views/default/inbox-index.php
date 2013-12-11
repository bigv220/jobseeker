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
          <a href="#" class="png square_btn jingchat_inbox_btn jingchat_inbox_btn_current"></a>
          <span class="bubble jingchat_inbox_bubble">2</span>
          <a href="#" class="png square_btn saved_bookmarks_btn"></a>
          <a href="#" class="png square_btn view_my_interviews_btn"></a>
         </div>
    </div>
    <div class="inbox_content">
        <div class="inbox_multi_actions_bar">
            <img src="<?php echo $theme_path;?>/style/btns/btn_inbox_multi_edit_on.png" alt=""/>
            <img src="<?php echo $theme_path;?>/style/btns/btn_inbox_multi_delete_on.png" alt=""/>
        </div>
      <div class="sresult-tab-hd">
          <span class="fxui-tab-tit">JingChat</span>
          <span class="fxui-tab-tit">Sent</span>
          <span class="fxui-tab-tit">Trash</span>
      </div>
      <div class="sresult-tab-bd zoom">
          <div class="fxui-tab-nav">
              <div class="inbox_wrapper">
                  <div class="inbox_overview_list">
                      <?php foreach($messages as $msg): 
                      $id = $msg['id'];
                      $user2 = $msg['user1'];
                      ?>
                      <div class="inbox_overview_row" data-id='<?php echo $msg['id']; ?>'>
                          <div class="email_select_checkbox">
                              <input id="email_checkbox_1" value="1" class="kyo-checkbox" style="display:none;"/>
                              <i class="kyo-checkbox" data-id="email_checkbox_1" data-val="0"></i>
                          </div>
                          <div class="sender_avatar">
                              <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="50px" height="50px" class="round_img_border3"/>
                          </div>
                          <div class="email_short_description">
                              <div class="received_date">Yesterday</div>
                              <div class="from_name"><?php echo $msg['first_name']; ?> <?php echo $msg['last_name']; ?></div>
                              <div class="email_subject"><?php echo $msg['title']; ?></div>
                              <div class="email_actions_bar">
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_reply.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_delete.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_jingchat_online_icon.png" alt=""/>
                              </div>
                          </div>
                          <div style="clear:both;"></div>
                      </div>
                      <?php endforeach; ?>
                      
                  </div>
                  <div class="jingchat_log_content">

                      <div class="jingchat_wrapper">
                          <div class="jingchat_messages">
                              <div class="load_older_message">
                                  Load older messages
                              </div>
                              <div class="jingchat_messages_bd">
                                  <?php 
                                  if (!empty($msg_detail)):
                                  foreach($msg_detail as $detail): ?>
                                  <div class="<?php if ($detail['user1'] == $uid) echo "jingchat_message_row_me"; else echo "jingchat_message_row_other"; ?>">
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
                          </div>
                          <input type="hidden" id="msg_id" value="<?php echo $id; ?>"/>
                          <input type="hidden" id="user2" value="<?php echo $user2; ?>"/>
                          <div class="jingchat_message_input">
                              <textarea id="message" rows="3" cols="" class="input-tip" data-tipval="Type your message here">Type your message here</textarea>
                          </div>
                      </div>
                  </div>
                  <div style="clear:both;"></div>
              </div>
          </div>
          <div class="fxui-tab-nav">
              <div class="jingchatlog_wrapper">
              <div class="inbox_overview_list">
                   <?php foreach($send_messages as $msg): 
                      $id = $msg['id'];
                      $user2 = $msg['user1'];
                      ?>
                      <div class="inbox_overview_row" data-id='<?php echo $msg['id']; ?>'>
                          <div class="email_select_checkbox">
                              <input id="email_checkbox_1" value="1" class="kyo-checkbox" style="display:none;"/>
                              <i class="kyo-checkbox" data-id="email_checkbox_1" data-val="0"></i>
                          </div>
                          <div class="sender_avatar">
                              <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="50px" height="50px" class="round_img_border3"/>
                          </div>
                          <div class="email_short_description">
                              <div class="received_date">Yesterday</div>
                              <div class="from_name"><?php echo $userinfo['first_name']; ?> <?php echo $userinfo['last_name']; ?></div>
                              <div class="email_subject"><?php echo $msg['message']; ?></div>
                              <div class="email_actions_bar">
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_reply.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_delete.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_jingchat_online_icon.png" alt=""/>
                              </div>
                          </div>
                          <div style="clear:both;"></div>
                      </div>
                      <?php endforeach; ?>
              </div>
                  <div class="jingchat_log_content">

                      <div class="jingchat_wrapper">
                          <div class="jingchat_messages">
                              <div class="load_older_message">
                                  Load older messages
                              </div>
                              <div class="jingchat_messages_bd">
                                  <div class="jingchat_message_row_me">
                                      <div class="jingchat_message_content">
                                          <img src="<?php echo $theme_path?>style/jingchat/me_jingchat_message_leftarrow.png" class="message_avatar_arrow"/>
                                          <div class="other_message_top"></div>
                                          <div class="other_message_content">
                                              <p class="sent_time">3 hours ago</p>
                                              <p>
                                                  This is the message content send to me from other people. this is the message content send to me from other people.
                                                  this is the message content send to
                                              </p>
                                          </div>
                                          <div class="other_message_bottom"></div>
                                      </div>
                                      <div class="jingchat_message_icon">
                                          <img src="<?php echo $theme_path?>style/search/job-img1.gif" alt=""/>
                                      </div>
                                      <div style="clear:both;"></div>
                                  </div>
                                  <div class="jingchat_message_row_other">
                                      <div class="jingchat_message_content">
                                          <img src="<?php echo $theme_path?>style/jingchat/other_jingchat_message_rightarrow.png" class="message_avatar_arrow"/>
                                          <div class="other_message_top"></div>
                                          <div class="other_message_content">
                                              <p class="sent_time">3 hours ago</p>
                                              <p>
                                              This is the message content send to me from other people. this is the message content send to me from other people.
                                              this is the message content send to me from other people. this is the message content send to me from other people.
                                              </p>
                                          </div>
                                          <div class="other_message_bottom"></div>
                                      </div>
                                      <div class="jingchat_message_icon">
                                          <img src="<?php echo $theme_path?>style/search/job-img1.gif" alt=""/>
                                      </div>
                                      <div style="clear:both;"></div>
                                  </div>
                                  <div class="jingchat_message_row_other">
                                      <div class="jingchat_message_content">
                                          <img src="<?php echo $theme_path?>style/jingchat/other_jingchat_message_rightarrow.png" class="message_avatar_arrow"/>
                                          <div class="other_message_top"></div>
                                          <div class="other_message_content">
                                              <p class="sent_time">3 hours ago</p>
                                              <p>
                                                  This is the message content send to me from other people. this is the message content send to me from other people.
                                                  this is the message content send to me from other people. this is the message content send to me from other people.
                                              </p>
                                          </div>
                                          <div class="other_message_bottom"></div>
                                      </div>
                                      <div class="jingchat_message_icon">
                                          <img src="<?php echo $theme_path?>style/search/job-img1.gif" alt=""/>
                                      </div>
                                      <div style="clear:both;"></div>
                                  </div>

                                  <div class="jingchat_message_row_me">
                                      <div class="jingchat_message_content">
                                          <img src="<?php echo $theme_path?>style/jingchat/me_jingchat_message_leftarrow.png" class="message_avatar_arrow"/>
                                          <div class="other_message_top"></div>
                                          <div class="other_message_content">
                                              <p class="sent_time">3 hours ago</p>
                                              <p>
                                                  This is the message content send to me from other people. this is the message content send to me from other people.
                                                  this is the message content send to
                                              </p>
                                          </div>
                                          <div class="other_message_bottom"></div>
                                      </div>
                                      <div class="jingchat_message_icon">
                                          <img src="<?php echo $pic; ?>" alt=""/>
                                      </div>
                                      <div style="clear:both;"></div>
                                  </div>

                              </div>
                          </div>

                          <div class="jingchat_message_input">
                              <textarea rows="3" cols="" class="input-tip" data-tipval="Type your message here">Type your message here</textarea>
                          </div>
                      </div>
                  </div>
                  <div style="clear:both;"></div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/inbox.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>