<div class="row-category" >
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
                
            <?if (in_array(23, $access_code)) {?>
            <a href="/admin/categorys/edit/<?=$item['id']?>">
                    <?=$item['title']?>
            </a>
            <?}else{?>
                <?=$item['title']?>
            <?}?>
        </div>
    </div>
    
    <div class="show_hidden" data-class=".hidden_button">
        <?=$item['path_url']?>
        <?if ($item['path_url'] != '/') {?>
            <a href="/<?=$item['path_url']?>" target="_blank" class="hidden_button pull-right btn btn-small" style="visibility: hidden;">
                <i class="icon-share-alt"></i>
            </a>
        <?} else {?>
            <a href="/" target="_blank" class="hidden_button pull-right btn btn-small" style="visibility: hidden;">
                <i class="icon-share-alt"></i>
            </a>
        <?}?>
    </div>
    
    <div>
        <p><?=date('d-m-y H:i', $item['update'])?></p>
    </div>
</div>