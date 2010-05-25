<h1><?php echo __('Themes') ?></h1>

<?php echo get_sympal_breadcrumbs(array(
  'Dashboard' => '@sympal_dashboard',
  'Themes' => '@sympal_themes',
)) ?>

<div id="sf_admin_container">
  <div id="sf_admin_content">
    <div class="sf_admin_list">
      <table cellspacing="0">
        <thead>
          <tr>
            <th width="100%"><?php echo __('Name'); ?></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($themes as $name => $theme): ?>
            <tr>
              <td><strong><?php echo sfInflector::humanize($name) ?></strong></td>
              <td>
                <?php echo button_to(__('Preview'), '@sympal_themes_preview?preview='.$name) ?>
              </td>
              <td>
                <?php if ($name != sfSympalConfig::get('theme', 'default_theme')): ?>
                  <?php echo button_to(__('Make Global Default'), '@sympal_themes_make_default?name='.$name) ?>
                <?php endif; ?>
              </td>
              <td>
                <?php if ($name != $sf_sympal_site->getTheme()): ?>
                  <?php echo button_to(__('Make %1% Default', array('%1%' => $sf_sympal_site->getTitle())), '@sympal_themes_make_default?site=1&name='.$name) ?>
                <?php else: ?>
                  <?php echo button_to(__('Remove %1% Default', array('%1%' => $sf_sympal_site->getTitle())), '@sympal_themes_make_default?site=1&name='.$name) ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
