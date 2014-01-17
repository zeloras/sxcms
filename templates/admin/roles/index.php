<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Roles list')?></h3>
                        <span class="action_buttons">
                            <?if (in_array(42, $access_code)) {?>
                            <button class="btn btn-info pull-right pjax_button" data-href="/admin/roles/add" data-container="#base-container">
                                <i class="icon-plus-sign-alt icon-large"></i> <?=__('Create')?>
                            </button>
                            <?}?>
                            
                            <?if (in_array(44, $access_code)) {?>
                            <button class="btn btn-danger pull-right sx_modal_show" data-modal=".sx_remove_role">
                                <i class="icon-trash icon-large"></i> <?=__('Delete')?>
                            </button>
                            <?}?>
                        </span>
                    </div>

                    <div class="widget-content">
                        <table class="table table-bordered table-striped table-highlight">
                            <thead>
                              <tr>
                                <th class="box-center">
                                    <?if (in_array(44, $access_code)) {?>
                                    <span class="niceCheck" id="sx_checkbox_general">
                                        <input type="checkbox" data-inputs=".checkbox_slected">
                                    </span>
                                    <?}?>
                                </th>
                                <th><?=__('ID')?></th>
                                <th><?=__('Title')?></th>
                                <th><?=__('Name')?></th>
                                <th><?=__('Description')?></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?foreach ($roles as $key => $role) {?>
                                  <tr>
                                    <td class="box-center">
                                        <?if (in_array(44, $access_code)) {?>
                                        <span class="niceCheck">
                                            <input type="checkbox" name="ids" value="<?=$role->id?>" class="checkbox_slected">
                                        </span>
                                        <?}?>
                                    </td>
                                    <td><?=$role->id?></td>
                                    <td>
                                        <?if (in_array(43, $access_code)) {?>
                                        <a href="/admin/roles/edit/<?=$role->id?>">
                                                <?=$role->title?>
                                        </a>
                                        <?}else{?>
                                            <?=$role->title?>
                                        <?}?>
                                    </td>
                                    <td>
                                        <?=$role->name?>
                                    </td>
                                    <td><?=$role->description?></td>
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
<div class="modal hide sx_remove_role" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal=".sx_remove_role">×</button>
    <h3><?=__('Remove roles')?></h3>
  </div>
  <div class="modal-body">
    <p><?=__('Do you really want to delete the selected roles?')?></p>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal=".sx_remove_role"><?=__("Cancel")?></a>
    <a href="javascript:;" class="btn btn-primary sx_modal_hide sx_remove_function" data-modal=".sx_remove_role" data-href="roles"><?=__('Delete')?></a>
  </div>
</div>