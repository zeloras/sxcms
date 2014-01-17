<div class="main">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Users list')?></h3>
                        <span class="action_buttons">
                            <?if (in_array(52, $access_code)) {?>
                            <button class="btn btn-info pull-right pjax_button" data-href="/admin/users/add" data-container="#base-container">
                                <i class="icon-plus-sign-alt icon-large"></i> <?=__('Create')?>
                            </button>
                            <?}?>
                            
                            <?if (in_array(54, $access_code)) {?>
                            <button class="btn btn-danger pull-right sx_modal_show" data-modal=".sx_remove_user">
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
                                    <?if (in_array(54, $access_code)) {?>
                                    <span class="niceCheck" id="sx_checkbox_general">
                                        <input type="checkbox" data-inputs=".checkbox_slected">
                                    </span>
                                    <?}?>
                                </th>
                                <th><a href="javascript:;" data-type="sortby" data-value="id:<?=$sortby?>" class="sx_filter_lists table_title"><?=__('ID')?></a></th>
                                <th><a href="javascript:;" data-type="sortby" data-value="username:<?=$sortby?>" class="sx_filter_lists table_title"><?=__('Username')?></a></th>
                                <th><a href="javascript:;" data-type="sortby" data-value="email:<?=$sortby?>" class="sx_filter_lists table_title"><?=__('Email')?></a></th>
                                <th><?=__('Role')?></th>
                                <th><a href="javascript:;" data-type="sortby" data-value="last_login:<?=$sortby?>" class="sx_filter_lists table_title"><?=__('Last login')?></a></th>
                              </tr>
                            </thead>
                            <tbody>
                                <?foreach ($users as $key => $user) {?>
                                  <tr>
                                    <td class="box-center">
                                        <?if (in_array(54, $access_code)) {?>
                                        <span class="niceCheck">
                                            <input type="checkbox" name="ids" value="<?=$user->id?>" class="checkbox_slected">
                                        </span>
                                        <?}?>
                                    </td>
                                    <td><?=$user->id?></td>
                                    <td>
                                        <?if (in_array(53, $access_code)) {?>
                                            <a href="/admin/users/edit/<?=$user->id?>">
                                                    <?=$user->username?>
                                            </a>
                                        <?}else{?>
                                            <?=$user->username?>
                                        <?}?>
                                    </td>
                                    <td class="show_hidden" data-class=".hidden_button">
                                        <?=$user->email?>
                                    </td>
                                    <td>
                                        <?if (in_array(43, $access_code)) {?>
                                            <a href="/admin/roles/edit/<?=$users_roles[$user->id]['id']?>"><?=$users_roles[$user->id]['title']?></a>
                                        <?}else{?>
                                            <?=$users_roles[$user->id]['title']?>
                                        <?}?>
                                    </td>
                                    <td><?=date('d-m-y H:i', $user->last_login)?></td>
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
<div class="modal hide sx_remove_user" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal=".sx_remove_page">×</button>
    <h3><?=__('Remove users')?></h3>
  </div>
  <div class="modal-body">
    <p><?=__('Do you really want to delete the selected users?')?></p>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal=".sx_remove_user"><?=__("Cancel")?></a>
    <a href="javascript:;" class="btn btn-primary sx_modal_hide sx_remove_function" data-modal=".sx_remove_user" data-href="users"><?=__('Delete')?></a>
  </div>
</div>