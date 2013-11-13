<?php $this->load->view($front_theme.'/header-block');?>
<link href="<?php echo $theme_path?>style/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.autocomplete.js"></script>

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
                                <?php $empl = getEmploymentLength();
                                foreach($empl as $k => $v) { ?>
                                <option value="<?php echo $k+1; ?>"><?php echo $v; ?></option>
                                <?php } ?>
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
                            <div class="search-row-tip">+Add another Industry</div>
                        </div>
                    </div>
                    <div class="span2">
                        <strong>Position *</strong>
                        <div>
                            <select name="position" id="position_1">
                                <option value="">Position</option>
                            </select>
                            <!--
                            <div class="search-row-tip">Hold down 'Command' to select a max of 10</div>
                            -->
                        </div>
                    </div>

                </div>

                <div class="postjob-content-left-row clearfix" id="language_item">
                    <div class="span1">
                        <strong>Language *</strong>
                        <div>
                            <select name="language[]" required>
                                <option value="">--Select--</option>
                                <?php $language = language_arr();
                                foreach($language as $k => $v) { ?>
                                    <option value="<?php echo $k+1; ?>"><?php echo $v; ?></option>
                                    <?php } ?>
                            </select>

                        </div>
                    </div>
                    <div class="span2">
                        <span>Language Level</span>
                        <div>
                            <select name="language_level[]" required>
                                <option value="">--Select--</option>
                                <?php
                                $level = language_level();
                                foreach($level as $k => $v) {
                                ?>
                                <option value="<?php echo $k+1; ?>"><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="addLanguageBtn">
                    <a onclick="addLanguageBtnClick(this);" href="javascript:void(0);" class="reg-row-tip">
                        + Add another language
                    </a>
                </div>


                <div class="postjob-content-left-row clearfix">
                    <div class="span1">
                        <strong>Type of Job *</strong>
                        <div>
                            <select id="employment_type" >
                                <option value="">--Select--</option>
                                <?php $jobtype = jobtype();
                                foreach ($jobtype as $k => $v) {?>
                                <option value="<?php echo $v?>"><?php echo $v?></option>
                                <?php }?>
                            </select>
                            <input type="hidden" name="employment_type" id="jobtype_tag"/>
                            <ul id="jobtype_box" data-name="nameOfSelect"></ul>
                        </div>
                    </div>
                        <div class="span2">
                            <span>Years of Experience Required</span>
                            <div>
                                <select name="preferred_year_of_experience">
                                    <?php $expe = getExperience();
                                    foreach($expe as $k => $v) { ?>
                                        <option value="<?php echo $k+1; ?>"><?php echo $v; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                </div>

                <div class="postjob-content-left-row clearfix">
                    <div class="span1">
                        <span>Teachnical Skills</span>
                        <div class="reg-row">
                            <div>
                                <input type="hidden" name="preferred_technical_skills" class="input-tip" value="" data-tipval="">
                                <input type="text" size="24" maxlength="255" autocomplete="on" id="ProfessionalSkills_input" class="skills-input input-tip" data-tipval="Start Typing" value="Start Typing" onkeypress="if(event.keyCode == 13){ addPersonalSkills('ProfessionalSkills',this,'step8'); return false;}" required>
                            </div>
                        </div>
                        <div class="skills-vals clearfix">
                            <ul id="ProfessionalSkills">
                                <?php foreach($professional_skills as $v) { ?>
                                    <li data-val="2">
                                        <i class="del" onclick="delPersonalSkills('ProfessionalSkills',this,'<?php echo $v['professional_skill']; ?>');"></i>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>
                    <div class="span2">
                        <span>Personal Skills Required</span>
                        <div class="reg-row">
                            <div>
                                <input type="hidden" name="preferred_technical_skills" class="input-tip" value="" data-tipval="">
                                <input type="text" size="24" maxlength="255" autocomplete="on" id="ProfessionalSkills_input" class="skills-input input-tip" data-tipval="Start Typing" value="Start Typing" onkeypress="if(event.keyCode == 13){ addPersonalSkills('ProfessionalSkills',this,'step8'); return false;}" required>
                            </div>
                        </div>
                        <div class="skills-vals clearfix">
                            <ul id="ProfessionalSkills">
                                <?php foreach($professional_skills as $v) { ?>
                                    <li data-val="2">
                                        <i class="del" onclick="delPersonalSkills('ProfessionalSkills',this,'<?php echo $v['professional_skill']; ?>');"></i>
                                    </li>
                                <?php } ?>
                            </ul>
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
                            <option value="">All Countries</option>
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
                        <strong>Salary *</strong>
                        <div>
                            <select name="salary_range">
                                <?php $salary = getSalary();
			                    foreach($salary as $k => $v) { ?>
			                    <option value="<?php echo $k+1; ?>"><?php echo $v; ?></option>
			                    <?php } ?>
                            </select>
                        </div>
                    </div>

                </div>

            </div>
            <div class="clearfix"></div>
            <div class="postjob-additional-information">
                <strong>Position Description or Addtional Information *</strong>
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
<script type="text/javascript" src="<?php echo $theme_path?>js/jobseeker.js"></script>
	
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
                        var data = $.parseJSON(result);
     			    	if("success" == status) {alert(data.id);
							window.location.href=site_url+'job/jobdetails/'+ data.id;
     			    	}
     		});
        }
    });
});

function addLanguageBtnClick(thisO) {
    var num = $('select[name="language[]"]').length;

    if(num >= 3) {
        alert("The can only add 3 languages.");
        return;
    }
    var html = '<div class="postjob-content-left-row clearfix">'+$('#language_item').html();
    html += '<div class="postjob_del"><i class="del" onclick="delNewUserLanguage(this);">'+
        '</i></div></div>';
    $(thisO).parent().before(html);
}

// change industry
function changeIndustry(thisO) {
    var name = $(thisO).val();
    $.post(site_url + 'jobseeker/ajaxchangeindustry',
        { ind_name: name },
        function(result,status) {
            var position_htm = '<option value="">All Positions</option>';

            if(status == 'success'){
                var obj = eval('('+result+')');
                for ( var i = 0; i < obj.data.length; i++) {
                    position_htm += "<option value=\""+obj.data[i].name+"\">"+obj.data[i].name+"</option>";
                }
            }

            $(thisO).parent().parent().next().find('select').html(position_htm);
        });
}

function delNewUserLanguage(thisO) {
    $(thisO).parent().prev().remove();
    $(thisO).parent().prev().remove();
    $(thisO).parent().parent().remove();
}


</script>
<script type="text/javascript" src="<?php echo $theme_path?>js/reg.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>
