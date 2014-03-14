<h3><?=__('Feedback')?></h3>
<?if (isset($process_send)) {?>
    <?if (!isset($errors)) {?>
        <?if ($message_send) {?>
            <div class="alert alert-success">
                <?=__('Message sent successfully')?>.
            </div>
        <?}else{?>
            <div class="alert alert-danger">
                <?=__('Failed to send message')?>.
            </div>
        <?}?>
    <?}else{?>
        <div class="alert alert-error">
            <?foreach ($errors as $key => $error) {?>
                <p><?=__('Error')?>: <?=__('row')?> <b><?=__(ucfirst($key))?></b> <?=__($error[0])?>.</p>
            <?}?>
        </div>
    <?}?>
<?}?>
<form method="post">
    <input type="hidden" name="submit_this_form" value="1">
    <div class="control-group">
        <label class="control-label" for="email_p"><?=__('Your mail')?></label>
        <div class="controls">
            <input type="text" class="input-xxlarge" value="<?=Arr::get($_POST, 'email')?>" name="email" id="email_p">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="title_p"><?=__('Title')?></label>
        <div class="controls">
            <input type="text" class="input-xxlarge" value="<?=Arr::get($_POST, 'title')?>" name="title" id="title_p">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="message_p"><?=__('Message')?></label>
        <div class="controls">
            <textarea class="input-xxlarge" name="message" data-minlength="10" data-maxlength="<?=$settings['message_length']?>" id="message_p"><?=Arr::get($_POST, 'message')?></textarea>
            <div id="texarea_insert_data">0 / <?=$settings['message_length']?></div>
        </div>
    </div>
    
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-info">Отправить</button>
        </div>
    </div>
</form>
<script src="/application/classes/modules/feedback/template/public/js/check.js"></script>