<?php $this->load->view($front_theme.'/header-block');?>
<script type="text/javascript">
    $(document).ready(function() {
        $("select[name='country']").change(function() {
            change_location($(this),'country');
        });
        $("select[name='province']").change(function() {
            change_location($(this), 'province');
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
                $('#position_1').html(position_htm);
            });
    }

    // ajax localtion
    function change_location(this1, key, location) {

        var selected = this1.val();
        var html_option = "";

        if("country" == key) {
            var url = site_url + "jobseeker/ajaxlocation/" + key + "/" + selected;
            $.get(url, function(data){
                var obj = eval('('+data+')');
                for ( var i = 0; i < obj.length; i++) {
                    html_option += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                }
                $("select[name='province']").html(html_option);
            });
        }

        if("province" == key) {
            var country = $("select[name='country']").val();
            var url = site_url + "jobseeker/ajaxlocation/" + key + "/" + selected + "/" + country;
            $.get(url, function(data){
                var obj = eval('('+data+')');
                for ( var i = 0; i < obj.length; i++) {
                    html_option += "<option value='"+obj[i]+"'>"+obj[i]+"</option>";
                }
                $("select[name='city']").html(html_option);
            });
        }

    }
</script>

<div class="advsearch w770 rel clearfix"> 
  <form method="post" action="<?php echo $site_url; ?>search/searchJob" id="searchForm">
  <div class="advsearch-bd box rel mb10">
		<div class="advsearch-tit">Find a Job</div>
        <div class="advsearch-min">
        	<div class="advsearch-row clearfix">
            	<div class="span1">
                	<strong>Search our job database</strong>
                    <div><input type="text" name="keywords" class="kyo-input input-tip" data-tipval="Enter Keywords" value="Enter Keywords"></div>
                </div>
                <div class="span2 location" style="width: 460px;">
                	<strong>Location</strong>
                    <div class="reg-row">
                        <select name="country" required>
                            <option value="">All Counties</option>
                            <?php foreach ($location as $k=>$v):?>
                            <?php if ($k == $userinfo['country']): ?>
                                <option value="<?php echo $k ?>" selected><?php echo $k ?></option>
                                <?php else: ?>
                                <option value="<?php echo $k ?>"><?php echo $k ?></option>
                                <?php endif; ?>
                            <?php endforeach;?>
                        </select>
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
                        <select name="city">
                            <option value="">All City</option>
                            <option value="2">Beijing</option>
                            <option value="3">Shanghai</option>
                        </select>
                    </div>
                    <!--<div class="search-row-tip">Hold down 'Command' to select a max of 3</div>-->
                    <div id="sel-city-val" class="show-selval"><ul></ul></div>
                </div>

            </div>
            
            <div class="advsearch-row clearfix">
            	<div class="span1 reg-row">
                	<strong>Industry</strong>
                    <select name="industry" class="industry_options" onchange="changeIndustry(this);">
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
                    <select name="position" id="position_1" required>
                                <option value="">Position</option>
                                <?php
                                foreach($position as $key=>&$v) {
                                ?>
                                <option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                                <?php } ?>
                            </select>
                </div>
                <div class="span3">
                    <strong>Type of employment</strong>
                    <div class="reg-row">
                        <select name="employment_type" class="after-select" style="width: 230px;">
                            <option value="">All Type</option>
                            <option value="1">Contract</option>
                            <option value="2">Part Time</option>
                            <option value="3">Full Time</option>
                            <option value="4">Internship</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="advsearch-row clearfix">
                <div class="span1">
                    <strong>Length of employment</strong>
                    <div>
                        <select class="kyo-select">
                            <option value="1">Long term employment (1+ years)</option>
                            <option value="2">Short term employment (-1 years)</option>
                            <option value="3">No preference</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="advsearch-below">
        	<div class="advsearch-row clearfix">
            	<div class="span1">
                	<strong>Salary </strong>
                    <select class="kyo-select">
                        <option value="0" selected="selected">Any Salary</option>
                        <option value="1">1500-2500</option>
                        <option value="2">2500-3500</option>
                        <option value="3">3500-5500</option>
                          </select>
                </div>
                <div class="span2">
                	<strong>Language</strong>
                    <div class="reg-row">
                    <select name="language" class="after-select">
                        <option value="0" selected="selected">All Languages</option>
                        <option value="1">English</option>
                        <option value="2">Chinese</option>
                        <option value="3">Japanese</option>
                    </select>
                    </div>
                    <!--<div class="search-row-tip">Hold down 'Command' to select a max of 3</div>-->
                    <div id="sel-language-val" class="show-selval"></div>
                </div>
                <div class="span3">
                	<strong>Personal Skills</strong>
                    <select name="personal_skills" class="industry_options">
                        <option value="">All Skills</option>
                        <?php foreach($tech_skills as $key=>&$v) {
                        if(empty($v['id'])) continue;
                        ?>
                        <option value="<?php echo $v['id']; ?>"><?php echo $v['skill']; ?></option>
                        <?php } ?>
                    </select>
                    <!--<div class="search-row-tip">Hold down 'Command' to select a max of 5</div>-->
                    <div id="sel-personal-val" class="show-selval"></div>

                </div>
            </div>
        	<div class="advsearch-row clearfix">
            	<div class="span1">
                	<strong>Technical Skills</strong>
                    <select name="technical_skills" class="industry_options">
                        <option value="">All Skills</option>
                        <?php foreach($pro_skills as $key=>&$v) {
                        if(empty($v['id'])) continue;
                        ?>
                        <option value="<?php echo $v['id']; ?>"><?php echo $v['skill']; ?></option>
                        <?php } ?>
                    </select>
                    <!--<div class="search-row-tip">Hold down 'Command' to select a max of 5</div>-->
                    <div id="sel-technical-val" class="show-selval"></div>
                </div>
            </div>
        </div>
        <div class="adv-search-bar">
        	<a href="#" class="text base">Basic Search</a>
        	<a href="#" class="text adv">Advanced Search</a>
        	<a href="javascript:void(0);" onclick="$('#searchForm').submit();" class="btn find"></a>
            <a href="javascript:void(0);" onclick="$('#searchForm').submit();" class="btn findnow"></a>
        </div>
  </div>
  </form>
</div>

<div class="w70">
  <div class="puartners-tit"><a href="#">Recently Viewed Jobs</a></div>
</div>
<!-- p-com-roll -->
<div class="com-roll-bd">
  <div class="com-roll w100">
    <div class="scroll-out">
      <div class="scroll-box"> <a class="scroll-item com-roll-item" href="#"> <img src="<?php echo $theme_path?>style/home/temp/sponsors1.gif" width="60" height="60" alt="" /> <i class="mark"></i>
        <p> <b>Beige Tomato Studio</b> <span>Technical Engineer</span> </p>
        </a> <a class="scroll-item com-roll-item" href="#"> <img src="<?php echo $theme_path?>style/home/temp/sponsors2.gif" width="60" height="60" alt="" /> <i class="mark"></i>
        <p> <b>microsoft, Beijing</b> <span>Technical Engineer</span> </p>
        </a> <a class="scroll-item com-roll-item" href="#"> <img src="<?php echo $theme_path?>style/home/temp/sponsors3.gif" width="60" height="60" alt="" /> <i class="mark"></i>
        <p> <b>microsoft, Beijing</b> <span>Technical Engineer</span> </p>
        </a> <a class="scroll-item com-roll-item" href="#"> <img src="<?php echo $theme_path?>style/home/temp/sponsors1.gif" width="60" height="60" alt="" /> <i class="mark"></i>
        <p> <b>microsoft, Beijing</b> <span>User Interface Midweight Designer</span> </p>
        </a> <a class="scroll-item com-roll-item" href="#"> <img src="<?php echo $theme_path?>style/home/temp/sponsors2.gif" width="60" height="60" alt="" /> <i class="mark"></i>
        <p> <b>microsoft, Beijing</b> <span>Technical Engineer</span> </p>
        </a> <a class="scroll-item com-roll-item" href="#"> <img src="<?php echo $theme_path?>style/home/temp/sponsors3.gif" width="60" height="60" alt="" /> <i class="mark"></i>
        <p> <b>microsoft, Beijing</b> <span>Technical Engineer</span> </p>
        </a> </div>
    </div>
    <div class="scroll-bar scroll-left"></div>
    <div class="scroll-bar scroll-right"></div>
  </div>
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

<script type="text/javascript" src="<?php echo $theme_path?>js/advsearch.js"></script> 
<?php $this->load->view($front_theme.'/footer-block');?>