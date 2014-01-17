<? if (isset($url_translit)) {?>
<div id="translit_text">
<?=$text?>
</div>
<?}?>

<? if (isset($save_positions)) {?>
<div id="save_position_status_block">
    <div id="position_status"><? if(isset($no_type) || isset($no_ids)) {?>error<?}else{?>success<?}?></div>
    <div id="position_text">
        <? if (isset($no_ids)) {?><?=__('You not select items to sort')?><?}?>
        <? if (isset($no_type)) {?><?=__('Dont select type sort')?><?}?>
        <? if (!isset($no_ids) && !isset($no_ids)) {?><?=__('Items success sorted')?><?}?>
    </div>
</div>
<?}?>

<? if (isset($updated)) {?>
<div id="status_delete_block">
    <div id="delete_status">success</div>
    <div id="delete_text"><?=__('Done!')?></div>
</div>
<?}?>
    
<? if (isset($delete)) {?>
<div id="status_delete_block">
    <div id="delete_status">success</div>
    <div id="delete_text"><?=__('Done!')?></div>
</div>
<?}?>
  
<? if (isset($no_ids)) {?>
<div id="status_delete_block">
    <div id="delete_status">error</div>
    <div id="delete_text"><?=__('Nothing to remove!')?></div>
</div>
<?}?>

<?if (isset($getcats)) {?>
    <select id="select-category">
        <option value="0"><?=__("select")?></option>
        <?=$catTreeHTML?>
    </select>
<?}?>

<?if (isset($getpages)) {?>
    <select id="select-page">
        <?foreach ($pages as $page) {?>
            <option value="<?=$page['url']?>"><?=$page['title']?></option>
        <?}?>
    </select>
<?}?>

<?if (isset($getsystem)) {?>
    <select id="select-system">
        <option value="/"><?=__('home')?></option>
        <option value="/category"><?=__('categories')?></option>
    </select>
<?}?>

<?if (isset($cloud_check)) {?>
<!-- START проверка коннекта облака -->
<div id="status_block_connect">
    showMessage('<?=__($result['text'])?>', '<?=__('Cloud connection status')?>', <?if ($result['type']) {?>'success'<?}else{?>'error'<?}?>)
</div>
<!-- END проверка коннекта облака -->
<?}?>

<?if (isset($ftp_check)) {?>
<!-- START проверка коннекта FTP -->
<div id="status_block_connect">
    showMessage('<?=__($result['text'])?>', '<?=__('FTP connection status')?>', <?if ($result['type']) {?>'success'<?}else{?>'error'<?}?>)
</div>
<!-- END проверка коннекта FTP -->
<?}?>



<?if (isset($delete_backup_ftp)) {?>
<!-- START удаление с FTP -->
<div id="status_block_delete">
    showMessage('<?=__($result['text'])?>', '<?=__('FTP remove status')?>', <?if ($result['type']) {?>'success'<?}else{?>'error'<?}?>)
</div>
<!-- END проверка коннекта облака -->
<?}?>

<?if (isset($save_backup_ftp)) {?>
<!-- START удаление с FTP -->
<div id="status_block_save">
    showMessage('<?=__($result['text'])?>', '<?=__('FTP save status')?>', <?if ($result['type']) {?>'success'<?}else{?>'error'<?}?>)
</div>
<!-- END сохранение на FTP -->
<?}?>


<?if (isset($delete_backup_cloud)) {?>
<!-- START удаление с Cloud -->
<div id="status_block_delete">
    showMessage('<?=__($result['text'])?>', '<?=__('Cloud remove status')?>', <?if ($result['type']) {?>'success'<?}else{?>'error'<?}?>)
</div>
<!-- END проверка коннекта Cloud -->
<?}?>

<?if (isset($save_backup_cloud)) {?>
<!-- START удаление с Cloud -->
<div id="status_block_save">
    showMessage('<?=__($result['text'])?>', '<?=__('Cloud save status')?>', <?if ($result['type']) {?>'success'<?}else{?>'error'<?}?>)
</div>
<!-- END сохранение на Cloud -->
<?}?>


<?if (isset($change_active)) {?>
<!-- START Смена статуса активности -->
<div id="change_status_active">
    <?if (!isset($no_item)) {?>
        showMessage('<?=__('Done!')?>', '<?=__('Change active status')?>', 'success');
    <?}else{?>
        showMessage('<?=__('Element not be found')?>', '<?=__('Change active status')?>', 'error');
    <?}?>
</div>
<!-- END Смена статуса активности -->
<?}?>

<?if (isset($generate_keywords)) {?>
<!--START генерация ключевых слов-->
<div id="keywords_gen">
    <?foreach ($keywords as $ks) {?>
    <a href="javascript:;" class="sx_put_keyword" data-put="<?=$put_input?>"><?=$ks?></a> &nbsp; 
    <?}?>
</div>
<!--END генерация ключевых слов-->
<?}?>


<?if (isset($additional_block)) {?>
<!--START Блок с доп.полями-->
<div id="additional_fields_html_block">
    <?=$html?>
</div>
<!--END Блок с доп.полями-->
<?}?>