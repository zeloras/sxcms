<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">
<div class="widget-header">
    <i class="icon-file"></i>
    <h3><?=__('Edit additional fields')?></h3>
    <span class="action_buttons">
        <button class="btn pull-right formSubmit" data-form="#submit-form" data-after="exit" data-action="/admin/additional_fields/edit/<?=$field->id?>">
            <i class="icon-save icon-large"></i> <?=__('Save and exit')?>
        </button>
        <button class="btn btn-success pull-right formSubmit" data-form="#submit-form" data-after="save" data-action="/admin/additional_fields/edit/<?=$field->id?>">
            <i class="icon-save icon-large"></i> <?=__('Save')?>
        </button>
        <button data-href="/admin/additional_fields" data-container="#base-container" class="btn pull-right btn-info pjax_button">
            <i class="icon-arrow-left"></i> <?=__('Back')?>
        </button>
    </span>
</div>
                    
<div class="widget-content">
    <?if (isset($success)) {?>
        <div id="success_block">
            <p id="status_success">showMessage('<?=__('Success edit additional field')?>', '<?=__('Status field edit')?>', 'success')</p>
            <p id="url_success">/admin/additional_fields/edit/<?=$success?></p>
            <p id="url_success_exit">/admin/additional_fields/</p>
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
            <input type="hidden" name="submit_this_form" value="1">
            <input type="hidden" value="<?=$field->id?>" name="field_id">
            <div class="inside_padd span9">
            <div class="control-group m-t_10">
                <label class="control-label"><?=__('Title')?>:</label>
                <div class="controls">
                    <input type="text" name="title" value="<?=$field->title?>" required/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?=__('CSV Name')?>:</label>
                <div class="controls">
                    <input type="text" name="csv" value="<?=$field->csv?>" required/>
                    <span class="help-inline"><?=__('Field should contain only latin character')?>.</span>
                </div>
            </div>
            <div class="control-group">
                <div class="control-label"></div>
                <div class="controls">
                        <span class="niceCheck" <?if ($field->active == 1) {?>style="background-position: 0px -17px;"<?}?>>
                            <input type="checkbox" <?if ($field->active == 1) {?>checked="checked"<?}?> value="1" name="active" />
                        </span>
                        <?=__('Active')?>                                           
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?=__('Use in categories')?>:</label>
                <div class="controls">
                    <select name="category[]" multiple="multiple">
                        <?=$catTreeHTML?>
                    </select>
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