$(function(){

/*
    //sponsors rool
    $('.p-sponsors').roll({
        box:{
            width:990,   //
            height:156,   //
            hspace:125    //
        },
        item:{
            width:168,    //
            height:85,   //
            mr:22        //
        },
        speed:600       //   
    });
    */

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
        popReg = $('.pop-reg-company-delete');

    //Delete Company - Account [http://site.com/company/register]
    $('.pbn-delete-company-btn').click(function(){
        popMark.fadeIn();
        popReg.fadeIn();
    });
    
    /*
    // Pop login
    $('.phd-login-btn').click(function(){
    	//popReg.fadeOut();
        //$('.pop-login').fadeIn();
    });
    */
   
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
    /*
    $('.pop-reg-company-delete-submit-btn').click(function(){
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

    /*
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
    */
    
    //click event for user sign up 
    $('#pop-reg-company-delete-submit').click(function()
    {
        var validation_error    =   0;

        if($('#delete_text').val() != 'DELETE')
        {
            alert("Please enter DELETE in capital letters.");
            validation_error    =   1;
        }
       
        if(validation_error==0 && $('#confirm_deletion').val() != 1)
        {
            alert("Please confirm the deletion.");
            validation_error    =   1;
        }
        

        if(validation_error==0)
        {
            //post data to server
            $.post(
                site_url + "company/delete",
                {'delete_text':validation_error},
                function(data)
                {
                    $('.pop-reg-company-delete').fadeOut();
                    //popMark.fadeOut();
                    $('.pop-message-delete-message').fadeIn(); 
                    
                     setTimeout(showhomepage, 1500);
                },
                "json"
            );
        }
        
        

    });
    
     // place this within dom ready function
  function showhomepage() 
  {     
      window.location.href = site_url+"user/logout"; 
  }
 
}) 