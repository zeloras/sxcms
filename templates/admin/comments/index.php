<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Comments list')?></h3>
                        <div class="action_buttons">
                            <?if (in_array(112, $access_code)) {?>
                                <div class="dropdown pull-right" style="margin-top: -7px;">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-tag"></i>
                                        <?=__('Statuses')?>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:;" class="sx_change_comment_status" data-type="comments" data-status="2"><?=__('In spam')?></a></li>
                                        <li><a href="javascript:;" class="sx_change_comment_status" data-type="comments" data-status="0"><?=__('In waiting')?></a></li>
                                        <li><a href="javascript:;" class="sx_change_comment_status" data-type="comments" data-status="1"><?=__('In prove')?></a></li>
                                    </ul>
                                </div>
                            <?}?>
                            <?if (in_array(114, $access_code)) {?>
                                <button type="button" class="btn pull-right btn-danger sx_modal_show" data-modal=".sx_remove_comments">
                                    <i class="icon-trash icon-large"></i><?=__('Delete')?>
                                </button>
                            <?}?>
                        </div>
                    </div>
                <div class="widget-content">
                    <div class="btn-group">
                        <a class="btn btn-small <?if ($comments_type == "all" || $comments_type == "comments") {?>active<?}?>" href="/admin/comments/all"><?=__('All comments')?></a>
                        <a class="btn btn-small <?if ($comments_type == "waiting") {?>active<?}?>" href="/admin/comments/waiting"><?=__('Waiting approve')?></a>
                        <a class="btn btn-small <?if ($comments_type == "approved") {?>active<?}?>" href="/admin/comments/approved"><?=__('Approved')?></a>
                        <a class="btn btn-small <?if ($comments_type == "spam") {?>active<?}?>" href="/admin/comments/spam"><?=__('Spam')?></a>
                    </div>
                        <?if ($comments_size > 0) {?>
                        <table class="table table-bordered table-hover table-highlight">
                            <thead>
                                <tr>
                                    <th class="span1">
                                        <span class="niceCheck" id="sx_checkbox_general">
                                            <input type="checkbox" data-inputs=".checkbox_slected">
                                        </span>
                                    </th>
                                    <th class="span1"><?=__('ID')?></th>
                                    <th class="span5"><?=__('Text')?></th>
                                    <th class="span2"><?=__('User')?></th>
                                    <th class="span2"><?=__('User email')?></th>
                                    <th class="span2"><?=__('Page with comment')?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?foreach ($comments_list as $key => $comment) {?>
                                    <tr>
                                            <td class="t-a_c">
                                                <span class="niceCheck">
                                                    <input type="checkbox" name="ids" value="<?=$comment->id?>" class="checkbox_slected">
                                                </span>
                                            </td>
                                            <td><?=$comment->id?></td>
                                            <td>
                                                <span class="<?=$icon[$key]['color']?>"><i class="<?=$icon[$key]['icon']?>"></i></span>
                                                <span class="time muted"><?=date('d-m-Y H:i', $comment->date)?></span>
                                                <?if (in_array(113, $access_code)) {?>
                                                    <span id="comment_span-<?=$comment->id?>">
                                                        <a href="javascript:void(0);"
                                                           class="sx_comment_edit"
                                                           data-comment_id="<?=$comment->id?>"
                                                           data-comment_block_edit="#comment_edit-<?=$comment->id?>"
                                                           data-hide="#comment_span-<?=$comment->id?>"
                                                           >
                                                            <?=$comment->text?>
                                                        </a>
                                                    </span>
                                                    <div class="hide" id="comment_edit-<?=$comment->id?>">
                                                        <textarea id="comment_text-<?=$comment->id?>"><?=$comment->text?></textarea>
                                                        <button 
                                                            class="btn btn-success sx_comment_update"
                                                            data-text="#comment_text-<?=$comment->id?>"
                                                            data-show="#comment_span-<?=$comment->id?>"
                                                            data-hide="#comment_edit-<?=$comment->id?>"
                                                            data-comment_id="<?=$comment->id?>"><?=__('Update')?></button>
                                                    </div>
                                                <?}else{?>
                                                    <span><?=$comment->text?></span>
                                                <?}?>
                                            </td>
                                            <td>
                                                <span>
                                                    <?if ($comment->user_id > 0) {?>
                                                        <a href="/admin/users/edit/<?=$comment->user_id?>"><?=$comment->user_name?></a>
                                                    <?}else{?>
                                                        <?=$comment->user_name?>
                                                    <?}?>
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    <?=$comment->user_mail?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?=$url_data[$key]['url']?>#itemComment-<?=$comment->id?>" target="_blank" title="<?=$url_data[$key]['title']?>"><?=$url_data[$key]['title']?></a>
                                            </td>
                                        </tr>
                                <?}?>
                            </tbody>
                    </table>

                    <?}else{?>
                        </br>
                        <div class="alert alert-info">
                            <?=__('No records')?>
                        </div>
                    <?}?>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal hide sx_remove_comments" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal=".sx_remove_comments">×</button>
    <h3><?=__('Remove comments')?></h3>
  </div>
  <div class="modal-body">
    <p><?=__('Do you really want to delete the selected comments?')?></p>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal=".sx_remove_comments"><?=__("Cancel")?></a>
    <a href="javascript:;" class="btn btn-primary sx_modal_hide sx_remove_function" data-modal=".sx_remove_comments" data-href="comments"><?=__('Delete')?></a>
  </div>
</div>