<?php $this->load->view($front_theme.'/header-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/jquery.als-1.2.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/portfolio.js"></script>
<link href="<?php echo $theme_path?>js/jplayer/skin/jobseeker/jplayer.jobseeker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $theme_path?>js/jplayer/jquery.jplayer.min.js"></script>
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
          <a href="#" class="png square_btn view_my_interviews_btn"></a>
          <span class="bubble view_my_interviews_bubble">10</span>
         </div>
    </div>
    <div class="company-bd jobseeker-bd">
      <div class="company-bd-left jobseeker-bd-left">
        <dl class="mb30">
          <dt>About me<a href="#" class="edit_jobseeker_profile_link">Edit</a></dt>
          <dd><strong><?php echo $userinfo['description']; ?></strong></dd>
        </dl>
        <dl class="mb30">
          <dt>Industry<a href="#" class="edit_jobseeker_profile_link">Edit</a></dt>
          <dd class="idustry">
            <?php foreach($seekingIndustry as $si): ?>
            <a href="javascript:void(0);"><?php echo $si['industry'];?></a>
          <?php endforeach; ?>
              </dd>
        </dl>
          <dl class="sresult-nav-job-dl">
              <?php foreach($workhistory as $wh): 
                if ($wh['is_stillhere'] == 1):
              ?>
              <dt>Current Employement<a href="#" class="edit_jobseeker_profile_link">Edit</a></dt>
              <dd>
                  <p class="employment_title"><?php echo $wh['company_name']; ?></p>
                  <p class="emploeyment_period"><?php echo $wh['period_time_from'];?> - <?php echo $wh['period_time_to']; ?></p>
                  <p class="employment_description"><?php echo $wh['introduce'];?></p>
              </dd>
            <?php else: ?>
              <dt>Previous Employment<a href="#" class="edit_jobseeker_profile_link">Edit</a></dt>
              <dd>
                  <p class="employment_title"><?php echo $wh['company_name']; ?></p>
                  <p class="emploeyment_period"><?php echo $wh['period_time_from'];?> - <?php echo $wh['period_time_to']; ?></p>
                  <p class="employment_description"><?php echo $wh['introduce'];?></p>
              </dd>
            <?php endif;?>
          <?php endforeach; ?>
              <dt>Personal Skills<a href="#" class="edit_jobseeker_profile_link">Edit</a></dt>
              <dd><?php 
              $str = '';
              foreach($personal_skills as $ps): ?>
                  <?php 
                  $str .= $ps['personal_skill'].', ';
                  ?>
                  <?php endforeach; ?>
                  <?php $str = substr($str, 0, -2);
                   echo $str;?><dd>
              <dt>Technical Skills<a href="#" class="edit_jobseeker_profile_link">Edit</a></dt>
              <dd><?php 
              $str = '';
              foreach($professional_skills as $ps): ?>
                  <?php 
                  $str .= $ps['professional_skill'].', ';
                  ?>
                  <?php endforeach; ?>
                  <?php $str = substr($str, 0, -2);
                   echo $str;?><dd>
              <dt>Language(s)<a href="#" class="edit_jobseeker_profile_link">Edit</a></dt>
              <dd>
                  <?php foreach ($language as $la): ?>
                      <div class="jobseeker_profile_language">
                          <label><?php echo $la['language'];?></label>
                          <i><?php echo $la['level'];?></i>
                      </div>
                  <?php endforeach;?>
              </dd>
          </dl>
          <div class="profile_portfolios_wrapper">
              <dt>Portfolio<a href="#" class="edit_jobseeker_profile_link">Edit</a></dt>
              <div class="als-container" id="portfolio_list">
                  <span class="als-prev"><img src="<?php echo $theme_path;?>/style/btns/previous_arrow.png" alt="prev" title="previous" /></span>
                  <div class="als-viewport">
                      <div class="profile_portfolios als-wrapper"">
                      <div class="als-item">
                          <div class="portfolio_row">
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/1.jpg"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/portfolio_text_file.png"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/portfolio_audio_file.png"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <div style="clear:both;"></div>
                          </div>
                          <div class="portfolio_row">
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/1.jpg"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/portfolio_text_file.png"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/portfolio_audio_file.png"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <div style="clear:both;"></div>
                          </div>

                      </div>

                      <div class="als-item">
                          <div class="portfolio_row">
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/1.jpg"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/portfolio_text_file.png"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/portfolio_audio_file.png"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <div style="clear:both;"></div>
                          </div>
                          <div class="portfolio_row">
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/1.jpg"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/portfolio_text_file.png"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/portfolio_audio_file.png"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <div style="clear:both;"></div>
                          </div>

                      </div>

                      <div class="als-item">
                          <div class="portfolio_row">
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/1.jpg"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/portfolio_text_file.png"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/portfolio_audio_file.png"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <div style="clear:both;"></div>
                          </div>
                          <div class="portfolio_row">
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/1.jpg"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/portfolio_text_file.png"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <a href="javascript:void(0);" class="portfolio_item">
                                  <img src="<?php echo $theme_path;?>/style/portfolio/portfolio_audio_file.png"/>
                                  <div class="portfolio_caption"><span>Project Name</span></div>
                              </a>
                              <div style="clear:both;"></div>
                          </div>

                      </div>

                      </div>

                </div>
                <span class="als-next"><img src="<?php echo $theme_path;?>/style/btns/forward_arrow.png" alt="next" title="next" /></span> <!-- "next" button -->
              </div>

          </div>
          <script type="text/javascript">
              $(document).ready(function(){
                  $("#portfolio_list").als({
                      circular: "yes",
                      //autoscroll: "yes",
                      visible_items: 1
                  });
              });
          </script>
      </div>

      <div class="company-bd-right  jobseeker-bd-right">
          <dl class="sresult-nav-job-dl">
              <dt>Recently Applied For</dt>
              <dd>
                  <ul class="recent_applied_jobs">
                      <li><a href="#">Admin Assistant</a></li>
                      <li><a href="#">UI Designer</a></li>
                      <li><a href="#">UI Designer</a></li>
                  </ul>
              </dd>
              <dt>Recently Viewed Companies</dt>
              <dd>
                  <ul class="similar">
                      <li><img src="<?php echo $theme_path.'style/home/temp/sponsors3.gif';?>" alt="" />
                          <p><a href="#">Company Name Here</a></p>
                          <p><a href="#" class="view_profile_link">View Profile</a></p>
                      </li>
                      <li><img src="<?php echo $theme_path.'style/home/temp/sponsors3.gif';?>" alt="" />
                          <p><a href="#">Company Name Here</a></p>
                          <p><a href="#" class="view_profile_link">View Profile</a></p>
                      </li>
                      <li><img src="<?php echo $theme_path.'style/home/temp/sponsors3.gif';?>" alt="" />
                          <p><a href="#">Company Name Here</a></p>
                          <p><a href="#" class="view_profile_link">View Profile</a></p>
                      </li>
                  </ul>
              </dd>
              <dt>Birthday<a href="#" class="edit_jobseeker_profile_link">Edit</a></dt>
              <dd>
                  <p class="jobseeker_birthday"><?php echo date("F j Y",strtotime($userinfo['birthday'])); ?></p>
              </dd>
              <dt>Education<a href="#" class="edit_jobseeker_profile_link">Edit</a></dt>
              <dd>
                  <?php foreach($education_info as $ei): ?>
                  <p class="school_name"><?php echo $ei['school_name'];?></p>
                  <?php if(!empty($ei['degree'])): ?>
                     <p class="school_major"><?php echo $ei['degree'];?>,  <?php echo $ei['major']; ?></p>
                     <p class="school_major"><?php echo $ei['achievements'];?></p>
                  <?php endif; ?>
                  <p class="school_period"><?php echo $ei['attend_date_from'];?> - <?php echo $ei['attend_date_to'];?></p>
                  <?php endforeach; ?>
              </dd>
              <dt>Elsewhere on Web<a href="#" class="edit_jobseeker_profile_link">Edit</a></dt>
              <dd>

                  <?php if (!empty($userinfo['twitter'])): ?>
                    <p><a href="http://twitter.com/$userinfo['twitter']" target="_blank">Twitter</a></p>
                  <?php endif; ?>
                  <?php if (!empty($userinfo['linkedin'])): ?>
                  <p><a href="#">Linkedin</a></p>
                  <?php endif; ?>
                  <?php if (!empty($userinfo['facebook'])):?>
                  <p><a href="<?php echo $userinfo['facebook']?>">Facebook</a></p>
                  <?php endif;?>
                  <?php if (!empty($userinfo['linkedin'])):?>
                  <p><a href="<?php echo $userinfo['linkedin']?>">Linkedin</a></p>
                  <?php endif;?>
                  <?php if (!empty($userinfo['weibo'])):?>
                  <p><a href="<?php echo $userinfo['weibo']?>">Weibo</a></p>
                  <?php endif;?>
                  <?php if (!empty($userinfo['personal_website'])): ?>
                  <p><a href="http://<?php echo $userinfo['personal_website']; ?>" target="_blank">Personal Website</a></p>
                <?php endif; ?>

              </dd>

              <dt>Phone<a href="#" class="edit_jobseeker_profile_link">Edit</a></dt>
              <dd><p class="phone_number"><?php echo $userinfo['phone']; ?></p></dd>
              <dd class="industry">
                  <ul class="industry-ul">
                  	<!-- 
                      <li class="n3"><b>Visa Assistance</b><span>
                        <?php if(empty($userinfo['is_visa_assistance'])): ?>Visa will be provided
                        <?php else: ?>
                        No Visa
                        <?php endif; ?></span></li>
                      <li class="n4"><b>Housing Assistance</b><span>
                        <?php if(empty($userinfo['is_visa_assistance'])): ?>Accomodation will be provided
                        <?php else: ?>
                        No Accomodation
                        <?php endif; ?></span>
                      </li>
                      -->
                      <li class="n1"><b>Type of Employment</b><span>
                        <?php echo str_replace(",", ", ", $userinfo['employment_type']); ?></span></li>
                      <li class="n2"><b>Length of Employment</b><span>
                      <?php echo getEmploymentLengthByID($userinfo['employment_length']) ?></span></li>
                  </ul>
              </dd>
              <!-- <dt>Similar to people <?php echo $userinfo['first_name']; ?></dt>
              <dd>
                  <div class="similar_people">
                      <?php foreach ($similar_peoples as $sp): ?>
                      <a href="#">
                          <div class="similar_people_row">

                                  <div class="people_icon">
                                      <img src="<?php echo $theme_path?>style/home/temp/temp-h2.gif">
                                      <i class="mask"></i>
                                  </div>
                                  <div class="people_description">
                                      <div><?php echo $sp['first_name'].' '.$sp['last_name']; ?></div>
                                      <p><?php echo $sp['description']; ?></p>
                                  </div>
                                <div class="clearfix"></div>

                          </div>
                      </a>
                    <?php endforeach; ?>                      
                  </div>

              </dd> -->
          </dl>
      </div>
    </div>
  </div>
</div>

<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>
<div class="view_portfolio_pop png">
    <div class="view_portfolio_pop_wrap rel">
        <i class="view_portfolio_pop_close abs" title="close"></i>
        <div class="view_portfolio_header">
            <h1>Project Name</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <div class="view_portfolio_body">
            <div class="view_portfolio_content text_style">
                <div class="content_text">
                Lorem ipsum dolor sit amet

                consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC
                "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"
                1914 translation by H. Rackham
                "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"
                Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC
                "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."
                1914 translation by H. Rackham
                "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."

                </div>
                <div class="font_zoom_bar">
                    <img class="zoom_in" src="<?php echo $theme_path;?>/style/portfolio/btn_zoom_in.png" alt="prev" title="previous" />
                    <img class="zoom_out" src="<?php echo $theme_path;?>/style/portfolio/btn_zoom_out.png" alt="prev" title="previous" />
                </div>
            </div>
            <div class="view_portfolio_content audio_style" style="display:none;">
                <div class="content_audio">
                    <div class="audio_icon"><img class="zoom_out" src="<?php echo $theme_path;?>/style/portfolio/audio_icon.png"/></div>
                    <div class="jplayer_wrapper">
                        <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                        <div id="jp_container_1" class="jp-audio">
                            <div class="jp-type-single">
                                <div class="jp-gui jp-interface">
                                    <ul class="jp-controls">
                                        <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                                        <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                                        <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
                                        <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                                        <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                                        <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
                                    </ul>
                                    <div class="jp-progress">
                                        <div class="jp-seek-bar">
                                            <div class="jp-play-bar"></div>
                                        </div>
                                    </div>
                                    <div class="jp-volume-bar">
                                        <div class="jp-volume-bar-value"></div>
                                    </div>
                                    <div class="jp-time-holder">
                                        <div class="jp-current-time"></div>
                                        <div class="jp-duration"></div>

                                    </div>
                                </div>

                                <div class="jp-no-solution">
                                    <span>Update Required</span>
                                    To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            //<![CDATA[
                            $(document).ready(function(){

                                $("#jquery_jplayer_1").jPlayer({
                                    ready: function (event) {
                                        $(this).jPlayer("setMedia", {
                                            m4a:"http://www.jplayer.org/audio/m4a/TSP-01-Cro_magnon_man.m4a",
                                            oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg"
                                        });
                                    },
                                    swfPath: "js",
                                    supplied: "m4a, oga",
                                    wmode: "window",
                                    smoothPlayBar: true,
                                    keyEnabled: true
                                });
                            });
                            //]]>
                        </script>
                    </div>
                </div>

            </div>

            <div class="view_portfolio_content image_style" style="display:none;">
                <div class="content_img">
                    <img src="<?php echo $theme_path;?>/style/portfolio/1.jpg"/>
                </div>

            </div>

            <div class="view_portfolio_navigator">
                <div class="als-container" id="portfolio_view_bar">
                    <span class="als-prev"><img src="<?php echo $theme_path;?>/style/btns/previous_arrow.png" alt="prev" title="previous" /></span>
                    <div class="als-viewport">
                        <ul class="als-wrapper">
                            <li class="als-item current"><img src="<?php echo $theme_path;?>/style/portfolio/edit_txt_file_btn.png"/></li>
                            <li class="als-item"><img src="<?php echo $theme_path;?>/style/portfolio/edit_audio_file_btn.png"/></li>
                            <li class="als-item"><img src="<?php echo $theme_path;?>/style/portfolio/edit_audio_file_btn.png"/></li>
                            <li class="als-item"><img src="<?php echo $theme_path;?>/style/portfolio/edit_txt_file_btn.png"/></li>
                            <li class="als-item"><img src="<?php echo $theme_path;?>/style/portfolio/edit_audio_file_btn.png"/></li>
                            <li class="als-item"><img src="<?php echo $theme_path;?>/style/portfolio/edit_audio_file_btn.png"/></li>
                            <li class="als-item"><img src="<?php echo $theme_path;?>/style/portfolio/edit_txt_file_btn.png"/></li>
                            <li class="als-item"><img src="<?php echo $theme_path;?>/style/portfolio/edit_audio_file_btn.png"/></li>
                            <li class="als-item"><img src="<?php echo $theme_path;?>/style/portfolio/edit_audio_file_btn.png"/></li>
                            <li class="als-item"><img src="<?php echo $theme_path;?>/style/portfolio/edit_txt_file_btn.png"/></li>
                            <li class="als-item"><img src="<?php echo $theme_path;?>/style/portfolio/edit_audio_file_btn.png"/></li>
                            <li class="als-item"><img src="<?php echo $theme_path;?>/style/portfolio/edit_audio_file_btn.png"/></li>
                        </ul>

                    </div>
                    <span class="als-next"><img src="<?php echo $theme_path;?>/style/btns/forward_arrow.png" alt="next" title="next" /></span> <!-- "next" button -->

                </div>
            </div>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#portfolio_view_bar").als({
                    circular: "yes",
                    autoscroll: "no",
                    scrolling_items: 1,
                    visible_items: 6
                });
            });
        </script>
        </div>
    </div>
</div>
<!--backtop-->
<div class="backtop png"></div>
<?php $this->load->view($front_theme.'/footer-block');?>