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
      <div class="text_wrapper">
        <h2><?php echo $userinfo['first_name'].' '.$userinfo['last_name']; ?></h2>
        <h4><?php echo $userinfo['city'].', '.$userinfo['country']; ?></h4>
        <p><!--Online now--></p>
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
          <dt>About me</dt>
          <dd><strong><?php echo $userinfo['description']; ?></strong></dd>
        </dl>
        <dl class="mb30">
          <dt>Industry</dt>
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
              <dt>Current Employement</dt>
              <dd>
                  <p class="employment_title"><?php echo $wh['company_name']; ?></p>
                  <p class="emploeyment_period"><?php echo $wh['period_time_from'];?> - <?php echo $wh['period_time_to']; ?></p>
                  <p class="employment_description"><?php echo $wh['introduce'];?></p>
              </dd>
            <?php else: ?>
              <dt>Previous Employment</dt>
              <dd>
                  <p class="employment_title"><?php echo $wh['company_name']; ?></p>
                  <p class="emploeyment_period"><?php echo $wh['period_time_from'];?> - <?php echo $wh['period_time_to']; ?></p>
                  <p class="employment_description"><?php echo $wh['introduce'];?></p>
              </dd>
            <?php endif;?>
          <?php endforeach; ?>
              <dt>Personal Skills</dt>
              <dd><?php 
              $str = '';
              foreach($personal_skills as $ps): ?>
                  <?php 
                  $str .= $ps['personal_skill'].', ';
                  ?>
                  <?php endforeach; ?>
                  <?php $str = substr($str, 0, -2);
                   echo $str;?><dd>
              <dt>Technical Skills</dt>
              <dd><?php 
              $str = '';
              foreach($professional_skills as $ps): ?>
                  <?php 
                  $str .= $ps['professional_skill'].', ';
                  ?>
                  <?php endforeach; ?>
                  <?php $str = substr($str, 0, -2);
                   echo $str;?><dd>
              <dt>Language(s)</dt>
              <dd>
                  <?php foreach ($language as $la): ?>
                      <div class="jobseeker_profile_language">
                          <label><?php echo $la['language'];?></label>
                          <i><?php echo $la['level'];?></i>
                      </div>
                  <?php endforeach;?>
              </dd>
          </dl>
      </div>

      <div class="company-bd-right  jobseeker-bd-right">
          <dl class="sresult-nav-job-dl">
              <dt>Birthday</dt>
              <dd>
                  <p class="jobseeker_birthday"><?php echo date("F j Y",strtotime($userinfo['birthday'])); ?></p>
              </dd>
              <dt>Education</dt>
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
              <dt>Elsewhere on Web</dt>
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

              <dt>Phone</dt>
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

<!--backtop-->
<div class="backtop png"></div>
<?php $this->load->view($front_theme.'/footer-block');?>