<div class="right_floater floater_alpha">
  <?php echo get_sympal_content_slot($content, 'home_image_b') ?>
</div>
<div class="right_floater floater_omega">
  <?php echo get_sympal_content_slot($content, 'home_image_a') ?>
</div>

<h1><?php echo get_sympal_content_slot($content, 'title') ?></h1>
<span class="home_content"><?php echo get_sympal_content_slot($content, 'body', 'Markdown') ?></span>
