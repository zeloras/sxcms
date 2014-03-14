<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">
<div class="widget-header">
    <i class="icon-file"></i>
    <h3><?=__('Language edit')?>: <?=$language_edit->title?></h3>
    <span class="action_buttons">
        <button class="btn pull-right formSubmit" data-form="#submit-form" data-after="exit" data-action="/admin/languages/edit/<?=$language_edit->id?>">
            <i class=" icon-save icon-large"></i> <?=__('Save and exit')?>
        </button>
        <button class="btn btn-success pull-right formSubmit" data-form="#submit-form" data-after="save" data-action="/admin/languages/edit/<?=$language_edit->id?>">
            <i class=" icon-save icon-large"></i> <?=__('Save')?>
        </button>
        <button data-href="/admin/languages" data-container="#base-container" class="btn pull-right btn-info pjax_button">
            <i class="icon-arrow-left"></i> <?=__('Back')?>
        </button>
    </span>
</div>
                    
<div class="widget-content">
    <?if (isset($success)) {?>
        <div id="success_block">
            <p id="status_success">showMessage('<?=__('Success edit language')?>', '<?=__('Status language edit')?>', 'success')</p>
            <p id="url_success">/admin/languages/edit/<?=$success?></p>
            <p id="url_success_exit">/admin/languages/</p>
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
            <input type="hidden" name="field_id" value="<?=$language_edit->id?>">
            <div class="tab-pane active" id="content">
                <div class="control-group">
                    <label class="control-label" for="language_p"><?=__('Name')?></label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge" name="language" value="<?=$language_edit->title?>" id="language_p">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="file_p"><?=__('Language file')?></label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge" value="<?=$language_edit->file?>" name="file" id="file_p">
                        <button type="button" class="btn btn-info sx_elfinder" data-input-id="file_p" data-path="language_system" data-type="language" data-block="#elfinder"><?=__('Find')?></button>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?=__('Active')?></label>
                    <div class="controls">
                        <span class="niceCheck" <?if ($language_edit->active == 1) {?>style="background-position: 0px -17px;"<?}?>>
                            <input type="checkbox" name="active" value="1" <?if ($language_edit->active == 1) {?>checked="checked"<?}?>>
                        </span>                    
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
<div id="elfinder"></div>