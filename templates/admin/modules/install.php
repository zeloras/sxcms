<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Modules install list')?></h3>
                    </div>

                    <div class="widget-content">
                        <?if (isset($success)) {?>
                            <div id="status_module_install">
                                <p id="status_success">showMessage('<?=__('Success install module')?>', '<?=__('Status module install')?>', 'success')</p>
                                <p id="url_success">/admin/modules/</p>
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
                        <div class="panel-module btn-group">
                            <a href="/admin/modules" class="btn"><?=__('All modules')?></a>
                            <a href="/admin/modules/install" class="btn active"><?=__('Install modules')?></a>
                        </div>
                        <table class="table table-bordered table-striped table-highlight">
                            <thead>
                              <tr>
                                <th><?=__('ID')?></th>
                                <th><?=__('Title')?></th>
                                <th><?=__('Version')?></th>
                                <th><?=__('Description')?></th>
                                <th><?=__('Author')?></th>
                                <th><?=__('Install')?></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?if($modules != false) {?>
                                <?foreach ($modules as $key => $mod) {?>
                                  <tr>
                                    <td><?=$key+1?></td>
                                    <td><?=$mod['name']?></td>
                                    <td><?=$mod['version']?></td>
                                    <td><?=$mod['description']?></td>
                                    <td><?=$mod['author']?>
                                        <?if ($mod['contacts'] != false){?>
                                        <a href="javascript://" rel="popover" class="sx_popover"
                                           data-original-title="<?=__('Author information')?>"
                                           data-content="
                                           <?foreach ($mod['contacts'] as $keyin => $inf) {?>
                                            <p><?=$keyin?>: <?=$inf?></p>
                                           <?}?>
                                           ">
                                            <span class="badge badge-info">
                                                <i class="icon-info-sign"></i>
                                            </span>
                                        </a>
                                        <?}?>
                                    </td>
                                    <td>
                                        <?if (in_array(92, $access_code)) {?>
                                        <a href="javascript:;" class="sx_module_install" data-module="<?=$mod['dir']?>">
                                            <?=__('Install')?>
                                        </a>
                                        <?}?>
                                    </td>
                                  </tr>
                                <?}?>
                                <?}else{?>
                                    <tr>
                                        <td><?=__('No modules to install')?></td>
                                    </tr>
                                <?}?>
                            </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal hide sx_remove_module" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal=".sx_remove_module">×</button>
    <h3><?=__('Remove module')?></h3>
  </div>
  <div class="modal-body">
    <p><?=__('Do you really want to delete the selected modules?')?></p>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal=".sx_remove_module"><?=__("Cancel")?></a>
    <a href="javascript:;" class="btn btn-primary sx_modal_hide sx_remove_function" data-modal=".sx_remove_module" data-href="module"><?=__('Delete')?></a>
  </div>
</div>