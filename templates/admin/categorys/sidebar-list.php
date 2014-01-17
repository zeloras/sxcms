<div class="row-item-sidebar" >
    <div width="100%">
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
            <a href="javascript:;" data-value="<?=$item['id']?>" data-type="category" class="sx_filter_lists"><?=$item['title']?></a>
        </div>
    </div>
</div>