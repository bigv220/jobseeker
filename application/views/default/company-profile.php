<?php $this->load->view($front_theme.'/header-block');?>

<!--company login page body-->
<div class="company-page w770 clearfix rel">
  <div class="company-body box rel mb5">
    <div class="company-hd rel"> 
    	<div class="people_icon">
    		<img src="<?php echo $site_url.'attached/users/'.$info['profile_pic']?>" alt="" width="128px" height="128px"/>
    		<i class="abs face png" ></i>
    	</div>
      <div class="text_wrapper">
        <h2><?php echo $info['first_name'];?></h2>
        <h4><?php echo $info['city'].', '.$info['country'];?></h4>
        <p></p>
      </div>
      <div class="btnarea">
          <a href="<?php echo $site_url?>jobseeker/register" class="png square_btn edit_profile_btn"></a>
          <?php if ($chat_unread != 0) : ?>
          <a href="<?php echo $site_url.'inbox'; ?>" class="png square_btn jingchat_inbox_btn"></a>
          <span class="bubble jingchat_inbox_bubble"><?php echo $chat_unread; ?></span>
          <?php else: ?>
          <a href="<?php echo $site_url.'inbox'; ?>" class="png square_btn jingchat_inbox_btn"></a>
          <?php endif; ?>
          <?php if ($info['user_type'] == 0): ?>
          <a href="<?php echo $site_url; ?>jobseeker/savedBookmarks" class="png square_btn saved_bookmarks_btn"></a>
          <?php else: ?>
          <a href="<?php echo $site_url; ?>company/shortlistCandidates" class="png square_btn view_my_candidates_btn"></a>
          <?php endif; ?>
          <!-- INTERVIEW START -->
          <?php if ($interview_num != 0) : ?>
          <a href="<?php echo $site_url; ?>jobseeker/viewInterviews" class="png square_btn view_my_interviews_btn"></a>
          <span class="bubble view_my_interviews_bubble">
              <?php echo $interview_num; ?>
          </span>
          <?php else: ?>
          <a href="<?php echo $site_url; ?>jobseeker/viewInterviews" class="png square_btn view_my_interviews_btn"></a>
          <?php endif; ?>
          <!-- INTERVIEW END -->
         </div>
    </div>
    <div class="company-bd">
      <div class="company-bd-left">
        <dl class="mb30">
          <dt>About <?php echo $info['first_name'];?></dt>
          <dd><strong><?php echo $info['description'];?></strong></dd>
        </dl>
        <dl class="mb30">
          <dt>Industry </dt>
          <dd class="idustry">
          <?php foreach ($industries as $industry):?>
            <a href="#"><?php echo $industry['industry']; ?></a> 
          <?php endforeach; ?>
          </dd>
        </dl>
        <dl>
          <dt>Phone </dt>
          <dd><strong><?php if ($info['country'] =='China'): ?> (+86) <?php else: ?> (+1) <?php endif; ?> <?php echo $info['phone']; ?></strong></dd>
        </dl>
      </div>
      <div class="company-bd-right">
        <dl class="mb20">
          <dt>Current listed jobs </dt>
          <dd class="mb40">
              <?php if(empty($jobinfo)):?>
              <div class="listed">
                <p>You are not currently advertising any job positions.</p>
                <a href="<?php echo $site_url?>job/postjob"><img src="<?php echo $theme_path?>style/company/post.png" alt="" border="0" /></a> </div>
              <?php else: ?>
              <ul class="redstar-works">
                <?php foreach ($jobinfo as $job):?>
                  <li><a href="<?php echo $site_url.'job/jobDetails/'.$job['id']?>"><?php echo $job['job_name'];?></a></li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
          </dd>
        </dl>
        <dl>
          <dt><?php echo $info['first_name']?> on the web </dt>
          <dd>
            <ul class="redstar-web">
              <?php if (!empty($info['twitter'])):?>
              <li><a href="<?php echo $info['twitter']?>">Twitter</a></li>
              <?php endif;?>
              <?php if (!empty($info['facebook'])):?>
              <li><a href="<?php echo $info['facebook']?>">Facebook</a></li>
              <?php endif;?>
              <?php if (!empty($info['linkedin'])):?>
              <li><a href="<?php echo $info['linkedin']?>">Linkedin</a></li>
              <?php endif;?>
              <?php if (!empty($info['weibo'])):?>
              <li><a href="<?php echo $info['weibo']?>">Weibo</a></li>
              <?php endif;?>
            </ul>
          </dd>
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