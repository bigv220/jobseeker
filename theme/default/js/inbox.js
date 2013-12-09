$(document).ready(function() {
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
		
	}

	var change_current_log_view = function(this1) {
		$('.inbox_overview_list div.inbox_overview_row').removeClass('inbox_overview_row_current');
		$(this1).addClass('inbox_overview_row_current');
	}

	

	$('#send_msg').click(function() {
		$.post(base_url + "inbox/response", { id:$('#msg_id').val(), user2:$('#user2').val(), message:$('#message').val() },
		  function(data){
		  	//TODO: 定位到最下面
		    $('.jingchat_messages_bd').append(data);
		});
	})

});

