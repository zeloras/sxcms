<?echo $breadcrumbs;?>
<div class="center">
    <ul>
        <?if (sizeof($cats) > 0) {?>
            <li style="list-style: none;"><?=__('Categories')?></li>
            <?foreach ($cats as $ct) {?>
                <li>
                    <a href="/<?echo Helper_Common::get_category_path($ct->id);?>"><?echo $ct->title;?></a>
                </li>
            <?}?>
        <?}else{?>
            <li><?=__('No categories')?></li>     
        <?}?>
    </ul>
    <hr />
    <ul>
        <?if (sizeof($pages) > 0) {?>
            <li style="list-style: none;"><?=__('Pages')?></li>
            <?foreach ($pages as $pg) {?>
                <li>
                    <a href="<?echo $pg->cat_url.$pg->url;?>"><?echo $pg->title;?></a>
                </li>
            <?}?>
        <?}else{?>
            <li><?__('No pages on this category')?></li>
        <?}?>
    </ul>
</div>