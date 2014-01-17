<ul class="breadcrumb">
    <li><a href="/">Главная</a> </li> 
        <?if (!isset($no_url) && isset($bread)) {?>
            <?foreach ($bread as $b) {?>
                <?if (strlen($b['title']) > 0) {?>
                    <li> <span class="divider">/</span><a href="<?if (!preg_match('@^\/@', $b['url'])) {?>/<?}?><?echo $b['url']?>"><?echo $b['title']?></a></li>
                <?}?>
            <?}?>
        <?}?>
</ul>