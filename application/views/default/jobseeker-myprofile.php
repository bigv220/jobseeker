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
          <?php if ($interview_num != 0) : ?>
          <a href="<?php echo $site_url; ?>jobseeker/viewInterviews" class="png square_btn view_my_interviews_btn view_my_interviews_btn_current"></a>
          <span class="bubble view_my_interviews_bubble">
              <?php echo $interview_num; ?>
          </span>
        <?php else: ?>
          <a href="<?php echo $site_url; ?>jobseeker/viewInterviews" class="png square_btn view_my_interviews_btn"></a>
        <?php endif; ?>
          <!-- INTERVIEW END -->
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
              <dt>Portfolio<a href="javascript:void(0);" class="edit_jobseeker_profile_link edit_portfolio_link">Edit</a></dt>
              <div class="als-container" id="portfolio_list">
                  <span class="als-prev"><img src="<?php echo $theme_path;?>/style/btns/previous_arrow.png" alt="prev" title="previous" style="display:<?php echo (count($portfolio_projects) < 1 ? 'none':'block'); ?>"/></span>
                  <div class="als-viewport">
                      <div class="profile_portfolios als-wrapper"">
                      <?php if(count($portfolio_projects) > 0):?>
                          <?php for($i=0,$len=count($portfolio_projects); $i < $len; $i++):?>
                              <?php if($i % 6 == 0):?>
                                    <div class="als-item">
                              <?php endif;?>

                                  <?php if($i % 3 == 0):?>
                                        <div class="portfolio_row">
                                  <?php endif;?>
                                      <a href="javascript:void(0);" class="portfolio_item" project-name="<?php echo $portfolio_projects[$i]['name'];?>" project-description="<?php echo $portfolio_projects[$i]['description'];?>" project-id="<?php echo $portfolio_projects[$i]['pid'];?>" file-type="<?php echo $portfolio_projects[$i]['type'];?>" file-url="<?php echo $site_url . 'attached/workExamples/' . $portfolio_projects[$i]['file_url'];?>">
                                          <?php switch($portfolio_projects[$i]['type']){
                                              case 0:
                                                  echo "<img src='" . $theme_path . "style/portfolio/portfolio_text_file.png" ."'/>";
                                                  break;
                                              case 1:
                                                  echo "<img src='" . $site_url . "attached/workExamples/" .$portfolio_projects[$i]['file_url']  ."'/>";
                                                  break;
                                              case 2:
                                                  echo "<img src='" . $theme_path . "style/portfolio/portfolio_audio_file.png" ."'/>";
                                                  break;
                                              case 3:
                                                  echo "<img src='" . $theme_path . "style/portfolio/portfolio_audio_file.png" ."'/>";
                                                  break;
                                              case 4:
                                                  echo "<img src='" . $theme_path . "style/portfolio/portfolio_text_file.png" ."'/>";
                                                  break;
                                              default:
                                                  echo "<img src='" . $theme_path . "style/portfolio/portfolio_text_file.png" ."'/>";
                                                  break;

                                          };?>
                                          <div class="portfolio_caption"><span><?php echo $portfolio_projects[$i]['name'];?></span></div>
                                      </a>
                                  <?php if($i % 3 == 2 || $i == ($len - 1)):?>
                                        <div style="clear:both;"></div>
                                      </div><!-- end of portfolio_row -->
                                  <?php endif;?>

                              <?php if($i % 6 == 5|| $i == ($len - 1)):?>
                                  </div><!-- end of als-item -->
                              <?php endif;?>
                          <?php endfor ?>
                            <?php if($len>3):?>
                          <script type="text/javascript">
                              $(document).ready(function(){
                                  $("#portfolio_list").als({
                                      circular: "no",
                                      //autoscroll: "yes",
                                      visible_items: 1
                                  });
                              });
                          </script>
                      <?php endif;?>
                      <?php else:?>
                          No Projects in Portfolio.
                        <?php endif;?>
                      </div>

                </div>
                <span class="als-next"><img src="<?php echo $theme_path;?>/style/btns/forward_arrow.png" alt="next" title="next"  style="display:<?php echo (count($portfolio_projects) < 1 ? 'none':'block'); ?>"/></span> <!-- "next" button -->
              </div>

          </div>

      <div style="clear:both;"></div>
      </div>

      <div class="company-bd-right  jobseeker-bd-right">
          <dl class="sresult-nav-job-dl">
              <dt>Recently Applied For</dt>
              <dd>
                  <ul class="recent_applied_jobs">
                      <?php foreach($applied_jobs as $job): ?>
                      <li><a href="<?php echo $site_url; ?>job/jobdetails/<?php echo $job['id']; ?>">
                          <?php echo $job['job_name']; ?></a></li>
                      <?php endforeach; ?>
                  </ul>
              </dd>
              <dt>Recently Viewed Companies</dt>
              <dd>
                  <ul class="similar">
                      <li>
                          <?php foreach($viewed_company as $com): ?>
                          <img src="<?php echo $site_url; ?>attached/users/<?php echo $com['profile_pic']?$com['profile_pic']:'no-image.png';?>" width="71px" height="85px" alt="" />
                          <p><a href="<?php echo $site_url; ?>company/companyInfo/<?php echo $com['company_id']; ?>">
                              <?php echo $com['job_name']; ?></a></p>
                          <p><a href="<?php echo $site_url; ?>company/companyInfo/<?php echo $com['company_id']; ?>" class="view_profile_link">
                              View Profile</a></p>
                          <?php endforeach; ?>
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
            <h1>Loading...</h1>
            <p>Loading...</p>
        </div>
        <div class="view_portfolio_body">
            <div class="view_portfolio_content text_style">
                <div class="content_text">
                Loading content...
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

                    </div>
                </div>

            </div>

            <div class="view_portfolio_content image_style" style="display:none;">
                <div class="content_img">
                    <img src="<?php echo $theme_path;?>/style/portfolio/1.jpg"/>
                </div>

            </div>
            <div class="view_portfolio_content other_text_style" style="display:none;">
                <div class="other_text_content">
                    <a href="#" target="_blank">Open/Download this file</a>
                </div>

            </div>

            <div class="view_portfolio_navigator">
                <div class="als-container" id="portfolio_view_bar">
                    <span class="als-prev"><img src="<?php echo $theme_path;?>style/btns/previous_arrow.png" alt="prev" title="previous" /></span>
                    <div class="als-viewport">
                        <ul class="als-wrapper">
                            <?php for($i=0,$len=count($portfolio_projects); $i < $len; $i++):?>
                                <li class="als-item" project-id="<?php echo $portfolio_projects[$i]['pid'];?>" project-name="<?php echo $portfolio_projects[$i]['name'];?>" project-description="<?php echo $portfolio_projects[$i]['description'];?>" file-type="<?php echo $portfolio_projects[$i]['type'];?>" file-url="<?php echo $site_url . 'attached/workExamples/' . $portfolio_projects[$i]['file_url'];?>">
                                    <?php switch($portfolio_projects[$i]['type']){
                                        case 0:
                                            echo "<img src='" . $theme_path . "style/portfolio/edit_txt_file_btn.png" ."'/>";
                                            break;
                                        case 1:
                                            echo "<img src='" . $site_url . "attached/workExamples/" .$portfolio_projects[$i]['file_url']  ."'/>";
                                            break;
                                        case 2:
                                            echo "<img src='" . $theme_path . "style/portfolio/edit_audio_file_btn.png" ."'/>";
                                            break;
                                        case 3:
                                            echo "<img src='" . $theme_path . "style/portfolio/edit_audio_file_btn.png" ."'/>";
                                            break;
                                        case 4:
                                            echo "<img src='" . $theme_path . "style/portfolio/edit_txt_file_btn.png" ."'/>";
                                            break;
                                        default:
                                            echo "<img src='" . $theme_path . "style/portfolio/edit_txt_file_btn.png" ."'/>";
                                            break;

                                    };?>
                                </li>
                            <?php endfor ?>

                        </ul>

                    </div>
                    <span class="als-next"><img src="<?php echo $theme_path;?>style/btns/forward_arrow.png" alt="next" title="next" /></span> <!-- "next" button -->

                </div>
            </div>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#portfolio_view_bar").als({
                    circular: "no",
                    autoscroll: "no",
                    scrolling_items: 1,
                    visible_items: <?php echo count($portfolio_projects)>6?6:count($portfolio_projects);?>
                });
            });
        </script>
        </div>
    </div>
</div>

<div class="edit_portfolio_pop png">
    <div class="edit_portfolio_pop_wrap rel">
        <i class="edit_portfolio_pop_close abs" title="close"></i>
        <b>Portfolio Management</b>
        <div class="edit_portfolio_pop_bd">
            <div class="add_new_portfolio">

                <div><label>Project Name:</label><input name="project_name" id="project_name"/></div>
                <div><label>Project Description:</label><textarea name="project_desc" id="project_desc"></textarea></div>
                <input type="hidden" name="portfolio_file_name" id="portfolio_file_name" value=""/>
                <div>
                    <button id="upload_portfolio_file_btn">Upload a project file</button>
                    <span id="upload_portfolio_file_status_message"></span>
                </div>

                <div><img class="add_portfolio_project_btn" src="<?php echo $theme_path;?>style/reg/save.gif"/></div>

                <script>
                    uploadFile("upload_portfolio_file_btn",'upload_portfolio_file_btn','upload_portfolio_file_status_message','portfolio_file_name');
                </script>
            </div>
            <div class="portfolio_mgmt_list">
                <ul>
                    <?php foreach($portfolio_projects as $project):?>
                        <li><span><?php echo $project['name'];?></span><img project-id="<?php echo $project['pid'];?>" project-file="<?php echo $project['file_url'];?>" class="delete_portfolio_project" src="<?php echo $theme_path;?>style/btns/btn_inbox_multi_delete_off.png"></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--backtop-->
<div class="backtop png"></div>
<?php $this->load->view($front_theme.'/footer-block');?>