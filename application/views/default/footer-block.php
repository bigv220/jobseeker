<!--popmark-->
<div class="pop-mark"></div>

<!--pop reg-->
<div class="pop-reg png">
    <div class="pop-reg-wrap rel">
        <form id="signup_form" method="post" action="<?php echo $site_url?>user/signup">
            <div class="pop-reg-close abs" title="close"></div>
            <div class="pop-reg-tit">
                <i>Already have an account? <a href="javascript:void(0);" class="login_on_regpop">Login</a></i>
                <b>Sign Up</b>
            </div>
            <div class="pop-reg-error-msg">
                An account using this email already exists,
                please <a href="javascript:void(0);" class="login_on_regpop">login</a>
                or request a new password <a href="javascript:void(0);" class="login_on_regpop">here</a></div>
            <div class="pop-reg-type">
                <input id="RegType" value="0" class="kyo-radio" style="display:none;"/>
                <i class="kyo-radio reg-typep font_bold" data-id="RegType" data-val="0">Jobseeker</i>
                <i class="kyo-radio reg-typec font_bold" data-id="RegType" data-val="1">Employer</i>
            </div>
            <div class="pop-reg-personal">
                <label class="fl">
                    <b>First Name</b>
                    <input type="text" id="first_name" name="first_name" class="kyo-input"/>
                </label>
                <label  class="fr">
                    <b>Last Name</b>
                    <input type="text" id="last_name" name="last_name" class="kyo-input" />
                </label>
            </div>
            <div class="pop-reg-company"  style="display:none;">
                <label>
                    <b>Company Name</b>
                    <input type="text" id="company_name" name="company_name" class="kyo-input" />
                </label>
            </div>
            <div class="pop-reg-mail">
                <label>
                    <b>Email</b><span class="email_existing"></span>
                    <input type="text" id="email" name="email" class="kyo-input" />
                </label>
            </div>
            <div class="pop-reg-password">
                <label>
                    <b>Password</b>
                    <input type="password" id="password" name="password" class="kyo-input" />
                </label>
            </div>
            <div class="pop-reg-agree">
                <input id="RegNewsletter" value="1" class="kyo-checkbox" style="display:none;"/>
                <input id="RegAgree" value="1" class="kyo-checkbox" style="display:none;"/>
                <i class="kyo-checkbox" data-id="RegNewsletter" data-val="1">Subscribe to Newsletter</i>
                <i class="kyo-checkbox margin_left15" data-id="RegAgree" data-val="1">Agree to terms</i>


            </div>
            <div class="pop-reg-submit">
                <input type="text" id="signup_submit" class="pop-reg-submit-btn" />
            </div>
        </form>
    </div>
    <div class="pop-reg-footer"></div>
</div>
<!--pop reg success-->
<div class="pop-welcome png">
    <div class="pop-welcome-wrap rel">
        <i class="pop-welcome-close abs" title="close"></i>
        <b>WELCOME TO JINGJOBS It’s time to GetJinged</b>
        <div class="pop-welcome-bd">
            <div class="span1"><span class="left-span-text">Tell us more about<br/> your company </span><br/>
                <a class="pop-welcome-here left-btn-link" href="<?php echo $base_url?>company/register"></a></div>
            <div class="span2">OR</div>
            <div class="span3"><span class="right-span-text">Start looking at<br/> jobseekers </span><br/>
                <a class="pop-welcome-here right-btn-link" href="<?php echo $base_url?>search/findstaff"></a>
            </div>
        </div>
    </div>
</div>
<!--pop message-->
<div class="pop-message png">
    <div class="pop-message-wrap rel">
        <i class="pop-message-close abs" title="close"></i>
        <b>An email for you</b>
        <div class="pop-message-bd">
            <div class="message_title">We have sent you an email with a special link to complete the registration.</div>
            <div class="message_content">If you don’t receive the email within several minutes, please check your spam folder.</div>
        </div>
    </div>
</div>

<div class="request_interview_pop png">
    <div class="request_interview_pop_wrap rel">
        <i class="request_interview_pop_close abs" title="close"></i>
        <b>Send Interview request to <span>Name Here</span></b>
        <div class="request_interview_pop_bd">
            <div class="request_interview_pop_left">
                <label>Position Title</label>
                <select name="position_title">
                    <option value="">Position Title One</option>
                    <option value="1">Position Title Two</option>
                </select>
                <label>Optional Message</label>
                <textarea name="optional_message"></textarea>
                <label>Date</label>
                <div class="date_selector_wrapper">
                    <input name="sent_date"/><img src="<?php echo $theme_path;?>/style/portfolio/calendar_selector_btn.png"/>
                </div>
            </div>
            <div class="request_interview_pop_right">
                <div class="preferred_communication_wrapper">
                    <label>Preferred Communication</label>
                    <input type="hidden" name="preferred_communication" id="preferred_communication" value="1" />
                    <i data-val="0" data-id="preferred_communication" class="kyo-radio kyo-radio-sel">Personal Email</i>
                    <i data-val="1" data-id="preferred_communication" class="kyo-radio">JingChat</i>
                    <i data-val="2" data-id="preferred_communication" class="kyo-radio">Phone</i>
                    <i data-val="3" data-id="preferred_communication" class="kyo-radio">Skype</i>
                    <i data-val="4" data-id="preferred_communication" class="kyo-radio">Other</i>
                    <input name="other_preferred_communication"/>
                </div>
                <div class="time_selector_wrapper">
                    <div class="time_zone">
                        <label>Time Zone</label>
                        <select name="time_zone">
                            <option value="0">GMT</option>
                            <option value="1">UTC</option>
                        </select>
                    </div>
                    <div class="time_wrapper">
                        <label>Time</label>
                        <input name="time_input"/>
                    </div>
                </div>
            </div>
            <div class="request_interview_pop_actions">
                <img class="cancel_request_interview" src="<?php echo $theme_path;?>/style/btns/btn_cancel.png"/>
                <img class="send_request_interview" src="<?php echo $theme_path;?>/style/btns/btn_send.png"/>
            </div>
        </div>
    </div>
</div>
<!--footer-->
<div class="pft-wrap">
	<div class="p-ft w70">
		<div class="pft-cn-text">
		中国人使用JINGJOBS的热情，并未因非英文母语的现状而消减。事实上，我们提供的翻译服务获得了雇主与应聘者的一致好评。您只需提供职位需求或个人简历，我们将竭诚为您翻译为专业的英文。此外，我们还可以为您设计相关细节——使您不论招聘或应征，都脱颖而出。
		</div>
		<div class="pft-text">
			<dl class="mr">
				<dt>FOLLOW US</dt>
				<dd>You can find Jingjobs.com on a range of social websites.</dd>
			</dl>
			<dl class="mr">
				<dt>DROP US A LINE</dt>
				<dd>Got any questions, or just want to say hello? We’d love to hear from you.</dd>
			</dl>
			<dl>
				<dt>STAY CONNECTED</dt>
				<dd>Sign up to our newsletter and keep up to date with excititng new jobs and news.</dd>
			</dl>
		</div>
		<div class="p-footer">
			<div class="span1 p-footer-weibo">
				<a href="#" class="pficon pfi-i"></a>
				<a href="#" class="pficon pfi-f"></a>
				<a href="#" class="pficon pfi-t"></a>
				<a href="#" class="pficon pfi-r"></a>
				<a href="#" class="pficon pfi-s"></a>
				<a href="#" class="pficon pfi-q"></a>
			</div>
			<div class="span2 p-footer-contact">
				<p><b>EMAIL:</b> <a href="mailto:info@jingjobs.com">info@jingjobs.com</a></p>
				<p><b>SKYPE:</b> JingjobsChina</p>
			</div>
			<div class="span3 p-footer-mail">
                <form id="newsletter_form">
                    <input type="text" id="newsletter_email" name="newsletter_email" class="pf-input input-tip" data-tipval="Email address" value="Email address"/>
                    <input type="submit" id="newsletter_submit" class="pf-btn" value="" />
                </form>
			</div>
		</div>
	</div>
</div>

<!-- <script type="text/javascript" src=""></script> -->

<script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.jSelectDate.js" ></script>
<script type="text/javascript" src="<?php echo $theme_path?>js/tagit.js" ></script>

<script type="text/javascript" src="<?php echo $theme_path?>js/company.js"></script>

<!--[if IE 6]> 
<script type="text/javascript"  src="js/jslib/DD_belatedPNG_0.0.8a-min.js"></script> 
<script>
	DD_belatedPNG.fix('.png');
</script> 
<![endif]-->

</body>
</html>