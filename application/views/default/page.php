<?php $this->load->view($front_theme.'/header-block');?>

<!--company page body-->
<div class="reg-page w770 clearfix rel box mb30 p10">
	<h1 class="title"><?php echo $article['title']?></h1>
	<div class="hr"></div>
	<div class="content">
	<?php echo $article['content']?>
	</div>
</div>						

<?php $this->load->view($front_theme.'/footer-block');?>