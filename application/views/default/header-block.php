<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?php 
			if (!empty($title)) echo $title.' | '; 
			if (!empty($article['title'])) echo $article['title'].' | ';
			echo $site_name;
		?></title>
<meta name="keywords" content="<?php echo $keyword?>" >
<meta name="description" content="<?php echo $description?>" >


<link href="<?php echo $theme_path?>style/pub.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $theme_path?>style/home.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $theme_path?>style/company.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $theme_path?>style/reg.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $theme_path?>style/search.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $theme_path?>style/adv-search.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $theme_path?>style/kyo-form/kyo-form.css" rel="stylesheet" type="text/css" />
<!--Import Select TAG CSS -->
<link href="<?php echo $theme_path?>css/tag/tagit-simple-grey.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery-1.7.2.min.js" ></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.lazyload.min.js" ></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/kyo4311.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/kyo4311-form.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery-ui.1.8.20.min.js" ></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.validate.js" ></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/common.js"></script>

<script>
	var site_url = "<?php echo $site_url?>";
    var base_url = "<?php echo $base_url?>";
	var theme_url = "<?php echo $theme_path?>";

    function topSearchSubmit() {
        $('#topSearchForm').submit();
    }
</script>
</head>
<body>
<!--header-->
<div class="p-hd">
	<div class="w100">
		<div class="phd-menu fl">
			<ul>
				<li class="home"><a href="<?php echo $site_url?>">HOME</a></li>
				<li class="about"><a href="<?php echo $site_url?>page/aboutus">ABOUT US</a></li>
				<li class="news"><a href="<?php echo $site_url?>news">JING NEWS</a></li>
				<li class="jobs"><a href="<?php echo $site_url?>search/searchJob">JOBS</a></li>
				<li class="jobs"><a href="<?php echo $site_url?>search/staff">CVs</a></li>
				<li class="post"><a href="<?php echo $site_url?>job/postjob">POST A JOB</a></li>
			</ul>
		</div>
		<a class="phd-logo png" href="<?php echo $site_url?>"></a>
		<div class="phd-login fr rel">
			<div class="phd-login-text">
                <?php $current_userId = isset($uid)?$uid:-1;
                if (-1 == $current_userId || '' == $current_userId):?>
                login
                <?php else: ?>
                    <?php echo isset($first_name)?$first_name:"";?>&nbsp;
                    <?php echo isset($last_name)?$last_name:"";?>
                <?php endif;?>
            </div>

            <div id="login_pop" class="phd-login-pop png">
                <div class="phd-login-pop-header">
                    <div class="phd-login-pop-header-txt">LOGIN</div>
                    <div class="forget-pw">
                        Forgot Password<img src="<?php echo $theme_path?>style/pub/question_mark.png"><a href="javascript:void(0);" id="forget_password_btn">Click Here</a>
                    </div>
                    <div style="clear:both;"></div>
                </div>

                <div class="phd-login-pop-content">
                    <div class="login-error-msg">Either your email or password is incorrect, try again.</div>
                    <form id="login_form" method="post" action="<?php echo $site_url?>user/login">
                        <p class="username-wrap"><input type="text" id="username" name="username" value="" class="input input-user" /></p>
                        <p class="password-wrap"><input type="password" id="login_password" name="login_password" value="" class="input input-pass" /></p>
                        <p class="tac" ><input type="submit" value="" class="login-btn" /></p>
                    </form>
                </div>
                <div class="phd-login-pop-footer"><a href="#"></a></div>
            </div>

            <div id="jobseeker_menu" class="phd-login-pop png">
                <div class="phd-login-pop-content">
                    <ul>
                        <?php $current_user_type = isset($user_type)?$user_type:-1;
                        if (0 == $current_user_type):?>
                            <li><a href="#">View Profile</a></li>
                            <li><a href="#">Edit Profile</a></li>
                            <li><a href="#">Bookmarked Employers</a></li>
                            <li><a href="#">Shortlisted Jobs</a></li>
                            <li><a href="#">Applied Jobs</a></li>
                        <?php elseif(1 == $current_user_type): ?>
                            <li><a href="#">View Profile</a></li>
                            <li><a href="#">Edit Company Profile</a></li>
                            <li><a href="#">Manage Job listings</a></li>
                            <li><a href="#">View Shortlisted Candidates</a></li>
                            <li><a href="#">Inbox</a></li>
                        <?php endif;?>
                        <li class="last"><a href="<?php echo $site_url?>user/logout">Sign out</a></li>
                    </ul>

                </div>
                <div class="phd-login-pop-footer"></div>
            </div>

            <?php $current_userId = isset($uid)?$uid:-1;
            if (-1 != $current_userId && '' != $current_userId):?>
                <script type="text/javascript">show_login_user_menu();</script>
            <?php endif;?>


            <div id="resetpw_pop" class="phd-login-pop png">
                <div class="phd-login-pop-header">
                    <div class="phd-login-pop-header-txt">Reset Password</div>
                    <div style="clear:both;"></div>
                </div>

                <div class="phd-login-pop-content">
                    <div>Enter the email address you used to create your JingJobs account and we'll email you a link so you can create a new password.</div>
                    <form id="resetpw_form" method="post" action="<?php echo $site_url?>user/sendResetPwRequest">
                        <p class="username-wrap"><input type="text" name="username" value="" class="input input-user" /></p>
                        <p class="tac" ><input type="submit" value="" class="send-btn" /></p>
                    </form>
                </div>
                <div class="phd-login-pop-footer"></div>
            </div>

		</div>
	</div>
</div>

<!--top search area-->
<div class="top-search w70 rel">
    <form action="<?php echo $site_url; ?>search/searchJob" method="post" id="topSearchForm">
        <input type="hidden" name="top_search" value="1" />
        <input type="text" name="search_text" class="abs top-search-input input-tip" value="Search our job database" data-tipval="Search our job database"/>
        <input type="submit" class="abs top-search-btn " value=""  title="search" onclick="topSearchSubmit()"   />
    </form>
    <a href="#" class="abs top-search-a">More Options</a>
</div>
