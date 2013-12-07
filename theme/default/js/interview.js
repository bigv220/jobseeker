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

    $('.jobseeker_request_interview').click(function(e){
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
        alert('Add send request interview function here');
        popMarker.fadeOut();
        popRequestInterview.fadeOut();
    });
});
