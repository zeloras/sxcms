<?if ($comments_settings['is_comment'] && $comments_settings['is_comment_this']) {?>
<div class="sx_textarea_box alert btn-info">
    <div class="errors alert alert-error"></div>
    <div calas="clearfix"></div>
    <form method="post" action="<?=$comments_settings['action']?>">
        <input type="hidden" name="submit_this_comment" value="1">
        <input type="hidden" name="comment_item_id" value="<?=$comments_settings['item']?>">
        <input type="hidden" name="comment_module" value="<?=$comments_settings['module']?>">
        <input type="hidden" name="comment_redirect" value="<?=$comments_settings['redirect']?>">
        <input type="hidden" name="comment_parent_id" value="<?=$comments_settings['parent']?>">
        <?if (!$comments_settings['is_auth']) {?>
            <div class="none_authorization">
                <div class="textbox input_username">
                    <input type="text" name="comment_username" placeholder="<?=__('Your name')?>">
                </div>
                <div class="textbox input_email">
                    <input type="text" name="comment_email" placeholder="<?=__('Your email')?>">
                </div>
            </div>
        <?}?>
        <div class="textbox">
            <textarea name="comment_text"></textarea>
        </div>
        <ul class="comment_form_buttons">
            <li>
                <input type="button"
                       name="comment_submit"
                       class="sx_comment_submit btn btn-danger"
                       data-rbutton=".leave_comment"
                       data-form=".sx_textarea_box"
                       value="<?=__('Submit')?>">
            </li>
            <li>
                <input type="button"
                       value="<?=__('Cancel')?>"
                       class="sx_comment_cancel btn btn-success"
                       data-rbutton=".leave_comment"
                       data-remove=".sx_textarea_box">
            </li>
        </ul>
        <?if ($comments_settings['is_captcha']) {?>
        <div class="captcha_block">
            <div class="textbox_img sx_captcha_block">
                <img src="/syscom/captcha"
                     data-block=".sx_captcha_block"
                     class="sx_captcha_update"
                     style="cursor: pointer;">
            </div>
            <div class="textbox_img sx_captcha_input">
                <input type="text" name="captcha" 
                       style="width: <?=$comments_settings['captcha_width']?>px; height: <?=$comments_settings['captcha_height']- 8?>px; font-size:  <?=$comments_settings['captcha_height'] / 2?>px">
            </div>
        </div>
        <?}?>
        
    </form>
</div>
<?}?>