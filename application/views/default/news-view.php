<?php $this->load->view($front_theme.'/header-block');?>

    <div class="w770 rel clearfix">

        <div class="news-index box rel mb10">
			
			<h1 class="title"><?php echo $article['title']?></h1>
			<div class="content">
			<?php echo $article['content']?>
			</div>

		</div>

    </div>

<?php $this->load->view($front_theme.'/footer-block');?>