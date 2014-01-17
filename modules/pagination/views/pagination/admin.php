<ul class="pagination">

	<?if ($first_page !== FALSE):?>
            <li>
		<a href="<?=HTML::chars($page->url($first_page))?>" class="pjax_button" data-container="#base-container">
                    <?=__('First')?>
                </a>
            </li>
	<?else:?>
            <li class="disabled">
		<a href="javascript:;">
                    <?=__('First')?>
                </a>
            </li>
	<?endif?>

	<?if ($previous_page !== FALSE):?>
            <li>
		<a href="<?=HTML::chars($page->url($previous_page))?>" class="pjax_button" data-container="#base-container">
                    <?=__('Previous')?>
                </a>
            </li>
	<?else:?>
            <li class="disabled">
                <a href="javascript:;">
                    <?=__('Previous')?>
                </a>
            </li>
	<?endif?>

	<?for ($i = 1; $i <= $total_pages; $i++):?>

		<?if ($i == $current_page):?>
                    <li class="active">
			<a href="javascript:;">
                            <?=$i?>
                        </a>
                    </li>
		<?else:?>
                    <li>
			<a href="<?=HTML::chars($page->url($i)) ?>" class="pjax_button" data-container="#base-container">
                            <?=$i?>
                        </a>
                    </li>
		<?endif?>

	<?endfor?>

	<?if ($next_page !== FALSE):?>
            <li>
                <a href="<?=HTML::chars($page->url($next_page))?>" class="pjax_button" data-container="#base-container">
                    <?=__('Next') ?>
                </a>
            </li>
	<?else:?>
            <li class="disabled">
                <a href="javascript:;">
                    <?=__('Next') ?>
                </a>
            </li>
	<?endif?>

	<?if ($last_page !== FALSE):?>
            <li>
                <a href="<?=HTML::chars($page->url($last_page))?>" class="pjax_button" data-container="#base-container">
                    <?=__('Last')?>
                </a>
            </li>
	<?else:?>
            <li class="disabled">
                <a href="javascript:;">
                    <?=__('Last')?>
                </a>
            </li>
	<?endif?>

</ul><!-- .pagination -->