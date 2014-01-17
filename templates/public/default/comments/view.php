<!-- Product Comment -->
<div id="rcheComments" class="container span11">
    <div id="allComment" class="row">
        <?if ($comment_list) {?>
            <?=$comment_list?>
        <?}?>
    </div>
    <?if ($comments_settings['is_comment'] && $comments_settings['is_comment_this']) {?>
        <div class="leave_comment">
            <a href="javascript://" 
               data-comment-block="#rcheComments"
               data-rbutton=".leave_comment"
               data-remove=".sx_textarea_box"
               data-item-id="<?=$comments_settings['item_id']?>"
               data-module="<?=$comments_settings['module']?>"
               data-comment-id="0"
               class="sx_comment_reply btn btn-success span12"
               title="<?=__('Leave comment')?>"><?=__('Leave comment')?></a>
        </div>
    <?}?>
</div>
<!-- End Product Comment -->