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

<link rel="stylesheet" type="text/css" href="<?php echo $theme_path?>css/style.css">
<script type="text/javascript" src="<?php echo $theme_path?>js/jquery.min.js"></script>
<script>
	var site_url = "<?php echo $site_url?>";
	var theme_url = "<?php echo $theme_path?>";
</script>
</head>
<body>
