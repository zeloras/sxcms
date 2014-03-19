<div class="main">
    <div class="container">
        <div class="row">
            <div class="span9">
                <div class="widget stacked">	
                    <div class="widget-header">
                        <i class="icon-file"></i>
                        <h3><?=__('Home page')?></h3>
                        <span class="action_buttons">
                            <?if (in_array(12, $access_code)) {?>
                            <a href="/admin/pages/add" class="btn btn-info pull-right">
                                <i class="icon-plus-sign-alt icon-large"></i> <?=__('Create page')?>
                            </a>
                            <?}?>
                            
                            <?if (in_array(22, $access_code)) {?>
                            <a href="/admin/categorys/add" class="btn btn-info pull-right">
                                <i class="icon-plus-sign-alt"></i> <?=__('Create category')?>
                            </a>
                            <?}?>
                        </span>
                    </div>

                    <div class="widget-content">
                        <h3><?=__('Last pages')?></h3>
                        <table class="table table-bordered table-striped table-highlight">
                            <thead>
                                <tr>
                                    <th><?=__('Title')?></th>
                                    <th><?=__('Category')?></th>
                                    <th><?=__('URL')?></th>
                                    <th><?=__('Date')?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?foreach ($pages as $key => $pg) {?>
                                    <tr>
                                        <td><a href="/admin/pages/edit/<?=$pg->id?>"><?=$pg->title?></a></td>
                                        <td><?if ($pg->category > 0) {?><a href="/admin/categorys/edit/<?=$pg->category?>"><?=$category[$key]['title']?></a><?}else{?><?=$category[$key]['title']?><?}?></td>
                                        <td><a href="<?=URL::base(true).$pg->cat_url.$pg->url?>" target="_blank"><?=URL::base(true).$pg->cat_url.$pg->url?></a></td>
                                        <td><?=date('d-m-Y H:i', $pg->update)?></td>
                                    </tr>
                                <?}?>
                            </tbody>
                        </table>
                    </div>	
                </div>
            </div>
            <div class="span3">
                <table class="table table-bordered table-highlight">
                    <thead>
                        <th colspan="2"><?=__('Stat')?></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=__('Pages')?></td>
                            <td><?=$count_pages?></td>
                        </tr>
                        <tr>
                            <td><?=__('Categories')?></td>
                            <td><?=$count_categorys?></td>
                        </tr>
                        <tr>
                            <td><?=__('Modules')?></td>
                            <td><?=$count_modules?></td>
                        </tr>
                        <tr>
                            <td><?=__('Widgets')?></td>
                            <td><?=$count_widgets?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="span3">
                <table class="table table-bordered table-striped table-highlight">
                    <thead>
                        <th colspan="2"><?=__('System information')?></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=__('Version')?></td>
                            <td><?=$sysinfo['current_version']?></td>
                        </tr>
                        <tr>
                            <td><?=__('Last version')?></td>
                            <td><?=$sysinfo['last_version']?><?if ($sysinfo['current_version'] !== $sysinfo['last_version']) {?> <a href="javascript:void(0);" class="sx_modal_show" data-modal="#update_current_version">(<?=__('Update')?>)</a><?}?></td>
                        </tr>
                        <tr>
                            <td><?=__('Last update')?></td>
                            <td><?=date('d-m-Y H:i', $sysinfo['last_update'])?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="center">
                                <a href="<?=$sysinfo['documentation_url']?>" target="_blank"><?=__('Documentation')?></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="update_current_version" class="modal hide" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close sx_modal_hide" data-modal="#update_current_version">×</button>
    <h3><?=__('Update CMS to last version')?></h3>
  </div>
  <div class="modal-body">
      <p><?=__('Currently, the auto-refresh function of the system is not implemented, all the latest updates you can visit our website')?>: <a href="<?=$sysinfo['developer_site']?>" target="_blank" style="font-weight: bold;"><?=$sysinfo['developer_site']?></p>
  </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn sx_modal_hide" data-modal="#update_current_version"><?=__("Cancel")?></a>
    <!--<a href="javascript:;" class="btn btn-primary sx_modal_hide" data-modal="#update_current_version"><?=__('Update')?></a>-->
  </div>
</div>