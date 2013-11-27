<?php $this->load->view($front_theme.'/header-block');?>

<!--company page body-->
<div class="company-page w770 clearfix rel">
    <div class="company-body box rel mb20">
        <div class="company-hd rel"> 
        <div class="people_icon">
	        <img src="<?php echo $site_url.'attached/users/'.$company_avatar?>" alt="" width="128px" height="128px"/>
	        <i class="abs face png"></i>
        </div>
            <div class="text" style="width:320px;">
                <h2><?php echo $jobinfo["job_name"]; ?></h2>
                <h4><?php echo $jobinfo["location"].' '.$jobinfo["city"]; ?></h4>
                <p>Posted on <?php echo $jobinfo["post_date"]; ?></p>
            </div>
            <div class="about-btns"> 
	            <a href="#" class="png abtn apply"></a> 
	            <a href="<?php echo $site_url.'company/companyInfo/'.$company_id?>" class="png abtn view"></a> 
	            <a href="#" class="png abtn bkmk"></a> 
	            <a href="#" class="png abtn bkmked" style="display:none;"></a> 
            </div>
        </div>
        <div class="clear"></div>
        <div class="company-bd">
            <div class="company-bd-left">
                <dl class="mb30">
                    <dt>About Job</dt>
                    <dd><?php echo $jobinfo["job_desc"]; ?></dd>
                </dl>
                <dl class="mb30">
                    <dt>Preferred Years of Experience</dt>
                    <dd class="idustry"><?php echo getExperienceByID($jobinfo["preferred_year_of_experience"]); ?></dd>
                </dl>
                <dl class="mb30">
                    <dt>Preferred Personal Skills</dt>
                    <dd><strong><?php if (!empty($jobinfo["preferred_personal_skills"])) echo str_replace(',',', ',substr($jobinfo["preferred_personal_skills"], 0, -1)); ?></strong></dd>
                </dl>
                <dl class="mb30">
                    <dt>Preferred Technical Skills</dt>
                    <dd><strong><?php if (!empty($jobinfo["preferred_technical_skills"])) echo str_replace(',',', ',substr($jobinfo["preferred_technical_skills"], 0, -1)); ?></strong></dd>
                </dl>
                <dl class="mb30">
                    <dt>Language(s) Required</dt>
                    <dd>
                    <dd>
                        <?php if(count($job_languages)>0) {
                            foreach($job_languages as $v):
                        ?>
                    	<span class="required">
                            <b><?php echo getLanguageByID($v["language"]); ?></b>
                            <i><?php echo getLanguageLevelByID($v["level"]); ?></i>
                        </span>
                        <?php endforeach; } ?>
                    </dd>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt>Salary</dt>
                    <dd><strong><?php echo getSalaryByID($jobinfo["salary_range"]); ?></strong></dd>
                </dl>
                <dl class="mb30">
                    <dt>Industry</dt>
                    <dd class="idustry">
                        <?php echo implode(', ', $industry); ?>
                    </dd>
                </dl>
                <dl class="mb30">
                    <dt>Share This Job</dt>
                    <dd> <a href="#" class="sharejob png sharejob-f"></a> <a href="#" class="sharejob png sharejob-t"></a> <a href="#" class="sharejob png sharejob-s"></a> <a href="#" class="sharejob png sharejob-g"></a> <a href="#" class="sharejob png sharejob-m"></a> </dd>
                </dl>
            </div>
            <div class="company-bd-right">
                <div class="match"> <b>93%</b> </div>
                <dl class="mb20">
                    <dt>Location</dt>
                    <dd class="location">
                        <input type="hidden" id="address" value="<?php echo $jobinfo['location']; ?>" />
                        <div id="map" style="width:229px;height:125px;border: 1px solid #DDDDDD"></div>
                        <strong><?php echo $jobinfo['location']; ?></strong>
                    </dd>
                </dl>
                <dl class="mb20">
                    <dd>
                        <ul class="industry-ul">
                            <li class="n1"><b>Type of Employment</b><span>
                                <?php echo $jobinfo["employment_type"];?></span>
                            </li>
                            <li class="n2"><b>Length of Employment</b><span>
                                <?php echo getEmploymentLengthByID($jobinfo["employment_length"]);?></span>
                            </li>
                            <!-- <li class="n3"><b>Visa Assistance</b><span>
                                <?php $v = $jobinfo["is_visa_assistance"]?$jobinfo["is_visa_assistance"]:0;
                                echo $constants_arr["visa_assist"][$v]; ?></span>
                            </li>
                            <li class="n4"><b>Housing Assistance</b><span>
                                <?php $v = $jobinfo["is_housing_assistance"]?$jobinfo["is_housing_assistance"]:0;
                                echo $constants_arr["housing_assist"][$v]; ?></span>
                            </li> -->
                        </ul>
                    </dd>
                </dl>
                <dl>
                    <dt>Featured jobs</dt>
                    <dd>
                        <ul class="similar">
                            <?php foreach($similar_jobs as $v) { ?>
                            <li><img src="<?php echo $site_url.'attached/users/'.$v['profile_pic'];?>" alt="" />
                                <a href="<?php echo $site_url.'job/jobDetails/'.$v['id']; ?>"><?php echo $v['job_name']; ?></a>
                                <?php echo $v['first_name']; ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>

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