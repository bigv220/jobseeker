$(document).ready(function(){
    var popMarker =$('.pop-mark'),
        popReplyMessage = $('.reply_message_pop'),
        popMessageSent = $('.message_sent_pop'),
        popRequestInterview = $('.request_interview_pop');

    $('.reply_message_pop_close').click(function(){
        popMarker.fadeOut();
        popReplyMessage.fadeOut();
    });

    $('.reply_interview_function').click(function(e){
        var id = $(this).attr('alt');
        var company_name = $('#int' + id).find('#company_name').html();
        $('#reply_to').html(company_name);

        var interview_id = $('#int' + id).find('#interview_id').val();
        $('#interviewId').val(interview_id);

        //interview message
        var msg = $('#int'+ id).find('#interview_msg').html();
        $('#reply_msg').html(msg);

        popMarker.fadeIn();
        popReplyMessage.fadeIn();
        e.stopPropagation();
    });
    $('.delete_interview_function').click(function(e){
        if(confirm('Are you sure to delete this interview request?')) {
            var id = $(this).attr('alt');
            $.post(site_url + 'search/deleteinterviewrequest',
                {id: id},
                function(result,status){
                    if(status == 'success'){
                        $('#int'+ id).css('display', 'none');
                    }
                });
        }
        e.stopPropagation();
        e.preventDefault();

    });

    $('.send_message_function').click(function(){
        var form = $('#replyInterviewRequest');
        $.post(site_url + 'search/replyinterviewrequest',
            form.serialize(),
            function(result,status){
                if(status == 'success'){

                }
        });

        popReplyMessage.fadeOut();
        popMessageSent.fadeIn();
    });

    $('.message_sent_pop_close').click(function(){
        popMarker.fadeOut();
        popMessageSent.fadeOut();
    });

    $('.jobseeker_request_interview').click(function(e){
        var uid = $(this).prev().val();
        var name = $(this).prev().prev().val();
        $('#jobseeker_name').html(name);
        $('#jobseeker_uid').val(uid);

        var position_lists = $('#current_user_jobs').html();
        $('#position_title').html(position_lists);

        popRequestInterview.fadeIn();
        popMarker.fadeIn();
        e.stopPropagation();
    });

    $('.request_interview_pop_close').click(function(){
        popMarker.fadeOut();
        popRequestInterview.fadeOut();
    });

    $('.cancel_request_interview').click(function(){
        popMarker.fadeOut();
        popRequestInterview.fadeOut();
    });

    $('.send_request_interview').click(function(){
        sendInterviewRequest();
        popMarker.fadeOut();
        popRequestInterview.fadeOut();
    });
});

function sendInterviewRequest() {
    var interviewForm = $('#sendInterviewRequest');

    $.post(site_url + 'search/sendinterviewrequest',
        interviewForm.serialize(),
        function(result,status){
            if(status == 'success'){
                $('.pop-mark').fadeIn();
                $('.request_interview_pop').fadeOut();
                $('.request-sent-pop-message').fadeIn();
            }
        });
}
