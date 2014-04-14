<!-- FOOTER -->
<footer>
<div id="footer_top" class="footer_row">
				<div>
					中国人使用JINGJOBS的热情并不能被非英文母语的现状而打消。事实上，我们提供的翻译服务获得了雇主与应聘方的青睐。您只需为我们提供职位需求清单或个人履历，我们将竭诚为您翻译为专业标准的英文。不仅如此，我们还可以为您设计相关细节-是您不论招聘或应征，都可以脱颖而出。
				</div>
			</div>
			<div id="footer_middle" class="footer_row">
				<div class="footer_middle_content_container">
					<div class="footer_middle_title">
						FOLLOW US
					</div>
					<div class="footer_middle_text">
						You can find Jingjobs.com on a range of social websites.
					</div>
					<div id="footer_social">
						<img src="<?php echo $theme_path ?>style/pub/social.png" usemap="#social_map">
						<map name="social_map">
							<area shape="rect" coords="0,0,24,22" href="http://linkedin.com/company/jingjobs" alt="linkedin">
							<area shape="rect" coords="44,0,67,22" href="http://facebook.com/JingJobs" alt="facebook">
							<area shape="rect" coords="91,0,108,22" href="http://twitter.com/JingJobs" alt="twitter">
							<area shape="rect" coords="133,0,155,22" href="" alt="wechat">
							<area shape="rect" coords="177,0,200,22" href="http://Instagram.com/JingJobs" alt="instagram">
						</map>
					</div>
				</div>
				<div class="footer_middle_content_container">
					<div class="footer_middle_title">
						DROP US A LINE
					</div>
					<div class="footer_middle_text">
						Feel free to tell us your feedback and suggestions, or just say hello! 
					</div>
					<div id="footer_contact">						
						<a href="javascript:void(0);" class="pbn-support-btn">SUPPORT</a>
						<br />
						<a href="mailto:info@jingjobs.com">EMAIL US</a>
						<br />
						<a href="">SKYPE:</a> JingjobsChina
					</div>
				</div>
				<div class="footer_middle_content_container">
					<div class="footer_middle_title">
						STAY CONNECTED
					</div>
					<div class="footer_middle_text">
						Sign up to our newsletter and keep up to date with excititng new jobs and news.
					</div>
					<div id="newsletter_form">
						<form id="newsletter_form">
							<input type="text" id="newsletter_email" name="newsletter_email" placeholder="Email" data-tipval="Email address">
							<input type="submit"  id="newsletter_submit" value="GO">
						</form>
					</div>
				</div>
			</div>
			<div id="footer_bottom" class="footer_row">
				<div id="footer_bottom_content">	
					Powered by				
					<img src="<?php echo $theme_path ?>style/pub/rsw_logo.png">				
					// Copyright © 2014 JINGJOBS.  All rights reserved.				
				</div>
			</div>
			</footer>
	</div>

	<!--SUPPORT SYSTEM - STARTS HERE. -->

<!-- Style Sheets & Javascript fiels for PopUp works. -->
<link href="<?php echo $theme_path?>style/support.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $theme_path?>js/support.js"></script>


<!-- PopUp pages & its contents. -->
<div class="pop-mark"></div>

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
                        <i class="kyo-radio support_optionc font_bold" data-id="support_option" data-val="3"></i>&nbsp;                      
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