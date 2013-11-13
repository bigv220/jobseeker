<?php $this->load->view($front_theme.'/header-block');?>

<!--adv search job body-->
<div class="advsearch w770 rel clearfix"> 

  <div class="advsearch-bd box rel mb10" id="find_staff_wrapper">
		<div class="advsearch-tit">Find Staff</div>
          <form action="<?php echo $site_url; ?>search/searchJobseeker" id="searchForm" method="post">
        <div class="advsearch-min">
            <div class="advsearch-row clearfix">
                <div class="span1 long_input">
                    <strong>Search our jobseeker database</strong>
                    <div><input type="text" name="keywords" class="kyo-input input-tip" data-tipval="Enter Keywords" value="Enter Keywords"></div>
                </div>

            </div>

            <div class="advsearch-row clearfix">
                <div class="span1">
                    <strong>Country</strong>
                    <div class="reg-row">
                        <select name="country" required>
                            <option value="">All Countries</option>
                            <?php foreach ($location as $k=>$v):?>
                                <?php if ($k == $userinfo['country']): ?>
                                    <option value="<?php echo $k ?>" selected><?php echo $k ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $k ?>"><?php echo $k ?></option>
                                <?php endif; ?>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="span1">
                    <strong>Province</strong>
                    <div class="reg-row">
                        <select name="province">
                            <option value="">All Province</option>
                            <?php foreach ($location['China'] as $k=>$v):?>
                                <?php if ($k == $userinfo['province']): ?>
                                    <option value="<?php echo $k ?>" selected><?php echo $k ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $k ?>"><?php echo $k ?></option>
                                <?php endif; ?>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="span1" style="margin-right:0;">
                    <strong>City</strong>
                    <div class="reg-row">
                        <select name="city">
                            <option value="">All Cities</option>
                            <option value="1">Beijing</option>
                        </select>
                    </div>
                </div>
                <!--<div class="search-row-tip">Hold down 'Command' to select a max of 3</div>-->
                <div id="sel-city-val" class="show-selval"><ul></ul></div>

            </div>
            
            <div class="advsearch-row clearfix">
                <div class="span1 reg-row long_input">
                    <strong>Industry</strong>
                    <select name="industry" class="industry_options" onchange="changeIndustry(this, false);">
                        <option value="">All Industries</option>
                        <?php foreach($industry as $key=>&$v) {
                        if(empty($v['name'])) continue;
                        ?>
                        <option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                        <?php } ?>
                    </select>
                    <!--<div class="search-row-tip">Hold down 'Command' to select a max of 3</div>-->
                    <div id="sel-industry-val" class="show-selval"><ul></ul></div>
                </div>
                <div class="span2  reg-row">
                    <strong>Position</strong>
                    <select name="position" id="position_1">
                                <option value="">All Positions</option>
                                <?php
                                foreach($position as $key=>&$v) {
                                ?>
                                <option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                                <?php } ?>
                            </select>
                </div>

            </div>

            <div class="advsearch-row clearfix">
                <div class="span1">
                    <strong>Type of employment</strong>
                    <div class="reg-row">
                        <select id="employment_type" class="after-select" style="width: 230px;">
                            <option value="">All Type</option>
                            <?php $jobtype = jobtype();
                            foreach ($jobtype as $k => $v) {?>
                                <option value="<?php echo $k+1?>"><?php echo $v?></option>
                            <?php }?>
                        </select>
                        <input type="hidden" name="employment_type" id="jobtype_tag"/>
                        <ul id="jobtype_box" data-name="nameOfSelect"></ul>
                    </div>
                </div>
                <div class="span1">
                    <strong>Length of employment</strong>
                    <div class="reg-row">
                        <select class="after-select">
                        	<option value="">All Length</option>
                        	<?php $expl = getEmploymentLength();
                        	foreach ($expl as $k => $v) {?>
                        	<option value="<?php echo $k+1?>"><?php echo $v?></option>
                        	<?php }?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="advsearch-below">
        	<div class="advsearch-row clearfix">
                <div class="span1">
                    <strong>Salary</strong>
                    <div class="reg-row">
                        <select name="salary">
                            <option value="">All Salary</option>
                            <?php $salary = getSalary();
                            foreach($salary as $v) { ?>
                                <option value="<?php echo $k+1; ?>"><?php echo $v; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            	<div class="span1">
                	<strong>Language(s)</strong>

                    <div class="reg-row">
                        <select name="language" class="after-select">
                            <option value="" selected="selected">All Languages</option>
                            <?php $language = language_arr();
                            $i = 0;
                            foreach($language as $v) { ?>
                                <option value="<?php echo ++$i; ?>"><?php echo $v; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="search-row-tip">Hold down 'Command' to select a max of 3</div>

                    <div id="sel-language-val" class="show-selval"></div>
                </div>

            </div>
            <div class="advsearch-row clearfix">
                <div class="span1 reg-row">
                    <strong>Technical Skills</strong>
                    <select name="technical_skills" class="industry_options">
                        <option value="">All Skills</option>
                        <?php foreach($pro_skills as $key=>&$v) {
                            if(empty($v['skill'])) continue;
                            ?>
                            <option value="<?php echo $v['skill']; ?>"><?php echo $v['skill']; ?></option>
                        <?php } ?>
                    </select>
                    <div class="search-row-tip">Hold down 'Command' to select a max of 5</div>
                    <div id="sel-technical-val" class="show-selval"></div>
                </div>
                <div class="span2 reg-row">
                    <strong>Personal Skills</strong>
                    <select name="personal_skills" class="industry_options">
                        <option value="">All Skills</option>
                        <?php foreach($tech_skills as $key=>&$v) {
                            if(empty($v['skill'])) continue;
                            ?>
                            <option value="<?php echo $v['skill']; ?>"><?php echo $v['skill']; ?></option>
                        <?php } ?>
                    </select>
                    <div class="search-row-tip">Hold down 'Command' to select a max of 5</div>
                    <div id="sel-personal-val" class="show-selval"></div>

                </div>

            </div>

        </div>
        <div class="adv-search-bar">
        	<a href="#" class="text base">Basic Search</a>
        	<a href="#" class="text adv">Advanced Search</a>
        	<a href="javascript:void(0);" onclick="$('#searchForm').submit();" class="btn findstaff"></a>
        </div>
    </form>
  </div>

</div>

<br />
<!-- recently jobs -->
<?php $this->load->view($front_theme.'/recentjobs-block');?>
<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>



<script type="text/javascript" src="<?php echo $theme_path?>js/advsearch.js"></script> 
<?php $this->load->view($front_theme.'/footer-block');?>