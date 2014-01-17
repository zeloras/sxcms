<div class="main">
    <div class="container">
        <div class="row">

	    <div class="span3">	
                <div class="widget stacked">
                    <div class="widget-header">
                        <h3><?=__('Categories')?></h3>
                    </div>
                    <div class="widget-content">
                        <div class="nav nav-pills nav-stacked" id="sidebar">
                            <div><span class="simple_tree">↳</span><a href="javascript:;" data-value="0" data-type="category" class="sx_filter_lists"><?=__('Root')?></a></div>
                            <?=$sidebar_categories?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="span9">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Pages list')?></h3>
                        <span class="action_buttons">
                            <?if (in_array(12, $access_code)) {?>
                            <button class="btn btn-info pull-right pjax_button" data-href="/admin/pages/add" data-container="#base-container">
                                <i class="icon-plus-sign-alt icon-large"></i> <?=__('Create')?>
                            </button>
                            <?}?>
                            
                            <?if (in_array(14, $access_code)) {?>
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
                                    <?if (in_array(14, $access_code)) {?>
                                    <span class="niceCheck" id="sx_checkbox_general">
                                        <input type="checkbox" data-inputs=".checkbox_slected">
                                    </span>
                                    <?}?>
                                </th>
                                <th><a href="javascript:;" data-type="sortby" data-value="id:<?=$sortby?>" class="sx_filter_lists table_title"><?=__('ID')?></a></th>
                                <th><a href="javascript:;" data-type="sortby" data-value="title:<?=$sortby?>" class="sx_filter_lists table_title"><?=__('Title')?></a></th>
                                <th><a href="javascript:;" data-type="sortby" data-value="url:<?=$sortby?>" class="sx_filter_lists table_title"><?=__('URL')?></a></th>
                                <th><a href="javascript:;" data-type="sortby" data-value="category:<?=$sortby?>" class="sx_filter_lists table_title"><?=__('Category')?></a></th>
                                <th><a href="javascript:;" data-type="sortby" data-value="update:<?=$sortby?>" class="sx_filter_lists table_title"><?=__('Created')?></a></th>
                                <th><a href="javascript:;" data-type="sortby" data-value="status:<?=$sortby?>" class="sx_filter_lists table_title"><?=__('Status')?></a></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?foreach ($pages as $key => $page) {?>
                                  <tr>
                                    <td class="box-center">
                                        <?if (in_array(14, $access_code)) {?>
                                        <span class="niceCheck">
                                            <input type="checkbox" name="ids" value="<?=$page->id?>" class="checkbox_slected">
                                        </span>
                                        <?}?>
                                    </td>
                                    <td><?=$page->id?></td>
                                    <td>
                                        <?if (in_array(13, $access_code)) {?>
                                        <a href="/admin/pages/edit/<?=$page->id?>">
                                                <?=$page->title?>
                                        </a>
                                        <?}else{?>
                                            <?=$page->title?>
                                        <?}?>
                                    </td>
                                    <td class="show_hidden" data-class=".hidden_button">
                                        <?=$page->url?>
                                        <?if ($page->url != '/') {?>
                                            <a href="/<?=$category_info[$key]['full_url']?><?=$page->url?>" target="_blank" class="hidden_button pull-right btn btn-small" style="visibility: hidden;">
                                                <i class="icon-share-alt"></i>
                                            </a>
                                        <?} else {?>
                                            <a href="/" target="_blank" class="hidden_button pull-right btn btn-small" style="visibility: hidden;">
                                                <i class="icon-share-alt"></i>
                                            </a>
                                        <?}?>
                                    </td>
                                    <td>
                                        <?if ($category_info[$key]['id'] > 0) {?>
                                        <a href="/admin/categorys/<?=$category_info[$key]['id']?>">
                                            <?=$category_info[$key]['title']?>
                                        </a>
                                        <?}else{?>
                                            <?=$category_info[$key]['title']?>
                                        <?}?>
                                    </td>
                                    <td><?=date('d-m-y H:i', $page->date)?></td>
                                    <td>
                                        <select class="sx_change_status" data-type="page" data-id="<?=$page->id?>">
                                            <option value="1" <?if($page->status == 1){?>selected="selected"<?}?>><?=__('Published')?></option>
                                            <option value="2" <?if($page->status == 2){?>selected="selected"<?}?>><?=__('Peding')?></option>
                                            <option value="0" <?if($page->status == 0){?>selected="selected"<?}?>><?=__('Unpublished')?></option>
                                        </select>
                                    </td>
                                  </tr>
                                <?}?>
                            </tbody>
                      </table>
                        <div class="pagination"><?=$pagination?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal hide sx_remove_page" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal=".sx_remove_page">×</button>
    <h3><?=__('Remove pages')?></h3>
  </div>
  <div class="modal-body">
    <p><?=__('Do you really want to delete the selected pages?')?></p>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal=".sx_remove_page"><?=__("Cancel")?></a>
    <a href="javascript:;" class="btn btn-primary sx_modal_hide sx_remove_function" data-modal=".sx_remove_page" data-href="pages"><?=__('Delete')?></a>
  </div>
</div>