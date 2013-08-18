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
						<h1 class="title"><?php echo $cat_name?></h1>
					</div>
				</div>
				<div class="block-content clearfix">
					<div class="article-content clearfix">
						<?php foreach ($lists as $row):?>
		                <div class="news-item">
		                <h3><a href="<?php echo $site_url.$lang.'/news/view/'.$row['aid'].'/'?>"><?php echo $row['title']?></a></h3>
		                <?php echo mb_substr(strip_tags( $row['content'] ), 0, 255).'...'?>
		                </div>
		                <?php endforeach;?>
		                
		                
		                <?php echo $pagination;?>
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