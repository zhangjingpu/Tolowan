jQuery(function($) {
    //主评论框
    $('.comment-form').submit(function () {

    });
    //回复点击事件
    $('.comment-list').on('click','.ds-post-reply',function () {
        commentForm = $('#comment-form').attr('id','').clone();
        pid = $(this).attr('pid');
        commentForm.find('#pid').val(pid);
        commentBodyBox = $(this).parents('.comment-self');
        commentBodyBox.append(commentForm);
        return false;
    });
    //副评论框
    $('.comment-list').on('click','.comment-deputy-form',function () {

    });
    //分页点击
    $('.comment-list').on('click','.ds-paginator li a',function () {

    });
})