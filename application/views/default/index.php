<?php $this->load->view($front_theme.'/header-block');?>

<h1 class="sitename">
	<a href="<?php echo $site_url.'/'?>" title=""><?php echo $site_name;?></a>
</h1>

<?php foreach ($news_list as $key => $value) {
	echo $value.'<br>';
}?>

<?php $this->load->view($front_theme.'/footer-block');?>