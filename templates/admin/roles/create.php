<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">
<div class="widget-header">
    <i class="icon-file"></i>
    <h3><?=__('Role create')?></h3>
    <span class="action_buttons">
        <button class="btn pull-right formSubmit" data-form="#submit-form" data-after="exit" data-action="/admin/roles/add">
            <i class=" icon-save icon-large"></i> <?=__('Save and exit')?>
        </button>
        <button class="btn btn-success pull-right formSubmit" data-form="#submit-form" data-after="save" data-action="/admin/roles/add">
            <i class=" icon-save icon-large"></i> <?=__('Save')?>
        </button>
        <button data-href="/admin/roles" data-container="#base-container" class="btn pull-right btn-info pjax_button">
            <i class="icon-arrow-left"></i> <?=__('Back')?>
        </button>
    </span>
</div>
                    
<div class="widget-content">
    <?if (isset($success)) {?>
        <div id="success_block">
            <p id="status_success">showMessage('<?=__('Success create role')?>', '<?=__('Status role create')?>', 'success')</p>
            <p id="url_success">/admin/roles/edit/<?=$success?></p>
            <p id="url_success_exit">/admin/roles/</p>
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
                    <input type="text" class="input-xxlarge" name="description" id="description_p">
                </div>
            </div>
        
            <div class="control-group">
                <label class="control-label" for="is_admin_p"><?=__('Is admin')?></label>
                <div class="controls">
                    <span class="niceCheck">
                        <input type="checkbox" name="is_admin" value="1" id="is_admin_p">
                    </span>
                </div>
            </div>
                
            <div class="control-group">
                
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
                
                <div class="span3 pull-left">
                    <div class="widget stacked widget-table">
                        <div class="widget-header">
                            <span class="icon-th"></span>
                            <h3><?=__('Pages')?></h3>
                        </div>

                        <div class="widget-content">
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="11"></span> <?=__('View a list of pages')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="12"></span> <?=__('Create pages')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="13"></span> <?=__('Edit pages')?>
                            </div>
                            
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="14"></span> <?=__('Remove pages')?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="span3 pull-left">
                    <div class="widget stacked widget-table">
                        <div class="widget-header">
                            <span class="icon-list-alt"></span>
                            <h3><?=__('Categories')?></h3>
                        </div>

                        <div class="widget-content">
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="21"></span> <?=__('View categories list')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="22"></span> <?=__('Create categories')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="23"></span> <?=__('Edit categories')?>
                            </div>
                            
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="24"></span> <?=__('Remove categories')?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="span3 pull-left">
                    <div class="widget stacked widget-table">
                        <div class="widget-header">
                            <span class="icon-link"></span>
                            <h3><?=__('Menu')?></h3>
                        </div>

                        <div class="widget-content">
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="31"></span> <?=__('View lists menu')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="32"></span> <?=__('Create menu')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="33"></span> <?=__('Edit menu')?>
                            </div>
                            
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="34"></span> <?=__('Remove menu')?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="span3 pull-left">
                    <div class="widget stacked widget-table">
                        <div class="widget-header">
                            <span class="icon-group"></span>
                            <h3><?=__('Groups')?></h3>
                        </div>

                        <div class="widget-content">
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="41"></span> <?=__('View lists groups')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="42"></span> <?=__('Create groups')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="43"></span> <?=__('Edit groups')?>
                            </div>
                            
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="44"></span> <?=__('Remove groups')?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="span3 pull-left">
                    <div class="widget stacked widget-table">
                        <div class="widget-header">
                            <span class="icon-user"></span>
                            <h3><?=__('Users')?></h3>
                        </div>

                        <div class="widget-content">
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="51"></span> <?=__('View users lists')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="52"></span> <?=__('Create users')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="53"></span> <?=__('Edit users')?>
                            </div>
                            
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="54"></span> <?=__('Remove users')?>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="span3 pull-left">
                    <div class="widget stacked widget-table">
                        <div class="widget-header">
                            <span class="icon-user"></span>
                            <h3><?=__('Additional fields')?></h3>
                        </div>

                        <div class="widget-content">
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="121"></span> <?=__('View additional fields list')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="122"></span> <?=__('Create additional fields')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="123"></span> <?=__('Edit additional fields')?>
                            </div>
                            
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="124"></span> <?=__('Remove additional fields')?>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="span3 pull-left">
                    <div class="widget stacked widget-table">
                        <div class="widget-header">
                            <span class="icon-user"></span>
                            <h3><?=__('For users')?></h3>
                        </div>

                        <div class="widget-content">
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="61"></span> <?=__('View pages')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="62"></span> <?=__('Comment')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="63"></span> <?=__('Login')?>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="span3 pull-left">
                    <div class="widget stacked widget-table">
                        <div class="widget-header">
                            <span class="icon-user"></span>
                            <h3><?=__('Widgets')?></h3>
                        </div>

                        <div class="widget-content">
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="81"></span> <?=__('View widgets')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="82"></span> <?=__('Create widgets')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="83"></span> <?=__('Edit widgets')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="84"></span> <?=__('Remove widgets')?>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="span3 pull-left">
                    <div class="widget stacked widget-table">
                        <div class="widget-header">
                            <span class="icon-user"></span>
                            <h3><?=__('Modules')?></h3>
                        </div>

                        <div class="widget-content">
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="91"></span> <?=__('View modules')?>
                            </div>
                            
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="92"></span> <?=__('Install modules')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="93"></span> <?=__('Edit modules')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="94"></span> <?=__('Remove modules')?>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="span3 pull-left">
                    <div class="widget stacked widget-table">
                        <div class="widget-header">
                            <span class="icon-user"></span>
                            <h3><?=__('Languages')?></h3>
                        </div>

                        <div class="widget-content">
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="101"></span> <?=__('View languages')?>
                            </div>
                            
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="102"></span> <?=__('Create language')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="103"></span> <?=__('Edit languages')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="104"></span> <?=__('Remove language')?>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="span3 pull-left">
                    <div class="widget stacked widget-table">
                        <div class="widget-header">
                            <span class="icon-user"></span>
                            <h3><?=__('Comments')?></h3>
                        </div>

                        <div class="widget-content">
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="111"></span> <?=__('View comments')?>
                            </div>
                            
                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="112"></span> <?=__('Change comments status')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="113"></span> <?=__('Edit comments')?>
                            </div>

                            <div class="checkbox-row">
                                <span class="niceCheck"><input type="checkbox" name="access[]" value="114"></span> <?=__('Remove comments')?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?foreach ($mod_access as $module) {?>
                    <div class="span3 pull-left">
                        <div class="widget stacked widget-table">
                            <div class="widget-header">
                                <span class="icon-user"></span>
                                <h3><?=$module['title']?></h3>
                            </div>

                            <div class="widget-content">
                                <?foreach ($module['data'] as $rows) {?>
                                    <div class="checkbox-row">
                                        <span class="niceCheck"><input type="checkbox" name="access[]" value="<?=$rows['value']?>"></span> <?=$rows['title']?>
                                    </div>
                                <?}?>
                            </div>
                        </div>
                    </div>
                <?}?>
            </div>  
        </form>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>