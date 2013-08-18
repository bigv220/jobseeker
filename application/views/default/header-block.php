<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php 
			if (!empty($title)) echo $title.' | '; 
			if (!empty($article['title'])) echo $article['title'].' | ';
			echo $site_name;
		?></title>
<meta name="keywords" content="<?php echo $keyword?>" >
<meta name="description" content="<?php echo $description?>" >

	
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path?>css/style.css">
<script type="text/javascript" src="<?php echo $theme_path?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/common.min.js"></script>
<link rel="stylesheet" href="<?php echo $theme_path?>js/fancybox/jquery.fancybox-1.3.4.css" />
<script src="<?php echo $theme_path?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script>
	var site_url = "<?php echo $site_url?>";
	var theme_url = "<?php echo $theme_path?>";
</script>
</head>
<body><div id="doc">
	<div id="hd">
		<div class="clearfix pagetitle">
			<h1 class="sitename">
				<a href="<?php echo $site_url.$lang.'/'?>" title="<?php echo lang('header_site_name')?>"><img id="sitelogo" class="ifixpng" src="<?php echo $theme_path?>images/logo.png" alt=""></a>
			</h1>
			
		</div>
		<div class="clearfix sitenav">
			<div class="clearfix menu-main">
				<ul id="menuSitenav" class="clearfix">
				<li class="first-item">
				     <a href="<?php echo $site_url.$lang.'/'?>" class="home"><span><?php echo lang('header_home')?></span></a>
				</li>
                                <li>
                <a href="<?php echo $site_url.$lang.'/'?>page/about/" target="_self"><span><?php echo lang('header_about')?></span></a>
                                </li>
                                <li>
                <a href="<?php echo $site_url.$lang.'/'?>news/category/company-news/" target="_self"><span><?php echo lang('header_news')?></span></a>
                                </li>
                                <li>
                <a href="<?php echo $site_url.$lang.'/'?>news/category/company-products/" target="_self"><span><?php echo lang('header_product')?></span></a>
                                </li>
                                <li>
                <a href="<?php echo $site_url.$lang.'/'?>page/download/" target="_self"><span><?php echo lang('header_download')?></span></a>
                                </li>
                                <li class="last-item">
                <a href="<?php echo $site_url.$lang.'/'?>page/contact/" target="_self"><span><?php echo lang('header_contact')?></span></a>
                                </li>
                                
                                <li class="last-item" style="float:right;z-index: 0; ">
                <a href="<?php echo $site_url.lang('header_change_lang_url').'/'?>" target="_self"><span><?php echo lang('header_change_lang_text')?></span></a>
                                </li>
                </ul>			</div>
		</div>
	</div>
