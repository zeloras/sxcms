<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">
<div class="widget-header">
    <i class="icon-file"></i>
    <h3><?=__('Category edit')?> `<?=$category['title']?>`</h3>
    <span class="action_buttons">
        <button class="btn pull-right formSubmit" data-form="#submit-form" data-after="exit" data-action="/admin/categorys/edit/<?=$category_id?>">
            <i class=" icon-save icon-large"></i> <?=__('Save and exit')?>
        </button>
        <button class="btn btn-success pull-right formSubmit" data-form="#submit-form" data-after="save" data-action="/admin/categorys/edit/<?=$category_id?>">
            <i class=" icon-save icon-large"></i> <?=__('Save')?>
        </button>
        <button data-href="/admin/categorys" data-container="#base-container" class="btn pull-right btn-info pjax_button">
            <i class="icon-arrow-left"></i> <?=__('Back')?>
        </button>
    </span>
</div>
                    
<div class="widget-content">
    <?if (isset($success)) {?>
        <div id="success_block">
            <p id="status_success">showMessage('<?=__('Success edit category')?>', '<?=__('Status category edit')?>', 'success')</p>
            <p id="url_success">/admin/categorys/edit/<?=$success?></p>
            <p id="url_success_exit">/admin/categorys/</p>
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
    <div class="tabbable">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#content" data-toggle="tab"><?=__('Content')?></a>
            </li>
            <li>
                <a href="#settings" data-toggle="tab"><?=__("Settings")?></a>
            </li>
        </ul>				
        <br>	
        <form id="submit-form" method="post" class="form-horizontal">
            <input type="hidden" value="<?=$category_id?>" name="category_id">
            <div class="tab-content">
                <input type="hidden" name="submit_this_form" value="1">
                <div class="tab-pane active" id="content">
                    <div class="control-group">
                        <label class="control-label" for="title_p"><?=__('Title')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" name="title" value="<?=$category['title']?>" id="title_p">
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="parent_p"><?=__('Parent')?></label>
                        <div class="controls">
                            <select class="input-xxlarge" name="parent" id="parent_p">
                                <option value="0">Нет</option>
                                <?=$catTreeHTML?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="image_p"><?=__('Image')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" name="image" value="<?=$category['image']?>" id="image_p">
                            <button type="button" class="btn btn-info sx_elfinder" data-input-id="image_p" data-type="image" data-block="#elfinder">Find</button>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="url_p"><?=__('URL')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" value="<?=$category['url']?>" name="url" id="url_p">
                            <button class="btn sx_translit_url" type="button" data-title="#title_p" data-url="#url_p"><i class="icon-share-alt"></i><?=__('Link generate')?></button>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="text_full_p"><?=__('Text full')?></label>
                        <div class="controls">
                            <textarea name="text_full" class="input-xxlarge load_texteditor" id="text_full_p"><?=$category['description']?></textarea>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="template_p"><?=__('Template')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" value="<?=$category['template']?>" name="template" id="template_p">
                            <p class="help-block"><?=__('Example: category_spec, default: category or empty')?></p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="settings">
                    <div class="control-group">
                        <label class="control-label" for="meta_keywords_p"><?=__('Meta keywords')?></label>
                        <div class="controls">
                            <textarea name="meta_keywords" class="input-xxlarge" id="meta_keywords_p"><?=$category['meta_keywords']?></textarea>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="meta_description_p"><?=__('Meta description')?></label>
                        <div class="controls">
                            <textarea name="meta_description" class="input-xxlarge" id="meta_description_p"><?=$category['meta_description']?></textarea>
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
</div>
<div id="elfinder"></div>