<?php $this->load->view($front_theme.'/header-block');?>
<link href="<?php echo $theme_path?>style/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    input.text { width: 215px;}
</style>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.autocomplete.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("select[name='country']").change(function() {
            change_location($(this),'country');
        });
        $("select[name='province']").change(function() {
            change_location($(this), 'province');
        });
        $("#PersonalSkills_input").autocomplete("<?PHP echo $site_url; ?>/jobseeker/personalskillsautocomplete",{
            delay:10,
            width: '230px',
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectItem1,
            formatItem: formatItem,
            formatResult: formatResult
        });

        $("#ProfessionalSkills_input").autocomplete("<?PHP echo $site_url; ?>/jobseeker/professionalskillsautocomplete",{
            delay:10,
            width: '230px',
            matchSubset:1,
            matchContains:1,
            cacheLength:10,
            onItemSelect:selectItem2,
            formatItem: formatItem,
            formatResult: formatResult
        });
    });


    // change industry
    function changeIndustry(thisO) {
        var name = $(thisO).val();
        $.post(site_url + '/jobseeker/ajaxchangeindustry',
            { ind_name: name },
            function(result,status) {
                var position_htm = '<option value="">Position</option>';

                if(status == 'success'){
                    var obj = eval('('+result+')');
                    for ( var i = 0; i < obj.data.length; i++) {
                        position_htm += "<option value=\""+obj.data[i].name+"\">"+obj.data[i].name+"</option>";
                    }
                }
                $('#position').html(position_htm);
            });
    }
</script>

<!--search-result body-->
<div class="result-page w770 rel clearfix">
<!--search-result condition-->
<form action="<?php echo $site_url; ?>search/searchJob" method="post">
    <input type="hidden" name="top_search" value="0" />
    <div class="result-condition rel box"> <b>Search</b>
        <dl class="search-row">
            <dt class="search-row-tit">Key Words</dt>
            <dd class="search-row-nav">
                <input type="text" class="kyo-input" data-tip="Enter Keywords" name="keywords" value="Enter Keywords" onfocus="clearHint(this)" onblur="showHint(this)" />
            </dd>
        </dl>
        <dl class="search-row">
            <dt class="search-row-tit">Country</dt>
            <dd class="search-row-nav">
                <select name="country" class="filter_key">
                            <option value="">All Counties</option>
                            <?php foreach ($location as $k=>$v):?>
                            <?php if ($k == $userinfo['country']): ?>
                                <option value="<?php echo $k ?>" selected><?php echo $k ?></option>
                                <?php else: ?>
                                <option value="<?php echo $k ?>"><?php echo $k ?></option>
                                <?php endif; ?>
                            <?php endforeach;?>
                        </select>
            </dd>
        </dl>
        <dl class="search-row">
            <dt class="search-row-tit">Province</dt>
            <dd class="search-row-nav">
                <select name="province" class="filter_key">
                            <option value="">All Province</option>
                            <?php foreach ($location['China'] as $k=>$v):?>
                                <?php if ($k == $userinfo['province']): ?>
                                <option value="<?php echo $k ?>" selected><?php echo $k ?></option>
                                <?php else: ?>
                                <option value="<?php echo $k ?>"><?php echo $k ?></option>
                                <?php endif; ?>
                            <?php endforeach;?>
                        </select>
            </dd>
        </dl>
        <dl class="search-row">
            <dt class="search-row-tit">City</dt>
            <dd class="search-row-nav">
                <select name="city" class="filter_key">
                           <option value="">All City</option>
                           <option value="2">Beijing</option>
                </select>
            </dd>
        </dl>
        
        <dl class="search-row ">
            <dt class="search-row-tit">Type of employment</dt>
            <dd class="search-row-nav">
                <select name="employment_type" class="filter_key">
                    <option value="">All Type</option>
                    <?php $jobtype = jobtype();
                    foreach ($jobtype as $k => $v) {?>
                    <option value="<?php echo $k+1?>"><?php echo $v?></option>
                    <?php }?>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Industry</dt>
            <dd class="search-row-nav reg-row">
                <select name="industry" class="industry_options" onchange="changeIndustry(this);">
                    <option value="">All Industries</option>
                    <?php foreach($industry as $key=>&$v) {
                    if(empty($v['name'])) continue;
                    ?>
                    <option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                    <?php } ?>
                </select>
                <div class="search-row-tip" style="display:none;">Hold down 'Command' to select a max of 3</div>

            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Position</dt>
            <dd class="search-row-nav">
                <select name="position" id="position" class="industry_options">
                    <option value="">All Positions</option>
                    <?php
                    foreach($position as $key=>&$v) {
                        ?>
                        <option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                        <?php } ?>
                </select>
                <div class="search-row-tip" style="display: none;">Hold down 'Command' to select a max of 10</div>
                <div id="sel-position-val" class="show-selval"></div>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Length of employment</dt>
            <dd class="search-row-nav">
                <select name="employment_length" class="filter_key">
                    <option value="">--Select--</option>
                    <option value="1">Long term employment (1+ years)</option>
                    <option value="2">Short term employment (-1 years)</option>
                    <option value="3">No preference</option>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Salary</dt>
            <dd class="search-row-nav">
                <select name="salary" class="filter_key">
                    <option value="0" selected="selected">Any Salary</option>
                    <?php $salary = getSalary();
                    foreach($salary as $v) { ?>
                    <option value="<?php echo $v+1; ?>"><?php echo $v; ?></option>
                    <?php } ?>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Year of experience</dt>
            <dd class="search-row-nav">
                <select name="experience_year" class="filter_key">
                    <option value="">--Select--</option>
                    <option value="1">Less than 1 year</option>
                    <option value="2">2 years</option>
                    <option value="3">3 years</option>
                    <option value="4">4 years and more</option>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Language</dt>
            <dd class="search-row-nav">
                <select name="language" class="filter_key">
                    <option value="0" selected="selected">All Languages</option>
                    <?php $language = language_arr();
                    foreach($language as $v) { ?>
                    <option value="<?php echo $v+1; ?>"><?php echo $v; ?></option>
                    <?php } ?>
                </select>
                <div class="search-row-tip" style="display: none;">Hold down 'Command' to select multiple</div>
                <div id="sel-language-val" class="show-selval"></div>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Personal Skills</dt>
            <dd class="search-row-nav">
                <input type="hidden" id="PersonalSkills_str" name="PersonalSkills_str" />
                <input type="text" size="24" maxlength="255" autocomplete="on" id="PersonalSkills_input" class="text skills-input" onkeypress="if(event.keyCode == 13){ addSkills('PersonalSkills',this); return false;}">
                <div class="search-row-tip" style="display: none;">Hold down 'Command' to select multiple</div>
            </dd>
            <div class="skills-vals clearfix">
                <ul id="PersonalSkills"></ul>
            </div>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Professional Skills</dt>
            <dd class="search-row-nav">
                <input type="hidden" id="ProfessionalSkills_str" name="ProfessionalSkills_str" />
                <input type="text" size="24" maxlength="255" autocomplete="on" id="ProfessionalSkills_input" class="text skills-input" onkeypress="if(event.keyCode == 13){ addSkills('ProfessionalSkills',this); return false;}">
                <div class="search-row-tip" style="display: none;">Hold down 'Command' to select multiple</div>
            </dd>
            <div class="skills-vals clearfix">
                <ul id="ProfessionalSkills"></ul>
            </div>
        </dl>
        <div class="result-condition-btnwrap">
            <input type="submit" class="condition-btn" value=""/>
        </div>
    </div>
</form>

<!--search-result sequence-->
<div class="result-az">
    <form action="<?php echo $site_url; ?>search/filterJob" method="post" id="search_form">
        <input type="hidden" name="jobIdStr" value="<?php echo $job_id_str; ?>">
        <div class="result-az-from fl reg-row"> <b>View jobs from</b>
            <select id="post_date" onchange="searchJob()" style="width: 150px;" name="post_date">
                <option value="0">--Select--</option>
                <option value="60" <?php if($selected_date == 60) echo "selected"; ?>>Last 2 months</option>
                <option value="30" <?php if($selected_date == 30) echo "selected"; ?>>Last month</option>
                <option value="14" <?php if($selected_date == 14) echo "selected"; ?>>Last 2 weeks</option>
                <option value="7" <?php if($selected_date == 7) echo "selected"; ?>>Last week</option>
            </select>
        </div>
        <div class="result-az-jobs fl reg-row"> <b>Sort jobs by</b>
            <select id="salary_sort" name="salary_sort" style="width: 150px;" onchange="searchJob()">
                <option value="0">--Select--</option>
                <option value="desc" <?php if($salary_sort == "desc") echo "selected"; ?>>Salary High - Low</option>
                <option value="asc" <?php if($salary_sort == "asc") echo "selected"; ?>>Salary Low -High</option>
            </select>
        </div>
    </form>
</div>

<!--search-result body-->
<div class="result-bd">
    <?php foreach($jobs as $job): ?>
    <div class="box rel sresult-row">
        <div class="sresult-par1">
            <div class="span1 rel"> <img src="<?php echo $site_url?>attached/image/no-image.png" alt="" width="85" height="81"/> <i class="job-mark job-mark1 png abs"></i> </div>
            <div class="span2">
                <h2><?php echo $job["job_name"]; ?></h2>
                <h3><?php echo $job["username"]; ?></h3>
                <p><?php echo $job["city"]; ?></p>
                <a href="javascript:void(0);" class="job-viewmore">View More</a> </div>
            <div class="span3">
                <div class="zoom"> <a href="#" class="job-btn job-btn-mark" style="display:none"></a> <a href="#" class="job-btn job-btn-marked"></a> <a href="#" class="job-btn job-btn-featured"  style="display:none"></a> <a href="#" class="job-btn job-btn-match">99%</a> </div>
                <div><a href="#" class="job-btn-submit"></a></div>
            </div>
        </div>
        <div class="sresult-par2">
            <div class="sresult-tab-hd"> <span class="fxui-tab-tit">The Job</span> <span class="fxui-tab-tit">The Compnay</span> </div>
            <div class="sresult-tab-bd zoom">
                <div class="fxui-tab-nav sresult-nav-job">
                    <div class="sresult-nav-job-left">
                        <div class="text_r">
                            <p><?php echo $job['job_desc'];?></p>
                        </div>
                        <dl class="sresult-nav-job-dl">
                            <dt>Preferred Years of Experience</dt>
                            <dd><?php echo getExperienceByID($job["preferred_year_of_experience"]); ?></dd>
                            <dt>Preferred Personal Skills</dt>
                            <dd><?php echo $job["preferred_personal_skills"]; ?></dd>
                            <dt>Preferred Technical Skills</dt>
                            <dd><?php echo $job["preferred_technical_skills"]; ?></dd>
                            <dt>Language(s) Required</dt>
                            <dd> <span class="required"> <b>English</b> <i>Fluent</i> </span> <span class="required"> <b>French</b> <i>Fluent</i> </span> <span class="required"> <b>German</b> <i>Fluent</i> </span> </dd>
                        </dl>
                    </div>
                    <div class="sresult-nav-job-right">
                        <dl class="sresult-nav-job-dl">
                            <dt>Location</dt>
                            <dd>
                                <input type="hidden" id="address" value="<?php echo $job['location']; ?>" />
                                <div id="map" style="width:149px;height:83px;border: 1px solid #DDDDDD"></div>
                                <strong><?php echo $job['location']; ?></strong>
                            </dd>
                            <dt>Salary</dt>
                            <dd><?php echo getSalaryByID($job["salary_range"]); ?></dd>
                            <dt>Industry</dt>
                            <dd class="industry">
                                <div><?php echo $job["industry"]; ?></div>
                                <ul class="industry-ul">
                                    <li class="n1"><b>Type of Employment</b><span><?php if($job['employment_type']) echo getJobtypeByID($job['employment_type']);?></span></li>
                                    <li class="n2"><b>Length of Employment</b><span><?php if($job['employment_length']) echo getEmploymentLength($job['employment_length']);?></span></li>
                                    <li class="n3"><b>Visa Assistance</b><span><?php $v = $job["is_visa_assistance"]?$job["is_visa_assistance"]:0;
                                        if($v) echo $constants_arr["visa_assist"][$v]; ?></span></li>
                                    <li class="n4"><b>Housing Assistance</b><span>
                                        <?php $v = $job["is_housing_assistance"]?$job["is_housing_assistance"]:0;
                                        if($v) echo $constants_arr["housing_assist"][$v]; ?></span></li>
                                </ul>
                            </dd>
                            <dt>Share This Job</dt>
                            <dd class="share-job"> <a href="#" class="n1"></a><a href="#" class="n2"></a><a href="#" class="n3"></a><a href="#" class="n4"></a><a href="#" class="n5"></a> </dd>
                        </dl>
                    </div>
                </div>
                <div class="fxui-tab-nav sresult-about">
                    <div><?php echo $job["description"]; ?></div>
                    <p><a href="<?php echo $site_url?>company/companyinfo/<?php echo $job['company_id'];?>">View Company Profile</a></p>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>

<!--backtop-->
<div class="backtop png"></div>
</div>

<!--popmark-->
<div class="pop-mark"></div>

<!--pop box-->
<div class="box pop-box pop-apply">
    <div class="rel">
        <div class="pop-close pop-apply-close"></div>
        <div class="pop-nav pop-apply-nav">
            <p>Are you sure you want to apply for this job?</p>
        </div>
        <div class="pop-bar">
            <a href="#yes" class="pop-bar-btn pop-btn-yes">Yes</a> <a href="#no" class="pop-bar-btn pop-btn-no">No</a>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $theme_path?>js/reg.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
    var map;
    var geocoder = new google.maps.Geocoder();
    function initialize() {
        var myOptions = {
            zoom : 13,
            center : new google.maps.LatLng(-34.397, 150.644),
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
            },
            panControl: false,
            scaleControl:false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false
        }

        map = new google.maps.Map(document.getElementById("map"),
            myOptions);
    }

    function codeAddress() {
        var address = $('#address').val();
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            }
        });
    }

    $(document).ready(function(){
        initialize();
        codeAddress();
    });

</script>
<?php $this->load->view($front_theme.'/footer-block');?>