<?php $this->load->view($front_theme.'/header-block');?>

<div class="page clearfix rel box mb30 p20">
	<h1 class="title"><?php echo $article['title']?></h1>
	<div class="small_title"><?php echo $article['descrip']?></div>
	<div class="content">
	<?php echo $article['content_general']?>
	<?php echo $article['content']?>
	</div>
</div>	

<?php $this->load->view($front_theme.'/footer-block');?>