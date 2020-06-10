$(function(){
    var div = $(".chatContainerScroll");
    div.scrollTop(div.prop('scrollHeight'));
    
    $('#msg-input').keypress(function (e) {
        if (e.which == 13) {
            $('#msg-form').submit();
            return false;    //<---- Add this line
        }
    });
    
    $('.person').on('click', function(){
        window.location.href = '/user/message/'+$(this).data('user');
        //alert($(this).data('user'));
    });
    
});