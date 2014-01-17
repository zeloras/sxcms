<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">
<div class="widget-header">
    <i class="icon-file"></i>
    <h3><?=__('Link create')?></h3>
    <span class="action_buttons">
        <button class="btn pull-right formSubmit" data-form="#submit-form" data-after="exit" data-action="/admin/menus_data/edit/<?=$menu_id?>/<?=$item_id?>">
            <i class=" icon-save icon-large"></i> <?=__('Save and exit')?>
        </button>
        <button class="btn btn-success pull-right formSubmit" data-form="#submit-form" data-after="save" data-action="/admin/menus_data/edit/<?=$menu_id?>/<?=$item_id?>">
            <i class=" icon-save icon-large"></i> <?=__('Save')?>
        </button>
        <button data-href="/admin/menus_data/<?=$menu_id?>" data-container="#base-container" class="btn pull-right btn-info pjax_button">
            <i class="icon-arrow-left"></i> <?=__('Back')?>
        </button>
    </span>
</div>
                    
<div class="widget-content">
    <?if (isset($success)) {?>
        <div id="success_block">
            <p id="status_success">showMessage('<?=__('Success create link')?>', '<?=__('Status link create')?>', 'success')</p>
            <p id="url_success">/admin/menus_data/edit/<?=$menu_id?>/<?=$item_id?></p>
            <p id="url_success_exit">/admin/menus_data/<?=$menu_id?></p>
        </div>
    <?}?>
    <div id="errors_block">
        <?if (isset($errors)) {?>
        <div class="alert alert-error">
            <strong><?=__('Error')?></strong>
            <ul>
                <?foreach ($errors as $error) {?>
                    <li><?=__($error)?></li>
                <?}?>
            </ul>
        </div>
        <?}?>
    </div>	
    <form id="submit-form" method="post" class="form-horizontal">
        <div class="tab-content">
            <input type="hidden" name="submit_this_form" value="1">
            <input type="hidden" name="menu_id" value="<?=$menu_id?>">
            <input type="hidden" name="item_id" value="<?=$item_id?>">
            <div class="tab-pane active" id="content">
                
                <div class="control-group sx_menu_block_type">
                    <label class="control-label" for="linktype_p"><?=__('Link type')?></label>
                    <div class="controls">
                        <select class="input-xxlarge sx_menu_type" name="linktype" id="linktype_p" data-first=".sx_menu_block_first" data-second=".sx_menu_block_second">
                            <option value="1" <?if ($sel['type'] == 1) {?>selected="selected"<?}?>><?=__("Category")?></option>
                            <option value="2" <?if ($sel['type'] == 2) {?>selected="selected"<?}?>><?=__("Page")?></option>
                            <option value="3" <?if ($sel['type'] == 3) {?>selected="selected"<?}?>><?=__("System")?></option>
                            <option value="4" <?if ($sel['type'] == 4) {?>selected="selected"<?}?>><?=__("Link")?></option>
                        </select>
                    </div>
                </div>
                
                <div class="control-group sx_menu_block_first <?if ($sel['type'] == 4){?>hide<?}?>">
                    <label class="control-label" for="first_p"><?=__('Category')?></label>
                    <div class="controls">
                        <select class="input-xxlarge sx_menu_first" name="first" id="first_p" data-second=".sx_menu_block_second" data-first=".sx_menu_block_first" data-type=".sx_menu_block_type">
                            <?if ($sel['type'] == 3) {?>
                            <option value="/" <?if ($sel['first'] == '/') {?>selected="selected"<?}?>><?=__('home')?></option>
                            <option value="/category" <?if ($sel['first'] == '/category') {?>selected="selected"<?}?>><?=__('categories')?></option>
                            <?}else{?>
                                <?=$sel['first']?>
                            <?}?>
                        </select>
                    </div>
                </div>
                
                
                <div class="control-group sx_menu_block_second <?if ($sel['type'] != 2) {?>hide<?}?>">
                    <label class="control-label" for="second_p"><?=__('Page')?></label>
                    <div class="controls">
                        <select class="input-xxlarge" name="second" id="second_p">
                            <?if (strlen($sel['second']) > 0) {?>
                                <?foreach ($sel['sechtml'] as $pages) {?>
                                    <option value="<?=$pages->url?>" <?if ($sel['second'] == $pages->url) {?>selected="selected"<?}?>><?=$pages->title?></option>
                                <?}?>
                            <?}else{?>
                                <option value="0"><?=__('select')?></option>
                            <?}?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group sx_menu_block_threed <?if ($sel['type'] != 4){?>hide<?}?>">
                    <label class="control-label" for="threed_p"><?=__('Link')?></label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge" name="threed" id="threed_p" value="<?=$sel['threed']?>">
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="title_p"><?=__('Title')?></label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge" name="title" id="title_p" value="<?=$mdata->title?>">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="parent_p"><?=__('Parent')?></label>
                    <div class="controls">
                        <select class="input-xxlarge" name="parent" id="parent_p">
                            <option value="0"><?=__("No")?></option>
                            <?foreach ($parrents as $links) {?>
                                <option value="<?=$links->id?>" <?if ($links->id == $item_id) {?>disabled="disabled"<?}?> <?if ($mdata->parent_id == $links->id) {?>selected="selected"<?}?>><?=$links->title?></option>
                            <?}?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="description_p"><?=__('Description')?></label>
                    <div class="controls">
                        <textarea name="description" class="input-xxlarge" id="description_p"><?=$mdata->description?></textarea>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="icon_p"><?=__('Icon')?></label>
                    <div class="controls">
                        <button class="btn btn-primary sx_modal_show" type="button" data-modal=".sx_show_modal_icons"><?=__('Show icons')?></button>
                        <div class="input-prepend">
                            <span class="add-on"><i id="icon-block" class="<?=$mdata->icons?>"></i></span>
                            <input type="text" class="input-xlarge" name="icons" id="icon_p" value="<?=$mdata->icons?>">
                        </div>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="classes_p"><?=__('Item class')?></label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge" name="classes" id="classes_p" value="<?=$mdata->classes?>">
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="visible_p"><?=__('Visible')?></label>
                    <div class="controls">
                        <p><input type="radio" name="visible" <?if ($mdata->hidden == 0) {?>checked="checked"<?}?> class="radio" value="0">&nbsp;<?=__('Yes')?>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="visible" <?if ($mdata->hidden == 1) {?>checked="checked"<?}?> class="radion" value="1">&nbsp;<?=__('No')?></p>
                    </div>
                </div>
            </div>
        </div>	
    </form>
</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal hide sx_show_modal_icons" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal=".sx_show_modal_icons">×</button>
    <h3><?=__('Icons')?></h3>
  </div>
  <div class="modal-body">
      <ul class="admin_modal_icons sx_select_icons" data-modal=".sx_show_modal_icons" data-input="#icon_p" data-bimage="#icon-block">
        <li><a href="javascript:;"><i class="icon-glass icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-music icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-search icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-envelope icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-heart icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-star icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-star-empty icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-user icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-film icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-th-large icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-th icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-th-list icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-ok icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-remove icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-zoom-in icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-zoom-out icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-off icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-signal icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-cog icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-trash icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-home icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-file icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-time icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-road icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-download-alt icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-download icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-upload icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-inbox icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-play-circle icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-repeat icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-refresh icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-list-alt icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-lock icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-flag icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-headphones icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-volume-off icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-volume-down icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-volume-up icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-qrcode icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-barcode icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-tag icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-tags icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-book icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-bookmark icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-print icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-camera icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-font icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-bold icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-italic icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-text-height icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-text-width icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-align-left icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-align-center icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-align-right icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-align-justify icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-list icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-indent-left icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-indent-right icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-facetime-video icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-picture icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-pencil icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-map-marker icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-adjust icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-tint icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-edit icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-share icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-check icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-move icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-step-backward icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-fast-backward icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-backward icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-play icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-pause icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-stop icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-forward icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-fast-forward icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-step-forward icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-eject icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-chevron-left icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-chevron-right icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-plus-sign icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-minus-sign icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-remove-sign icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-ok-sign icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-question-sign icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-info-sign icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-screenshot icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-remove-circle icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-ok-circle icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-ban-circle icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-arrow-left icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-arrow-right icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-arrow-up icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-arrow-down icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-share-alt icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-resize-full icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-resize-small icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-plus icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-minus icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-asterisk icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-exclamation-sign icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-gift icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-leaf icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-fire icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-eye-open icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-eye-close icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-warning-sign icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-plane icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-calendar icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-random icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-comment icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-magnet icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-chevron-up icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-chevron-down icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-retweet icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-shopping-cart icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-folder-close icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-folder-open icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-resize-vertical icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-resize-horizontal icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-hdd icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-bullhorn icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-bell icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-certificate icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-thumbs-up icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-thumbs-down icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-hand-right icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-hand-left icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-hand-up icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-hand-down icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-circle-arrow-right icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-circle-arrow-left icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-circle-arrow-up icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-circle-arrow-down icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-globe icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-wrench icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-tasks icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-filter icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-briefcase icon-2x"></i></li>
        <li><a href="javascript:;"><i class="icon-fullscreen icon-2x"></i></li>
      </ul>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal=".sx_show_modal_icons"><?=__("Cancel")?></a>
  </div>
</div>