<?php 
$id=0;
$seq = 0;
                         if (!empty($msg_detail)):
                                  foreach($msg_detail as $detail): 
                                     $seq = $detail['seq'];
                                     $id = $detail['id'];?>
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
                                
                                    