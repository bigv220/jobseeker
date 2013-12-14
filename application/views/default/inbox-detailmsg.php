<?php 
$seq = 0;                         if (!empty($msg_detail)):
                                  foreach($msg_detail as $detail): 
                                     $seq = $detail['seq'];
                                   $id?>
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
                                  <input type="hidden" id="msg_id" value="<?php echo $detail['id']; ?>"/>
                                <input type="hidden" id="seq" value="<?php echo $seq; ?>"/>
                                <input type="hidden" id="user2" value="<?php echo $detail['user2']; ?>"/>
                                <?php endif; ?>
                                    