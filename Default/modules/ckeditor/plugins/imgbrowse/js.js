jQuery(function($) {
    href = $('#images_list').attr('init');
    $.get(href, function(data) {
        $('#images_list').html(data);
    })
    $('#images_list').on('click', '.pagination a', function() {
      href = $(this).attr('href');
      $.get(href,function(data){
        $('#images_list').html(data);
      })
      return false;
    });
    $('#images_list').on('click', '.list img', function() {
        ckNum = $('#images_list').attr('CKEditorFuncNum');
        window.opener.CKEDITOR.tools.callFunction(ckNum, $(this).attr('src'));
        window.close();
        return false;
    });
})
