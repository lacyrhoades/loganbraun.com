<?php $form = $library->getUploadForm() ?>

<form method="post" enctype="multipart/form-data" action="<?php echo url_for('sfMediaLibrary/upload') ?>?dir=<?php echo $library->getCurrentDir() ?>">
  <?php echo $form->renderHiddenFields() ?>

  <div>
    <?php echo $form['file']->renderLabel() ?>
    <?php echo $form['file']->renderError() ?>
    <?php echo $form['file'] ?>
  </div>

  <div>
    <input type="submit" value="Add" />
  </div>
</form>
