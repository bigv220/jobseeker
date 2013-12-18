<?php $this->load->view($front_theme.'/header-block');?>

<!--company login page body-->
<div class="company-page w770 clearfix rel">
  <div class="company-body box rel mb5">
    <div class="company-hd jobseeker-hd rel">
        <?php if (!empty($userinfo['profile_pic'])): 
        $pic = $site_url.'attached/users/'.$userinfo['profile_pic'];
        ?>
        <div class="people_icon company_icon">
          <img src="<?php echo $pic; ?>" alt="" width="128px" height="128px" class="jobseeker_icon"/>
        </div>

        <?php else: ?>
        <i class="abs face png"></i>
        <?php endif; ?>
      <div class="text_wrapper">
        <h2><?php echo $userinfo['first_name'].' '.$userinfo['last_name']; ?></h2>
        <h4><?php echo $userinfo['city'].', '.$userinfo['country']; ?></h4>
        <p class="profile_views_num">4 Profile Views</p>
      </div>
      <div class="btnarea">
          <a href="<?php echo $site_url?>company/register" class="png square_btn edit_profile_btn"></a>
          <a href="#" class="png square_btn jingchat_inbox_btn"></a>
          <span class="bubble jingchat_inbox_bubble">2</span>
          <a href="#" class="png square_btn view_my_candidates_btn view_my_candidates_btn_current"></a>
          <a href="#" class="png square_btn view_my_interviews_btn"></a>
          <span class="bubble view_my_interviews_bubble">10</span>
      </div>
    </div>

  </div>
</div>

<div class="result-page w770 clearfix view_applied_jobs_page" style="margin-top:20px;">
<!--search-result condition-->
<div class="result-condition rel box">
    <div class="search_interviews">
        <label>Search Job Listings</label>
        <form action="#">
            <input type="text" name="saved_candidates_keywords" class="kyo-input input-tip" style="width:203px;border:none;line-height:23px;height:23px;" data-tipval="Enter Keywords" value="Enter Keywords">
            <input type="submit" name="search_saved_candidates_btn" class="search_interview_btn search_saved_candidates_btn" value=""/>
        </form>
    </div>
</div>

<!--search-result body-->
<div class="result-bd">
	<?php foreach ($jobs as $job):?>
    <div class="box rel sresult-row">
        <div class="sresult-par1">
            <div class="span1 rel">
                <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="80px" height="80px" class="round_corner10_img"/>
            </div>
            <div class="span2">
                <h2>Job Title Here</h2>
                <h3>Company Name</h3>
                <p>Beijing, China</p>
                <a href="#" class="job-viewmore">View More</a> </div>
            <div class="span3">
                <div class="zoom">
                    <a href="#" class="company-btn-delete-job"></a>
                    <a href="#" class="job-btn job-btn-match">93%</a>
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
                        <div class="text_r">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                        <dl class="sresult-nav-job-dl">
                            <dt>Industry</dt>
                            <dd>
                                <a href='#'>Graphic Design</a>
                                <a href='#'>Media Publishing</a>
                                <a href='#'>Marketing</a>
                            </dd>
                            <dt>Current Employment</dt>
                            <dd><p class="employment_title">Clinical Nurse Specialist for NHS London</p>
                                <p class="emploeyment_period">
                                    June 2011 – Present (2 years 3 months)
                                </p>
                                <p class="employment_description">
                                    My main role is to provide an in-reach service to HMP Addiewell where I support and develop the testing service, assess and support patients through treatment for hepatitis C. I co-lead a project called HATMEP (hepatitis awareness and treatment of minority ethnic populations).
                                </p>
                            </dd>
                            <dt>Previous Employment</dt>
                            <dd><p class="employment_title">Keep Well Outreach Worker/Project Nurse for NHS London</p>
                                <p class="emploeyment_period">
                                    December 2009 – June 2011 (1 year 7 months)
                                </p>
                                <p class="employment_description">
                                    Keep well's vision is to reduce health inequalities and tackle the incidence of cardiovascular disease in the homeless, gypsy/traveller, offender and ex-offender populations of 35+yrs old by providing anticipatory care.
                                    As an outreach worker and project nurse specifically working with the homeless and travelling populations, I support, buddy, mentor, advise, educate, signpost and develop tailor made support programmes/information for my client group.
                                    Courses completed - motivational interviewing, solution focused interviewing, smoking cessation, alcohol brief intervention, safetalk, ASSIST training.
                                </p>
                            </dd>

                            <dt>Personal Skills</dt>
                            <dd>Time Managment, Public Speaking, Networking, Leadership<dd>
                            <dt>Technical Skills</dt>
                            <dd>Branding, Adobe Creative Suite, Printing, Critical Thinking</dd>
                            <dt>Language(s)</dt>
                            <dd>
                                <div class="jobseeker_profile_language">
                                    <label>English</label>
                                    <i>Yiban</i>
                                </div>

                            </dd>
                        </dl>
                    </div>
                    <div class="sresult-nav-job-right">
                        <dl class="sresult-nav-job-dl">
                            <dt>Birthday</dt>
                            <dd>
                                <p class="jobseeker_birthday">May 15 1984</p>
                            </dd>
                            <dt>Education</dt>
                            <dd>
                                <p class="school_name">School Name Here</p>
                                <p class="school_major">School Major</p>
                                <p class="school_period">2004 - 2008</p>
                            </dd>
                            <dt>Elsewhere on Web</dt>
                            <dd>
                                <p><a href="#">Twitter</a></p>
                                <p><a href="#">Facebook</a></p>
                                <p><a href="#">Linkedin</a></p>
                                <p><a href="#">Weibo</a></p>
                            </dd>

                            <dt>Phone</dt>
                            <dd><p class="phone_number">15553226263</p></dd>
                            <dd class="industry">
                                <ul class="industry-ul">
                                    <li class="n1"><b>Type of Employment</b><span>Full Time</span></li>
                                    <li class="n2"><b>Length of Employment</b><span>Long Term (1+ year)</span></li>
                                    <li class="n3"><b>Visa Assistance</b><span>Visa will be provided</span></li>
                              <li class="n4"><b>Housing Assistance</b><span>Accomodation will be provided</span></li>
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
	<?php endforeach;?>
</div>
<!--backtop-->
<div class="backtop png" style="right:200px;"></div>
</div>

<!--popmark-->
<div class="pop-mark"></div>

<div class="reply_message_pop png">
    <div class="reply_message_pop_wrap rel">
        <i class="reply_message_pop_close abs" title="close"></i>
        <b>Send JingChat Message</b>
        <div class="reply_message_pop_bd">
            <div class="reply_message_pop_bd_heder">
                <div>
                    <div class="title">To:</div>
                    <div class="content">Redstar Works Ltd.</div>
                    <div style="clear:both;"></div>
                </div>
                <div>
                    <div class="title">Subject:</div>
                    <div class="content"><input name="message_subject" value="Re:Interview Request"/></div>
                    <div style="clear:both;"></div>
                </div>
            </div>
            <div class="reply_message_pop_bd_content">
                <textarea>
                    On November 22, 2013 4:05 AM,  Redstar Works wrote:
                    --------------------

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

                    I look forward to speaking with you on Tuesday,

                    Joe Bloggs
                </textarea>
            </div>
            <div class="reply_message_pop_bd_action_bar">
                <img src="<?php echo $theme_path;?>/style/btns/btn_send_message.png" alt="" class="send_message_function"/>
            </div>
        </div>
    </div>
</div>

<div class="message_sent_pop png">
    <div class="message_sent_pop_wrap rel">
        <i class="message_sent_pop_close abs" title="close"></i>
        <div class="message_sent_pop_bd">
            <div class="message_title">Your message has been sent</div>
            <div class="message_content"><a href="#">View in JingChat Inbox Now</a></div>
        </div>
    </div>
</div>
<!-- Partners -->
<?php $this->load->view($front_theme.'/partners-block');?>
<script type="text/javascript" src="<?php echo $theme_path?>js/search-result.js"></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/advsearch.js"></script>
<?php $this->load->view($front_theme.'/footer-block');?>