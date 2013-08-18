<?php $this->load->view($front_theme.'/header-block');?>
<div id="bd">
	<?php $this->load->view($front_theme.'/banner-block');?>

<div id="homepg" class="bd-inner">
		<div class="clearfix  layout-home  three-cols">
    	
	<div class="col-sub">
	
		<div class="block first-block block-products" id="block-products-49843" style="" >
			<div class="block-content clearfix">
				<?php echo $block_index1?>
			</div>
			<div class="block-foot"></div>
		</div>
		
   		<div class="block first-block block-products" id="block-products-49843" style="width:450px;float:left;" >
			<div class="block-head">
				<div class="head-inner clearfix">
					<h2 class="title">公司简介</h2>
					<div class="links"><div class="links"><a class="more" href="#">more</a></div></div>
				</div>
			</div>
			<div class="block-content clearfix">
				<?php echo $block_index2?>
			</div>
			<div class="block-foot"></div>
		</div>	
		
		<div class="block first-block block-products" id="block-products-49843" style="width:450px;float:right;" >
			<div class="block-head">
				<div class="head-inner clearfix">
					<h2 class="title">公司新闻</h2>
					<div class="links"><div class="links"><a class="more" href="#">more</a></div></div>
				</div>
			</div>
			<div class="block-content clearfix">
				<ul><?php foreach ($news_list as $row):?>
					<li style="line-height:24px;border-bottom:1px #ccc dashed;"><a href=""><?php echo $row['title']?></a><span style="float:right;"><i><?php echo date('Y-m-d',$row['date'])?></i></span></li>
				<?php endforeach;?></ul>
			</div>
			<div class="block-foot"></div>
		</div>
		
		<div class="clear"></div>
		
		
		
		<div class="block first-block block-products" id="block-products-49843" style="" >
			<div class="block-head">
				<div class="head-inner clearfix">
					<h2 class="title">合作伙伴</h2>
					
				</div>
			</div>
			<div class="block-content clearfix">
				<?php echo $block_index3?>
			</div>
			<div class="block-foot"></div>
		</div>
	</div>
	
	
	</div>
	</div>
	
</div>
<?php $this->load->view($front_theme.'/footer-block');?>