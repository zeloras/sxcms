<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">
<div class="widget-header">
    <i class="icon-file"></i>
    <h3><?=__('Pages edit')?> `<?=$page['title']?>`</h3>
    <span class="action_buttons">
        <button class="btn pull-right formSubmit" data-form="#submit-form" data-after="exit" data-action="/admin/pages/edit/<?=$page_id?>">
            <i class=" icon-save icon-large"></i> <?=__('Save and exit')?>
        </button>
        <button class="btn btn-success pull-right formSubmit" data-form="#submit-form" data-after="save" data-action="/admin/pages/edit/<?=$page_id?>">
            <i class=" icon-save icon-large"></i> <?=__('Save')?>
        </button>
        <button data-href="/admin/pages" data-container="#base-container" class="btn pull-right btn-info pjax_button">
            <i class="icon-arrow-left"></i> <?=__('Back')?>
        </button>
    </span>
</div>
                    
<div class="widget-content">
    <?if (isset($success)) {?>
        <div id="success_block">
            <p id="status_success">showMessage('<?=__('Success create page')?>', '<?=__('Status page create')?>', 'success')</p>
            <p id="url_success">/admin/pages/edit/<?=$success?></p>
            <p id="url_success_exit">/admin/pages/</p>
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
                <a href="#additional_fields" data-toggle="tab"><?=__("Additional fields")?></a>
            </li>
            <li>
                <a href="#settings" data-toggle="tab"><?=__("Settings")?></a>
            </li>
        </ul>				
        <br>	
        <form id="submit-form" method="post" class="form-horizontal">
            <input type="hidden" name="page_id" value="<?=$page_id?>">
            <div class="tab-content">
                <input type="hidden" name="submit_this_form" value="1">
                <div class="tab-pane active" id="content">
                    <div class="control-group">
                        <label class="control-label" for="title_p"><?=__('Title')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" name="title" value="<?=$page['title']?>" id="title_p">
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="category_p"><?=__('Category')?></label>
                        <div class="controls">
                            <select class="input-xxlarge sx_category_fields"
                                    data-insert="#additional_fields"
                                    data-item="<?=$page_id?>"
                                    name="category"
                                    id="category_p">
                                <option value="0">Нет</option>
                                <?=$catTreeHTML?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="url_p"><?=__('URL')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" value="<?=$page['url']?>" name="url" id="url_p">
                            <button class="btn sx_translit_url" type="button" data-title="#title_p" data-url="#url_p"><i class="icon-share-alt"></i>Генерировать ссылку</button>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="text_prev_p"><?=__('Text previously')?></label>
                        <div class="controls">
                            <textarea name="text_prev" class="input-xxlarge load_texteditor" id="text_prev_p"><?=$page['short_text']?></textarea>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="text_full_p"><?=__('Text full')?></label>
                        <div class="controls">
                            <textarea name="text_full" class="input-xxlarge load_texteditor" id="text_full_p"><?=$page['text']?></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane" id="additional_fields">
                    <?=$additional_fields?>
                </div>

                <div class="tab-pane" id="settings">
                    
                    <div class="control-group">
                        <label class="control-label" for="post_time_p"><?=__('Post time')?></label>
                        <div class="controls input-append">
                            <input type="text" data-date="<?=date('d/m/Y H:i', ($page['post_date'] > 1000) ? $page['post_date'] : time())?>" value="<?=date('d/m/Y H:i', ($page['post_date'] > 1000) ? $page['post_date'] : time())?>" name="post_time" class="input sx_timepicker" id="post_time_p" style="margin-left: -159px;">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="is_comment_p"><?=__('Enable comments')?></label>
                        <div class="controls">
                            <span class="niceCheck" <?if ($page['comment']) {?>style="background-position: 0px -17px;"<?}?>>
                                <input type="checkbox" name="is_comment" <?if ($page['comment']) {?>checked="checked"<?}?> id="is_comment_p">
                            </span>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="meta_keywords_p"><?=__('Meta keywords')?></label>
                        <div class="controls">
                            <textarea name="meta_keywords" class="input-xxlarge" id="meta_keywords_p"><?=$page['meta_keywords']?></textarea>
                            <button type="button" class="btn btn-small sx_generate_keywords" data-get="#text_prev_p" data-put="#keywords_list" data-input="#meta_keywords_p">
                                <i class="icon-refresh"></i>
                                &nbsp;&nbsp;Автоподбор
                            </button>
                        </div>
                    </div>
                    
                    <div class="control-group keywords_list">
                        <div id="keywords_list" class="controls alert-info">
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="meta_description_p"><?=__('Meta description')?></label>
                        <div class="controls">
                            <textarea name="meta_description" class="input-xxlarge" id="meta_description_p"><?=$page['meta_description']?></textarea>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="publication_status_p"><?=__('Publication status')?></label>
                        <div class="controls">
                            <select name="publication_status" class="input-xxlarge" id="publication_status_p">
                                <option value="1" <?if ($page['status'] == 1) {?>selected="selected"<?}?>><?=__('Published')?></option>
                                <option value="2" <?if ($page['status'] == 2) {?>selected="selected"<?}?>><?=__('Peding')?></option>
                                <option value="0" <?if ($page['status'] == 0) {?>selected="selected"<?}?>><?=__('Unpublished')?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="template_p"><?=__('Page template')?></label>
                        <div class="controls">
                            <input type="text" name="template" value="<?=$page['template']?>" class="input-xxlarge" id="template_p">
                            <p class="help-block"><?=__('Example: page_spec, default: page or empty')?></p>
                        </div>
                    </div>
                    
                    <!--<div class="control-group">
                        <label class="control-label" for="site_template_p"><?=__('Site template')?></label>
                        <div class="controls">
                            <input type="text" name="site_template" value="<?=$page['site_template']?>" class="input-xxlarge" id="site_template_p">
                            <p class="help-block"><?=__('Example: index_spec, default: index or empty')?></p>
                        </div>
                    </div>-->
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