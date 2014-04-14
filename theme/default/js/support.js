$(function(){

    //Pop mark
    var popMark =$('.pop-mark'), 
        popReg = $('.pop-reg-support');

    //Delete Company - Account [http://site.com/company/register]
    $('.pbn-support-btn').click(function(){
        popMark.fadeIn();
        popReg.fadeIn();
    });
   
    $('.pop-reg-support-close').click(function(){
        popMark.fadeOut();
        popReg.fadeOut();
    });
       
       
    $('.pop-message-delete-message-close').click(function(){
        $('.pop-message-delete-message').fadeOut(); 
    });
    
    
    $('.reg-typep').click(function(){
        $('.pop-reg-support-personal').show().next().hide();
    });
    $('.reg-typec').click(function(){
        $('.pop-reg-support-company').show().prev().hide();
    });
    /*
    $('.pop-reg-support-submit-btn').click(function(){
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
        $('.request-sent-pop-message').fadeOut();
        popMark.fadeOut();
    });

    
    
    
    $('.support_step2_cancel').click(function()
    {
        $('#support_option1').hide();
        $('#support_option3').hide();
        $('#support_step1').show();        
    });
        
    
    
    //click event for user sign up 
    $('#pop-reg-support-submit').click(function()
    {
        var validation_error    =   0;

        if($('#support_option').val() ==0)
        {
            alert("Please choose one.");
            validation_error    =   1;
        }
        else if(validation_error==0 && $('#support_option').val() ==1)
        {
            $('#support_step1').hide();
            $('#support_option1').show();
            
        }
        else if(validation_error==0 && $('#support_option').val() ==3)
        {
            $('#support_step1').hide();
            $('#support_option3').show()
            
        }
        else if(validation_error==0 && $('#support_option').val() ==2)
        {
            window.location.href = site_url+"whitelist";             
        }
    });
}) 