$(function(){

    //sponsors rool
    $('.p-sponsors').roll({
        box:{
            width:990,   //整块的宽
            height:156,   //整块的高
            hspace:125    //两边空的间距
        },
        item:{
            width:168,    //小块的宽
            height:85,   //小块的高
            mr:22        //左边空的间距
        },
        speed:600       //滚动速度      
    });

/*
    //Find
    $('.pbn-find-block').hover(function(){
        var obj= $(this).find('.find-hover');
        obj.stop().fadeIn();
    },function(){
        var obj= $(this).find('.find-hover');
        obj.stop().fadeOut();
    })
*/
    //Pop mark
    var popMark =$('.pop-mark'),
        popReg = $('.pop-reg');

    //Pop Sing Up
    $('.pbn-singup-btn, #sign_up_btn_header').click(function(){
        popMark.fadeIn();
        popReg.fadeIn();
    });
    
    // Pop login
    $('.phd-login-btn').click(function(){
    	//popReg.fadeOut();
        //$('.pop-login').fadeIn();
    });

    $('.pop-reg-close').click(function(){
        popMark.fadeOut();
        popReg.fadeOut();
    });
    $('.reg-typep').click(function(){
        $('.pop-reg-personal').show().next().hide();
    });
    $('.reg-typec').click(function(){
        $('.pop-reg-company').show().prev().hide();
    });
    /*
    $('.pop-reg-submit-btn').click(function(){
        popReg.fadeOut();
        $('.pop-welcome').fadeIn();
    })
    */
    $('.pop-welcome-close').click(function(){
        $('.pop-welcome').fadeOut();
        popMark.fadeOut();
    })

    $('.pop-message-close').click(function(){
        $('.pop-message').fadeOut();
        popMark.fadeOut();
    });

    $('.show_login_btn').click(function(){
        $('#login_pop').fadeIn();
    });

    $('.show_register_btn').click(function(){
        popMark.fadeIn();
        popReg.fadeIn();
    });

    $('.login_on_regpop').click(function(){
        $('#login_pop').fadeIn();
        popMark.fadeOut();
        popReg.fadeOut();
    })
    //click event for user sign up
    $('#signup_submit').click(function(){
        $('.email_existing').html('');
        var regAgree = $('#RegAgree').val();
        if(regAgree != 1){
            alert("Please check Agree to terms.");
        }
        else{
            var validated = true;
            var regType = $('#RegType').val();
            var firstName = $('#first_name').val();
            var lastName = $('#last_name').val();
            var companyName = $('#company_name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var newsletter = $('#RegNewsletter').val();

            if(regType == 1){ //company signup
                if(companyName == ''){
                    validated = false;
                    $('#company_name').css( "border-color", "red");
                }
                firstName = companyName;
                lastName = "";
            }
            else{
                if(firstName == ''){
                    validated = false;
                    $('#first_name').css( "border-color", "red");
                }
                if(lastName == ''){
                    validated = false;
                    $('#last_name').css( "border-color", "red");
                }
            }
            if(valid_email(email) == false){
                validated = false;
                $('#email').css( "border-color", "red");
            }

            if(validated){
                if(newsletter != 1) newsletter = 0;
                //post data to server
                $.post(
                    site_url + "/user/signup",
                    {'first_name':firstName,'last_name':lastName,'email':email, 'password':password, 'user_type':regType, 'newsletter':newsletter},
                    function(data){
                        if(data.userId <1){
                            //$('.email_existing').html(data.message);
                            $('.pop-reg-error-msg').show();
                        }
                        else{
                        	$('.pop-reg').fadeOut();
                        	popMark.fadeOut();
                            show_pop_message();
                        	/*$('#first_name').attr('value','').css("border-color", "#cecece");
                            $('#last_name').attr('value','').css("border-color", "#cecece");
                            $('#company_name').attr('value','').css("border-color", "#cecece");
                            $('#email').attr('value','').css("border-color", "#cecece");
                            $('#password').attr('value','').css("border-color", "#cecece");
                            $('.pop-reg').fadeOut();
                            $('.phd-login-text').html(firstName + ' ' + lastName);
                            show_welcome_pop(regType);
                            userType = regType;*/
                        }

                    },
                    "json"
                );
            }
        }
    });

   //login form ajax submit
    var loginform = $('#login_form');
    loginform.submit(function(){
        $.post(site_url + '/user/login',
                loginform.serialize(),
                function(result, status){

                    if(result.status == 'success'){
                        current_login_user_id = result.uid;
                    	// if not new account will goto findpage directly
                    	if(result.user_type == "1") {
                        	window.location.href = site_url + "search/findstaff";
                        } else {
                        	window.location.href = site_url + "jobseeker/viewprofile";
                        } 
                    	$('.pop-login').fadeOut();
                        //$('.phd-login-pop').remove();
                        $('.phd-login-text').html(result.first_name + ' ' + result.last_name);
                        $('.phd-login-pop-content .login-error-msg').hide();
                        //show_welcome_pop(result.user_type); 
                    }
                    else{
                        $('.phd-login-pop-content .login-error-msg').html(result.message);
                        $('.phd-login-pop-content .login-error-msg').show();
                    }
                },
                'json');
        return false;
    });

    var resetPasswordRequestForm = $('#resetpw_form');
    resetPasswordRequestForm.submit(function(){
        $.post(resetPasswordRequestForm.attr('action'),
            resetPasswordRequestForm.serialize(),
            function(result, status){
                if(result.status == 'error'){
                    $('#resetpw_pop .phd-login-pop-content div').html(result.message);
                }
                else{
                    var oldcontent = $('#resetpw_pop').html();
                    $('#resetpw_pop .phd-login-pop-header-txt').html("You've Got Mail");
                    var htmlcontent = "<div>Please check your email, we've sent you instructions on how to reset your password.</div><div class='ok_btn'></div>";
                    $('#resetpw_pop .phd-login-pop-content').html(htmlcontent);
                    $('#resetpw_pop .phd-login-pop-content .ok_btn').click(function(){
                        $('#resetpw_pop').hide();
                        $('#resetpw_pop').html(oldcontent);
                    });
                }
            },
            'json');
        return false;
    });

    var newsletterform = $('#newsletter_form');

    newsletterform.submit(function(){
        var email = $('#newsletter_email').val();

        if(valid_email(email) == false){
            alert('Wrong email address');
        }
        else{
            $.post(site_url + '/index/newsletter',
                    newsletterform.serialize(),
                    function(result, status){
                        $('#newsletter_email').attr('value', 'Email address');
                        alert(result.message);
                    },'json');
        }
        return false;
    });

    $('#forget_password_btn').click(function(){
        $('#login_pop').hide();
        $('#resetpw_pop').show();
    })


    var resetpwform = $('#reset_password_form');

    resetpwform.submit(function(){
        var newpw = $('#reset_password').val();
        var confirmpw = $('#reset_password_confirm').val();
        if(newpw == confirmpw){
            $.post(site_url + resetpwform.attr('action'),
                resetpwform.serialize(),
                function(result, status){
                    if(result.status == "success"){
                        $('.reset-password-wrapper').hide();
                        $('.reset-password-success').show();
                    }
                    else{
                        alert(result.message);
                    }
                },'json');
        }
        else{
            alert("Please check the confirm password");
        }

        return false;
    });

    $('.reset-password-success-btn').click(function(){
        window.location.href=site_url;
    });

    $('.check_login_user_type_for_postjob').click(function(e){
        if(userType < 1){//is not company user or not login
            alert('Please login as a company to be able to post a job');
            e.preventDefault();
        }
    });
})