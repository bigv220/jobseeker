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
</script>
<!--search-result body-->
<div class="result-page w770 rel clearfix">
<!--search-result condition-->
<form action="<?php echo $site_url; ?>search/searchJobseeker" method="post">
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
                    <?php if ($k == $_POST['country']): ?>
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
                    <?php if ($k == $_POST['province']): ?>
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
                    <?php if (empty($_POST['city'])): ?>
                    <option value="">All City</option>
                    <option value="1">Beijing</option>
                    <?php else: ?>
                    <option value="<?php echo $_POST['city']; ?>"><?php echo $_POST['city']; ?></option>
                    <option value="">All City</option>
                    <?php endif; ?>
                </select>
            </dd>
        </dl>

        <dl class="search-row ">
            <dt class="search-row-tit">Type of employment</dt>
            <dd class="search-row-nav">
                <select id="employment_type" class="filter_key">
                    <option value="">All Type</option>
                    <?php $jobtype = jobtype();
                    foreach ($jobtype as $k => $v) {?>
                        <option value="<?php echo $k+1?>"><?php echo $v?></option>
                        <?php }?>
                </select>
                <input type="hidden" name="employment_type" id="jobtype_tag"/>
                <ul id="jobtype_box" data-name="nameOfSelect"></ul>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Industry</dt>
            <dd class="search-row-nav reg-row">
                <select name="industry" class="industry_options"  onchange="changeIndustry(this);">
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
                <select name="position" id="position_1" class="filter_key">
                    <option value="">Position</option>
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
                <select name="employment_length" class=" filter_key">
                    <option value="">--Select--</option>
                    <?php $expl = getEmploymentLength();
                    foreach ($expl as $k => $v) {?>
                        <option value="<?php echo $k+1?>"><?php echo $v?></option>
                        <?php }?>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Salary</dt>
            <dd class="search-row-nav">
                <select name="salary" class=" filter_key">
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
                <select name="experience_year" class=" filter_key">
                    <option value="" selected="selected">--Select--</option>
                    <?php $exp = getExperience();
                    foreach($exp as $v) { ?>
                        <option value="<?php echo $v+1; ?>"><?php echo $v; ?></option>
                        <?php } ?>
                </select>
            </dd>
        </dl>
        <dl class="search-row ">
            <dt class="search-row-tit">Language</dt>
            <dd class="search-row-nav">
                <select name="language" class=" filter_key">
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
                <input type="hidden" id="ProfessionalSkills_str" name="PersonalSkills_str" />
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
    <div class="result-az-from fl"> <b>View jobseekers from</b>
        <select class="kyo-select">
            <option value="0">--Select--</option>
            <option value="60">Last 2 months</option>
            <option value="30">Last month</option>
            <option value="14">Last 2 weeks</option>
            <option value="7">Last week</option>
        </select>
    </div>
    <div class="result-az-jobs fl"> <b>Sort jobseekers by</b>
        <select class="kyo-select">
            <option value="a" selected="selected">Salary High - Low</option>
            <option value="b">Salary Low -High</option>
        </select>
    </div>
</div>

<!--search-result body-->
<div class="result-bd">
    <?php foreach ($jobseekers as $user):
    ?>
    <div class="box rel sresult-row id-<?php echo $user['uid']?>">
        <div class="sresult-par1">
            <div class="span1 rel"> <img src="<?php echo $site_url?>attached/users/<?php echo $user['profile_pic']?>" alt="" width="85" height="81"/> <i class="job-mark job-mark1 png abs"></i> </div>
            <div class="span2">
                <h2><?php echo $user['first_name']; ?></h2>
                <h3>
                    Accounting
                </h3>
                <p><?php echo $user['city'].' '.$user['province'].' '.$user['country']; ?></p>
                <a href="#" class="job-viewmore">View More</a> </div>
            <div class="span3">
                <div class="zoom">
                    <a href="#" class="job-btn jobseeker-btn-shortlisted"></a>
                    <a href="#" class="job-btn job-btn-match">99%</a>
                </div>
                <div><a href="#" class="jobseeker_request_interview"></a></div>
            </div>
        </div>
        <div class="sresult-par2">
            <div class="sresult-tab-hd">
                <span class="fxui-tab-tit">About me</span>
                <span class="fxui-tab-tit">Portfolio</span>
                <span class="fxui-tab-tit">JingChat</span>
            </div>
            <div class="sresult-tab-bd zoom">
                <div class="fxui-tab-nav sresult-nav-job sresult_about_me">
                    <div class="sresult-nav-job-left">
                        <div class="text">
                            <p><?php echo $user['description']; ?></p>
                        </div>
                        <dl class="sresult-nav-job-dl">
                            <dt>Industry</dt>
                            <dd>
                                <?php
                                $industry_arr = $user['industry_arr'];
                                for($i=0; $i<count($industry_arr); $i++) {
                                    echo '<a href="#">'.$industry_arr[$i]['industry']."</a> ";
                                }
                                ?>
                            </dd>
                            <?php foreach($user['work_history'] as $v) {
                            if($v['period_time_to'] == date('Y') || $v['is_stillhere'] == 1) {
                                ?>
                                <dt>Current Employment</dt>
                                <?php } else { ?>
                                <dt>Previous Employment</dt>
                                <?php } ?>

                            <dd><p class="employment_title"><?php echo $v['introduce']; ?></p>
                                <p class="emploeyment_period">
                                    <?php echo $v['period_time_from'] . ' - ' . $v['period_time_to']; ?>
                                </p>
                                <p class="employment_description"><?php echo $v['description']; ?></p></dd>
                            <?php } ?>

                            <dt>Personal Skills</dt>
                            <dd><?php
                            $arr = $user['personal_skills'];
                            for($i=0; $i<count($arr); $i++) {
                                if($i==0) {
                                    echo $arr[$i]['personal_skill'];
                                } else {
                                    echo ", " . $arr[$i]['personal_skill'];
                                }
                            }
                            ?><dd>
                            <dt>Technical Skills</dt>
                            <dd><?php
                                $arr = $user['professional_skills'];
                                for($i=0; $i<count($arr); $i++) {
                                    if($i==0) {
                                        echo $arr[$i]['professional_skill'];
                                    } else {
                                        echo ", " . $arr[$i]['professional_skill'];
                                    }
                                }
                                ?></dd>
                            <dt>Language(s)</dt>
                            <dd>
                                <?php $languages = $user['languages'];
                                for($i=0; $i<count($languages); $i++) { ?>
                                    <span class="required">
                            <b><?php echo $languages[$i]["language"]; ?></b>
                            <i><?php echo $languages[$i]["level"]; ?></i>
                        </span>
                                    <?php }?>
                            </dd>
                        </dl>
                    </div>
                    <div class="sresult-nav-job-right">
                        <dl class="sresult-nav-job-dl">
                            <dt>Birthday</dt>
                            <dd>
                                <p class="jobseeker_birthday"><?php echo date('M j Y',strtotime($user['birthday'])); ?></p>
                            </dd>
                            <dt>Education</dt>
                            <dd>
                                <?php $educations = $user['educations'];
                                for($i=0; $i<count($educations); $i++) { ?>
                                    <p class="school_name"><?php echo $educations[$i]['school_name']; ?></p>
                                    <p class="school_major"><?php echo $educations[$i]['major']; ?></p>
                                    <p class="school_period"><?php echo $educations[$i]['attend_date_from'] . ' - ' . $educations[$i]['attend_date_to']; ?></p>
                                    <?php }?>
                            </dd>
                            <dt>Elsewhere on Web</dt>
                            <dd>
                                <?php if (!empty($user['twitter'])):?>
                                <p><a href="<?php echo $user['twitter']?>">Twitter</a></p>
                                <?php endif;?>
                                <?php if (!empty($user['facebook'])):?>
                                <p><a href="<?php echo $user['facebook']?>">Facebook</a></p>
                                <?php endif;?>
                                <?php if (!empty($user['linkedin'])):?>
                                <p><a href="<?php echo $user['linkedin']?>">Linkedin</a></p>
                                <?php endif;?>
                                <?php if (!empty($user['weibo'])):?>
                                <p><a href="<?php echo $user['weibo']?>">Weibo</a></p>
                                <?php endif;?>
                            </dd>

                            <dt>Phone</dt>
                            <dd><p class="phone_number"><?php echo $user['phone']; ?></p></dd>
                            <dd class="industry">
                                <ul class="industry-ul">
                                    <li class="n1"><b>Type of Employment</b><span>Full Time</span></li>
                                    <li class="n2"><b>Length of Employment</b><span>Long Term (1+ year)</span></li>
                                    <!-- <li class="n3"><b>Visa Assistance</b><span>Visa will be provided</span></li>
                              <li class="n4"><b>Housing Assistance</b><span>Accomodation will be provided</span></li> -->
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="fxui-tab-nav sresult-portfolio">
                    <div class="portfolio_row"></div>
                </div>
                <div class="fxui-tab-nav sresult-jingchat">
                    <div class="jingchat_wrapper">
                        <div class="jingchat_messages" style="display:none;">
                            <div class="load_older_message">
                                Load older messages
                            </div>
                            <div class="jingchat_messages_bd">
                                <div class="jingchat_message_row_other">
                                    <div class="jingchat_message_icon"><img src="<?php echo $theme_path?>style/search/job-img1.gif" alt="" width="85" height="81"/> <i class="job-mark job-mark1 png abs"></i></div>
                                    <div class="jingchat_message_content">this is a message other person said</div>
                                </div>
                                <div class="jingchat_message_row_me">
                                    <div class="jingchat_message_icon"></div>
                                    <div class="jingchat_message_content">this is a message other sent by myself</div>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="jingchat_offline_message">
                            <p style="height:200px;"></p>
                            <p>Jobseeker is currently offline,</p>
                            <p>your message be sent to their Jingchat inbox</p>
                        </div>
                        <div class="jingchat_message_input">
                            <textarea rows="3" cols=""></textarea>
                        </div>
                    </div>
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
<?php $this->load->view($front_theme.'/footer-block');?>