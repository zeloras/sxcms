<?if (!isset($no_properties)) {?>
    <?foreach ($properties as $prop) {?>
<div class="control-group">
    <label class="control-label" for="">
        <?=$prop['title']?>:
    </label>
    <div class="controls">
        <input type="text" name="prop[<?=$prop['id']?>][value]" value="<?=$prop['value']?>" id="prop_<?=$prop['id']?>">
        <input type="hidden" name="prop[<?=$prop['id']?>][category]" value="<?=$prop['category']?>">
        <input type="hidden" name="prop[<?=$prop['id']?>][id]" value="<?=$prop['id']?>">
    </div>
                                                    
</div>
    <?}?>
<?}else{?>
<div class="alert alert-info" style="margin-bottom: 18px; margin-top: 18px;">
  <?=__('No additional fields for the selected category')?>
</div>
<?}?>