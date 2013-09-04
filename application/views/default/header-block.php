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
<link href="<?php echo $theme_path?>style/kyo-form/kyo-form.css" rel="stylesheet" type="text/css" />
<!--Import Select TAG CSS -->
<link href="<?php echo $theme_path?>css/tag/tagit-simple-grey.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery-1.7.2.min.js" ></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.lazyload.min.js" ></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/kyo4311.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/kyo4311-form.js"></script>

<script>
	var site_url = "<?php echo $site_url?>";
	var theme_url = "<?php echo $theme_path?>";
</script>
</head>
<body>
<!--header-->
<div class="p-hd">
	<div class="w100">
		<div class="phd-menu fl">
			<ul>
				<li class="home"><a href="#">HOME</a></li>
				<li class="about"><a href="#">ABOUT US</a></li>
				<li class="events"><a href="#">EVENTS</a></li>
				<li class="jobs"><a href="#">JOBS</a></li>
				<li class="post"><a href="#">POST A JOB</a></li>
			</ul>
		</div>
		<a class="phd-logo png" href="#"></a>
		<div class="phd-login fr rel">
			<div class="phd-login-text">login</div>
			<div class="phd-login-pop png">
				<div class="phd-login-pop-hd"><a href="#"></a></div>
				<p class="input-wrap"><input type="text" value="" class="input input-user" /></p>
				<p class="input-wrap"><input type="password" value="" class="input input-pass" /></p>
				<p class="tac" ><input type="submit" value="" class="btn" /></p>
			</div>
		</div>
	</div>
</div>
