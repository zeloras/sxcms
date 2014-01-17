<div class="main">
    <div class="container">
        <div class="row">
            
            <div class="span12">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Additional fields')?></h3>
                        <span class="action_buttons">
                            <?if (in_array(122, $access_code)) {?>
                            <button class="btn btn-info pull-right pjax_button" data-href="/admin/additional_fields/add" data-container="#base-container">
                                <i class="icon-plus-sign-alt icon-large"></i> <?=__('Create')?>
                            </button>
                            <?}?>
                            
                            <?if (in_array(124, $access_code)) {?>
                            <button class="btn btn-danger pull-right sx_modal_show" data-modal=".sx_remove_page">
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
                                    <?if (in_array(124, $access_code)) {?>
                                    <span class="niceCheck" id="sx_checkbox_general">
                                        <input type="checkbox" data-inputs=".checkbox_slected">
                                    </span>
                                    <?}?>
                                </th>
                                <th><?=__('ID')?></th>
                                <th><?=__('Title')?></th>
                                <th><?=__('CSV Name')?></th>
                                <th><?=__('Status')?></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?if (!isset($no_properties)) {?>
                                    <?foreach ($properties as $prop) {?>
                                        <tr>
                                            <td class="box-center">
                                                <span class="niceCheck">
                                                    <input type="checkbox" name="ids" class="checkbox_slected" value="<?=$prop->id?>">
                                                </span>
                                            </td>
                                            <td><?=$prop->id?></td>
                                            <td>
                                                <?if (in_array(123, $access_code)) {?>
                                                    <a href="/admin/additional_fields/edit/<?=$prop->id?>"><?=$prop->title?></a>
                                                <?}else{?>
                                                    <?=$prop->title?>
                                                <?}?>
                                            </td>
                                            <td><?=$prop->csv?></td>
                                            <td>
                                                <div class="make-switch switch-mini sx_change_active" data-on-label="<?=__('ON')?>" data-off-label="<?=__('OFF')?>" data-type="fields" data-id="<?=$prop->id?>">
                                                    <input type="checkbox" <?if ($prop->active == 1) {?>checked<?}?>>
                                                </div>
                                            </td>
                                        </tr>
                                    <?}?>
                                <?}else{?>
                                    <tr>
                                        <td colspan="5"><?=__('No additional fields')?></td>
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
<div class="modal hide sx_remove_fields" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal=".sx_remove_fields">×</button>
    <h3><?=__('Remove additional field')?></h3>
  </div>
  <div class="modal-body">
    <p><?=__('Do you really want to delete the selected additional fields?')?></p>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal=".sx_remove_fields"><?=__("Cancel")?></a>
    <a href="javascript:;" class="btn btn-primary sx_modal_hide sx_remove_function" data-modal=".sx_remove_fields" data-href="fields"><?=__('Delete')?></a>
  </div>
</div>