<?php $this->load->view($front_theme.'/header-block');?>
<style>
.top-search {display:none;}
</style>
<?php if (isset($_GET['welcome'])):?>
<script>
$(function(){
	$('.pop-mark').fadeIn();
	show_welcome_pop($('#RegType').val());
});
</script>
<?php endif;?>
<!-- find & singup -->
	<div class="p-bn rel">
		<div class="pbn-find rel">
			<div class="pbn-find-block pbn-job rel">
				<a href="<?php echo $site_url?>search/findjob" class="pbn-btn png pbn-btn-job"></a>
				<div class="find-hover png abs">
					<strong>TODAY’S HOT JOBS</strong>
					<ul class="pbn-job-ul">
						<li class="odd">
							<img src="<?php echo $theme_path?>style/home/temp/find-temp1.gif" width="71" height="44" alt="" />
							<a href="#" class="png"><b>IKEA, Beijing</b> <i>Head of Marketing</i></a>
						</li>
						<li class="even">
							<img src="<?php echo $theme_path?>style/home/temp/2.jpg" width="71" height="44" alt="" />
							<a href="#" class="png"><b>IKEA, Beijing</b> <i>Head of Marketing</i></a>
						</li>
						<li class="odd">
							<img src="<?php echo $theme_path?>style/home/temp/3.jpg" width="71" height="44" alt="" />
							<a href="#" class="png"><b>IKEA, Beijing</b> <i>Head of Marketing</i></a>
						</li>
						<li class="even">
							<img src="<?php echo $theme_path?>style/home/temp/4.jpg" width="71" height="44" alt="" />
							<a href="#" class="png"><b>IKEA, Beijing</b> <i>Head of Marketing</i></a>
						</li>
					</ul>
					<p><a href="javascript:void(0);" class="show_login_btn">Login</a> or <a href="javascript:void(0);" class="show_register_btn">Register</a> to view all</p>
				</div>
			</div>
			<div class="pbn-find-block pbn-staff rel">
				<a href="<?php echo $site_url?>job/postjob" class="pbn-btn png pbn-btn-staff check_login_user_type_for_postjob"></a>
				<div class="find-hover png abs">
					<strong>NEWEST JOB SEEKERS</strong>
					<ul class="pbn-staff-ul">
                        <?php foreach($newest_jobseekers as $key => $jobseeker):?>
                            <li class="<?php if($key % 2 == 0) echo 'odd'; else echo 'even';?>">
                                <img src="<?php echo $theme_path?>style/home/temp/temp-h1.gif" width="44" height="44" alt="" />
                                <a href="#" class="png"><b><?php echo $jobseeker['first_name'] .', '. $jobseeker['city'];?></b> <i>Head of Marketing</i></a>
                            </li>
                        <?php endforeach; ?>

					</ul>
					<p><a href="javascript:void(0);" class="show_login_btn">Login</a> or <a href="javascript:void(0);" class="show_register_btn">Register</a> to view all</p>
				</div>
			</div>
			<div class="beta-msg abs"></div>
		</div>
		<div class="pbn-singup">
			<a href="javascript:void(0);" class="pbn-singup-btn"></a>
		</div>
	</div>

	<!-- recently jobs -->
	<?php $this->load->view($front_theme.'/recentjobs-block');?>
	
	<!-- Partners -->
	<?php $this->load->view($front_theme.'/partners-block');?>
	
	<!-- sponsors -->
	<!-- 
	<div class="p-bd">
		<div class="p-sponsors w100">
		  <div class="scroll-out">
		    <div class="scroll-box">
		      <a class="scroll-item p-sponsors-item" href="#">
		      	<img src="<?php echo $theme_path?>style/home/temp/sponsors1.gif" widthh="71" height="85" alt="" />
		      	<i class="mark"></i>
		      	<p>
		      		<b>microsoft, Beijing</b>
					<span>Technical Engineer</span>
		      	</p>
		      </a>
		      <a class="scroll-item p-sponsors-item" href="#">
				<img src="<?php echo $theme_path?>style/home/temp/sponsors2.gif" widthh="71" height="85" alt="" />
		      	<i class="mark"></i>
		      	<p>
		      		<b>microsoft, Beijing</b>
					<span>Technical Engineer</span>
		      	</p>
		      </a>
		      <a class="scroll-item p-sponsors-item" href="#">
				<img src="<?php echo $theme_path?>style/home/temp/sponsors3.gif" widthh="71" height="85" alt="" />
		      	<i class="mark"></i>
		      	<p>
		      		<b>microsoft, Beijing</b>
					<span>Technical Engineer</span>
		      	</p>
		      </a>
		      <a class="scroll-item p-sponsors-item" href="#">
		      	<img src="<?php echo $theme_path?>style/home/temp/sponsors1.gif" widthh="71" height="85" alt="" />
		      	<i class="mark"></i>
		      	<p>
		      		<b>microsoft, Beijing</b>
					<span>User Interface Midweight Designer</span>
		      	</p>
		      </a>
		      <a class="scroll-item p-sponsors-item" href="#">
				<img src="<?php echo $theme_path?>style/home/temp/sponsors2.gif" widthh="71" height="85" alt="" />
		      	<i class="mark"></i>
		      	<p>
		      		<b>microsoft, Beijing</b>
					<span>Technical Engineer</span>
		      	</p>
		      </a>
		      <a class="scroll-item p-sponsors-item" href="#">
				<img src="<?php echo $theme_path?>style/home/temp/sponsors3.gif" widthh="71" height="85" alt="" />
		      	<i class="mark"></i>
		      	<p>
		      		<b>microsoft, Beijing</b>
					<span>Technical Engineer</span>
		      	</p>
		      </a>
		    </div>
		  </div>
		  <div class="scroll-bar scroll-left"></div>
		  <div class="scroll-bar scroll-right"></div>
		</div>
	</div>
	-->


	<!--pop login-->
	<div class="pop-login png">
		<div class="phd-login-pop rel">
			<div class="pop-login-close abs" title="close"></div>
			<div class="phd-login-pop-header">
             <div class="phd-login-pop-header-txt">LOGIN</div>
             <div class="forget-pw">
                        <!-- Forgot Password<img src="<?php echo $theme_path?>style/pub/question_mark.png"><a href="javascript:void(0);" id="forget_password_btn">Click Here</a> -->
             </div>
             <div style="clear:both;"></div>
        	</div>

        	<div class="phd-login-pop-content">
             <div class="login-error-msg">Either your email or password is incorrect, try again.</div>
             <form id="login_form2" method="post" action="">
                        <p class="username-wrap"><input type="text" id="username" name="username" value="" class="input input-user" /></p>
                        <p class="password-wrap"><input type="password" id="login_password" name="login_password" value="" class="input input-pass" /></p>
                        <p class="tac" ><input type="submit" value="" class="login-btn" /></p>
             </form>
         	</div>
        	<div class="phd-login-pop-footer"><a href="#"></a></div>
        </div>
	</div>

<?php $this->load->view($front_theme.'/footer-block');?>