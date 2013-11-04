<?php $this->load->view($front_theme.'/header-block');?>

<!--company page body-->
<div class="company-page w770 clearfix rel">
  <div class="company-body box rel mb20">
    <div class="company-hd rel"> <i class="abs face png" style="background:url(<?php echo $site_url.'attached/users/'.$info['profile_pic']?>) no-repeat;"></i>
      <div class="text">
        <h2><?php echo $info['first_name'];?></h2>
        <h4><?php echo $info['city'].', '.$info['country'];?></h4>
        <p>Online now</p>
      </div>
      <div class="btnarea"> <a href="#" class="png combtn website"></a> <a href="#" class="png combtn bookmark"></a> <a href="#" class="combtn bookmarded" style="display:none;"></a> </div>
    </div>
    <div class="company-bd">
      <div class="company-bd-left">
        <dl class="mb30">
          <dt>About <?php echo $info['first_name'];?></dt>
          <dd><strong><?php echo $info['description'];?></strong></dd>
        </dl>
        <dl class="mb30">
          <dt>Industry</dt>
          <dd class="idustry">
          <?php foreach ($industries as $industry):?>
            <a href="#"><?php echo $industry['industry']; ?></a> 
          <?php endforeach; ?>
          </dd>
        </dl>
        <dl>
          <dt>Phone</dt>
          <dd><strong><?php if ($info['country'] =='China'): ?> (+86) <?php else: ?> (+1) <?php endif; ?> <?php echo $info['phone']; ?></strong></dd>
        </dl>
      </div>
      <div class="company-bd-right">
        <dl class="mb20">
          <dt>Jobs at <?php echo $info['first_name']?></dt>
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
          <dt><?php echo $info['first_name'];?> elsewhere on the web</dt>
          <dd>
            <ul class="redstar-web">
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Pinterest</a></li>
              <li><a href="#">WeChat</a></li>
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
