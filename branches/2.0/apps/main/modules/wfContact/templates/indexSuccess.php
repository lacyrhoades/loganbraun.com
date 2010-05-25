<h1><?= $page->getTitle(); ?></h1>

<div class="content">
	<?= $page->getBody(); ?>
</div>

<div class="hr"></div>

<div id="contact-form-wrapper">
	<h2 class="mbottom">Leave me a Message</h2>
<?php include_partial('wfContact/form', array('form'=>$form)); ?>
</div>
