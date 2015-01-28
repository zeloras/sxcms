<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Feedback settings')?></h3>
                        <span class="action_buttons">
                            <button class="btn btn-success pull-right formSubmit" data-form="#submit-form" data-after="save" data-action="/admin/feedback">
                                <i class="icon-save icon-large"></i> <?=__('Save')?>
                            </button>
                            <button data-href="/admin/modules" data-container="#base-container" class="btn pull-right btn-info pjax_button">
                                <i class="icon-arrow-left"></i> <?=__('Back')?>
                            </button>
                        </span>
                    </div>

                    <div class="widget-content">
                        <?if (isset($success)) {?>
                            <div id="success_block">
                                <p id="status_success">showMessage('<?=__('Success update settings')?>', '<?=__('Status update')?>', 'success')</p>
                                <p id="url_success">/admin/feedback/</p>
                                <p id="url_success_exit">/admin/modules/</p>
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
                            <div class="control-group">
                                <label class="control-label" for="email_p"><?=__('Email letters to come')?></label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge" name="email" value="<?=$settings['email']?>" id="email_p">
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label" for="message_length_p"><?=__('Maximum number of characters in a letter')?></label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge" name="message_length" value="<?=$settings['message_length']?>" id="message_length_p">
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label" for="message_format_p"><?=__('Message format')?></label>
                                <div class="controls">
                                    <select id="message_format_p" name="message_format">
                                        <option value="html" <?if ($settings['message_format'] == 'html') {?>selected="selected"<?}?>>HTML</option>
                                        <option value="text" <?if ($settings['message_format'] == 'text') {?>selected="selected"<?}?>>TEXT</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>	
                </div>
            </div>
        </div>
    </div>
</div>