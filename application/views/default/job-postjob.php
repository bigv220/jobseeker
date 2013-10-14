<?php $this->load->view($front_theme.'/header-block');?>

<!--top search area-->
<div class="top-search w70 rel">
    <input type="text" class="abs top-search-input input-tip" value="Search our job database" data-tipval="Search our job database"/>
    <input type="submit" class="abs top-search-btn " value=""  title="search"   />
    <a href="#" class="abs top-search-a">More Options</a>
</div>
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
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="postjob-content-left-row clearfix">
                    <div class="span1">
                        <strong>Industry *</strong>
                        <div>
                            <select name="industry" required>
                                <option value="">All Industries</option>
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
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
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
                            </select>
                            <div class="search-row-tip">+ Add another language</div>
                        </div>
                    </div>
                </div>

                <div class="postjob-content-left-row clearfix">
                    <div class="span1">
                        <strong>Position *</strong>
                        <div>
                            <select name="position" required>
                                <option value="">All Positions</option>
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
                            </select>
                            <!--
                            <div class="search-row-tip">Hold down 'Command' to select a max of 10</div>
                            -->
                        </div>
                    </div>
                    <div class="span2">
                        <strong>Language Level *</strong>
                        <div>
                            <select name="languagelevel" required>
                                <option value="">--Select--</option>
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="postjob-content-left-row clearfix">
                    <div class="span1">
                        <strong>Type of Job *</strong>
                        <div>
                            <select name="typeofjob" required>
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
                        <span>Personal Skills Required</span>
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
                            <select class="location-input">
                                <option value="">Provinces *</option>
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
                            </select>
                            <select class="location-input">
                                <option value="">City *</option>
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="postjob-content-right-row clearfix">
                    <div class="span1">
                        <div>
                            <select class="location-input" required>
                                <option value="">Country *</option>
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
                            </select>
                            <input type="text" name="postalcode" class="location-input input-tip" value="Postal Code" data-tipval="Postal Code">
                        </div>
                    </div>

                </div>
                <div class="postjob-content-right-row clearfix">
                    <div class="span1">
                        <span>Salary</span>
                        <div>
                            <select>
                                <option value="">Under 10,000 RMB</option>
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="postjob-content-right-row clearfix">
                    <div class="span1">
                        <span>Years of Experience Required</span>
                        <div>
                            <select>
                                <option value="">Less than 1 year</option>
                                <option value="1">value1</option>
                                <option value="2">value2</option>
                                <option value="3">value3</option>
                                <option value="4">value4</option>
                                <option value="5">value5</option>
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
            <a href="#" class="btn findnow"></a>
        </div>
    </div>
    </form>
</div>

<!-- Our Partners -->
<div class="partners w70">
    <div class="puartners-tit">Our Partners</div>
    <div class="puartners-nav">
        <ul class="puartners-ul zoom">
            <li><a href="#"><img src="<?php echo $theme_path?>style/company/partners.png" alt="" width="176" height="103" /></a></li>
            <li><a href="#"><img src="<?php echo $theme_path?>style/company/partners.png" alt="" width="176" height="103" /></a></li>
            <li><a href="#"><img src="<?php echo $theme_path?>style/company/partners.png" alt="" width="176" height="103" /></a></li>
            <li><a href="#"><img src="<?php echo $theme_path?>style/company/partners.png" alt="" width="176" height="103" /></a></li>
        </ul>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#post').click(function() {
        $('#postjobForm').validate();
        if ($('#postjobForm').valid()) {
        	$('#postjobForm').submit();
        }
    });
});

</script>
<?php $this->load->view($front_theme.'/footer-block');?>