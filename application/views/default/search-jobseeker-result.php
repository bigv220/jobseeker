<?php $this->load->view($front_theme.'/header-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/jquery.als-1.2.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/portfolio.js"></script>
<link href="<?php echo $theme_path?>js/jplayer/skin/jobseeker/jplayer.jobseeker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $theme_path?>js/jplayer/jquery.jplayer.min.js"></script>
<link href="<?php echo $theme_path?>style/jquery.autocomplete.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    input.text { width: 215px;}
    .jingchat_message_row_me .jingchat_message_content,.jingchat_message_row_other .jingchat_message_content {width:390px;}
    .jingchat_message_content .message_avatar_arrow {right:-14px;}
</style>
<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.autocomplete.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            $( "#datepicker" ).datepicker();
        });

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
<input type="hidden" id="ids" value="<?php echo $ids; ?>" />
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
                    <option value="">All Countries</option>
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
                    <option value="">All Cities</option>
                    <option value="1">Beijing</option>
                    <?php else: ?>
                    <option value="<?php echo $_POST['city']; ?>"><?php echo $_POST['city']; ?></option>
                    <option value="">All Cities</option>
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
                <select name="employment_length" class=" filter_key">
                    <option value="">All Length</option>
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
                    <option value="" selected="selected">All Experience</option>
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
            <dt class="search-row-tit">Technical Skills</dt>
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
            <input type="submit" class="find-staff-btn" value=""/>
        </div>
    </div>
</form>

<!--search-result sequence-->
<div class="result-az">
    <div class="result-az-from fl reg-row"> <b>View jobseekers from</b>
        <select style="width: 150px;">
            <option value="0">--Select--</option>
            <option value="60">Last 2 months</option>
            <option value="30">Last month</option>
            <option value="14">Last 2 weeks</option>
            <option value="7">Last week</option>
        </select>
    </div>
    <div class="result-az-jobs fl reg-row"> <b>Sort jobseekers by</b>
        <select style="width: 150px;">
            <option value="0">--Select--</option>
            <option value="a">Salary High - Low</option>
            <option value="b">Salary Low -High</option>
        </select>
    </div>
</div>

<!--search-result body-->
<div class="result-bd">
    <select id="current_user_jobs" style="display: none">
    <?php foreach($current_user_jobs as $job): ?>
        <option value="<?php echo $job['id']; ?>"><?php echo $job['job_name']; ?></option>
    <?php endforeach; ?>
    </select>

    <?php if (count($jobseekers) > 0): ?>
    <?php foreach ($jobseekers as $user):
    ?>
    <div class="box rel sresult-row id-<?php echo $user['uid']?>">
        <div class="sresult-par1">
            <div class="span1 rel"> <img src="<?php echo $site_url?>attached/users/<?php echo $user['profile_pic']?$user['profile_pic']:'no-image.png';?>" alt="" width="85" height="81"/> <i class="job-mark job-mark1 png abs"></i> </div>
            <div class="span2">
                <h2><?php echo $user['first_name']; ?></h2>
                <h3>
                    <?php
                                $industry_arr = $user['industry_arr'];
                                if (!empty($industry_arr)) {
                                    echo ''.$industry_arr[0]['industry']." ";
                                }
                                
                                ?>
                </h3>
                <p><?php echo $user['city'].' '.$user['province'].' '.$user['country']; ?></p>
                <a href="#" class="job-viewmore" alt="<?php echo $user['uid']; ?>">View More</a> </div>
            <div class="span3">
                <div class="zoom">
                    <a href="#" data-id="<?php echo $user['uid']?>" class="job-btn jobseeker-btn-shortlisted <?php if ($user['is_shortlisted']==1):?>jobseeker-btn-shortlisted_current<?php endif; ?>"></a>
                    <a href="#" class="job-btn job-btn-match">99%</a>
                </div>
                <div>
                    <input type="hidden" name="jobseeker_name" value="<?php echo $user['first_name'];?>" />
                    <input type="hidden" name="jobseeker_uid" value="<?php echo $user['uid'];?>" />
                    <a href="#" class="jobseeker_request_interview"></a>
                </div>
            </div>
        </div>
        <div class="sresult-par2">
            <div class="sresult-tab-hd">
                <span class="fxui-tab-tit">About me</span>
                <span class="fxui-tab-tit">Portfolio</span>
                <span class="fxui-tab-tit" onclick="getDetailMsgForSearchResult(this);" data-id="<?php echo empty($user['jingchat']['id'])?0:$user['jingchat']['id']; ?>" data-user="<?php echo $user['uid']; ?>">JingChat</span>
            </div>
            <div class="sresult-tab-bd zoom">
                <div class="fxui-tab-nav sresult-nav-job sresult_about_me">
                    <div class="sresult-nav-job-left">
                        <div class="text_r">
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
                                    <div class="jobseeker_profile_language">
                                        <label><?php echo $languages[$i]["language"]; ?></label>
                                        <i><?php echo $languages[$i]["level"]; ?></i>
                                    </div>

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
                    <div id="portfolio_view_bar_<?php echo $user['uid'];?>" class="hide">
                        <span class="als-prev"><img src="<?php echo $theme_path;?>style/btns/previous_arrow.png" alt="prev" title="previous" /></span>
                        <div class="als-viewport">
                            <ul class="als-wrapper">
                                <?php for($i=0,$len=count($user['portfolio_projects']); $i < $len; $i++):?>
                                    <li class="als-item" user-id="<?php echo $user['uid'];?>" project-id="<?php echo $user['portfolio_projects'][$i]['pid'];?>" project-name="<?php echo $user['portfolio_projects'][$i]['name'];?>" project-description="<?php echo $user['portfolio_projects'][$i]['description'];?>" file-type="<?php echo $user['portfolio_projects'][$i]['type'];?>" file-url="<?php echo $site_url . 'attached/workExamples/' . $user['portfolio_projects'][$i]['file_url'];?>">
                                        <?php switch($user['portfolio_projects'][$i]['type']){
                                            case 0:
                                                echo "<img src='" . $theme_path . "style/portfolio/edit_txt_file_btn.png" ."'/>";
                                                break;
                                            case 1:
                                                echo "<img src='" . $site_url . "attached/workExamples/" .$user['portfolio_projects'][$i]['file_url']  ."'/>";
                                                break;
                                            case 2:
                                                echo "<img src='" . $theme_path . "style/portfolio/edit_audio_file_btn.png" ."'/>";
                                                break;
                                            case 3:
                                                echo "<img src='" . $theme_path . "style/portfolio/edit_audio_file_btn.png" ."'/>";
                                                break;
                                            case 4:
                                                echo "<img src='" . $theme_path . "style/portfolio/edit_txt_file_btn.png" ."'/>";
                                                break;
                                            default:
                                                echo "<img src='" . $theme_path . "style/portfolio/edit_txt_file_btn.png" ."'/>";
                                                break;

                                        };?>
                                    </li>
                                <?php endfor ?>

                            </ul>

                        </div>
                        <span class="als-next"><img src="<?php echo $theme_path;?>style/btns/forward_arrow.png" alt="next" title="next" /></span> <!-- "next" button -->
                    </div>

                    <div class="profile_portfolios_wrapper">
                        <div class="als-container" id="portfolio_list_<?php echo $user['uid'];?>">
                            <span class="als-prev"><img src="<?php echo $theme_path;?>/style/btns/previous_arrow.png" alt="prev" title="previous" style="display:<?php echo (count($user['portfolio_projects']) < 1 ? 'none':'block'); ?>"/></span>
                            <div class="als-viewport">
                                <div class="profile_portfolios als-wrapper"">
                                <?php if(count($user['portfolio_projects']) > 0):?>
                                    <?php for($i=0,$len=count($user['portfolio_projects']); $i < $len; $i++):?>
                                    <?php if($i % 6 == 0):?>
                                    <div class="als-item">
                                <?php endif;?>

                                    <?php if($i % 3 == 0):?>
                                <div class="portfolio_row">
                                <?php endif;?>
                                    <a href="javascript:void(0);" class="portfolio_item" user-id="<?php echo $user['uid'];?>" project-name="<?php echo $user['portfolio_projects'][$i]['name'];?>" project-description="<?php echo $user['portfolio_projects'][$i]['description'];?>" project-id="<?php echo $user['portfolio_projects'][$i]['pid'];?>" file-type="<?php echo $user['portfolio_projects'][$i]['type'];?>" file-url="<?php echo $site_url . 'attached/workExamples/' . $user['portfolio_projects'][$i]['file_url'];?>">
                                        <?php switch($user['portfolio_projects'][$i]['type']){
                                            case 0:
                                                echo "<img src='" . $theme_path . "style/portfolio/portfolio_text_file.png" ."'/>";
                                                break;
                                            case 1:
                                                echo "<img src='" . $site_url . "attached/workExamples/" .$user['portfolio_projects'][$i]['file_url']  ."'/>";
                                                break;
                                            case 2:
                                                echo "<img src='" . $theme_path . "style/portfolio/portfolio_audio_file.png" ."'/>";
                                                break;
                                            case 3:
                                                echo "<img src='" . $theme_path . "style/portfolio/portfolio_audio_file.png" ."'/>";
                                                break;
                                            case 4:
                                                echo "<img src='" . $theme_path . "style/portfolio/portfolio_text_file.png" ."'/>";
                                                break;
                                            default:
                                                echo "<img src='" . $theme_path . "style/portfolio/portfolio_text_file.png" ."'/>";
                                                break;

                                        };?>
                                        <div class="portfolio_caption"><span><?php echo $user['portfolio_projects'][$i]['name'];?></span></div>
                                    </a>
                                    <?php if($i % 3 == 2 || $i == ($len - 1)):?>
                                    <div style="clear:both;"></div>
                                </div><!-- end of portfolio_row -->
                                <?php endif;?>

                                    <?php if($i % 6 == 5|| $i == ($len - 1)):?>
                                    </div><!-- end of als-item -->
                                <?php endif;?>
                                <?php endfor ?>
                                <?php if($len>3):?>

                                <?php endif;?>
                                <?php else:?>
                                    No Projects in Portfolio.
                                <?php endif;?>
                            </div>

                        </div>
                        <span class="als-next"><img src="<?php echo $theme_path;?>/style/btns/forward_arrow.png" alt="next" title="next"  style="display:<?php echo (count($user['portfolio_projects']) < 1 ? 'none':'block'); ?>"/></span> <!-- "next" button -->
                    </div>
                </div>
                </div>
                <div class="fxui-tab-nav sresult-jingchat">
                    <div class="jingchat_wrapper" id="message_list_<?php echo $user['uid']; ?>" data-id="<?php echo empty($user['jingchat']['id'])?0:$user['jingchat']['id']; ?>" data-user="<?php echo $user['uid']; ?>">
                        <div class="jingchat_messages" style="display:none;">
                            <div class="jingchat_messages_bd">
                            </div>
                        </div>
                        <div class="jingchat_offline_message">
                            <p style="height:200px;"></p>
                            <p>Jobseeker is currently offline,</p>
                            <p>your message will sent to their Jingchat inbox</p>
                        </div>
                        <div class="jingchat_message_input">
                              <textarea data-user="<?php echo $user['uid']?>" id="message" rows="3" cols="" class="input-tip" data-tipval="Type your message here">Type your message here</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
     <div class="sresult-par1">
        <div class="box rel sresult-row id-4">
        <div class="noresult">
            Sorry, no matches were found, <br/>please alter your search and try again.
            </div>
        </div>
    </div>
    <?php endif;?>
    <input type="hidden" id="msg_id" />
    <input type="hidden" id="user2" />
</div>

<!--backtop-->
<div class="backtop png"></div>
</div>
    <div class="view_portfolio_pop png">
        <div class="view_portfolio_pop_wrap rel">
            <i class="view_portfolio_pop_close abs" title="close"></i>
            <div class="view_portfolio_header">
                <h1>Loading...</h1>
                <p>Loading...</p>
            </div>
            <div class="view_portfolio_body">
                <div class="view_portfolio_content text_style">
                    <div class="content_text">
                        Loading content...
                    </div>
                    <div class="font_zoom_bar">
                        <img class="zoom_in" src="<?php echo $theme_path;?>/style/portfolio/btn_zoom_in.png" alt="prev" title="previous" />
                        <img class="zoom_out" src="<?php echo $theme_path;?>/style/portfolio/btn_zoom_out.png" alt="prev" title="previous" />
                    </div>
                </div>
                <div class="view_portfolio_content audio_style" style="display:none;">
                    <div class="content_audio">
                        <div class="audio_icon"><img class="zoom_out" src="<?php echo $theme_path;?>/style/portfolio/audio_icon.png"/></div>
                        <div class="jplayer_wrapper">
                            <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                            <div id="jp_container_1" class="jp-audio">
                                <div class="jp-type-single">
                                    <div class="jp-gui jp-interface">
                                        <ul class="jp-controls">
                                            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                                            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                                            <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
                                            <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                                            <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                                            <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
                                        </ul>
                                        <div class="jp-progress">
                                            <div class="jp-seek-bar">
                                                <div class="jp-play-bar"></div>
                                            </div>
                                        </div>
                                        <div class="jp-volume-bar">
                                            <div class="jp-volume-bar-value"></div>
                                        </div>
                                        <div class="jp-time-holder">
                                            <div class="jp-current-time"></div>
                                            <div class="jp-duration"></div>

                                        </div>
                                    </div>

                                    <div class="jp-no-solution">
                                        <span>Update Required</span>
                                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="view_portfolio_content image_style" style="display:none;">
                    <div class="content_img">
                        <img src="<?php echo $theme_path;?>/style/portfolio/1.jpg"/>
                    </div>

                </div>
                <div class="view_portfolio_content other_text_style" style="display:none;">
                    <div class="other_text_content">
                        <a href="#" target="_blank">Open/Download this file</a>
                    </div>

                </div>

                <div class="view_portfolio_navigator">
                    <div class="als-container" id="portfolio_view_bar">
                        <span class="als-prev"><img src="<?php echo $theme_path;?>style/btns/previous_arrow.png" alt="prev" title="previous" /></span>
                        <div class="als-viewport">
                            <ul class="als-wrapper">


                            </ul>

                        </div>
                        <span class="als-next"><img src="<?php echo $theme_path;?>style/btns/forward_arrow.png" alt="next" title="next" /></span> <!-- "next" button -->

                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#portfolio_view_bar").als({
                            circular: "no",
                            autoscroll: "no",
                            scrolling_items: 1,
                            visible_items: 6
                        });
                    });
                </script>
            </div>
        </div>
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
<script type="text/javascript" src="<?php echo $theme_path?>js/searchJobPage.js"></script>

<script type="text/javascript" src="<?php echo $theme_path?>js/My97DatePicker/WdatePicker.js"></script>

<?php $this->load->view($front_theme.'/footer-block');?>