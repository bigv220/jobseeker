	<div class="p-jobs rel">
		<div class="w770">
			<div class="title">Recently Added Jobs</div>
		</div>
		<div class="h-jobs-bd">
			<div class="w770">
			<?php foreach ($recently_jobs as $arr):?>
				<a class="p-jobs-item rel" href="<?php echo $site_url.'job/jobDetails/'.$arr['id']?>">
			      	<img src="<?php echo $site_url.'attached/users/'.$arr['profile_pic']?>" width="55px;" />
			      	<div class="jobtitle abs"><?php echo $arr['job_name']?></div>
			      	<div class="city abs"><?php echo $arr['city']?></div>
		      	</a>
		    <?php endforeach;?>
			</div>
		</div>		
	</div>