<?php $this->load->view($front_theme.'/header-block');?>
<style>
.top-search {display:none;}
</style>
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
				<a href="<?php echo $site_url?>job/postjob" class="pbn-btn png pbn-btn-staff"></a>
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


	<!--popmark-->
	<div class="pop-mark"></div>

	<!--pop reg-->
	<div class="pop-reg png">
		<div class="pop-reg-wrap rel">
            <form id="signup_form" method="post" action="<?php echo $site_url?>user/signup">
			<div class="pop-reg-close abs" title="close"></div>
				<div class="pop-reg-tit">
					<i>Already have an account? <a href="javascript:void(0);" class="login_on_regpop">Login</a></i>
					<b>SIGN UP</b>
				</div>
				<div class="pop-reg-type">
					<input id="RegType" value="0" class="kyo-radio" style="display:none;"/>
					<i class="kyo-radio reg-typep" data-id="RegType" data-val="0">Jobseeker</i>
					<i class="kyo-radio reg-typec" data-id="RegType" data-val="1">Employer</i>
				</div>
				<div class="pop-reg-personal">
					<label class="fl">
						<b>First Name</b>
						<input type="text" id="first_name" name="first_name" class="kyo-input"/>
					</label>
					<label  class="fr">
						<b>Last Name</b>
						<input type="text" id="last_name" name="last_name" class="kyo-input" />
					</label>
				</div>
				<div class="pop-reg-company"  style="display:none;">
					<label>
						<b>Company Name</b>
						<input type="text" id="company_name" name="company_name" class="kyo-input" />
					</label>
				</div>
				<div class="pop-reg-mail">
					<label>
						<b>Email</b><span class="email_existing"></span>
						<input type="text" id="email" name="email" class="kyo-input" />
					</label>					
				</div>
				<div class="pop-reg-password">
					<label>
						<b>Password</b>
						<input type="password" id="password" name="password" class="kyo-input" />
					</label>
				</div>
				<div class="pop-reg-agree">
					<input id="RegNewsletter" value="1" class="kyo-checkbox" style="display:none;"/>
					<input id="RegAgree" value="1" class="kyo-checkbox" style="display:none;"/>
					<i class="kyo-checkbox fr" data-id="RegAgree" data-val="1">Agree to terms</i>
					<i class="kyo-checkbox" data-id="RegNewsletter" data-val="1">Subscribe to Newsletter</i>
					
				</div>
				<div class="pop-reg-submit">
					<input type="text" id="signup_submit" class="pop-reg-submit-btn" />
				</div>
            </form>
		</div>
	</div>

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