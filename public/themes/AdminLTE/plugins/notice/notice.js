jQuery(function ($) {
    $.notice = function notice(text) {
        $("#notice").text(text).animate({
            opacity: 0.7,
            right: 25
        }, 300);
        setTimeout(function () {
            $("#notice").animate({
                opacity: 0,
                right: -300
            }, 800);
        }, 2500);
    };
});