<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">
<div class="widget-header">
    <i class="icon-file"></i>
    <h3><?=__('Menu create')?></h3>
    <span class="action_buttons">
        <button class="btn pull-right formSubmit" data-form="#submit-form" data-after="exit" data-action="/admin/menus/add">
            <i class=" icon-save icon-large"></i> <?=__('Save and exit')?>
        </button>
        <button class="btn btn-success pull-right formSubmit" data-form="#submit-form" data-after="save" data-action="/admin/menus/add">
            <i class=" icon-save icon-large"></i> <?=__('Save')?>
        </button>
        <button data-href="/admin/menus" data-container="#base-container" class="btn pull-right btn-info pjax_button">
            <i class="icon-arrow-left"></i> <?=__('Back')?>
        </button>
    </span>
</div>
                    
<div class="widget-content">
    <?if (isset($success)) {?>
        <div id="success_block">
            <p id="status_success">showMessage('<?=__('Success create menu')?>', '<?=__('Status menu create')?>', 'success')</p>
            <p id="url_success">/admin/menus/edit/<?=$success?></p>
            <p id="url_success_exit">/admin/menus/</p>
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
            <div class="tab-pane active" id="content">
                <div class="control-group">
                    <label class="control-label" for="title_p"><?=__('Title')?></label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge" name="title" id="title_p">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="name_p"><?=__('Name')?></label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge" name="name" id="name_p">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="description_p"><?=__('Description')?></label>
                    <div class="controls">
                        <textarea name="description" class="input-xxlarge" id="description_p"></textarea>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="template_p"><?=__('Template')?></label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge" disabled="disabled" name="template" id="template_p">
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="class_p"><?=__('Class menu')?></label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge" name="class" id="class_p">
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="parent_class_p"><?=__('Child class')?></label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge" name="parent_class" id="parent_class_p">
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