<?php $this->load->view($front_theme.'/header-block');?>

<!--company login page body-->
<div class="company-page w770 clearfix rel">
  <div class="company-body box rel mb5">
    <div class="company-hd jobseeker-hd rel">
        <?php if (false &&!empty($userinfo['profile_pic'])): 
        $pic = $site_url.'attached/users/'.$this->session->userdata('uid').'/'.$userinfo['profile_pic'];
        ?>
        <i class="abs face png"><img src="<?php echo $pic; ?>" alt="" width="128px" height="128px"/></i>
        <?php else: ?>
        <i class="abs face png"></i>
        <?php endif; ?>
      <div class="text">
        <h2><?php echo $userinfo['first_name'].' '.$userinfo['last_name']; ?></h2>
        <h4><?php echo $userinfo['city'].', '.$userinfo['country']; ?></h4>
        <p><!--Online now--></p>
      </div>
      <div class="btnarea">
          <a href="#" class="png combo_btns view_profile"></a>
          <a href="#" class="png combo_btns start_jingchat "></a>
          <a href="#" class="png combo_btns shorlist_candidate"></a>
          <a href="#" class="png combo_btns request_interview"></a> </div>
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
                  <span class="required"> <b><?php echo $la['language'];?></b> <i><?php echo $la['level'];?></i> </span>
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
                  <p><a href="#">Twitter</a></p>
                  <p><a href="#">Facebook</a></p>
                  <p><a href="#">Pinterest</a></p>
                  <p><a href="#">Personal Website</a></p>
              </dd>

              <dt>Phone</dt>
              <dd><p class="phone_number"><?php echo $userinfo['phone']; ?></p></dd>
              <dd class="industry">
                  <ul class="industry-ul">
                      <li class="n3"><b>Visa Assistance</b><span>
                        <?php if(empty($userinfo['is_visa_assistance'])): ?>Visa will be provided
                        <?php else: ?>
                        No Visa
                        <?php endif; ?></span></li>
                      <li class="n4"><b>Housing Assistance</b><span>
                        <?php if(empty($userinfo['is_visa_assistance'])): ?>Accomodation will be provided
                        <?php else: ?>
                        No Accomodation
                        <?php endif; ?></span></li>
                      <li class="n1"><b>Type of Employment</b><span>
                        <?php switch($userinfo['employment_type']){
                              case 1:
                                echo "Contract";
                                break;
                              case 2:
                                echo "Part Time";
                                break;
                              case 3:
                                echo "Full Time";
                                break;
                              case 4:
                                echo "Internship";
                                break;
                              case 5:
                                echo "Any";
                                break;
                              default:
                                echo "Any";
                                break;  
                         }; ?></span></li>
                      <li class="n2"><b>Length of Employment</b><span>
                      <?php switch($userinfo['employment_length']){
                              case 1:
                                echo "Long term employment (1+ years)";
                                break;
                              case 2:
                                echo "Short term employment (-1 years)";
                                break;
                              case 3:
                                echo "No preference";
                                break;
                              default:
                                echo "No preference";
                                break;  
                         }; ?></span></li>
                  </ul>
              </dd>
              <dt>Similar to people <?php echo $userinfo['first_name']; ?></dt>
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

              </dd>
          </dl>
      </div>
    </div>
  </div>
</div>

<!-- Our Partners -->
<div class="partners w70">
  <div class="puartners-tit">Our Partners</div>
  <div class="puartners-nav">
    <ul class="puartners-ul zoom">
      <li><a href="#"><img src="<?php echo $theme_path?>style/company/partners.png" alt="" width="176" height="103" /></a></li>
      <li><a href="#"><img src="<?php echo $theme_path?>style/company/partners.png" alt="" width="176" height="103" /></a></li>
      <li><a href="#"><img src="<?php echo $theme_path?>style/company/partners.png" alt="" width="176" height="103" /></a></li>
      <li><a href="#"><img src="<?php echo $theme_path?>style/company/partners.png" alt="" width="176" height="103" /></a></li>
    </ul>
  </div>
</div>

<!--backtop-->
<div class="backtop png"></div>
<?php $this->load->view($front_theme.'/footer-block');?>