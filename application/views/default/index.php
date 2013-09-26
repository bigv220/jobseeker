<?php $this->load->view($front_theme.'/header-block');?>

<!-- find & singup -->
	<div class="p-bn rel">
		<div class="pbn-find">
			<div class="pbn-find-block pbn-job rel">
				<a href="#" class="pbn-btn png pbn-btn-job"></a>
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
					<p><a href="#">Login</a> or <a href="#">Register</a> to view all</p>
				</div>
			</div>
			<div class="pbn-find-block pbn-staff rel">
				<a href="#" class="pbn-btn png pbn-btn-staff"></a>
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
					<p><a href="#">Login</a> or <a href="#">Register</a> to view all</p>
				</div>
			</div>
		</div>
		<div class="pbn-singup">
			<a href="javascript:;" class="pbn-singup-btn"></a>
		</div>
	</div>

	<!--blog-->
	<div class="p-blog rel">
		<div class="w70">
			<div class="h-blog-hd">
				<strong>Jing News</strong>
				<a href="#">View all articles</a>
			</div>
			<div class="h-blog-bd">
				<ul class="h-blog-ul">

                    <?php foreach($news_list as $key => $news):?>
                        <li class="n<?php echo $key+1;?>">
                            <img src="<?php echo $theme_path?>style/home/temp/temp-h1.gif" width="120" height="120" alt="" />
                            <i class="mark png"></i>
                            <a href="#" class="h-blog-item">
                                <strong><?php echo $news['title'];?></strong>
                                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                                <b>Continue Reading</b>
                            </a>

                        </li>
                    <?php endforeach;?>
                    <!--
					<li class="n1">
						<img src="<?php echo $theme_path?>style/home/temp/temp-h1.gif" width="120" height="120" alt="" />
						<i class="mark png"></i>
						<a href="#" class="h-blog-item">
							<strong>Colin Lew’s Expat Profile</strong>
							<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
							<b>Continue Reading</b>
						</a>
	
					</li>
					<li class="n2">
						<img src="<?php echo $theme_path?>style/home/temp/temp-h2.gif" width="120" height="120" alt="" />
						<i class="mark png"></i>
						<a href="#" class="h-blog-item">
							<strong>The Happiest Places to Work</strong>
							<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
							<b>Continue Reading</b>
						</a>
	
					</li>
					<li class="n3">
						<img src="<?php echo $theme_path?>style/home/temp/temp-h3.gif" width="120" height="120" alt="" />
						<i class="mark png"></i>
						<a href="#" class="h-blog-item">
							<strong>Colin Lew’s Expat Profile</strong>
							<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
							<b>Continue Reading</b>
						</a>
	
					</li>
					<li class="n4">
						<img src="<?php echo $theme_path?>style/home/temp/temp-h4.gif" width="120" height="120" alt="" />
						<i class="mark png"></i>
						<a href="#" class="h-blog-item">
							<strong>Mastering the Perfect CV</strong>
							<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
							<b>Continue Reading</b>
						</a>
					</li>
                    -->
				</ul>
			</div>
		</div>
	</div>
	<!-- sponsors -->
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



	<!--popmark-->
	<div class="pop-mark"></div>

	<!--pop reg-->
	<div class="pop-reg png">
		<div class="pop-reg-wrap rel">
            <form id="signup_form" method="post" action="/user/signup">
			<div class="pop-reg-close abs" title="close"></div>
				<div class="pop-reg-tit">
					<i>Already have an account? <a href="#">Login</a></i>
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


<?php $this->load->view($front_theme.'/footer-block');?>