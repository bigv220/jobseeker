<?php $this->load->view($front_theme.'/header-block');?>
	<div id="bd">
		<?php $this->load->view($front_theme.'/banner-block');?>
		
	<div id="innerpg" class="bd-inner">
		<div class="clearfix  layout-innerpg">
    
		<div class="col-main">
		<div class="main-wrap">
						<div class="block first-block block-article-view">
				<div class="block-head">
					<div class="head-inner">
						<h1 class="title"><?php echo $article['title']?></h1>
					</div>
				</div>
				<div class="block-content clearfix">
					<div class="article-content clearfix">
						<?php echo $article['content']?>
					</div>
				</div>
				<div class="block-foot"><div><div>-</div></div></div>
			</div>
		</div>
		</div>
		<?php $this->load->view($front_theme.'/leftside-block.php');?>
	</div>
	</div>
	</div>

<?php $this->load->view($front_theme.'/footer-block');?>