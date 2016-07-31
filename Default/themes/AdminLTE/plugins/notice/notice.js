jQuery(function($) {
    $.notice = function notice() {
        var text = arguments[0] ? arguments[0] : '请求成功';
        var addQueue = arguments[1] ? arguments[1] : false;

        var noticeObject = $("<div class='notice'>"+text+"</div>").appendTo("body");
        noticeObject.animate({
            opacity: 0.5,
            bottom: '99%',
        }, 3000);
        if(addQueue !== false){
            noticeText = '<li><a href="javascript:;">'+text+'</a></li>';
            $(noticeText).appendTo("#bell-ul");
            bellNum = $('#bell-num').text($('#bell-ul li').length);
        }
        setTimeout(function() {
            noticeObject.remove();
        }, 2500);
    };
});
