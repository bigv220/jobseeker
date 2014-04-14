<!-- NAVIGATION -->             
            <nav>
                <div id="nav_bg">
                    <div id="nav_bg_left"> </div>
                    <div id="nav_bg_right"> </div>
                    <img src="<?php echo $theme_path ?>style/pub/header.jpg">
                </div>
                <div id="nav_left">
    <!-- PHONE NAVIGATION -->
                    <div id="phone_nav">
                        <figure id="phone_nav_tab">                 
                            NAVIGATE                
                        </figure>
                    </div>
                    <div id="phone_bubble">
                        <div id="button_container">
                            <a id="first" href="<?php echo $site_url ?>">HOME</a>
                            <a href="<?php echo $site_url ?>page/aboutus">ABOUT US</a>
                            <a href="<?php echo $site_url ?>news">JING NEWS</a>
                            <?php
                        $current_user_type = isset($user_type) ? $user_type : -1;
                        if (true || 0 == $current_user_type):
                            ?>
                            <a href="<?php echo $site_url ?>search/findjob">JOBS</a>
                            <?php endif; ?>
                            <a href="#" onclick="funcFindstaff();">FIND STAFF</a>
                            <a href="<?php echo $site_url ?>job/postjob" class="check_login_user_type_for_postjob">POST A JOB</a>
                        </div>
                    </div>
    <!-- /PHONE NAVIGATION -->
                    <div class="computer">
                        <a id="first" href="<?php echo $site_url ?>">HOME</a>
                            <a href="<?php echo $site_url ?>page/aboutus">ABOUT US</a>
                            <a href="<?php echo $site_url ?>news">JING NEWS</a>
                    </div>
                </div>
                <a href="<?php echo $site_url ?>"><img id="logo" src="<?php echo $theme_path ?>style/pub/logo.jpg"></a>
                <div id="nav_right">
                    <div>
                        <?php
                        $current_user_type = isset($user_type) ? $user_type : -1;
                        if (true || 0 == $current_user_type):
                            ?>
                            <a href="<?php echo $site_url ?>search/findjob">JOBS</a>
                            <?php endif; ?>
                            <a href="#" onclick="funcFindstaff();">FIND STAFF</a>
                            <a href="<?php echo $site_url ?>job/postjob" class="check_login_user_type_for_postjob">POST A JOB</a>
                    </div>
                    <figure id="nav_tab">                   
                        LOGIN //<br />
                        SIGN UP                 
                    </figure>
                    <figure id="bubble">
                        <figure id"login_content">
                            <span id="login">
                                Login
                            </span>
                            <span id="reset">
                                Reset Password
                            </span>
                            <span id="oops">
                                Oops!
                            </span>
                            <span id="got_mail">
                                You've Got Mail
                            </span>
                            <span id="forgot">
                                Forgot Password? <a href="javascript:void(0);" id="forget_password_btn">Click Here</a>
                            </span>
                            <span id="sign_up">
                                No Account? <a href="javascript:void(0);" id="sign_up_btn_header">Sign up now!</a>
                            </span>
                            <span id="incorrect">
                                <p>Either your email or password is incorrect, please try again.</p>
                            </span>
                            <span id="instructions">
                                <p>Enter the email address you used to create your JingJobs account and we'll email you a link so you can create a new password.</p>
                            </span>
                            <span id="no_one">
                                <p>No one with that email was found, please try again with an alternative email address.</p>
                            </span>
                            <span id="check_mail">
                                <p>Please check you email, we've sent you instructions on how to reset your password.</p>
                            </span>
                            <form id="login_in_form" method="post" action="<?php echo $site_url ?>user/login">
                                    <img class="bubble_icon_username" src="<?php echo $theme_path ?>style/pub/username_icon.png">
                                <input type="text" id="username" name="username" placeholder="Email">
                                    <img id="bubble_icon_password" src="<?php echo $theme_path ?>style/pub/password_icon.png">
                                <input type="password" name="login_password" id="login_password" placeholder="Password">
                                <input type="submit" value="LOGIN">                             
                            </form>
                            <form id="forgot_form">
                                    <img class="bubble_icon_username" src="<?php echo $theme_path ?>style/pub/username_icon.png">
                                <input type="text" name="email" placeholder="Email">
                                <input type="submit" value="SEND">                              
                            </form>
                            <form id="ok_form">
                                <input type="submit" value="OK">                                
                            </form>
                            <div class="clearfix"></div>
                        </figure>
                    </figure>
                    
                </div>          
            </nav>  