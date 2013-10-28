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
                                <?php $language = language_arr();
                                foreach($language as $v) { ?>
                                <option value="<?php echo $v+1; ?>"><?php echo $v; ?></option>
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
                                $level = language_level();
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
                                <option value="">--Select--</option>
                                <?php $jobtype = jobtype();
                                foreach ($jobtype as $k => $v) {?>
                                <option value="<?php echo $k+1?>"><?php echo $v?></option>
                                <?php }?>
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
                                <?php $salary = getSalary();
			                    foreach($salary as $v) { ?>
			                    <option value="<?php echo $v+1; ?>"><?php echo $v; ?></option>
			                    <?php } ?>
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
                <script type="text/javascript" src="<?php echo $theme_path?>js/jslib/xheditor/xheditor-1.1.14-en.min.js"></script>
                <script>
                $(document).ready(function() {
                $('#job_desc').xheditor({
                    tools:'Bold,Italic,Underline,|,Align,List,|,Link,Img,Table,|,Source,Fullscreen',
                    skin:'nostyle',
                    hoverExecDelay:-1,
                    forcePtag:false,
                    submitID:'post'});
                });
                </script>
                <div><textarea name="job_desc" id="job_desc" rows="7" cols=""></textarea></div>
            </div>
        </div>

        <div class="adv-search-bar">

            <a href="javascript:void(0);" class="btn post" id="post"></a>
            
        </div>
    </div>
    </form>
</div>

<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>
	
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
