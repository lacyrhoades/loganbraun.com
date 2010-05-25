<?php if ($library->getCurrentDir()): ?>
  <div class="assetImage">
    <a href="<?php echo url_for('sfMediaLibrary/'.$sf_context->getActionName()).'?dir='.$library->getParentDir() ?>">
      <img src="/sfMediaLibraryPlugin/images/up.png" alt=".." height="64" width="64" />
    </a>
    <p class="assetComment">&raquo;&nbsp;..<br />&nbsp;</p>
  </div>
<?php endif; ?>

<?php foreach ($library->getDirectories() as $count => $dir): ?>
  <div id="dir_<?php echo $count ?>" class="assetImage">
    <?php include_partial('sfMediaLibrary/block', array(
      'library' => $library,
      'name'    => $dir,
      'type'    => 'folder',
      'info'    => array(),
      'count'   => $count,
    )) ?>
  </div>
<?php endforeach; ?>
