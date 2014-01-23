<div class="main">
    <form method="post" id="submit-form">
        <input type="hidden" name="submit_this_form" value="1">
    <div class="container">
        <div class="row">
      	
            <div class="span10">
                <div class="widget stacked">
<div class="widget-header">
    <i class="icon-wrench"></i>
    <h3><?=__('Settings')?></h3>
    <span class="action_buttons">
        <button class="btn btn-success pull-right formSubmit" data-form="#submit-form" type="button" data-after="save" data-action="/admin/settings">
            <i class=" icon-save icon-large"></i> <?=__('Save')?>
        </button>
    </span>
</div>
				
                    <div class="widget-content">
    <?if (isset($success)) {?>
        <div id="success_block">
            <p id="status_success">showMessage('<?=__('Success update settings')?>', '<?=__('Status settings update')?>', 'success')</p>
            <p id="url_success">/admin/settings</p>
        </div>
    <?}?>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="settings-global">
                                <div class="form-horizontal">
                                    
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="6">
                                                    <?=__('Settings')?>                        
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="">
                                                <td colspan="6">
                                                    <div class="control-group">
                                                        <div class="control-label"><?=__('Site name')?></div>
                                                        <div class="controls">
                                                            <input type="text" name="settings[general][site_name]" value="<?=$settings['general']['site_name']?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="control-group">
                                                        <div class="control-label"><?=__('Disable site?')?></div>
                                                        <div class="controls">
                                                            <select name="settings[general][disable_site]">
                                                                <option value="1" <? if($settings['general']['disable_site'] == 1) {?>selected="selected"<?}?>><?=__('Enable')?></option>
                                                                <option value="0" <? if($settings['general']['disable_site'] == 0) {?>selected="selected"<?}?>><?=__('Disable')?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="control-group">
                                                        <div class="control-label"><?=__('Language')?></div>
                                                        <div class="controls">
                                                            <select name="settings[general][language]">
                                                                <option value="ru" <? if($settings['general']['language'] == "ru") {?>selected="selected"<?}?>>Русский</option>
                                                                <option value="en" <? if($settings['general']['language'] == "en") {?>selected="selected"<?}?>>English</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="control-group">
                                                        <div class="control-label"><?=__('Text editor')?></div>
                                                        <div class="controls">
                                                            <select name="settings[general][text_editor]">
                                                                <option value="tinymce" <? if($settings['general']['text_editor'] == "tinymce") {?>selected="selected"<?}?>><?=__('TinyMce')?></option>
                                                                <option value="elrte" <? if($settings['general']['text_editor'] == "elrte") {?>selected="selected"<?}?>><?=__('ElRte')?></option>
                                                                <option value="native" <? if($settings['general']['text_editor'] == "native") {?>selected="selected"<?}?>><?=__('Native')?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="6">
                                                    SEO                        
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="">
                                                <td colspan="6">
                                                    <div class="control-group">
                                                        <div class="control-label"><?=__('Short site name')?></div>
                                                        <div class="controls">
                                                            <input type="text" name="settings[seo][site_name]" value="<?=$settings['seo']['site_name']?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="control-group">
                                                        <div class="control-label"><?=__('Description')?></div>
                                                        <div class="controls">
                                                            <input type="text" name="settings[seo][description]" value="<?=$settings['seo']['description']?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="control-group">
                                                        <div class="control-label"><?=__('Keywords')?></div>
                                                        <div class="controls">
                                                            <input type="text" name="settings[seo][keywords]" value="<?=$settings['seo']['keywords']?>">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            
                            
                            <div class="tab-pane fade" id="settings-template">
                                <?if (isset($success_template)) {?>
                                    <div id="template_status_block">
                                        <p id="status_success">showMessage('<?=__('Success change template')?>', '<?=__('Status template change')?>', 'success')</p>
                                    </div>
                                <?}?>
<table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th colspan="6">
                    <?=__('Templates')?>                                    
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="control-group">
                        <label class="control-label"><?=__('Select template for site')?>:</label>
                        <div class="controls">
                            <select data-div=".information" class="sx_template_view" style="">
                                <?foreach ($templates as $tpl) {?>
                                    <option <?if ($template_current == $tpl['base']['name']) {?> selected="selected" <?}?>
                                        data-png="<?=$tpl['base']['png']?>"
                                        data-author="<?=$tpl['author']['name']?>"
                                        data-contacts="<?=$tpl['author']['contacts']?>"
                                        value="<?=$tpl['base']['name']?>">
                                        <?=$tpl['base']['title_rus']?>
                                    </option>
                                <?}?>
                            </select>
                                <input type="button" data-value=".sx_template_view" class="sx_save_template btn btn-primary" value="<?=__('Change template')?>">
                        </div>

                        <div class="information">
                            <div class="base">
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <?=__('Template information')?>                                    
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?=__('Template')?>:</td><td><?=$template_current?></td>
                                        </tr>

                                        <tr>
                                            <td><?=__('Author')?>:</td><td><?=$tpl['author']['name']?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"><img width="250px" height="250px" src="<?=$tpl['base']['png']?>" /></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="contacts">
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <?__('Author information')?>                                    
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? foreach ($tpl['author']['contacts_uns'] as $keyz => $cont) {?>
                                            <tr>
                                                <td><?=$keyz?></td>
                                                <td><?=$cont?></td>
                                            </tr>
                                        <?}?>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
                            </div>
                            
                            
                            
                            <div class="tab-pane fade" id="settings-backup">
                                <?if (isset($success_backup_create)) {?>
                                    <div id="backup_status_block">
                                        <p id="status_success">showMessage('<?=__('Success create backup')?>', '<?=__('Status backup create')?>', 'success')</p>
                                    </div>
                                <?}?>
                                
                                <?if (isset($success_backup_delete)) {?>
                                    <div id="backup_status_block">
                                        <p id="status_success">showMessage('<?=__('Success delete backup')?>', '<?=__('Status backup delete')?>', 'success')</p>
                                    </div>
                                <?}?>
  <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th colspan="6">
                   <?=__('System backup')?>                                   
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="inside_padd">
                        <div class="control-group">
                            <label class="control-label"><?=__('Backup')?>:</label>
                            <div class="controls">
                              <select class="select_backup_type">
                                  <option value="1"><?=__('Files')?></option>
                                  <option value="2"><?=__('Database')?></option>
                                  <option value="3"><?=__('Files & database')?></option>
                              </select>
                            </div>
                        </div> 
                        
                        <div class="control-group">
                            <div class="controls">
                              <button type="button" class="btn btn-small btn-primary action_on sx_new_backup" data-form="#settings_form" data-select=".select_backup_type"><i class="icon-ok"></i><?=__('Create new backup')?></button>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><?=__('Ready backups')?>:</label>
                            <div class="backups_list">
                            <?if (is_array($backup_mysql)) {?>
                                <ul>
                               <? foreach ($backup_mysql as $backup) {?>
                                   <li>
                                        <div class="first">
                                            <a href="/admin/syscom/download_backup/<?=$backup['link']?>" target="_blank">
                                                <?=$backup['name']?> -- <?=__('Created')?> <?=date("d.m.Y H:i", $backup['time'])?>
                                            </a> 
                                            (<a href="javascript:void(0)" data-modal-value="data-remove-file:<?=$backup['link']?>" data-value-data=".sx_remove_backup" data-modal-title="<?=__('Remove backup')?> <?=$backup['link']?> <?=__('at')?> <?=date("d.m.Y", $backup['time'])?>" data-modal=".sx_remove_backup" class="sx_remove_backup_modal">
                                                <?=__('Remove')?>
                                            </a>)
                                        </div>
                                                
                                        <div  class="second">
                                            <?if ($cloud['yandex']['active'] == 1) {?>
                                                <?if ($cloud_files[$backup['link']]) {?>
                                                    <button type="button" class="btn btn-small btn-primary sx_cloud_delete" data-service="yandex" data-link="<?=$backup['link']?>">
                                                        <i class="icon-remove"></i><?=__('Remove from disk')?>
                                                    </button>
                                                <?}else{?>
                                                    <button type="button" class="btn btn-small btn-primary sx_cloud_save" data-service="yandex" data-link="<?=$backup['link']?>">
                                                        <i class="icon-file"></i><?=__('Save on disk')?>
                                                    </button>
                                                <?}?>
                                            <?}?>
                                            
                                            <?if ($cloud['ftp']['active'] == 1) {?>
                                                <?if ($ftp_files[$backup['link']]) {?>
                                                    <button type="button" class="btn btn-small btn-primary sx_ftp_delete" data-service="ftp" data-link="<?=$backup['link']?>">
                                                        <i class="icon-remove"></i><?=__('Remove from FTP')?>
                                                    </button>
                                                <?}else{?>
                                                    <button type="button" class="btn btn-small btn-primary sx_ftp_save" data-service="ftp" data-link="<?=$backup['link']?>">
                                                        <i class="icon-file"></i><?=__('Save on FTP')?>
                                                    </button>
                                                <?}?>
                                            <?}?>
                                        </div>
                                   </li>
                               <?}?>
                               </ul>
                            <?}else{?>
                                <div><?=__('No backups')?></div> 
                            <?}?>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
                            </div>
                            
<div class="tab-pane fade" id="settings-comments">
    <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th colspan="6">
                    <?=__('Comments')?>                                  
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="inside_padd">
                        
                        <div class="control-group">
                            <label class="control-label" for="comment_length"><?=__('Max length comment')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <input type="text" id="comment_length" name="comments[length]" value="<?=$comments['length']?>">
                                </span>
                            </div>
                        </div>
                              
                        <div class="control-group">
                            <label class="control-label" for="comment_timeout"><?=__('Time out comment')?>:</label>
                            <div class="controls">
                                <input type="text" value="<?=$comments['timeout']?>" name="comments[timeout]" id="comment_timeout">
                                <span class="help-block"><?=__('Frequency limit commenting in minutes. 0 - Disable checking.')?></span>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="comment_user"><?=__('Who may comment')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <select id="comment_user" name="comments[user]">
                                        <option value="0" <?if ($comments['user'] == 0) {?>selected="selected"<?}?>><?=__('None')?></option>
                                        <option value="1" <?if ($comments['user'] == 1) {?>selected="selected"<?}?>><?=__('Only for registered users')?></option>
                                        <option value="2" <?if ($comments['user'] == 2) {?>selected="selected"<?}?>><?=__('Only for guests')?></option>
                                        <option value="3" <?if ($comments['user'] == 3) {?>selected="selected"<?}?>><?=__('For all')?></option>
                                    </select>
                                </span>
                            </div>
                        </div>
                                
                        <div class="control-group">
                            <label class="control-label" for="comment_capthca"><?=__('Enable captcha')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <select id="comment_capthca" name="comments[captcha]">
                                        <option value="0" <?if ($comments['captcha'] == 0) {?>selected="selected"<?}?>><?=__('No')?></option>
                                        <option value="1" <?if ($comments['captcha'] == 1) {?>selected="selected"<?}?>><?=__('Only for registered users')?></option>
                                        <option value="2" <?if ($comments['captcha'] == 2) {?>selected="selected"<?}?>><?=__('Only for guests')?></option>
                                        <option value="3" <?if ($comments['captcha'] == 3) {?>selected="selected"<?}?>><?=__('For all')?></option>
                                    </select>
                                </span>
                            </div>
                        </div>
                        
                                    
                        <div class="control-group">
                            <label class="control-label" for="comment_capthca_sizew"><?=__('Captcha size')?>:</label>
                            <div class="controls">
                                <input type="text" id="comment_capthca_sizew" name="comments[captcha_width]" value="<?=$comments['captcha_width']?>">
                                <span class="help-block"><?=__('Width')?></span>
                            </div>
                            <div class="controls">
                                <input type="text" id="comment_capthca_sizeh" name="comments[captcha_height]" value="<?=$comments['captcha_height']?>">
                                <span class="help-block"><?=__('Height')?></span>
                            </div>
                        </div>
                                
                        <div class="control-group">
                            <label class="control-label" for="comment_capthca_length"><?=__('Captcha length')?>:</label>
                            <div class="controls">
                                <input type="text" id="comment_capthca_length" name="comments[captcha_length]" value="<?=$comments['captcha_length']?>">
                                <span class="help-block"><?=__('From 1 to 9')?></span>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="comment_status"><?=__('Approving comments')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <select id="comment_status" name="comments[status]">
                                        <option value="0" <?if ($comments['status'] == 0) {?>selected="selected"<?}?>><?=__('No')?></option>
                                        <option value="1" <?if ($comments['status'] == 1) {?>selected="selected"<?}?>><?=__('Only for registered users')?></option>
                                        <option value="2" <?if ($comments['status'] == 2) {?>selected="selected"<?}?>><?=__('Only for guests')?></option>
                                        <option value="3" <?if ($comments['status'] == 3) {?>selected="selected"<?}?>><?=__('For all')?></option>
                                    </select>
                                </span>
                            </div>
                        </div>
                                    
                                    
                        <div class="control-group">
                            <label class="control-label" for="comment_cotroller"><?=__('Comment handler')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <input type="text" value="<?if ($comments['controller']) {echo $comments['controller'];} else {echo '/myshop/post_comment';}?>" name="comments[controller]" id="comment_cotroller">
                                    <span class="help-inline"><?=__('Only if you know what does it do')?></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>             
                            
<div class="tab-pane fade" id="settings-remote">
  <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th colspan="6">
                    <?=__('Yandex cloud')?>                               
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="inside_padd">
                        <div class="control-group">
                            <label class="control-label" for="yandex_login"><?=__('Yandex login')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <input type="text" name="cloud[yandex][login]" value="<?=$cloud['yandex']['login']?>" id="yandex_login">
                                </span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="yandex_password"><?=__('Yandex password')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <input type="text" name="cloud[yandex][password]" value="<?=$cloud['yandex']['password']?>" id="yandex_password">
                                </span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="yandex_active"><?=__('Active')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <span class="niceCheck" <?if ($cloud['yandex']['active'] == 1) {?>style="background-position: 0px -17px;"<?}?>>
                                        <input type="checkbox" id="yandex_active" name="cloud[yandex][active]" <?if ($cloud['yandex']['active'] == 1) {?>checked="checked"<?}?> value="1">
                                    </span>
                                </span>
                            </div>
                        </div>
                                    
                        <div class="control-group">
                            <div class="controls">
                                <span class="frame_label">
                                    <input type="button" data-service="yandex" data-password="#yandex_password" data-login="#yandex_login" class="sx_cloud_check btn btn-primary" value="<?=__('Check connect')?>">
                                </span>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
                                    
<table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th colspan="6">
                    <?=__('FTP Server')?>                               
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="inside_padd">
                        <div class="control-group">
                            <label class="control-label" for="ftp_server"><?=__('Server')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <input type="text" name="cloud[ftp][server]" value="<?=$cloud['ftp']['server']?>" id="ftp_server">
                                </span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="ftp_port"><?=__('Port')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <input type="text" name="cloud[ftp][port]" value="<?=$cloud['ftp']['port']?>" id="ftp_port">
                                </span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="ftp_login"><?=__('Login')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <input type="text" name="cloud[ftp][login]" value="<?=$cloud['ftp']['login']?>" id="ftp_login">
                                </span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="ftp_password"><?=__('Password')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <input type="text" name="cloud[ftp][password]" value="<?=$cloud['ftp']['password']?>" id="ftp_password">
                                </span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="ftp_active"><?=__('Active')?>:</label>
                            <div class="controls">
                                <span class="frame_label">
                                    <span class="niceCheck" <?if ($cloud['ftp']['active'] == 1) {?>style="background-position: 0px -17px;"<?}?>>
                                        <input type="checkbox" id="ftp_active" name="cloud[ftp][active]" <?if ($cloud['ftp']['active'] == 1) {?>checked="checked"<?}?> value="1">
                                    </span>
                                </span>
                            </div>
                        </div>
                                    
                        <div class="control-group">
                            <div class="controls">
                                <span class="frame_label">
                                    <input type="button" data-service="ftp" data-password="#ftp_password" data-login="#ftp_login" data-server="#ftp_server" data-port="#ftp_port" class="sx_ftp_check btn btn-primary" value="<?=__('Check connect')?>">
                                </span>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
                            </div>
                        </div>
                    </div>
					
                </div> 	
            </div>
	        
	    
	    <div class="span2">	
                <div class="widget widget-plain">
                    <div class="widget-content">
                        <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
                            <li class="active">
                                <a href="#settings-global" data-toggle="tab"><?=__('Global settings')?></a>
                            </li>
                            
                            <li>
                                <a href="#settings-comments" data-toggle="tab"><?=__('Comments')?></a>
                            </li>

                            <li>
                                <a href="#settings-template" data-toggle="tab"><?=__('Template')?></a>
                            </li>

                            <li>
                                <a href="#settings-backup" data-toggle="tab"><?=__('Backups')?></a>
                            </li>
                            
                            <li>
                                <a href="#settings-remote" data-toggle="tab"><?=__('Cloud/Ftp')?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
      	
      </div> 
    </div> 
    </form>
</div>

<div class="modal hide sx_remove_backup" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal=".sx_remove_backup">×</button>
    <h3><?=__('Remove backup')?></h3>
  </div>
  <div class="modal-body">
    <p><?=__('Do you really want to delete the selected backup?')?></p>
    <p class="modal_spec_title"></p>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal=".sx_remove_backup"><?=__("Cancel")?></a>
    <a href="javascript:;" class="btn btn-primary sx_modal_hide sx_delete_backup confirm_modal_button" data-modal=".sx_remove_backup"><?=__('Delete')?></a>
  </div>
</div>