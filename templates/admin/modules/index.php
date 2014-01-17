<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Modules list')?></h3>
                        <span class="action_buttons">
                            
                            <?if (in_array(94, $access_code)) {?>
                            <button class="btn btn-danger pull-right sx_modal_show" data-modal=".sx_remove_module">
                                <i class="icon-trash icon-large"></i> <?=__('Delete')?>
                            </button>
                            <?}?>
                        </span>
                    </div>

                    <div class="widget-content">
                        <div class="panel-module btn-group">
                            <a href="/admin/modules" class="btn active"><?=__('All modules')?></a>
                            <a href="/admin/modules/install" class="btn"><?=__('Install modules')?></a>
                        </div>
                        <table class="table table-bordered table-striped table-highlight">
                            <thead>
                              <tr>
                                <th class="box-center">
                                    <?if (in_array(94, $access_code)) {?>
                                    <span class="niceCheck" id="sx_checkbox_general">
                                        <input type="checkbox" data-inputs=".checkbox_slected">
                                    </span>
                                    <?}?>
                                </th>
                                <th><?=__('ID')?></th>
                                <th><?=__('Title')?></th>
                                <th><?=__('Available at')?></th>
                                <th><?=__('Active')?></th>
                                <th><?=__('On site')?></th>
                                <th><?=__('In menu')?></th>
                                <th><?=__('Created')?></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?foreach ($modules as $key => $mod) {?>
                                  <tr>
                                    <td class="box-center">
                                        <?if (in_array(94, $access_code)) {?>
                                        <span class="niceCheck">
                                            <input type="checkbox" name="ids" value="<?=$mod->id?>" class="checkbox_slected">
                                        </span>
                                        <?}?>
                                    </td>
                                    <td><?=$mod->id?></td>
                                    <td><?if ($ifdir[$key]) {?><a href="/admin/<?=$mod->dir?>"><?=$mod->name?></a><?}else{?><?=$mod->name?><?}?></td>
                                    <td><?if ($onsite[$key]) {?><a href="<?=$sitename?><?=$mod->dir?>"><?=$sitename?><?=$mod->dir?></a><?}else{?>-<?}?></td>
                                    <td>
                                        <div class="make-switch switch-mini sx_change_active" data-on-label="<?=__('ON')?>" data-off-label="<?=__('OFF')?>" data-type="modules_active" data-id="<?=$mod->id?>">
                                            <input type="checkbox" <?if ($mod->active == 1) {?>checked<?}?>>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="make-switch switch-mini sx_change_active" data-on-label="<?=__('ON')?>" data-off-label="<?=__('OFF')?>" data-type="modules_site" data-id="<?=$mod->id?>">
                                            <input type="checkbox" <?if ($mod->site == 1) {?>checked<?}?>>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="make-switch switch-mini sx_change_active" data-on-label="<?=__('ON')?>" data-off-label="<?=__('OFF')?>" data-type="modules_menu" data-id="<?=$mod->id?>">
                                            <input type="checkbox" <?if ($mod->menu == 1) {?>checked<?}?>>
                                        </div>
                                    </td>
                                    <td><?=date('d.m.y H:i', $mod->date)?></td>
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
    <a href="javascript:;" class="btn btn-primary sx_modal_hide sx_remove_function" data-modal=".sx_remove_module" data-href="modules"><?=__('Delete')?></a>
  </div>
</div>