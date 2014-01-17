<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Link list')?></h3>
                        <span class="action_buttons">
                            <?if (in_array(32, $access_code)) {?>
                            <button class="btn btn-info pull-right pjax_button" data-href="/admin/menus_data/add/<?=$menu_id?>" data-container="#base-container">
                                <i class="icon-plus-sign-alt icon-large"></i> <?=__('Create')?>
                            </button>
                            <?}?>
                            
                            <?if (in_array(34, $access_code)) {?>
                            <button class="btn btn-danger pull-right sx_modal_show" data-modal=".sx_remove_data_menu">
                                <i class="icon-trash icon-large"></i> <?=__('Delete')?>
                            </button>
                            <?}?>
                            <button data-href="/admin/menus" data-container="#base-container" class="btn pull-right btn-info pjax_button">
                                <i class="icon-arrow-left"></i> <?=__('Back')?>
                            </button>
                        </span>
                    </div>

                    <div class="widget-content">
                        <div class="frame_table">
                            <div id="links">
                                <div class="row-links head">
                                    <div class="t-a_c">
                                        <?if (in_array(34, $access_code)) {?>
                                        <span class="niceCheck" id="sx_checkbox_general">
                                            <input type="checkbox" data-inputs=".checkbox_slected">
                                        </span>
                                        <?}?>
                                    </div>
                                    <div><?=__('ID')?></div>
                                    <div><?=__('Title')?></div>
                                    <div><?=__('Visible')?></div>
                                    <div><?=__('Created')?></div>
                                </div>
                                <div class="body_links">
                                    <div class="frame_level sx_sort_table sx_save_positions" data-sort-class=".row-links" data-sort-type="ondiv" data-type="menu_links">
                                        <?if ($links) {?>
                                            <?=$links?>
                                        <?} else {?>
                                            <div class="alert alert-info">
                                                <?=__('No links')?>
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
<div class="modal hide sx_remove_data_menu" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal=".sx_remove_data_menu">×</button>
    <h3><?=__('Remove links')?></h3>
  </div>
  <div class="modal-body">
    <p><?=__('Do you really want to delete the selected links?')?></p>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal=".sx_remove_data_menu"><?=__("Cancel")?></a>
    <a href="javascript:;" class="btn btn-primary sx_modal_hide sx_remove_function" data-modal=".sx_remove_data_menu" data-href="menu_data"><?=__('Delete')?></a>
  </div>
</div>