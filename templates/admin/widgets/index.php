<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Widget list')?></h3>
                        <span class="action_buttons">
                            <?if (in_array(82, $access_code)) {?>
                            <button class="btn btn-info pull-right pjax_button" data-href="/admin/widgets/add" data-container="#base-container">
                                <i class="icon-plus-sign-alt icon-large"></i> <?=__('Create')?>
                            </button>
                            <?}?>
                            
                            <?if (in_array(84, $access_code)) {?>
                            <button class="btn btn-danger pull-right sx_modal_show" data-modal=".sx_remove_widgets">
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
                                    <?if (in_array(84, $access_code)) {?>
                                    <span class="niceCheck" id="sx_checkbox_general">
                                        <input type="checkbox" data-inputs=".checkbox_slected">
                                    </span>
                                    <?}?>
                                </th>
                                <th><?=__('ID')?></th>
                                <th><?=__('Title')?></th>
                                <th><?=__('Name')?></th>
                                <th><?=__('Description')?></th>
                                <th><?=__('Active')?></th>
                                <th><?=__('Date')?></th>
                              </tr>
                            </thead>
                            <tbody  class="sx_sort_table sx_save_positions" data-type="widgets">
                                <?foreach ($widgets as $key => $widget) {?>
                                  <tr>
                                    <td class="box-center">
                                        <?if (in_array(84, $access_code)) {?>
                                        <span class="niceCheck">
                                            <input type="checkbox" name="ids" value="<?=$widget->id?>" class="checkbox_slected">
                                        </span>
                                        <?}?>
                                    </td>
                                    <td><?=$widget->id?></td>
                                    <td>
                                        <?if (in_array(43, $access_code)) {?>
                                        <a href="/admin/widgets/edit/<?=$widget->id?>">
                                                <?=$widget->title?>
                                        </a>
                                        <?}else{?>
                                            <?=$widget->title?>
                                        <?}?>
                                    </td>
                                    <td>
                                        <?=$widget->name?>
                                    </td>
                                    <td><?=$widget->description?></td>
                                    <td>
                                        <div class="make-switch switch-mini sx_change_active" data-on-label="<?=__('ON')?>" data-off-label="<?=__('OFF')?>" data-type="widgets" data-id="<?=$widget->id?>">
                                            <input type="checkbox" <?if ($widget->active == 1) {?>checked<?}?>>
                                        </div>
                                    </td>
                                    <td>
                                        <?=date('d-m-Y H:i', $widget->date)?>
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
<div class="modal hide sx_remove_widgets" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal=".sx_remove_widgets">×</button>
    <h3><?=__('Remove widget')?></h3>
  </div>
  <div class="modal-body">
    <p><?=__('Do you really want to delete the selected widgets?')?></p>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal=".sx_remove_widgets"><?=__("Cancel")?></a>
    <a href="javascript:;" class="btn btn-primary sx_modal_hide sx_remove_function" data-modal=".sx_remove_widgets" data-href="widgets"><?=__('Delete')?></a>
  </div>
</div>