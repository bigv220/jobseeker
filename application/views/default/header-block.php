<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php
            if (!empty($title))
                echo $title . ' | ';
            if (!empty($article['title']))
                echo $article['title'] . ' | ';
            echo $site_name;
            ?></title>
        <meta name="keywords" content="<?php echo $keyword ?>" >
        <meta name="description" content="<?php echo $description ?>" >

        <link rel='shortcut icon' type='image/x-icon' href='<?php echo $theme_path ?>style/site/favicon.ico' />

        <link href="<?php echo $theme_path ?>style/pub.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/home.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/company.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/reg.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/search.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/adv-search.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $theme_path ?>style/kyo-form/kyo-form.css" rel="stylesheet" type="text/css" />
        <!--Import Select TAG CSS -->
        <link href="<?php echo $theme_path ?>css/tag/tagit-simple-grey.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/jquery-1.7.2.min.js" ></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/jquery.lazyload.min.js" ></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/kyo4311.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/kyo4311-form.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/jquery-ui.1.8.20.min.js" ></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/jquery.validate.js" ></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/jslib/ajaxupload.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/common.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/home.js"></script>
        <script type="text/javascript" src="<?php echo $theme_path ?>js/interview.js"></script>

        <script>
            var site_url = "<?php echo $site_url ?>";
            var base_url = "<?php echo $base_url ?>";
            var theme_url = "<?php echo $theme_path ?>";
            var current_login_user_id = "<?php echo (isset($uid) ? $uid : -1) ?>";
            function topSearchSubmit() {
                $('#topSearchForm').submit();
            }


            function funcFindstaff() {
                var user_type = <?php echo json_encode($this->session->userdata('user_type')); ?>;

                if (user_type != 1) {
                    alert("You have to be logged in as a company to be able to see this page.");
                } else {
                    window.location = site_url + "search/findstaff";
                }
            }

//            $('input[type="submit"].login-btn').on("click",(function(e) {
//                e.preventDefault();
//                alert('e');
//                $('.login-btn').html('Loading...');
//            });

        </script>

        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-48145475-1', 'jingjobs.com');
            ga('send', 'pageview');

        </script>

    </head>
    <body>

        <!--header-->
        <div class="p-hd">



            <div class="w100">
                <div class="phd-menu fl">
                    <a class="phd-logo png" href="<?php echo $site_url ?>"><img src="<?php echo base_url(); ?>theme/default/style/pub/logo.png" alt="logo" /></a>
                    <ul>
                        <li class="home"><a href="<?php echo $site_url ?>"></a></li>
                        <li class="about"><a href="<?php echo $site_url ?>page/aboutus"></a></li>
                        <li class="news"><a href="<?php echo $site_url ?>news"></a></li>
                        <?php
                        $current_user_type = isset($user_type) ? $user_type : -1;
                        if (true || 0 == $current_user_type):
                            ?>
                            <li class="jobs"><a href="<?php echo $site_url ?>search/findjob"></a></li>

                        <?php endif; ?>

                        <li class="findstaff"><a href="#" onclick="funcFindstaff();"></a></li>
                        <?php // echo $site_url ?><!--search/findstaff-->

                        <li class="post"><a href="<?php echo $site_url ?>job/postjob" class="check_login_user_type_for_postjob"></a></li>
                    </ul>
                </div>



                <div class="phd-login fr rel">
                    <div class="phd-login-text">
                        <?php if (!isLogin()): ?>
                            Login
                        <?php else: ?>
                            <?php echo isset($first_name) ? $first_name : ""; ?>&nbsp;
                            <?php
                            if (!isCompany($user_type)) {
                                echo isset($last_name) ? $last_name : "";
                            }
                            ?>
                        <?php endif; ?>
                    </div>

                    <div id="login_pop" class="phd-login-pop png">
                        <div class="phd-login-pop-header">
                            <div class="phd-login-pop-header-txt">LOGIN</div>
                            <div class="forget-pw">
                                Forgot Password<img src="<?php echo $theme_path ?>style/pub/question_mark.png"><a href="javascript:void(0);" id="forget_password_btn">Click Here</a>
                                <br />Sign up <a href="javascript:void(0);" id="sign_up_btn_header">Click Here</a> 
                            </div>
                            <div style="clear:both;"></div>
                        </div>

                        <div class="phd-login-pop-content">
                            <div class="login-error-msg"></div>
                            <form id="login_form" method="post" action="<?php echo $site_url ?>user/login">
                                <p class="username-wrap"><input type="text" id="username" name="username" value="" class="input input-user" /></p>
                                <p class="password-wrap"><input type="password" id="login_password" name="login_password" value="" class="input input-pass" /></p>
                                <p class="tac" ><input type="submit" value="" class="login-btn" /></p>
                            </form>
                        </div>
                        <div class="phd-login-pop-footer"><a href="#"></a></div>
                    </div>

                    <?php if (!isLogin()): ?>
                        <script>userType = -1;//not login</script>
                    <?php else: ?>


                        <div id="jobseeker_menu" class="phd-login-pop png">
                            <div class="phd-login-pop-content">
                                <ul>
                                    <?php if (isCompany($user_type)): ?>
                                        <script>userType = 1;</script>
                                        <li><a href="<?php echo $site_url ?>company/companyprofile" class="view_profile_logo">View Profile</a></li>
                                        <li><a href="<?php echo $site_url ?>company/register" class="edit_profile_logo">Edit Company Profile</a></li>
                                        <li><a href="<?php echo $site_url ?>company/joblisting" class="manage_job_logo">Manage Job Listings</a></li>
                                        <li><a href="<?php echo $site_url ?>company/applicants" class="applied_jobs_logo">View Applicants</a></li>
                                        <li><a href="<?php echo $site_url ?>company/shortlistCandidates" class="candidates_logo">View Shortlisted Candidates</a></li>
                                        <li><a href="<?php echo $site_url ?>inbox" class="jingchat_logo">JingChat</a></li>  
                                    <?php else: ?>
                                        <script>userType = 0;</script>
                                        <li><a href="<?php echo $site_url ?>jobseeker/viewprofile" class="view_profile_logo">View Profile</a></li>
                                        <li><a href="<?php echo $site_url ?>jobseeker/register" class="edit_profile_logo">Edit Profile</a></li>
                                        <li><a href="<?php echo $site_url; ?>jobseeker/savedBookmarks" class="saved_bookmarks_logo">Saved Bookmarks</a></li>
                                        <li><a href="<?php echo $site_url ?>job/appliedjobs" class="applied_jobs_logo">Applied Jobs</a></li>
                                    <?php endif; ?>
                                    <li class="last"><a href="<?php echo $site_url ?>user/logout" class="sign_out_logo">Sign out</a></li>
                                </ul>

                            </div>
                            <div class="phd-login-pop-footer"></div>
                        </div>

                        <script type="text/javascript">show_login_user_menu();</script>

                    <?php endif; ?>

                    <div id="resetpw_pop" class="phd-login-pop png">
                        <div class="phd-login-pop-header">
                            <div class="phd-login-pop-header-txt">Reset Password</div>
                            <div style="clear:both;"></div>
                        </div>

                        <div class="phd-login-pop-content">
                            <div>Enter the email address you used to create your JingJobs account and we'll email you a link so you can create a new password.</div>
                            <form id="resetpw_form" method="post" action="<?php echo $site_url ?>user/sendResetPwRequest">
                                <p class="username-wrap"><input type="text" name="username" value="" class="input input-user" /></p>
                                <p class="tac" ><input type="submit" value="" class="send-btn" /></p>
                            </form>
                        </div>
                        <div class="phd-login-pop-footer"></div>
                    </div>

                </div>
            </div>
        </div>

        <!--top search area-->
        <div class="top-search w70 rel">
            <form action="<?php echo $site_url; ?>search/searchJob" method="post" id="topSearchForm">
                <input type="hidden" name="top_search" value="1" />
                <input type="text" name="keywords" class="abs top-search-input input-tip" value="Enter Keywords" data-tipval="Enter Keywords"/>
                <input type="submit" class="abs top-search-btn" value=""  title="search" onclick="topSearchSubmit()"   />
            </form>
            <?php if (isCompany($user_type)): ?>
                <a href="<?php echo $site_url ?>search/findstaff" class="abs top-search-a">More Options</a>
            <?php else: ?>
                <a href="<?php echo $site_url ?>search/findjob" class="abs top-search-a">More Options</a>
            <?php endif; ?>
        </div>