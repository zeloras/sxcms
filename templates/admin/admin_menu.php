<div class="subnavbar">
    <div class="subnavbar-inner">
        <div class="container">
            <a class="btn-subnavbar collapsed" data-toggle="collapse" data-target=".subnav-collapse">
                <i class="icon-reorder"></i>
            </a>

            <div class="subnav-collapse collapse">
                <ul class="mainnav">	
                    <?foreach ($menus as $menu) {?>
                        <li class="<?=$menu['class']?>">
                            <a href="<?=$menu['url']?>" <?if (isset($menu['under'])) {?>class="dropdown-toggle" data-toggle="dropdown"<?}else{?>class="pjax"<?}?>>
                                <i class="<?=$menu['icon']?>"></i>
                                <span><?=$menu['title']?></span>
                                <b class="<?=$menu['caret']?>"></b>
                            </a>
                            <?if (isset($menu['under'])) {?>
                                <ul class="dropdown-menu">
                                    <?foreach ($menu['under'] as $under) {?>
                                        <li class="<?=$under['class']?>">
                                            <?if (strlen($under['url']) > 2) {?>
                                            <a href="<?=$under['url']?>" class="pjax"><?=$under['title']?></a>
                                            <?}?>
                                        </li> 
                                    <?}?>
                                    
                                    <?if (isset($menu['type']) && isset($menu_ext)) {?>
                                        <?foreach ($menu_ext[$menu['type']] as $mext) {?>
                                            <li>
                                                <a href="<?=$mext['url']?>"><?=$mext['title']?></a>
                                            </li>
                                        <?}?>
                                    <?}?>
                                </ul>
                            <?}?>
                        </li>
                    <?}?>	
                </ul>
            </div>
        </div>
    </div>
</div>