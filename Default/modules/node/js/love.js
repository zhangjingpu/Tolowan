jQuery(function ($) {
    $('.zan').click(function () {
        $(this).css('cursor','wait');
        theElement = $(this);
        url = $(this).attr('data-url');
        $.getJSON(url,function(data) {
            if(data.state != 'success'){
                alert(data.notice);
            }else{
                theElement.find('.zan-text').text(data.notice);
                theElement.find('.badge').text(data.number);
            }
        });4
        $(this).css('cursor','pointer');
    })
})