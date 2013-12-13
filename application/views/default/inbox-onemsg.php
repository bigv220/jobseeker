<div class="jingchat_message_row_me">
                                      <div class="jingchat_message_content">
                                          <img src="<?php echo $theme_path?>style/jingchat/me_jingchat_message_leftarrow.png" class="message_avatar_arrow"/>
                                          <div class="other_message_top"></div>
                                          <div class="other_message_content">
                                              <p class="sent_time"><?php echo time_elapsed_string($timestamp+1); ?></p>
                                              <p>
                                                  <?php echo $message; ?>
                                              </p>
                                          </div>
                                          <div class="other_message_bottom"></div>
                                      </div>
                                      <div class="jingchat_message_icon">
                                          <img src="<?php echo $site_url.'attached/users/'.$userinfo['profile_pic'];?>" alt=""/>
                                      </div>
                                      <div style="clear:both;"></div>
                                  </div>