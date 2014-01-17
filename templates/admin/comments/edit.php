<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">
<div class="widget-header">
    <i class="icon-file"></i>
    <h3><?=__('Comment edit')?></h3>
    <span class="action_buttons">
        <button class="btn pull-right formSubmit" data-form="#submit-form" data-after="exit" data-action="/admin/comments/edit/<?=$comm_id?>">
            <i class=" icon-save icon-large"></i> <?=__('Save and exit')?>
        </button>
        <button data-href="/admin/comments" data-container="#base-container" class="btn pull-right btn-info pjax_button">
            <i class="icon-arrow-left"></i> <?=__('Back')?>
        </button>
    </span>
</div>
                    
<div class="widget-content">
    <?if (isset($success)) {?>
        <div id="success_block">
            <p id="status_success">showMessage('<?=__('Success edit comment')?>', '<?=__('Status comment edit')?>', 'success')</p>
            <p id="url_success">/admin/comments/edit/<?=$success?></p>
            <p id="url_success_exit">/admin/comments/</p>
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
                    <label class="control-label" for="title_p"><?=__('Title')?></label>
                    <div class="controls">
                        <input type="text" class="input-xxlarge" name="title" value="" id="title_p">
                    </div>
                </div>

        </form>
</div>
                </div>
            </div>
        </div>
    </div>
</div>