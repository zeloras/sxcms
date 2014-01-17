<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Menu list')?></h3>
                        <span class="action_buttons">
                            <?if (in_array(32, $access_code)) {?>
                            <button class="btn btn-info pull-right pjax_button" data-href="/admin/menus/add" data-container="#base-container">
                                <i class="icon-plus-sign-alt icon-large"></i> <?=__('Create')?>
                            </button>
                            <?}?>
                            
                            <?if (in_array(34, $access_code)) {?>
                            <button class="btn btn-danger pull-right sx_modal_show" data-modal=".sx_remove_menu">
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
                                    <?if (in_array(34, $access_code)) {?>
                                    <span class="niceCheck" id="sx_checkbox_general">
                                        <input type="checkbox" data-inputs=".checkbox_slected">
                                    </span>
                                    <?}?>
                                </th>
                                <th><?=__('ID')?></th>
                                <th><?=__('Title')?></th>
                                <th><?=__('Name')?></th>
                                <th><?=__('Links')?></th>
                                <th><?=__('Created')?></th>
                                <th><?=__('Edit')?></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?foreach ($menus as $key => $menu) {?>
                                  <tr>
                                    <td class="box-center">
                                        <?if (in_array(34, $access_code)) {?>
                                        <span class="niceCheck">
                                            <input type="checkbox" name="ids" value="<?=$menu->id?>" class="checkbox_slected">
                                        </span>
                                        <?}?>
                                    </td>
                                    <td><?=$menu->id?></td>
                                    <td><a href="/admin/menus_data/<?=$menu->id?>"><?=$menu->title?></a></td>
                                    <td><?=$menu->name?></td>
                                    <td><a href="/admin/menus_data/<?=$menu->id?>"><?=$count_links[$menu->id]?></a></td>
                                    <td><?=date('d.m.y H:i', $menu->update)?></td>
                                    <td>
                                        <?if (in_array(33, $access_code)) {?>
                                        <a href="/admin/menus/edit/<?=$menu->id?>">
                                            <?=__('Edit')?>
                                        </a>
                                        <?}?>
                                    </td>
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
<div class="modal hide sx_remove_menu" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal=".sx_remove_menu">×</button>
    <h3><?=__('Remove menu')?></h3>
  </div>
  <div class="modal-body">
    <p><?=__('Do you really want to delete the selected item?
        <br />Along with these menus will also be removed and placed in ni links.')?></p>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal=".sx_remove_menu"><?=__("Cancel")?></a>
    <a href="javascript:;" class="btn btn-primary sx_modal_hide sx_remove_function" data-modal=".sx_remove_menu" data-href="menu"><?=__('Delete')?></a>
  </div>
</div>