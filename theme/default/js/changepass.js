$(function() {
    //Pop mark
    var popMark = $('.pop-mark'), //form
            popReg = $('.pop-reg-change-password'); //white background

    //Change password
    $('.pbn-change-password-btn').click(function() {
        popMark.fadeIn();
        popReg.fadeIn();
    });


    //close popup when click on the close button
    $('.pop-reg-change-password-close').click(function() {
    	$('#wrong-new').text('');
        $('#wrong-old').text('');
        $('#wrong-conf').text('');
        $('#new-pass').text('');
        $('#old-pass').text('');
        $('#conf-pass').text('');
        popMark.fadeOut();
        popReg.fadeOut();
    });



    $('.pop-message-change-password-message-close').click(function() {
        $('.pop-message-change-password-message').fadeOut();
    });


    $('.reg-typep').click(function() {
        $('.pop-reg-change-password-personal').show().next().hide();
    });
    $('.reg-typec').click(function() {
        $('.pop-reg-change-password').show().prev().hide();
    });

    $('.pop-welcome-close').click(function() {
        $('.pop-welcome').fadeOut();
        popMark.fadeOut();
    });

    $('.pop-message-close').click(function() {
        $('.pop-message').fadeOut();
        $('.request-sent-pop-message').fadeOut();
        popMark.fadeOut();
    });

    //click event for user sign up 
    $('#pop-reg-change-password-submit').click(function()
    {
        var validation_error = 0;
        var newpass = $('#new-pass').val();
        var oldpass = $('#old-pass').val();
        var confpass = $('#conf-pass').val();
        
        $('#wrong-new').text('');
        $('#wrong-old').text('');
        $('#wrong-conf').text('');        

        if (newpass != confpass)
        {
            $('#wrong-conf').text('Confirmation password is wrong!');
            validation_error = 1;
        }
        
        if (newpass == ""){
       	    $('#wrong-new').text('New password is empty!');
            validation_error = 1;
        } 
        
        if (confpass == ""){
       	    $('#wrong-conf').text('Confirmation password is empty!');
            validation_error = 1;
        } 
        
        if (oldpass == ""){
       	    $('#wrong-old').text('Old password is empty!');
            validation_error = 1;
        }      
        
        if (validation_error == 0)
        {
           //post data to server
           $.ajax({//Make the Ajax Request
                type: "POST",
                url:  site_url + "company/changepass",
                data: {newpass: newpass, oldpass: oldpass},
                success: function(html){
                    if(html == "success"){
                    	alert('Password is changed.');
                     	showhomepage();
                    }else{
                    	$('#wrong-old').text('Old password is wrong!');
                    }
                   
                }
            });   
        }
        // place this within dom ready function
        function showhomepage()
        {
            window.location.href = site_url + "jobseeker/viewprofile";
        }
    });
});