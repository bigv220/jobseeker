<?php $this->load->view($front_theme.'/header-block');?>
	<div id="bd">
		<?php $this->load->view($front_theme.'/banner-block');?>
		
	<div id="innerpg" class="bd-inner">
		<div class="clearfix  layout-innerpg">
    
		<div class="col-main">
		<div class="main-wrap">
						<div class="block first-block">
				<div class="block-head">
					<div class="head-inner">
						<h2 class="title">网站新闻</h2>
											</div>
				</div>
				<div class="block-content clearfix">
					<div class="list-table">
					<table class="data">
						<thead>
						<tr>
							<th class="title">Title</th>
							<th class="time">Time</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($news as $row):?>
						<tr>
							<td class="title"><span class="catalog">[ <a href="" >News</a> ]</span> <a href="<?php echo $row['aid']?>" ><span class="style1"><?php echo $row['title']?></span></a></td>
							<td><?php echo date('Y-m-d',$row['date'])?></td>
						</tr>
						<?php endforeach;?>
						</tbody>
					</table>
										</div>
					<div class="pager clearfix">
<div class="list">
	<?php echo $pagination;?>
</div>
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