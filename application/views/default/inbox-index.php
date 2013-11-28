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
          <span class="fxui-tab-tit">Inbox</span>
          <span class="fxui-tab-tit">JingChat Log</span>
      </div>
      <div class="sresult-tab-bd zoom">
          <div class="fxui-tab-nav">
              <div class="inbox_wrapper">
                  <div class="inbox_overview_list">
                      <div class="inbox_overview_row inbox_overview_row_current">
                          <div class="email_select_checkbox">
                              <input id="email_checkbox_1" value="1" class="kyo-checkbox" style="display:none;"/>
                              <i class="kyo-checkbox" data-id="email_checkbox_1" data-val="0"></i>
                          </div>
                          <div class="sender_avatar">
                              <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="50px" height="50px" class="round_img_border3"/>
                          </div>
                          <div class="email_short_description">
                              <div class="received_date">Yesterday</div>
                              <div class="from_name">Redstar Works</div>
                              <div class="email_subject">Job oppotunity for you</div>
                              <div class="email_actions_bar">
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_reply.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_delete.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_jingchat_online_icon.png" alt=""/>
                              </div>
                          </div>
                          <div style="clear:both;"></div>
                      </div>

                      <div class="inbox_overview_row">
                          <div class="email_select_checkbox">
                              <input id="email_checkbox_1" value="1" class="kyo-checkbox" style="display:none;"/>
                              <i class="kyo-checkbox" data-id="email_checkbox_1" data-val="0"></i>
                          </div>
                          <div class="sender_avatar">
                              <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="50px" height="50px" class="round_img_border3"/>
                          </div>
                          <div class="email_short_description">
                              <div class="received_date">Yesterday</div>
                              <div class="from_name">Redstar Works</div>
                              <div class="email_subject">Job oppotunity for you</div>
                              <div class="email_actions_bar">
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_reply.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_delete.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_jingchat_online_icon.png" alt=""/>
                              </div>
                          </div>
                          <div style="clear:both;"></div>
                      </div>

                      <div class="inbox_overview_row">
                          <div class="email_select_checkbox">
                              <input id="email_checkbox_1" value="1" class="kyo-checkbox" style="display:none;"/>
                              <i class="kyo-checkbox" data-id="email_checkbox_1" data-val="0"></i>
                          </div>
                          <div class="sender_avatar">
                              <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="50px" height="50px" class="round_img_border3"/>
                          </div>
                          <div class="email_short_description">
                              <div class="received_date">Yesterday</div>
                              <div class="from_name">Redstar Works</div>
                              <div class="email_subject">Job oppotunity for you</div>
                              <div class="email_actions_bar">
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_reply.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_delete.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_jingchat_offline_icon.png" alt=""/>
                              </div>
                          </div>
                          <div style="clear:both;"></div>
                      </div>

                      <div class="inbox_overview_row">
                          <div class="email_select_checkbox">
                              <input id="email_checkbox_1" value="1" class="kyo-checkbox" style="display:none;"/>
                              <i class="kyo-checkbox" data-id="email_checkbox_1" data-val="0"></i>
                          </div>
                          <div class="sender_avatar">
                              <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="50px" height="50px" class="round_img_border3"/>
                          </div>
                          <div class="email_short_description">
                              <div class="received_date">Yesterday</div>
                              <div class="from_name">Redstar Works</div>
                              <div class="email_subject">Job oppotunity for you</div>
                              <div class="email_actions_bar">
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_reply.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_delete.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_jingchat_offline_icon.png" alt=""/>
                              </div>
                          </div>
                          <div style="clear:both;"></div>
                      </div>

                      <div class="inbox_overview_row">
                          <div class="email_select_checkbox">
                              <input id="email_checkbox_1" value="1" class="kyo-checkbox" style="display:none;"/>
                              <i class="kyo-checkbox" data-id="email_checkbox_1" data-val="0"></i>
                          </div>
                          <div class="sender_avatar">
                              <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="50px" height="50px" class="round_img_border3"/>
                          </div>
                          <div class="email_short_description">
                              <div class="received_date">Yesterday</div>
                              <div class="from_name">Redstar Works</div>
                              <div class="email_subject">Job oppotunity for you</div>
                              <div class="email_actions_bar">
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_reply.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_delete.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_jingchat_offline_icon.png" alt=""/>
                              </div>
                          </div>
                          <div style="clear:both;"></div>
                      </div>

                      <div class="inbox_overview_row">
                          <div class="email_select_checkbox">
                              <input id="email_checkbox_1" value="1" class="kyo-checkbox" style="display:none;"/>
                              <i class="kyo-checkbox" data-id="email_checkbox_1" data-val="0"></i>
                          </div>
                          <div class="sender_avatar">
                              <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="50px" height="50px" class="round_img_border3"/>
                          </div>
                          <div class="email_short_description">
                              <div class="received_date">Yesterday</div>
                              <div class="from_name">Redstar Works</div>
                              <div class="email_subject">Job oppotunity for you</div>
                              <div class="email_actions_bar">
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_reply.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_email_delete.png" alt=""/>
                                  <img src="<?php echo $theme_path;?>/style/btns/btn_jingchat_online_icon.png" alt=""/>
                              </div>
                          </div>
                          <div style="clear:both;"></div>
                      </div>
                  </div>
                  <div class="inbox_mail_content">
                      <div class="inbox_detail_header">
                        <p><label>From:</label><span>Redstar Works</span></p>
                          <p><label>Subject:</label><span>Job opportunity for you</span></p>
                          <p><label>Date:</label><span>August 29,2013 4:48:48 PM GMT+08:00</span></p>
                      </div>
                      <div class="inbox_detail_content">
                          <p>
                              Hi Sophie,<br/>
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br/>
                              Thanks,<br/>
                              Emma Lu<br/>
                          </p>
                      </div>
                  </div>
                  <div style="clear:both;"></div>
              </div>
          </div>
          <div class="fxui-tab-nav">
            sdfsdfsdfsdfsfa
          </div>
      </div>
    </div>
  </div>
</div>

<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>