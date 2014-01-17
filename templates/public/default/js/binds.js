$(".sx_comment_reply").live('click', function () {
    sx_comment.reply_form(this);
});

$(".sx_comment_cancel").live('click', function () {
    sx_comment.reply_cancel(this);
});

$('.sx_comment_submit').live('click', function () {
    sx_comment.check_form(this);
});

$('.sx_captcha_update').live('click', function () {
    sx_comment.captcha_update(this);
});