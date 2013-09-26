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


    //Find
    $('.pbn-find-block').hover(function(){
        var obj= $(this).find('.find-hover');
        obj.stop().fadeIn();
    },function(){
        var obj= $(this).find('.find-hover');
        obj.stop().fadeOut();
    })

    //Pop mark
    var popMark =$('.pop-mark'),
        popReg = $('.pop-reg');

    //Pop Sing Up
    $('.pbn-singup-btn').click(function(){
        popMark.fadeIn();
        popReg.fadeIn();
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
                            $('.email_existing').html(data.message);
                        }
                        else{
                            $('#first_name').attr('value','').css("border-color", "#cecece");
                            $('#last_name').attr('value','').css("border-color", "#cecece");
                            $('#company_name').attr('value','').css("border-color", "#cecece");
                            $('#email').attr('value','').css("border-color", "#cecece");
                            $('#password').attr('value','').css("border-color", "#cecece");
                            $('.pop-reg').fadeOut();
                            show_welcome_pop(regType);
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
                        $('.phd-login-pop').remove();
                        $('.phd-login-text').html(result.first_name + '<br/>' + result.last_name);
                        show_welcome_pop(result.user_type);
                    }
                    else{
                        alert(result.message);
                    }
                },
                'json');
        return false;
    });

    $("#orderform").validate({
        submitHandler: function(form) {

        }
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
})