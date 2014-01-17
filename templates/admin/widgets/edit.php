<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">
<div class="widget-header">
    <i class="icon-file"></i>
    <h3><?=__('Widgets edit')?> '<?=$widget->title?>'</h3>
    <span class="action_buttons">
        <button class="btn pull-right formSubmit" data-form="#submit-form" data-after="exit" data-action="/admin/widgets/edit/<?=$widget_id?>">
            <i class=" icon-save icon-large"></i> <?=__('Save and exit')?>
        </button>
        <button class="btn btn-success pull-right formSubmit" data-form="#submit-form" data-after="save" data-action="/admin/widgets/edit/<?=$widget_id?>">
            <i class=" icon-save icon-large"></i> <?=__('Save')?>
        </button>
        <button data-href="/admin/widgets" data-container="#base-container" class="btn pull-right btn-info pjax_button">
            <i class="icon-arrow-left"></i> <?=__('Back')?>
        </button>
    </span>
</div>
                    
<div class="widget-content">
    <?if (isset($success)) {?>
        <div id="success_block">
            <p id="status_success">showMessage('<?=__('Success edit widget')?>', '<?=__('Status widget edit')?>', 'success')</p>
            <p id="url_success">/admin/widgets/edit/<?=$success?></p>
            <p id="url_success_exit">/admin/widgets/</p>
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
        <input type="hidden" name="widget_id" value="<?=$widget->id?>">
            <div class="control-group">
                <label class="control-label" for="title_p"><?=__('Title')?></label>
                <div class="controls">
                    <input type="text" class="input-xxlarge" value="<?=$widget->title?>" name="title" id="title_p">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="type_p"><?=__('Type')?></label>
                <div class="controls">
                    <select class="input-xxlarge sx_change_widget_type" name="type" data-html="#data_block" data-module="#module_block" id="type_p">
                        <option value="html" <?if ($widget->type == 'html') {?>selected="selected"<?}?>><?=__('Html widget')?></option>
                        <option value="module" <?if ($widget->type == 'module') {?>selected="selected"<?}?>><?=__('Module widget')?></option>
                    </select>
                </div>
            </div>
        
            <div class="control-group">
                <label class="control-label" for="name_p"><?=__('Name')?></label>
                <div class="controls">
                    <input type="text" class="input-xxlarge" value="<?=$widget->name?>" name="name" id="name_p">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="description_p"><?=__('Description')?></label>
                <div class="controls">
                    <input type="text" class="input-xxlarge" value="<?=$widget->description?>" name="description" id="description_p">
                </div>
            </div>
        
            <div class="control-group" id="data_block">
                <label class="control-label" for="data_p"><?=__('Html data')?></label>
                <div class="controls">
                    <textarea name="data" class="input-xxlarge load_texteditor" id="data_p"><?=$widget->data?></textarea>
                </div>
            </div>
                
            <div class="control-group hide" id="module_block">
                <div class="span3 pull-left">
                    <div class="widget stacked widget-table">
                        <div class="widget-header">
                            <span class="icon-key"></span>
                            <h3><?=__('Administrative')?></h3>
                        </div>

                        <div class="widget-content">
                            <div class="checkbox-row">
                                <span class="niceCheck">
                                    <input type="checkbox" name="access[]" value="71">
                                </span> <?=__('Login in admin panel')?>
                            </div>
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