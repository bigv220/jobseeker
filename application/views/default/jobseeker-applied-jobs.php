<?php $this->load->view($front_theme.'/header-block');?>

<!--company login page body-->
<div class="company-page w770 clearfix rel">
  <div class="company-body box rel mb5">
    <div class="company-hd jobseeker-hd rel">
        <?php if (!empty($userinfo['profile_pic'])): 
        $pic = $site_url.'attached/users/'.$userinfo['profile_pic'];
        ?>
        <div class="people_icon">
          <img src="<?php echo $pic; ?>" alt="" width="128px" height="128px" class="jobseeker_icon"/>
        </div>

        <?php else: ?>
        <i class="abs face png"></i>
        <?php endif; ?>
      <div class="text">
        <h2><?php echo $userinfo['first_name'].' '.$userinfo['last_name']; ?></h2>
        <h4><?php echo $userinfo['city'].', '.$userinfo['country']; ?></h4>
        <p class="profile_views_num">4 Profile Views</p>
      </div>
      <div class="btnarea">
          <a href="#" class="png square_btn edit_profile_btn"></a>
          <a href="#" class="png square_btn jingchat_inbox_btn"></a>
          <span class="bubble jingchat_inbox_bubble">2</span>
          <a href="#" class="png square_btn saved_bookmarks_btn"></a>
          <a href="#" class="png square_btn view_my_interviews_btn"></a>
          <span class="bubble view_my_interviews_bubble">10</span>
         </div>
    </div>

  </div>
</div>

<div class="result-page w770 clearfix view_applied_jobs_page" style="margin-top:20px;">
<!--search-result condition-->
<div class="result-condition rel box">
    <h2 class="applied_jobs_title">Applied Jobs</h2>

    <div class="search_interviews">
        <label>Search Applied Jobs</label>
        <form action="#">
            <input type="text" name="applied_jobs_keywords" class="kyo-input input-tip" style="width:203px;border:none;line-height:23px;height:23px;" data-tipval="Enter Keywords" value="Enter Keywords">
            <input type="submit" name="search_applied_jobs_btn" class="search_interview_btn search_applied_jobs_btn" value=""/>
        </form>
    </div>
</div>

<!--search-result body-->
<div class="result-bd">
    <div class="box rel sresult-row">
        <div class="sresult-par1">
            <div class="span1 rel">
                <img src="<?php echo $theme_path;?>/style/search/job-img2.gif" alt="" width="90px" height="90px" class="round_corner10_img"/>
            </div>
            <div class="span2">
                <h2>Job Title Here</h2>
                <h3>Company Name</h3>
                <p>Beijing, China</p>
                <a href="#" class="job-viewmore">View More</a> </div>
            <div class="span3">
                <div class="interview_sent_date">DD/MM/YY</div>

            </div>
        </div>
        <div class="sresult-par2">

            <div class="zoom">
                <div class="sresult-nav-job">
                    <div class="sresult-nav-job-left">
                        <div class="text_r">
                            <p>We have an exciting opportunity for a full time Graphic Designer to join our creative team.
                                We are a leading creative, events and media agency with offices in Beijing, London and Qingdao.
                                We create and distribute amazing work for a variety of retailers and clients. You will be working on great brands such as Baccarat, Arcosteel, Alex Liddy and Marie Claire.
                                We offer the opportunity to work with a great team on exciting, creative and challenging designs.
                                Reporting to the marketing manager, you will be assisting on projects ranging from packaging, catalogues, theme and design concepts, product development, decals and surface decorations applied to a range of home products, flyers, ads, signage, posters, for a variety of brands and various brand style applications.</p>
                        </div>
                        <dl class="sresult-nav-job-dl">
                            <dt>Preferred Years of Experience</dt>
                            <dd>1 to 3 years</dd>
                            <dt>Preferred Personal Skills</dt>
                            <dd>Time Managment, Public Speaking, Networking, Leadership</dd>
                            <dt>Preferred Technical Skills</dt>
                            <dd>Branding, Adobe Creative Suite, Printing, Critical Thinking</dd>
                            <dt>Language(s) Required</dt>
                            <dd>
                                <div class="jobseeker_profile_language">
                                    <label>English</label>
                                    <i>Yiban</i>
                                    <label>English</label>
                                    <i>Yiban</i>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="sresult-nav-job-right">
                        <dl class="sresult-nav-job-dl">
                            <dt>Location</dt>
                            <dd>
                                <input type="hidden" id="address" value="address" />
                                <!--
                                <div id="map" style="width:149px;height:83px;border: 1px solid #DDDDDD"></div>
                                -->
                                <strong><a href="#">Job location</a></strong>
                            </dd>
                            <dt>Salary</dt>
                            <dd>10,000 CNY – 15,000 CNY</dd>
                            <dt>Industry</dt>
                            <dd class="industry">
                                <div>
                                    <a href="#">Graphic Design</a>
                                    <a href="#">Media Publishing</a>
                                    <a href="#">Marketing</a>

                                </div>
                                <ul class="industry-ul">
                                    <li class="n1"><b>Type of Employment</b><span>full time</span></li>
                                    <li class="n2"><b>Length of Employment</b><span>long term</span></li>
                                    <li class="n3"><b>Visa Assistance</b><span>Visa will be provided</span></li>
                                    <li class="n4"><b>Housing Assistance</b><span>Accomodation will be provided</span>
                                    </li>
                                </ul>
                            </dd>
                            <dt>Share This Job</dt>
                            <dd class="share-job"> <a href="#" class="n1"></a><a href="#" class="n2"></a><a href="#" class="n3"></a><a href="#" class="n4"></a><a href="#" class="n5"></a> </dd>
                        </dl>
                    </div>
                </div>
                
            </div>

        </div>
    </div>

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