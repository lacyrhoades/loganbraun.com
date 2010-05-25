<div id="sf_admin_container">
  <h1>Editing "<?php echo $sf_sympal_content ?>" Slots</h1>

  <?php echo get_sympal_breadcrumbs(array(
    'Dashboard' => '@sympal_dashboard',
    'Site Content' => '@sympal_content_types_index',
    $sf_sympal_content->getType()->getLabel() => '@sympal_content_list_type?type='.$sf_sympal_content->getType()->getSlug(),
    'Editing '.$sf_sympal_content->getTitle() => $sf_sympal_content->getEditRoute(),
    'Editing Slots' => null
  )) ?>

  <div id="sf_admin_content">
    <div class="sf_admin_form">
      <?php foreach ($sf_sympal_content->getSlots() as $slot): ?>
        <?php if (!$slot->is_column): ?>
          <fieldset id="sf_fieldset_<?php echo $slot->getName() ?>">
            <h2 class="sf_fieldset_h2"><?php echo $slot ?></h2>
            <div class="sf_admin_form_row">
              <?php echo get_sympal_content_slot_editor($sf_sympal_content, $slot) ?>
            </div>
          </fieldset>
        <?php endif; ?>
      <?php endforeach; ?>

      <?php echo button_to('Go back to Editing Content', $sf_sympal_content->getEditRoute()) ?>
    </div>
  </div>
</div>