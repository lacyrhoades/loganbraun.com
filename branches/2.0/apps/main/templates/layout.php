<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title(); ?>

<link rel="shortcut icon" type="image/png" href="<?= image_path('/favicon.png'); ?>" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" media="screen" href="<?= url_for('@ie6fix'); ?>" />
<![endif]-->

<link rel="stylesheet" href="<?= asset_path('/css/print.css'); ?>" type="text/css" media="print" />

<script type="text/javascript">
	var tb_pathToImage = "<?= asset_path('/wfCorePlugin/images/loadingAnimation.gif'); ?>";
</script>

</head>
<body>
	<div id="wrapper">
		<div id="header"><?php include_partial('global/header'); ?></div>
		<div id="left"><?php include_component_slot('nav'); ?></div>
		<div id="right">
			<?php if ($sf_user->hasFlash('global')): ?><div id="flash"><div><?= $sf_user->getFlash('global'); ?></div><a href="#" id="flash-hide" onclick="$('#flash').slideUp(); return false;"></a><div class="clear"></div></div><?php endif; ?>
			<?php echo $sf_content ?>
		</div>
		<div class="clear"></div>
	</div>
<?php include_partial('wfAnalytics/analytics'); ?>
</body>
</html>
