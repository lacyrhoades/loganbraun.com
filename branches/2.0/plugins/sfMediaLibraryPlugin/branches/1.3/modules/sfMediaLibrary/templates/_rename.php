<?php $form = $library->getRenameForm($current) ?>

<form method="post" action="<?php echo url_for('sfMediaLibrary/rename') ?>?current=<?php echo $current ?>&dir=<?php echo $library->getCurrentDir() ?>">
  <?php echo $form->renderHiddenFields() ?>

  <div>
    <?php echo $form['name']->renderError() ?>
    <?php echo $form['name'] ?>
  </div>

  <div>
    <input type="submit" value="Rename" />
  </div>
</form>
