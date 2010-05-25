<div class="video_preview">
	<div class="inside">
		<?php echo link_to(image_tag('/uploads/preview/'.$video->getPreview(), array('style'=>'float: left; width: 200px;')), '/video/watch?id='.$video->getId()); ?>
		<h4 class="center"><?php echo $video->getName(); ?></h4>
		<div class="video_text"><?php echo $video->getDescription(); ?></div>
		<?php echo link_to('Watch video', '/video/watch?id='.$video->getId()); ?>
		<div style="clear: both;">&nbsp;</div>
	</div>
</div>