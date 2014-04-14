$(function(){
    //Pop mark
    var popMark =$('.pop-mark'), 
        popReg = $('.pop-reg-company-delete');
    
    var uid     =   0;
    
    //Delete Company - Account [http://site.com/company/register]
    $('.pbn-delete-company-btn').click(function(){
        popMark.fadeIn();
        popReg.fadeIn();
        
        var uid_string      =   $(this).attr("id");
        var uid_array       =   uid_string.split("_"); 
        uid                 =   uid_array[1];        
    });

    $('.pop-reg-company-delete-close').click(function(){
        popMark.fadeOut();
        popReg.fadeOut();
    });
    
       
    $('.pop-message-delete-message-close').click(function(){
        $('.pop-message-delete-message').fadeOut(); 
    });
    
    
    $('.reg-typep').click(function(){
        $('.pop-reg-company-delete-personal').show().next().hide();
    });
    $('.reg-typec').click(function(){
        $('.pop-reg-company-delete-company').show().prev().hide();
    });

    $('.pop-welcome-close').click(function(){
        $('.pop-welcome').fadeOut();
        popMark.fadeOut();
    })

    $('.pop-message-close').click(function(){
        $('.pop-message').fadeOut();
        $('.request-sent-pop-message').fadeOut();
        popMark.fadeOut();
    });
    
    //click event for user sign up 
    $('#pop-reg-company-delete-submit').click(function()
    {
        var user_type   =   $('#RegType').val();
        
        if(uid==0)
        {
            alert("Invalid Click.");
            $('.pop-reg-company-delete').fadeOut();
        }
        else
        {
            
            $.ajax({//Make the Ajax Request
                type: "POST",
                url:  site_url + "admin/user/authenticate",
                data: {user_type: user_type, uid: uid},
                success: function(html){
                    $("#uid_"+uid).unbind("click");;//Remove the CLICK from the Authenticate Button
                    $("#uidimg_"+uid).attr('src', site_url+'theme/admin/img/icons/user_authenticate_off.png');
                    $('.pop-reg-company-delete').fadeOut(); // Hide PopUp
                }
            });   
        }
    });
})