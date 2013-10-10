<?php $this->load->view($front_theme.'/header-block');?>

<!--top search area-->
<div class="top-search w70 rel">
  <input type="text" class="abs top-search-input input-tip" value="Search our job database" data-tipval="Search our job database"/>
  <input type="submit" class="abs top-search-btn " value=""  title="search"   />
  <a href="#" class="abs top-search-a">More Options</a> </div>

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
          <dt>Jobs at Redstar Works</dt>
          <dd>
            <ul class="redstar-works">
              <li><a href="#">Admin Assistant</a></li>
              <li><a href="#">UI Designer</a></li>
              <li><a href="#">Project Manager</a></li>
            </ul>
          </dd>
        </dl>
        <dl>
          <dt>Redstar Works elsewhere on the web</dt>
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
  <div class="company-similar"> <a href="#">Similar Employers to Redstar Works</a> </div>
</div>

<!-- p-com-roll -->
<div class="com-roll-bd">
  <div class="com-roll w100">
    <div class="scroll-out">
      <div class="scroll-box"> <a class="scroll-item com-roll-item" href="#"> <img src="<?php echo $theme_path?>style/home/temp/sponsors1.gif" width="60" height="60" alt="" /> <i class="mark"></i>
        <p> <b>Beige Tomato Studio</b> <span>Technical Engineer</span> </p>
        </a> <a class="scroll-item com-roll-item" href="#"> <img src="<?php echo $theme_path?>style/home/temp/sponsors2.gif" width="60" height="60" alt="" /> <i class="mark"></i>
        <p> <b>microsoft, Beijing</b> <span>Technical Engineer</span> </p>
        </a> <a class="scroll-item com-roll-item" href="#"> <img src="<?php echo $theme_path?>style/home/temp/sponsors3.gif" width="60" height="60" alt="" /> <i class="mark"></i>
        <p> <b>microsoft, Beijing</b> <span>Technical Engineer</span> </p>
        </a> <a class="scroll-item com-roll-item" href="#"> <img src="<?php echo $theme_path?>style/home/temp/sponsors1.gif" width="60" height="60" alt="" /> <i class="mark"></i>
        <p> <b>microsoft, Beijing</b> <span>User Interface Midweight Designer</span> </p>
        </a> <a class="scroll-item com-roll-item" href="#"> <img src="<?php echo $theme_path?>style/home/temp/sponsors2.gif" width="60" height="60" alt="" /> <i class="mark"></i>
        <p> <b>microsoft, Beijing</b> <span>Technical Engineer</span> </p>
        </a> <a class="scroll-item com-roll-item" href="#"> <img src="<?php echo $theme_path?>style/home/temp/sponsors3.gif" width="60" height="60" alt="" /> <i class="mark"></i>
        <p> <b>microsoft, Beijing</b> <span>Technical Engineer</span> </p>
        </a> </div>
    </div>
    <div class="scroll-bar scroll-left"></div>
    <div class="scroll-bar scroll-right"></div>
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
