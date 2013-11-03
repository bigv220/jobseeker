<?php $this->load->view($front_theme.'/header-block');?>

<!--company page body-->
<div class="company-page w770 clearfix rel">
  <div class="company-body box rel mb20">
    <div class="company-hd rel"> <i class="abs face png"></i>
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
          <dd>
            <ul class="redstar-works">
              <li><a href="#">Admin Assistant</a></li>
              <li><a href="#">UI Designer</a></li>
              <li><a href="#">Project Manager</a></li>
            </ul>
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
