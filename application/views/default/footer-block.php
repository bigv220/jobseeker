<!--popmark--><div class="pop-mark"></div><!--pop reg--><div class="pop-reg png">    <div class="pop-reg-wrap rel">        <form id="signup_form" method="post" action="<?php echo $site_url?>user/signup">            <div class="pop-reg-close abs" title="close"></div>            <div class="pop-reg-tit">                <i>Already have an account? <a href="javascript:void(0);" class="login_on_regpop">Login</a></i>                <b>Sign Up</b>            </div>            <div class="pop-reg-error-msg">                An account using this email already exists,                please <a href="javascript:void(0);" class="login_on_regpop">login</a>                or request a new password <a href="javascript:void(0);" class="login_on_regpop">here</a></div>            <div class="pop-reg-type">                <input id="RegType" value="0" class="kyo-radio" style="display:none;"/>                <i class="kyo-radio reg-typep font_bold" data-id="RegType" data-val="0">Jobseeker</i>                <i class="kyo-radio reg-typec font_bold" data-id="RegType" data-val="1">Employer</i>            </div>            <div class="pop-reg-personal">                <label class="fl">                    <b>First Name</b>                    <input type="text" id="first_name" name="first_name" class="kyo-input"/>                </label>                <label  class="fr">                    <b>Last Name</b>                    <input type="text" id="last_name" name="last_name" class="kyo-input" />                </label>            </div>            <div class="pop-reg-company"  style="display:none;">                <label>                    <b>Company Name</b>                    <input type="text" id="company_name" name="company_name" class="kyo-input" />                </label>            </div>            <div class="pop-reg-mail">                <label>                    <b>Email</b><span class="email_existing"></span>                    <input type="text" id="email" name="email" class="kyo-input" />                </label>            </div>            <div class="pop-reg-password">              <label>                    <b>Password</b>                    <input type="password" id="password" name="password" class="kyo-input" />                </label>            </div>            <div class="pop-reg-agree">                <input id="RegNewsletter" value="1" class="kyo-checkbox" style="display:none;"/>                <input id="RegAgree" value="1" class="kyo-checkbox" style="display:none;"/>                <i class="kyo-checkbox" data-id="RegNewsletter" data-val="1">Subscribe to Newsletter</i>                <i class="kyo-checkbox margin_left15" data-id="RegAgree" data-val="1">Agree to terms</i>            </div>            <div class="pop-reg-submit">                <input type="text" id="signup_submit" class="pop-reg-submit-btn" />            </div>        </form>    </div>    <div class="pop-reg-footer"></div></div><!--pop reg success--><div class="pop-welcome png">    <div class="pop-welcome-wrap rel">        <i class="pop-welcome-close abs" title="close"></i>        <b>WELCOME TO JINGJOBS It’s time to GetJinged</b>        <div class="pop-welcome-bd">            <div class="span1"><span class="left-span-text">Tell us more about<br/> your company </span><br/>                <a class="pop-welcome-here left-btn-link" href="<?php echo $base_url?>company/register"></a></div>            <div class="span2">OR</div>            <div class="span3"><span class="right-span-text">Start looking at<br/> jobseekers </span><br/>                <a class="pop-welcome-here right-btn-link" href="<?php echo $base_url?>search/findstaff"></a>            </div>        </div>    </div></div><!--pop message--><div class="pop-message png">    <div class="pop-message-wrap rel">        <i class="pop-message-close abs" title="close"></i>        <b>An email for you</b>        <div class="pop-message-bd">            <div class="message_title">We have sent you an email with a special link to complete the registration.</div>            <div class="message_content">If you don’t receive the email within several minutes, please check your spam folder.</div>        </div>    </div></div><div class="request-sent-pop-message png">    <div class="pop-message-wrap rel">        <i class="pop-message-close abs" title="close"></i>        <div class="pop-succ-message">Your interview request has been sent successfully!</div>    </div></div><form action="<?php echo $site_url; ?>search/sendinterviewrequest" method="post" id="sendInterviewRequest"><div class="request_interview_pop png">    <div class="request_interview_pop_wrap rel">        <i class="request_interview_pop_close abs" title="close"></i>        <b>Send Interview request to <span id="jobseeker_name"></span></b>        <input type="hidden" name="jobseeker_uid" id="jobseeker_uid" />        <div class="request_interview_pop_bd">            <div class="request_interview_pop_left">                <label>Position Title</label>                <select name="job_id" id="position_title">                    <option value="">Position Title</option>                </select>                <label>Optional Message</label>                <textarea name="optional_message"></textarea>                <label>Date</label>                <div class="date_selector_wrapper">                    <input class="Wdate" name="interview_date" type="text" onClick="WdatePicker({lang:'en'})" required />                </div>            </div>            <div class="request_interview_pop_right">                <div class="preferred_communication_wrapper">                    <label>Preferred Communication</label>                    <input type="hidden" name="preferred_communication" id="preferred_communication" value="Personal Email" />                    <i data-val="Personal Email" data-id="preferred_communication" class="kyo-radio kyo-radio-sel">Personal Email</i>                    <i data-val="JingChat" data-id="preferred_communication" class="kyo-radio">JingChat</i>                    <i data-val="Phone" data-id="preferred_communication" class="kyo-radio">Phone</i>                    <i data-val="Skype" data-id="preferred_communication" class="kyo-radio">Skype</i>                    <i data-val="Other" data-id="preferred_communication" class="kyo-radio">Other</i>                    <input name="other_preferred_communication"/>                </div>                <div class="time_selector_wrapper">                    <div class="time_zone">                        <label>Country</label>                        <select name="country" required>                            <?php                                $this->load->helper('location');                                $location = getLoction();                                foreach ($location as $k=>$v):                            ?>                            <option value="<?php echo $k ?>"><?php echo $k ?></option>                            <?php endforeach;?>                        </select>                    </div>                    <div class="city">                        <label>City</label>                        <input type="text" name="city" required />                    </div>                    <div class="time_zone">                        <label>Time</label>                        <input type="text" name="time_input" required />                    </div>                </div>            </div>            <div class="request_interview_pop_actions">                <img class="cancel_request_interview" src="<?php echo $theme_path;?>/style/btns/btn_cancel.png"/>                <img class="send_request_interview" src="<?php echo $theme_path;?>/style/btns/btn_send.png"/>            </div>        </div>    </div></div></form><!--footer--><div class="pft-wrap">	<div class="p-ft w70">		<div class="pft-cn-text">中国人使用JINGJOBS的热情并不能被非英文母语的现状而打消。事实上，我们提供的翻译服务获得了雇主与应聘方的青睐。您只需为我们提供职位需求清单或个人履历，我们将竭诚为您翻译为专业标准的英文。不仅如此，我们还可以为您设计相关细节-是您不论招聘或应征，都可以脱颖而出。</div>		<div class="pft-text">			<dl class="mr">				<dt>FOLLOW US</dt>				<dd>You can find Jingjobs.com on a range of social websites.</dd>			</dl>			<dl class="mr">				<dt>DROP US A LINE</dt>				<dd>Got any questions, or just want to say hello? We’d love to hear from you.</dd>			</dl>			<dl>				<dt>STAY CONNECTED</dt>				<dd>Sign up to our newsletter and keep up to date with excititng new jobs and news.</dd>			</dl>		</div>		<div class="p-footer">			<div class="span1 p-footer-weibo">				<a href="http://linkedin.com/company/jingjobs" class="pficon pfi-i"></a>				<a href="http://facebook.com/JingJobs" class="pficon pfi-f"></a>				<a href="http://twitter.com/JingJobs" class="pficon pfi-t"></a>                                                                <!--<a href="http://Instagram.com/JingJobs" class="pficon pfi-in"></a>-->                                				<a href="http://Instagram.com/JingJobs" class="pficon pfi-r"></a>				<a href="#" class="pficon pfi-s"></a>			</div>			<div class="span2 p-footer-contact">				<p><b>EMAIL:</b> <a href="mailto:info@jingjobs.com">info@jingjobs.com</a></p>				<p><b>SKYPE:</b> JingjobsChina</p>
            
            <p><b>Support:</b> <a href="javascript:void(0);" class="pbn-support-btn">Click here</a></p>
            
            </div>			<div class="span3 p-footer-mail">                <form id="newsletter_form">                    <input type="text" id="newsletter_email" name="newsletter_email" class="pf-input input-tip" data-tipval="Email address" value="Email address"/>                    <input type="submit" id="newsletter_submit" class="pf-btn" value="" />                </form>			</div>		</div>	</div></div>
                                                                                                                                                                                                        
                                                                                                                                                            
<!--SUPPORT SYSTEM - STARTS HERE. -->

<!-- Style Sheets & Javascript fiels for PopUp works. -->
<link href="<?php echo $theme_path?>style/support.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $theme_path?>js/support.js"></script>


<!-- PopUp pages & its contents. -->
<div class="pop-mark-support"></div>

<!--First Pop Up window for Support. -->
<div style="display: none;" class="pop-reg-support png">
    <div class="pop-reg-support-wrap rel">
        
            <div class="pop-reg-support-close abs" title="close"></div>
            
            <div id="support_step1">
                <div class="pop-reg-support-agree">

                    <div class="pop-reg-support-tit">
                        <b>Support:</b>
                    </div>                    

                    <p>
                        <input id="support_option" value="0" class="kyo-radio" style="display:none;">
                        <i class="kyo-radio support_optiona font_bold" data-id="support_option" data-val="1"></i>&nbsp;
                        <label>Resend Authentication Email</label>

                        
                    </p> 


                    <p>
                        <i class="kyo-radio support_optionb font_bold" data-id="support_option" data-val="2"></i>&nbsp;
                        <label>Mail From JingJobs.com Goes to My SPAM Folder</label>
                        
                    </p>   
                    <p>
                        <i class="kyo-radio support_optionc font_bold" data-id="support_option" data-val="3"></i> &nbsp;                      
                        <label>Request Support</label>
                        
                    </p>

                    <p>&nbsp;</p>
                </div>

                <div class="pop-reg-support-submit">
                    <input id="pop-reg-support-submit" class="pop-reg-support-submit-btn" type="button">
                </div>
            </div>
  
            
            <!-- Resend Email -->
            <div id="support_option1" style="display:none;" class="support_option_container">
                    
                    <div class="pop-reg-support-tit">
                        <b>Resend Authentication Email</b>
                    </div>                
                    <form id="support_option1_form" name="support_option1_form">
                    <p>
                        <input type="hidden" value="0" class="kyo-radio" style="display:none;" name="support_option1_user_type" id="support_option1_user_type" >
                        <i class="kyo-radio support_optiona font_bold" data-id="support_option1_user_type" data-val="0"></i>&nbsp;
                        Job Seeker
                    </p> 


                    <p>
                        <i class="kyo-radio support_optionb font_bold" data-id="support_option1_user_type" data-val="1"></i>&nbsp;
                        Employer
                    </p>                   
                
                    <p>
                        <label>Email:</label> <br>
                        <input type="text" name="support_option1_email" id="support_option1_email" class="support_option_text">
                    </p>    
                    
                    <p id="support_option1_submit_btn_container">
                        <input type="button" class="support_option1_submit_btn" id="support_option1_submit_btn">
                        &nbsp;&nbsp;
                        <a href="javascript:void(0)" class="support_step2_cancel">Cancel</a> 
                    </p> 
                    
                    <p id="support_option1_status"></p>
                    </form>
            </div>
            
            <div id="support_option3" style="display:none;" class="support_option_container">
                    
                    <div class="pop-reg-support-tit">
                        <b>Request Support</b>
                    </div>                  
                
                    <form id="support_option3_form" name="support_option3_form">
                    <p>
                        <label>Name:</label>  <br>
                        <input type="text" name="support_option3_name" id="support_option3_name" class="support_option_text">
                    </p>                  
                
                    <?php if(!isLogin()): // Only if the User is not logged in. ?>
                    <p>
                        <label>Email:</label>  <br>
                        <input type="text" name="support_option3_email" id="support_option3_email" class="support_option_text">
                    </p>                     
                    <?php endif; ?>
                    
                    <p>
                        <label>Your Problem:</label> <br>
                        <select name="support_option3_problem" id="support_option3_problem" class="support_option_select">
                            <option value="Not Receiving Emails">Not Receiving Emails</option>
                            <option value="Buttons Not Working">Buttons Not Working</option>
                            <option value="Page Not Loading">Page Not Loading</option>
                            <option value="Other">Other</option>
                        </select>
                    </p> 
                    
                    <p>
                        <label>Describe your issue:</label> <br>
                        <textarea name="support_option3_description" id="support_option3_description" class="support_option_textarea"></textarea>
                    </p>                     
                    
                    
                    <p id="support_option3_submit_btn_container">
                        <input type="hidden" name="screen_width" id="screen_width">
                        <input type="hidden" name="screen_height" id="screen_height">
                        <input type="hidden" name="current_page_url" id="current_page_url" value="<?=curPageURL()?>">
                        <input type="button" class="support_option3_submit_btn" id="support_option3_submit_btn">
                        &nbsp;&nbsp;
                        <a href="javascript:void(0)" class="support_step2_cancel">Cancel</a>
                    </p> 
                    
                    <p id="support_option3_status"></p>
                    
                    </form>
            </div>            

            
    </div>
    <div class="pop-reg-support-footer"></div>
</div>

<!-- JQuery functions to handle the form submissions & Validations - STARTS HERE -->

<script type="text/javascript">

$(document).ready(function () {    

$("#screen_width").val(screen.width);
$("#screen_height").val(screen.height);

// Request Support
$('#support_option3_submit_btn').click(function() {

    $("#support_option3_status").html('');
    var error   =   0;

    if($('#support_option3_name').val()=='')
    {
        var error   =   1;
        $("#support_option3_status").html('Please enter name.');
    }
    
    <?php if(!isLogin()): // Only if the User is not logged in. ?>
    if(error==0 && $('#support_option3_email').val()=='')
    {
        var error   =   1;
        $("#support_option3_status").html('Please enter email.');
    }
    <?php endif; ?>   
        
    if(error==0 && $('#support_option3_description').val()=='')
    {
        var error   =   1;
        $("#support_option3_status").html('Please describe your issue.');
    }      
        
    
    
    if(error==0)
    {   
        $("#support_option3_status").html('Please wait...');
        $("#support_option3_submit_btn_container").hide();
        
        dataString = $("#support_option3_form").serialize();
        $.ajax({
            type: "POST",
            url: "<?php echo $site_url?>support/create",
            data: dataString,
            dataType: "json",
            success: function(data){
                    if(data.returnstatus == "error")
                    {
                        $("#support_option3_status").html(data.message); 
                        $("#support_option3_submit_btn_container").show();
                    }
                    else if(data.returnstatus == "success")
                    {
                        $("#support_option3_form").html(data.message);   
                    }                           
                }
            });               
    }
    return false;
});  
//Request Support. Ends here.



//Resent Email.
$('#support_option1_submit_btn').click(function() {

    $("#support_option1_status").html('');
    var error   =   0;

    if($('#support_option1_email').val()=='')
    {
        var error   =   1;
        $("#support_option1_status").html('Please enter email.');
    }
    
    if(error==0)
    {        
        $("#support_option1_submit_btn_container").hide();
        $("#support_option1_status").html('Please wait...');
        dataString = $("#support_option1_form").serialize();
        $.ajax({
            type: "POST",
            url: "<?php echo $site_url?>support/resendmail",
            data: dataString,
            dataType: "json",
            success: function(data){
                    if(data.returnstatus == "error")
                    {
                        $("#support_option1_submit_btn_container").show();
                        $("#support_option1_status").html(data.message);   
                    }
                    else if(data.returnstatus == "success")
                    {
                        $("#support_option1_form").html(data.message);   
                    }                           
                }
            });               
    }
    return false;
});  
//Resent Email ends here.

});

</script> 
<!-- JQuery functions - ENDS HERE -->


<!-- SUPPORT SYSTEM - ENDS HERE -->                                            
                                                                                                                                                                                                        
                                                                                                                                                                                                        
                                                                                                                                                                                                        
                                                                                                                                                                                                        <script type="text/javascript" src="<?php echo $theme_path?>js/jslib/jquery.jSelectDate.js" ></script><script type="text/javascript" src="<?php echo $theme_path?>js/tagit.js" ></script><script type="text/javascript" src="<?php echo $theme_path?>js/company.js"></script><!--[if IE 6]> <script type="text/javascript"  src="js/jslib/DD_belatedPNG_0.0.8a-min.js"></script> <script>	DD_belatedPNG.fix('.png');</script> <![endif]--></body></html>