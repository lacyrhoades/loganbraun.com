<h1><?= $page->getTitle(); ?></h1>

<div class="content">
	<?= $page->getBody(); ?>
</div>


<?php $hover_text = 'Hover over an image to see a description here'; ?>
<?php foreach($types as $type): ?>
	<div class="media-type">
		<h3 class="center"><?= $type->getTitle(); ?></h3>
		<div class="caption" id="title-display-<?= $type->getId(); ?>"><?= $hover_text; ?></div>
		<div class="thumbs">
			<?php foreach($type->getMediaFilesSorted() as $file): ?>
				<a href="<?= asset_path('/uploads/'.$file->getFilename()); ?>" target="_blank" title="<?= $file->getTitle(); ?>" rel="title-display-<?= $type->getId(); ?>">
					<?= wf_image_tag('/uploads/'.$file->getPreviewFilename(), array('height'=>118, 'rounded'=>true, 'alt'=>$file->getTitle())); ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
	<?php if (end($types)!=$type): ?><div class="hr"></div><?php endif; ?>
<?php endforeach; ?>

<script type="text/javascript">
	$(document).ready(function()
		{
			$('.media-type a').hover(function() {
				$('#'+$(this).attr('rel')).html($(this).attr('title'));
			}, function() {
				$('#'+$(this).attr('rel')).html('<?= $hover_text; ?>');
			});
		}
	);
</script>
