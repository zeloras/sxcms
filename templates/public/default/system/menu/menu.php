<?if (!isset($no_menu)) {?>
    <?if (!isset($no_links)) {?>
        <?=$links?>
    <?}else{?>
        <div>No links on menu</div>
    <?}?>
<?}else{?>
    <div>Menu couldn't load</div>
<?}?>

