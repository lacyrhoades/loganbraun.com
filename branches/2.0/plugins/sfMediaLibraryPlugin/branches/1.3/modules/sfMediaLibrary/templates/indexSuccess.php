<?php use_helper('JavascriptBase', 'I18N') ?>

<div id="sf_asset_container">
  <h1><?php echo __('Media library (%1%)', array('%1%' => $library->getCurrentDir().'/'), 'sfMediaLibrary') ?></h1>

  <div id="sf_asset_content">
    <div id="sf_asset_controls">
      <?php include_partial('sfMediaLibrary/upload', array('library' => $library)) ?>
      <?php include_partial('sfMediaLibrary/mkdir', array('library' => $library)) ?>
    </div>

    <div id="sf_asset_assets">
      <?php include_partial('sfMediaLibrary/dirs', array('library' => $library)) ?>
      <?php include_partial('sfMediaLibrary/files', array('library' => $library)) ?>
    </div>
  </div>
</div>
