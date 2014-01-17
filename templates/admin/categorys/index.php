<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Categorys list')?></h3>
                        <span class="action_buttons">
                            <?if (in_array(22, $access_code)) {?>
                            <button class="btn btn-info pull-right pjax_button" data-href="/admin/categorys/add" data-container="#base-container">
                                <i class="icon-plus-sign-alt icon-large"></i> <?=__('Create')?>
                            </button>
                            <?}?>
                            <?if (in_array(24, $access_code)) {?>
                            <button class="btn btn-danger pull-right sx_modal_show" data-modal=".sx_remove_category">
                                <i class="icon-trash icon-large"></i> <?=__('Delete')?>
                            </button>
                            <?}?>
                        </span>
                    </div>

                    <div class="widget-content">
                        <div class="frame_table">
                            <div id="category">
                                <div class="row-category head">
                                    <div class="t-a_c">
                                        <?if (in_array(24, $access_code)) {?>
                                        <span class="frame_label">
                                            <span class="niceCheck" id="sx_checkbox_general">
                                                <input type="checkbox" data-inputs=".checkbox_slected"/>
                                            </span>
                                        </span>
                                        <?}?>
                                    </div>
                                    <div><?=__('ID')?></div>
                                    <div><?=__('Title')?></div>
                                    <div><?=__('URL')?></div>
                                    <div><?=__('Edit')?></div>
                                </div>
                                <div class="body_category frame_level">
                                    <div class="sx_sort_table sx_save_positions"  data-sort-class=".row-category" data-sort-type="ondiv" data-type="categories">
                                        <?if ($categorys) {?>
                                            <?=$categorys?>
                                        <?} else {?>
                                            <div class="alert alert-info">
                                                <?=__('No categories')?>
                                            </div>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal hide sx_remove_category" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal=".sx_remove_category">×</button>
    <h3><?=__('Remove categorys')?></h3>
  </div>
  <div class="modal-body">
    <p><?=__('Do you really want to delete the selected categorys?')?></p>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal=".sx_remove_category"><?=__("Cancel")?></a>
    <a href="javascript:;" class="btn btn-primary sx_modal_hide sx_remove_function" data-modal=".sx_remove_category" data-href="category"><?=__('Delete')?></a>
  </div>
</div>