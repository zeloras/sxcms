<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">
<div class="widget-header">
    <i class="icon-file"></i>
    <h3><?=__('User create')?></h3>
    <span class="action_buttons">
        <button class="btn pull-right formSubmit" data-form="#submit-form" data-after="exit" data-action="/admin/users/add">
            <i class=" icon-save icon-large"></i> <?=__('Save and exit')?>
        </button>
        <button class="btn btn-success pull-right formSubmit" data-form="#submit-form" data-after="save" data-action="/admin/users/add">
            <i class=" icon-save icon-large"></i> <?=__('Save')?>
        </button>
        <button data-href="/admin/users" data-container="#base-container" class="btn pull-right btn-info pjax_button">
            <i class="icon-arrow-left"></i> <?=__('Back')?>
        </button>
    </span>
</div>
                    
<div class="widget-content">
    <?if (isset($success)) {?>
        <div id="success_block">
            <p id="status_success">showMessage('<?=__('Success create user')?>', '<?=__('Status user create')?>', 'success')</p>
            <p id="url_success">/admin/users/edit/<?=$success?></p>
            <p id="url_success_exit">/admin/users/</p>
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
                <a href="#general_user" data-toggle="tab"><?=__('General')?></a>
            </li>
            <li>
                <a href="#private_user" data-toggle="tab"><?=__("Private data")?></a>
            </li>
        </ul>				
        <br>	
        <form id="submit-form" method="post" class="form-horizontal">
            <div class="tab-content">
                <input type="hidden" name="submit_this_form" value="1">
                <div class="tab-pane active" id="general_user">
                    <div class="control-group">
                        <label class="control-label" for="username_p"><?=__('Username')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" name="username" id="username_p">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="email_p"><?=__('Email')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" name="email" id="email_p">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="password_p"><?=__('Password')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" name="password" id="password_p">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="role_p"><?=__('Role')?></label>
                        <div class="controls">
                            <select class="input-xxlarge" name="role" id="role_p">
                                <?foreach ($roles as $role) {?>
                                    <option value="<?=$role->id?>"><?=$role->title?></option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="private_user">
                    <div class="control-group">
                        <label class="control-label" for="country_p"><?=__('User country')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" name="country" id="country_p">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="city_p"><?=__('User city')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" name="city" id="city_p">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="address_p"><?=__('User address')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" name="address" id="address_p">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="zipcode_p"><?=__('User zip code')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" name="zipcode" id="zipcode_p">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="phone_p"><?=__('User phone')?></label>
                        <div class="controls">
                            <input type="text" class="input-xxlarge" name="phone" id="phone_p">
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