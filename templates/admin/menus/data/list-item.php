<div class="row-links" >
    <div class="t-a_c">
        <?if (in_array(24, $access_code)) {?>
        <span class="frame_label">
            <span class="niceCheck">
                <input type="checkbox" name="ids" value="<?=$item['id']?>" class="checkbox_slected"/>
            </span>
        </span>
        <?}?>
    </div>
    
    <div><p><?=$item['id']?></p></div>
    
    <div>
        <div class="title <?if ($item['parent_id'] > 0) {?> lev <?}?>">
            <?if (isset($item['subtree'])) {?>
                <button type="button" class="btn btn-small my_btn_s" style="display: none;">
                    <i class="my_icon icon-minus"></i>
                </button>
                <button type="button" class="btn btn-small my_btn_s btn-primary">
                    <i class="my_icon icon-plus"></i>
                </button>
            <?}else{?>
                <span class="simple_tree">↳</span>
            <?}?>
                
            <?if (in_array(33, $access_code)) {?>
            <a href="/admin/menus_data/edit/<?=$item['menu_id']?>/<?=$item['id']?>">
                    <?=$item['title']?>
            </a>
            <?}else{?>
                <?=$item['title']?>
            <?}?>
        </div>
    </div>
    
    <div class="show_hidden" data-class=".hidden_button">
        <div class="make-switch switch-mini sx_change_active" data-on-label="<?=__('ON')?>" data-off-label="<?=__('OFF')?>" data-type="menu-data" data-id="<?=$item['id']?>">
            <input type="checkbox" <?if ($item['hidden'] == 0) {?>checked<?}?>>
        </div>
    </div>
    
    <div>
        <p><?=date('d-m-y H:i', $item['update'])?></p>
    </div>
</div>