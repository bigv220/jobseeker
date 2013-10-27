<?php $this->load->view($front_theme.'/header-block');?>

<!-- post a job body -->
<div class="postjob w770 rel clearfix">
<form method="post" id="postjobForm">
    <div class="postjob-bd box rel mb10">
        <div class="postjob-tit">Post a Job</div>
        <div class="postjob-content">
            <div class="postjob-content-left">
                <div class="postjob-content-left-row clearfix">
                    <div class="span1">
                        <strong>Position Title *</strong>
                        <div><input type="text" name="job_name" required></div>
                    </div>
                    <div class="span2">
                        <strong>Length of Job *</strong>
                        <div>
                            <select name="employment_length" required>
                                <option value="">--Select--</option>
                                <option value="1">Long term employment (1+ years)</option>
                                <option value="2">Short term employment (-1 years)</option>
                                <option value="3">No preference</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="postjob-content-left-row clearfix">
                    <div class="span1">
                        <strong>Industry *</strong>
                        <div>
                            <select name="industry" onchange="changeIndustry(this);" required>
                                <option value="">All Industries</option>
                                <?php foreach($industry as $key=>$v) {
                                    if(empty($v['name'])) continue;                    
                                ?>
                                <option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                                <?php } ?>
                            </select>
                            <!--
                            <div class="search-row-tip">Hold down 'Command' to select a max of 3</div>
                            -->
                        </div>
                    </div>
                    <div class="span2">
                        <strong>Language *</strong>
                        <div>
                            <select name="language" required>
                                <option value="">--Select--</option>
                                <?php

                                foreach($language as $v) {
                                ?>
                                <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                            </select>
                            <div class="search-row-tip">+ Add another language</div>
                        </div>
                    </div>
                </div>

                <div class="postjob-content-left-row clearfix">
                    <div class="span1">
                        <strong>Position *</strong>
                        <div>
                            <select name="position" id="position_1" required>
                                <option value="">Position</option>
                                <?php
                                $user_position = $seekingIndustry["position"];
                                foreach($position as $key=>&$v) {
   
                                ?>
                                <option value="<?php echo $v['name']; ?>"<?php echo $str; ?>><?php echo $v['name']; ?></option>
                                <?php } ?>
                            </select>
                            <!--
                            <div class="search-row-tip">Hold down 'Command' to select a max of 10</div>
                            -->
                        </div>
                    </div>
                    <div class="span2">
                        <strong>Language Level *</strong>
                        <div>
                            <select name="" required>
                                <option value="">--Select--</option>
                                <?php

                                foreach($level as $v) {
                                ?>
                                <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="postjob-content-left-row clearfix">
                    <div class="span1">
                        <strong>Type of Job *</strong>
                        <div>
                            <select name="employment_type" required>
                                <option value="">Full Time</option>
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
                            </select>
                        </div>
                    </div>
                    <div class="span2">
                        <span>Personal Skills *</span>
                        <div>
                            <input type="text" name="preferred_personal_skills" class="input-tip" value="Start Typing" data-tipval="Start Typing" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="postjob-content-right">
                <div class="postjob-content-right-row clearfix">
                    <div class="span1">
                        <strong>Location *</strong>
                        <div>
                            <input type="text" name="location" class="input-tip" value="Street Address" data-tipval="Street Address" required>
                        </div>
                    </div>

                </div>
                <div class="postjob-content-right-row clearfix">
                    <div class="span1">
                        <div>
                            <select name="country" class="location-input" required>
                            <option value="">All Counties</option>
                            <?php foreach ($location as $k=>$v):?>
                         
                                <option value="<?php echo $k ?>"><?php echo $k ?></option>
                               
                            <?php endforeach;?>
                        </select>                            

                            <select name="province" class="location-input">
                                <option value="">All Province</option>
                            <?php foreach ($location['China'] as $k=>$v):?>
                           
                                <option value="<?php echo $k ?>"><?php echo $k ?></option>
                              
                            <?php endforeach;?>
                            </select>
                            
                        </div>
                    </div>

                </div>
                <div class="postjob-content-right-row clearfix">
                    <div class="span1">
                        <div>
			              <select class="location-input" name="city" >
                                <option value="">City</option>

                            </select>
                            <input type="text" name="" class="location-input input-tip" value="Postal Code" data-tipval="Postal Code">
                        </div>
                    </div>

                </div>
                <div class="postjob-content-right-row clearfix">
                    <div class="span1">
                        <span>Salary</span>
                        <div>
                            <select name="salary_range">
                                <option value="Under 10000">Under 10,000 RMB</option>
                                <option value="10000-30000">10000 RMB - 30000 RMB</option>
                                <option value="30000-60000">30000 RMB - 60000 RMB</option>
                                <option value="60000-100000">60000 RMB - 100000 RMB</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="postjob-content-right-row clearfix">
                    <div class="span1">
                        <span>Years of Experience Required</span>
                        <div>
                            <select name="preferred_year_of_experience">
                                <option value="1">Less than 1 year</option>
                                <option value="1-2">1-2 year</option>
                                <option value="2-3">2-3 year</option>
                                <option value="3-4">3-4 year</option>
                                <option value="4-5">4-5 year</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
            <div class="postjob-additional-information">
                <span>Position Description or Addtional Information</span>
                <div><textarea name="job_desc" rows="5" cols=""></textarea></div>
            </div>
        </div>

        <div class="adv-search-bar">

            <a href="javascript:void(0);" class="btn post" id="post"></a>
            
        </div>
    </div>
    </form>
</div>

<!-- Partners -->
<div class="p-partners rel">
	<div class="w770">
		<div class="title">Our Partners</div>
		<div class="h-partners-bd">
			<div class="p-partners-item"><img src="<?php echo $theme_path?>style/home/temp/pertner-rs.png"  alt="" /></div>
			<div class="p-partners-item"><img src="<?php echo $theme_path?>style/home/temp/pertner-ca.png"  alt="" /></div>
			<div class="p-partners-item"><img src="<?php echo $theme_path?>style/home/temp/pertner-hds.png"  alt="" /></div>
			<div class="p-partners-item"><img src="<?php echo $theme_path?>style/home/temp/pertner-bc.png"  alt="" /></div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
     $("select[name='country']").change(function() {
        change_location($(this),'country');
    });
    $("select[name='province']").change(function() {
        change_location($(this), 'province');
    });
    $('#post').click(function() {
        $('#postjobForm').validate();
        if ($('#postjobForm').valid()) {
        	$.post(
                	site_url+"job/postjob", 
                	$('#postjobForm').serialize(),
     			    function(result,status){
     			    	if("success" == status) {
							alert("success.");
     			    	}
     		});
        }
    });
});

</script>
<script type="text/javascript" src="<?php echo $theme_path?>js/reg.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/jobseeker.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>
