<?php
	use_helper('Flash');
?>
<h2><?php $video->getName(); ?></h2>
<div class="video_preview" style="width: 400px; float: none;">
	<div class="inside" style="padding: 0;">
		
		<?php echo flash_object( $id, $params ); ?>
		
		<h4 class="center"><?php echo $video->getName(); ?></h4>
		<div class="video_text" style="padding-left: 30px;"><?php echo $video->getDescription(); ?></div>
		<div style="clear: both;">&nbsp;</div>
	</div>
</div>