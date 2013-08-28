<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path?>css/theme.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path?>css/style.css" />
<script type="text/javascript" src="<?php echo $theme_path?>js/jquery-1.4.4.min.js"></script> 
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path?>js/tablesorter/themes/blue/style.css" />
<script type="text/javascript" src="<?php echo $theme_path?>js/tablesorter/jquery.tablesorter.min.js"></script> 
<script>
   var StyleFile = "theme" + document.cookie.charAt(6) + ".css";
   document.writeln('<link rel="stylesheet" type="text/css" href="<?php echo $theme_path?>css/' + StyleFile + '">');
</script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path?>css/ie-sucks.css" />
<![endif]-->
</head>

<body>
	<div id="container">
    	<div id="header">
        	<h2>网站后台管理系统</h2>
    	  <div id="topmenu">
            	<ul>
                	<!-- <li class="current"><a href="<?php echo $site_url?>admin/">Dashboard</a></li> -->
                	<li <?php if(strpos(current_url(),'cat')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/category/">分类管理</a></li>
                	<li <?php if(strpos(current_url(),'menu')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/menu/">菜单管理</a></li>
                    <li <?php if(strpos(current_url(),'page')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/page/">页面管理</a></li>
                	<li <?php if(strpos(current_url(),'news')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/news/">新闻管理</a></li>
                    <!-- <li <?php if(strpos(current_url(),'profile')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/profile/">Profile</a></li> -->
                    <!-- <li <?php if(strpos(current_url(),'product')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/product/">产品管理</a></li> -->
					         <li <?php if(strpos(current_url(),'block')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/block/">碎片管理</a></li>
                    <!-- <li <?php if(strpos(current_url(),'message')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/message/">留言管理</a></li>
                    <li <?php if(strpos(current_url(),'photo')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/photo/">图片管理</a></li>
					         <li <?php if(strpos(current_url(),'form')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/form/">报名管理</a></li>
                    <li <?php if(strpos(current_url(),'qa')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/qa/">问答管理</a></li> -->
                    <li <?php if(strpos(current_url(),'user')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/user/">用户管理</a></li>
                    <li <?php if(strpos(current_url(),'setting')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/setting/">网站设置</a></li>
                    <li <?php if(strpos(current_url(),'template')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/template/">模板编辑</a></li>
					         <li <?php if(strpos(current_url(),'database')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/database/">数据库管理</a></li>
                    <!-- <li <?php if(strpos(current_url(),'syslog')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/syslog/">系统日志</a></li> -->
                    <!-- <li <?php if(strpos(current_url(),'help')) echo 'class="current"'?>><a href="<?php echo $site_url?>admin/help/">系统帮助</a></li> -->
              </ul>
          </div>
          <div class="logout" style="color:#fff">欢迎 <?php echo $username?> &nbsp; | &nbsp; 
          										<a href="<?php echo $site_url?>" style="color:#fff">返回首页</a> &nbsp; | &nbsp; 
          										<a style="color:#fff" href="<?php echo $site_url?>user/logout/">退出系统</a>
          </div>
      </div>
