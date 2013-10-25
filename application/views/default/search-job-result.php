<?php $this->load->view($front_theme.'/header-block');?>
<link href="<?php echo $theme_path?>style/jquery.autocomplete.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    input.text { width: 215px;}
</style>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.autocomplete.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
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

    function formatItem(row){
        return " <p>"+row +" </p>";
    }

    function formatResult(row){
        return row[0].replace(/(<.+?>)/gi, '');
    }

    function selectItem1(v){
        addSkillsAjax('PersonalSkills',v);
    }

    function selectItem2(v){
        addSkillsAjax('ProfessionalSkills', v);
    }

    function searchJob() {
        $('#search_form').submit();
    }

    function addSkills(id_str, thisO) {
        var v = $(thisO).val();

        addSkillsAjax(id_str, v);
    }

    function addSkillsAjax(id_str, v) {
        var htm = '<li data-val="2">'+ v +
            '<i class="del" onclick="delSkills' + '(\''+ id_str + '\',this,\''+ v + '\');"></i></li>'

        var str_key = '#'+ id_str + '_str';
        var str = $(str_key).val();

        if(str == '') {
            $(str_key).val(v);
        } else if(str.indexOf(v)==-1) {
            $(str_key).val(str+','+v);
        }
        $('#'+ id_str).append(htm);

        $('#'+id_str+'_input').val('');
    }

    function delSkills(id_str, thisO, v) {
        var str_key = '#'+ id_str + '_str';
        var str = $(str_key).val();

        var str_cop = str;
        if(str != '' && str.indexOf(v)>-1) {
            var new_str = str_cop.substring(0, str.indexOf(v)-1) + str.substr(str.indexOf(v)+v.length);
            $(str_key).val(new_str);
        }

        $(thisO).parent().remove();
    }

    function clearHint(thisO) {
        if($(thisO).val() == 'Enter Keywords') {
            $(thisO).val('');
        }
    }

    function showHint(thisO) {
        if($(thisO).val() == '') {
            $(thisO).val('Enter Keywords');
        }
    }
</script>

<!--top search area-->
<div class="top-search w70 rel">
    <input type="text" class="abs top-search-input input-tip" value="Search our job database" data-tipval="Search our job database"/>
    <input type="submit" class="abs top-search-btn " value=""  title="search"   />
    <a href="#" class="abs top-search-a">More Options</a> </div>

<!--search-result body-->
<div class="result-page w770 rel clearfix">
<!--search-result condition-->
<form action="<?php echo $site_url; ?>search/searchJob" method="post">
    <div class="result-condition rel box"> <b>Alert Search</b>
        <dl class="search-row">
            <dt class="search-row-tit">Key Words</dt>
            <dd class="search-row-nav">
                <input type="text" class="kyo-input" data-tip="Enter Keywords" name="keywords" value="Enter Keywords" onfocus="clearHint(this)" onblur="showHint(this)" />
            </dd>
        </dl>
        <dl class="search-row">
            <dt class="search-row-tit">Location</dt>
            <dd class="search-row-nav">
                <select name="location" class="after-select">
                    <option value="0" selected="selected">All Cities</option>
                    <option value="1">Shanghai</option>
                    <option value="2">Beijing</option>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Type of employment</dt>
            <dd class="search-row-nav">
                <select name="employment_type" class="after-select">
                    <option value="1">Contract</option>
                    <option value="2">Part Time</option>
                    <option value="3">Full Time</option>
                    <option value="4">Internship</option>
                    <option value="5">Any</option>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Industry</dt>
            <dd class="search-row-nav reg-row">
                <select name="industry">
                    <option value="">All Industries</option>
                    <?php foreach($industry as $key=>&$v) {
                    if(empty($v['name'])) continue;
                    ?>
                    <option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                    <?php } ?>
                </select>
                <div class="search-row-tip">Hold down 'Command' to select a max of 3</div>

            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Position</dt>
            <dd class="search-row-nav">
                <input type="text" id="sel-position" name="position">
                <div class="search-row-tip">Hold down 'Command' to select a max of 10</div>
                <div id="sel-position-val" class="show-selval"></div>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Length of employment</dt>
            <dd class="search-row-nav">
                <select name="employment_length" class="after-select">
                    <option value="1">Long term employment (1+ years)</option>
                    <option value="2">Short term employment (-1 years)</option>
                    <option value="3">No preference</option>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Salary</dt>
            <dd class="search-row-nav">
                <select name="salary" class="after-select">
                    <option value="0" selected="selected">Any Salary</option>
                    <option value="1">select2</option>
                    <option value="2">select3</option>
                    <option value="3">select4</option>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Year of experience</dt>
            <dd class="search-row-nav">
                <select name="experience_year" class="after-select">
                    <option value="1" selected="selected">Less than 1 year</option>
                    <option value="2">select2</option>
                    <option value="3">select3</option>
                    <option value="4">select4</option>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Language</dt>
            <dd class="search-row-nav">
                <select name="language" class="after-select">
                    <option value="0" selected="selected">All Languages</option>
                    <option value="1">English</option>
                    <option value="2">Chinese</option>
                    <option value="3">Japanese</option>
                </select>
                <div class="search-row-tip">Hold down 'Command' to select multiple</div>
                <div id="sel-language-val" class="show-selval"></div>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Personal Skills</dt>
            <dd class="search-row-nav">
                <input type="hidden" id="PersonalSkills_str" name="PersonalSkills_str" />
                <input type="text" size="24" maxlength="255" autocomplete="on" id="PersonalSkills_input" class="text skills-input" onkeypress="if(event.keyCode == 13){ addSkills('PersonalSkills',this); return false;}">
                <div class="search-row-tip">Hold down 'Command' to select multiple</div>
            </dd>
            <div class="skills-vals clearfix">
                <ul id="PersonalSkills"></ul>
            </div>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Personal Skills</dt>
            <dd class="search-row-nav">
                <input type="hidden" id="ProfessionalSkills_str" name="PersonalSkills_str" />
                <input type="text" size="24" maxlength="255" autocomplete="on" id="ProfessionalSkills_input" class="text skills-input" onkeypress="if(event.keyCode == 13){ addSkills('ProfessionalSkills',this); return false;}">
                <div class="search-row-tip">Hold down 'Command' to select multiple</div>
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
            <div class="span1 rel"> <img src="<?php echo $theme_path?>style/search/job-img1.gif" alt="" width="85" height="81"/> <i class="job-mark job-mark1 png abs"></i> </div>
            <div class="span2">
                <h2><?php echo $job["job_name"]; ?></h2>
                <h3><?php echo $job["name"]; ?></h3>
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
                            <p>We have an exciting opportunity for a full time Graphic Designer to join our creative team.
                                We are a leading creative, events and media agency with offices in Beijing, London and Qingdao.</p>
                            <p>We create and distribute amazing work for a variety of retailers and clients. You will be working on great brands such as Baccarat, Arcosteel, Alex Liddy and Marie Claire.</p>
                            <p>We offer the opportunity to work with a great team on exciting, creative and challenging designs.</p>
                            <p>Reporting to the marketing manager, you will be assisting on projects ranging from packaging, catalogues, theme and design concepts, product development, decals and surface decorations applied to a range of home products, flyers, ads, signage, posters, for a variety of brands and various brand style applications.</p>
                        </div>
                        <dl class="sresult-nav-job-dl">
                            <dt>Preferred Years of Experience</dt>
                            <dd><?php echo $job["preferred_year_of_experience"]; ?></dd>
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
                            <dd><?php echo $job["salary_range"]; ?></dd>
                            <dt>Industry</dt>
                            <dd class="industry">
                                <div><?php echo $job["industry"]; ?></div>
                                <ul class="industry-ul">
                                    <li class="n1"><b>Type of Employment</b><span><?php echo $job["employment_type"]; ?></span></li>
                                    <li class="n2"><b>Length of Employment</b><span><?php echo $job["employment_length"]; ?></span></li>
                                    <li class="n3"><b>Visa Assistance</b><span><?php echo $job["is_visa_assistance"]; ?></span></li>
                                    <li class="n4"><b>Housing Assistance</b><span>Accomodation will be provided</span></li>
                                </ul>
                            </dd>
                            <dt>Share This Job</dt>
                            <dd class="share-job"> <a href="#" class="n1"></a><a href="#" class="n2"></a><a href="#" class="n3"></a><a href="#" class="n4"></a><a href="#" class="n5"></a> </dd>
                        </dl>
                    </div>
                </div>
                <div class="fxui-tab-nav sresult-about">
                    <div><?php echo $job["description"]; ?></div>
                    <p><a href="#">View Company Profile</a></p>
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