<?php $this->load->view($front_theme.'/header-block');?>

    <div class="top-search w70 rel">
        <input type="text" class="abs top-search-input input-tip" value="Search our job database" data-tipval="Search our job database"/>
        <input type="submit" class="abs top-search-btn " value=""  title="search"   />
        <a href="#" class="abs top-search-a">More Options</a> </div>

    <div class="w770 rel clearfix">

        <div class="news-index box rel mb10">
			
			<h1 class="title"><?php echo $article['title']?></h1>
			<div class="hr"></div>
			<div class="content">
			<?php echo $article['content']?>
			</div>

		</div>

    </div>

<?php $this->load->view($front_theme.'/footer-block');?>