<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <?php include_http_metas() ?>
  <?php include_metas() ?>
  <?php include_title() ?>
  <?php sympal_minify() ?>
  <?php include_stylesheets() ?>
  <?php include_javascripts() ?>
</head>
<body>
  <div id="lb30_wrapper" class="container_12">
    <div id="lb30_logo" class="grid_4 alpha">
      <a href="<?php url_for('@homepage') ?>">
        <img src="/sfSympalLb30ThemePlugin/images/logo.png">
      </a>
    </div>
    <div id="lb30_nav_top" class="grid_8 omega nav">
      <?php echo get_sympal_menu('primary', false); ?>
    </div>
    <div id="lb30_content" class="grid_12">
      <?php echo $sf_content ?>
    </div>
    <div id="lb30_sig" class="grid_4 alpha">
      <ul>
        <li>Logan Braun Video & Graphics</li>
        <li>Ann Arbor, Michigan</li>
      </ul>
      <ul>
        <li><strong>Phone:</strong> 734.255.4306</li>
        <li><strong>Email:</strong> loganbraun@gmail.com</li>
      </ul>
    </div>
    <div id="lb30_nav_bottom" class="grid_8 omega nav">
      <?php echo get_sympal_menu('primary', false); ?>
    </div>
    <br class="clear"/>
  </div>
</body>
</html>