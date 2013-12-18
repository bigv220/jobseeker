$(document).ready(function() {
	setInterval(function(){
        checkonlinestatus();
    }, 5000);

	setInterval(function(){
         getRealTimeMessage();
    }, 5000);

	$(".jingchat_messages").scrollTop($(".jingchat_messages_bd")[0].scrollHeight);
	$('.inbox_overview_row').click(function() {
		getmsgdetail(this,$(this).attr('data-id'),$(this).attr('data-user'));
	});	
	/**
	* Get Message by id, this id is the same with different seq.		
	**/
	var getmsgdetail = function(this1, id, user1) {
		change_current_log_view(this1);
		// AJAX get message list
		$('#msg_id').val(id);
		$.post(base_url + "inbox/getDetailMsg", { msg_id:$(this1).attr('data-id') },
		  	function(data){
		  		//TODO: 定位到最下面
		    	$('.jingchat_messages_bd').html(data);
		    	$('#user2').val(user1);
		    	$(".jingchat_messages").scrollTop($(".jingchat_messages_bd")[0].scrollHeight);

		});
	}

	var change_current_log_view = function(this1) {
		$('.inbox_overview_list div.inbox_overview_row').removeClass('inbox_overview_row_current');
		$(this1).addClass('inbox_overview_row_current');
	}

	
	$('.jingchat_message_input textarea').keypress(function(event) {
    	// Check the keyCode and if the user pressed Enter (code = 13) 
    	if (event.keyCode == 13) {
	        $.post(base_url + "inbox/response", { msg_id:$('#msg_id').val(),user2:$('#user2').val(), message:$('#message').val() },
		  	function(data){
		  		//TODO: 定位到最下面
		    	$('.jingchat_messages_bd').append(data);
		    	
		    	$(".jingchat_messages").scrollTop($(".jingchat_messages_bd")[0].scrollHeight);
				$('.jingchat_message_input textarea').val('');
			});
    	}
	});

	var msg_id = 0;
	// Delete a message
	$('.delete_msg').click(function(e) {
		
		msg_id = $(this).attr('data-id');

		$('.pop-mark').fadeIn();
        $('.pop-apply').fadeIn();
       
        e.stopPropagation();
        e.preventDefault();
	});

	$('.delete-message-yes').click(function(e) {
		if (msg_id != 0) {
			$.post(base_url + "inbox/delete", { id:msg_id },
		  	function(data){
		  		//TODO: 定位到最下面
		    	$('.inbox_overview_row[attr-id='+id+']').remove();
			});	
		}
		$('.pop-mark').fadeOut();
        $('.pop-apply').fadeOut();
	});

	$('.kyo-checkbox').click(function(e) {
		var ids = $('#delete_ids').val();
		if ($(this).hasClass('kyo-checkbox-sel')) {
			ids = ids + $(this).attr('data-val') + ",";
		} else {
			ids = ids.replace($(this).attr('data-val')+',','');
		}
		$('#delete_ids').val(ids);	
	});

	$('#multi_delete').click(function(e) {
		if ($('#delete_ids').val() == '') {
			alert('Please select a message to delete.');
			return;
		}
		$('.pop-mark').fadeIn();
        $('.pop-multi-delete').fadeIn();
       
        e.stopPropagation();
        e.preventDefault();
	});

	$('.delete-multi-message-yes').click(function(e) {
	
			$.post(base_url + "inbox/delete", { id:$('#delete_ids').val() },
		  	function(data){
		  		//TODO: 定位到最下面
		  		var ids = $('#delete_ids').val().split(',');
		  		$.each(ids, function(i, id){
                	if (id != '')
                    	$('.inbox_overview_row[data-id='+id+']').remove();
                });
		    	
			});	
		
		$('.pop-mark').fadeOut();
        $('.pop-multi-delete').fadeOut();

        e.stopPropagation();
        e.preventDefault();
	});

	$('.pop-btn-no, .pop-close').click(function(){
		$('.pop-mark').fadeOut();
        $('.pop-multi-delete').fadeOut();
	});
});

var refresh = function(mode) {
	window.location.href = base_url + 'inbox/index/' + mode;
}
var ajaxclear = function() {

}
var checkonlinestatus = function() {
		var user_id = "";
		if ($('#ids').val() != '' && $('#ids').val() != undefined) {
			user_id = $('#ids').val();
		}
		var ajax=$.getJSON(base_url + 'user/getstatus', {
            'userid': user_id
        }, function(status){
			
            if (checkJson(status)) {
                
                $.each(status, function(i, statusItem){
                	if (statusItem.status == 1)
                    	$('.online_status[online-id=' + statusItem.uid + ']').show();
                    else 
                    	$('.online_status[online-id=' + statusItem.uid + ']').hide();
                });
                
            }
        });
	
}
var getRealTimeMessage = function() {
	 var seq = $('.jingchat_messages_bd').children().last().attr('data-seq');
	 if (seq==undefined) 
        return;
	 $.post(base_url + "inbox/getRealTimeMessage", { msg_id:$('#msg_id').val(),user2:$('#user2').val(),seq:seq},
		  	function(data){
		  		//TODO: 定位到最下面
		    	$('.jingchat_messages_bd').append(data);
		    	
		    	$(".jingchat_messages").scrollTop($(".jingchat_messages_bd")[0].scrollHeight);
			});
}