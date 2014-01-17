<?=@$parent_id?>
        <option <?if ($no_sel == $item['id']) {?>disabled="disabled"<?}?> value="<?=$item['id']?>"  <?if ($item['id'] == @$parent_id OR $item['id'] == @$sel_cat OR @in_array($item['id'], $sel_cat)) {?> selected="selected" <?}?>
        <?if ($item['id'] == @$id AND !$page_editing) {?> disabled="disabled" <?}?>
	>
        <?for ($i=0; $i < $item['level'];$i++) {?>-<?}?> <?=$item['title']?> <?=@$sel_id?>
	</option>