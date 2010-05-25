<?php
	/* Input parameters */
	$full_width = 716;
	$nav_padding = 35;
	$margin_left = 0;
	$item_padding = 0;
	
	$full_width = $full_width-(2*$nav_padding);
	$useful_width = $full_width-((count($pages)-1)*$margin_left);
	$li_width = floor($useful_width/count($pages)) - (2*$item_padding)-2;
	$count = 0;
?>

<div class="filler"></div>
<?php foreach($pages as $page): ?>
	<div class="nav_item" style="width: <?= $li_width; ?>px; margin-left: <?= ($count==0)?'0':$margin_left; ?>px; border-left: <?= ($count==0)?'1px solid #fff':'none'; ?>;">
		<?php echo link_to($page->getNavTitle(), '/page/index?title='.$page->getStrippedTitle(), ($current_page==$page->getId())?array('class'=>'selected'):array()); ?>
	</div>
	<?php $count++; ?>
<?php endforeach; ?>
<div class="filler"></div>
<div class="clear"></div>