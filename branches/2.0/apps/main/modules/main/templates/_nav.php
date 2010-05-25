<div id="nav">
	<a id="sample-work" href="<?= url_for('@sample_work'); ?>" title="<?= wfPagePeer::retrieveByInternalSlug('sample_work')->getTitle(); ?>"></a>
	<a id="contact" href="<?= url_for('@contact'); ?>" title="<?= wfPagePeer::retrieveByInternalSlug('contact')->getTitle(); ?>"></a>
	<a id="about" href="<?= url_for('@about'); ?>" title="<?= wfPagePeer::retrieveByInternalSlug('homepage')->getTitle(); ?>"></a>
</div>

<a id="linked-in" href="http://www.linkedin.com/in/loganbraun" title="View my Profile on LinkedIn"></a>
