<?if (isset($is_parent)) {?>
<ul class="<?=$menu['items'][0]['menu_config']['parent_class']?>">
<?} else {?>
   <ul class="<?=$menu['items'][0]['menu_config']['class']?>">
<?}?>
<?php
	foreach ($menu['items'] as &$item):
		$classes = '';
                $icons = '';
		if (isset($item['classes']))
			$classes = ' class="'.join(' ', $item['classes']).'"';
		if (isset($item['icons']))
			$icons = ' class="'.join(' ', $item['icons']).'"';
?>
	<li <?=$classes?>>
	<?php
                if (strlen($item['url']) > 0)
                    echo HTML::anchor($item['url'], '<i '.$icons.'></i>'.$item['title']);
                else
                    echo $item['title'];
		if (isset($item['items']))
		{
			$items = array('items' => &$item['items']);
			echo View::factory('menu')->bind('menu', $items)->bind('is_parent', $item)->render();
		}
	?>
	</li>
<?php endforeach; ?>
<?if (isset($is_parent)) {?>
    </ul>
<?} else {?>
</ul>
<? } ?>
