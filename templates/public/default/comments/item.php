<div class="itemComment span12 alert alert-info" id="itemComment-<?=$id?>" style="margin-left: <?=$margin+10?>px;"> <!--"-->
    <ul class="comment_header">
      <li class="user_avatar"><img src="http://www.gravatar.com/avatar/<?=$avatar?>?size=100?default=mm" width="38" height="38" class="img-circle" alt="<?=__('User avatar')?>: <?=$username?>"></li>
      <li class="comment_owner"><?=$username?></li>
      <li class="comment_date"><span title="<?=__('Date, comment time')?>"><?=date('d.m:Y H:i', $date)?></span></li>
    </ul>
    <ul class="comment_body">
      <li class="comment_text alert alert-block"><?=$text?></li>
      <li class="comment_footer">
            <?if ($is_comment && $is_comment_this) {?>
                <a href="javascript://" 
                   data-comment-block="#itemComment-<?=$id?>"
                   data-remove=".sx_textarea_box"
                   data-item-id="<?=$item_id?>"
                   data-comment-id="<?=$id?>"
                   data-module="<?=$module?>"
                   class="sx_comment_reply btn btn-primary"
                   title="<?=__('Reply comment')?>: <?=$username?>"><i class="icon-share-alt"></i><?=__('Reply')?></a>
            <?}?>
      </li>
    </ul>
</div>
