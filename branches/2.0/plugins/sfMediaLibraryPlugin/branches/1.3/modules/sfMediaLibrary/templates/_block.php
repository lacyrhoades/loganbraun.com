<?php $action = $sf_context->getActionName() !== 'choice' ? 'index' : $sf_context->getActionName() ?>

<div class="thumbnails">
  <?php if ($type == 'folder'): ?>
    <a href="<?php echo url_for('sfMediaLibrary/'.$action).'?dir='.urlencode($library->getCurrentDir().'/'.$name) ?>">
      <img alt="<?php echo $name ?>" src="/sfMediaLibraryPlugin/images/folder.png" height="64" width="64" />
    </a>
    <?php $size = '' ?>
  <?php else: ?>
    <?php $thumbnail = image_tag($info['icon'], array('alt' => $name, 'title' => $name) + ($info['thumbnail'] ? array() : array('height' => '64'))) ?>
    <?php if ($action == 'index'): ?>
      <a href="<?php echo $library->getWebAbsCurrentDir().'/'.$name ?>"><?php echo $thumbnail ?></a>
    <?php else: ?>
      <?php echo link_to_function($thumbnail, "setFileSrc('".$library->getWebAbsCurrentDir().'/'.$name."')") ?>
    <?php endif; ?>

    <?php $size = sprintf('&nbsp;&nbsp;[%d %s]', $info['size'] < 1000 ? $info['size'] : $info['size'] / 1000, $info['size'] < 1000 ? 'o' : 'Ko') ?>
  <?php endif; ?>
</div>

<div class="assetComment">
  <?php if ($action == 'index'): ?>
    <div id="edit_<?php echo $count ?>">
      <?php include_partial('sfMediaLibrary/rename', array('current' => $name, 'library' => $library)) ?>
    </div>
    <div style="text-align:right">
      <?php echo $size ?>
      <?php echo link_to(image_tag('/sfMediaLibraryPlugin/images/delete.png', array(
        'alt'   => __('Delete', array(), 'sfMediaLibrary'),
        'align' => 'absmiddle',
      )), 'sfMediaLibrary/delete', array(
        'query_string' => 'name='.$name.'&dir='.$library->getCurrentDir(),
        'confirm' => __('Are you sure to want to delete this '.$type.'?', array(), 'sfMediaLibrary')
      )) ?>
    </div>
  <?php else: ?>
    <div id="view_<?php echo $count ?>"><?php echo $name ?></div>
  <?php endif; ?>
</div>
