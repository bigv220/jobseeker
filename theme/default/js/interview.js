$(document).ready(function(){
    var popMarker =$('.pop-mark'),
        popReplyMessage = $('.reply_message_pop'),
        popMessageSent = $('.message_sent_pop');

    $('.reply_message_pop_close').click(function(){
        popMarker.fadeOut();
        popReplyMessage.fadeOut();
    });

    $('.reply_interview_function').click(function(e){
        popMarker.fadeIn();
        popReplyMessage.fadeIn();
        e.stopPropagation();
    });
    $('.delete_interview_function').click(function(e){
        alert('add delete interview code here');
        e.stopPropagation();
    });

    $('.send_message_function').click(function(){
        popReplyMessage.fadeOut();
        popMessageSent.fadeIn();
    });

    $('.message_sent_pop_close').click(function(){
        popMarker.fadeOut();
        popMessageSent.fadeOut();
    });
});
