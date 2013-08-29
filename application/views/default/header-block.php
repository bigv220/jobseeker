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


<link href="<?php echo $theme_path?>css/pub.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $theme_path?>css/home.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $theme_path?>css/kyo-form/kyo-form.css" rel="stylesheet" type="text/css" />

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
