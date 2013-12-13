$(document).ready(function() {
	$(".jingchat_messages").scrollTop($(".jingchat_messages_bd")[0].scrollHeight);
	$('.inbox_overview_row').click(function() {
		getmsgdetail(this,$(this).attr('data-id'));
	})	
	/**
	* Get Message by id, this id is the same with different seq.		
	**/
	var getmsgdetail = function(this1, id) {
		change_current_log_view(this1);
		// AJAX get message list
		$('#msg_id').val(id);
		$.post(base_url + "inbox/getDetailMsg", { msg_id:$(this1).attr('data-id') },
		  	function(data){
		  		//TODO: 定位到最下面
		    	$('.jingchat_messages_bd').html(data);

		});
	}

	var change_current_log_view = function(this1) {
		$('.inbox_overview_list div.inbox_overview_row').removeClass('inbox_overview_row_current');
		$(this1).addClass('inbox_overview_row_current');
	}

	
	$('.jingchat_message_input textarea').keypress(function(event) {
    	// Check the keyCode and if the user pressed Enter (code = 13) 
    	if (event.keyCode == 13) {
	        $.post(base_url + "inbox/response", { user2:$('#user2').val(), message:$('#message').val() },
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
});

var refresh = function(mode) {
	window.location.href = base_url + 'inbox/index/' + mode;
}