<div class="center">
	<?php foreach($video_types as $type): ?>
		<div class="media_type">
			<h1><?= strtoupper($type->getName()); ?></h1>
			(right click and select "save target as" to download)
			<br/>
			<?php if ($type->getExternalLink()): ?>
				<a href="<?=$type->getExternalLink(); ?>" target="_blank"><?= ($type->getExternalLinkName())?$type->getExternalLinkName():$type->getExternalLink(); ?></a>
			<?php endif; ?>
			
			<?php foreach($type->getVideosForSamplePage() as $vid): ?>
				<div class="vid_preview">
					<h3><?= $vid->getName(); ?></h3>
					<a href="/uploads/video/<?= $vid->getFilename(); ?>"><?= ($vid->getPreview())?image_tag('/uploads/preview/'.$vid->getPreview(), array('thumb_width'=>600, 'thumb_height'=>100)):$vid->getName(); ?></a>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>
</div>
