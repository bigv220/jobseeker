	<div id="ft">
	<div class="ft-inner">
	
<div class="ft-menu" id="ft-menu">
	<a href="<?php echo $site_url.$lang.'/'?>page/about/" target="_self"><span><?php echo lang('header_about')?></span></a> | 
	<a href="<?php echo $site_url.$lang.'/'?>news/" target="_self"><span><?php echo lang('header_news')?></span></a> | 
	<a href="<?php echo $site_url.$lang.'/'?>product/" target="_self"><span><?php echo lang('header_product')?></span></a> | 
	<a href="<?php echo $site_url.$lang.'/'?>page/download/" target="_self"><span><?php echo lang('header_download')?></span></a> | 
	<a href="<?php echo $site_url.$lang.'/'?>page/contact/" target="_self"><span><?php echo lang('header_contact')?></span></a> | 
	<a href="<?php echo $site_url?>admin/" target="_self"><span>后台管理</span></a>
	
</div>

<div class="siteinfo" id="ft-siteinfo">
	<p>
	<?php echo $footer?>
	</p>	
	<div class="etonn hide">Powered by <a href="http://www.etonn.com/" title="青岛易通天下信息技术有限公司">etonn</a></div>
</div>	

	</div>
	</div>
</div>
<!-- <script type="text/javascript" src=""></script> -->
<script type="text/javascript">
$(document).ready(function(){
	$(".popup").fancybox({
		overlayShow: false
	});
});
</script>

</body></html>