<form method="post">
    <input type="hidden" name="submit_this_form" value="1">
    <div class="control-group">
        <label class="control-label" for="email_p"><?=__('Your mail')?></label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="email" id="email_p">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="title_p"><?=__('Title')?></label>
        <div class="controls">
            <input type="text" class="input-xxlarge" name="title" id="title_p">
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="message_p"><?=__('Message')?></label>
        <div class="controls">
            <textarea class="input-xxlarge" name="message" id="message_p"></textarea>
        </div>
    </div>
    
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-info">Отправить</button>
        </div>
    </div>
</form>