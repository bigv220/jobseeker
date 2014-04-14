	<div class="p-jobs rel">
		<div class="w770">
			<div class="title">Recently Added Jobs</div>
		</div>
		<div class="h-jobs-bd">
			<div class="w770">
			<?php for($i=0, $len=count($recently_jobs); $i < $len; $i++):?>
				<a class="p-jobs-item rel" <?php echo ($i==$len-1?"style='border:none;'":"");?> href="<?php echo $site_url.'job/jobDetails/'.$recently_jobs[$i]['id']?>">
			      	<img src="<?php echo $site_url.'attached/users/'.($recently_jobs[$i]['profile_pic']?$recently_jobs[$i]['profile_pic']:'no-image.png');?>" width="55px;" />
			      	<div class="jobtitle abs"><?php echo ucwords(strtolower($recently_jobs[$i]['job_name'])); ?></div>
			      	<div class="city abs"><?php echo $recently_jobs[$i]['city']?></div>
		      	</a>
		    <?php endfor;?>
			</div>
		</div>		
	</div>