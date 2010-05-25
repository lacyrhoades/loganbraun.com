<?php $form = $library->getCreateDirectoryForm() ?>

<form method="post" action="<?php echo url_for('sfMediaLibrary/mkdir') ?>?dir=<?php echo $library->getCurrentDir() ?>">
  <?php echo $form->renderHiddenFields() ?>

  <div>
    <?php echo $form['name']->renderLabel() ?>
    <?php echo $form['name']->renderError() ?>
    <?php echo $form['name'] ?>
  </div>

  <div>
    <input type="submit" value="Create" />
  </div>
</form>
