var sx_comment = new Object({

reply_form:function (label) {
   $parent = $(label).data("comment-id");
   $item = $(label).data("item-id");
   $block = $(label).data("comment-block");
   $remove = $(label).data("remove");
   $url = document.location.pathname;
   $module = $(label).data("module");
   $rbutton = $(label).data("rbutton");
   
   $.get('/syscom/comment_reply', {item: $item, parent: $parent, url: $url, module: $module}, function (data) {
       $($remove).remove();
       $($block).append(data);
       $($block).find(".errors").css("display", "none");
       $($rbutton).css("display", "none");
   });
},
       
reply_cancel:function (label) {
    $remove_block = $(label).data("remove");
    $rbutton = $(label).data("rbutton");
    $(label).parents($remove_block).remove();
    $($rbutton).css("display", "block");
},
        

check_form: function(label) {
    $form = $(label).data("form");
    $form_submit = $($form).find("form");
    $captcha = $form_submit.find("input[name=captcha]");
    $text = $form_submit.find("textarea");
    $rbutton = $(label).data("rbutton");
    if ($form_submit.find("textarea").val().length > 5)
    {
        $.post('/syscom/comment_check', {captcha: $captcha.val(), text: $text.val()}, function (data) {
            $errors = JSON.parse ( data );
            if ($errors != null)
            {
                //console.log($errors);
                if ($errors.captcha_false)
                    $($form).find(".errors").text("wrong_captcha".l());
                if ($errors.timeout)
                    $($form).find(".errors").text("comment_timeout_1".l()+$errors.time+"comment_timeout_2".l());
                if ($errors.no_comment)
                    $($form).find(".errors").text("cant_comment".l());
                if ($errors.length_size)
                    $($form).find(".errors").text("comment_length_long_1".l()+$errors.length+"comment_length_long_2".l()+$errors.yousize+"comment_length_long_3".l());
                // $form_submit.submit();
                $($form).find(".errors").fadeIn();
            }
            else
            {
                $($rbutton).css("display", "block");
                $form_submit.submit();
            }
        });
    }
    else
    {
        $($form).find(".errors").text("short_comment".l());
        $($form).find(".errors").fadeIn();
    }
},
        
captcha_update: function (label) {
    $src_img = $(label).attr("src")+"?"+ Math.random();;
    $(label).attr("src", $src_img);
} 

});