<?php $this->load->view($front_theme.'/header-block');?>
<div class="top-search w70 rel">
</div>

<!--company page body-->
<div class="page clearfix rel box mb30 p20">
	<h1 class="title"><?php echo $article['title']?></h1>
	<div class="content">
	<?php echo $article['content']?>
	</div>
</div>						

<?php $this->load->view($front_theme.'/footer-block');?>