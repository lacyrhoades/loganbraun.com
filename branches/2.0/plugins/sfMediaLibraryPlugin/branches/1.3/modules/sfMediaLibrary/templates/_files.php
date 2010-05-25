<?php $count = 0; foreach ($library->getFiles($sf_request->getParameter('images_only')) as $file => $info): ++$count ?>
  <div id="file_<?php echo $count ?>" class="assetImage">
    <?php include_partial('sfMediaLibrary/block', array(
      'library' => $library,
      'name'    => $file,
      'type'    => 'file',
      'info'    => $info,
      'count'   => $count,
    )) ?>
  </div>
<?php endforeach; ?>
