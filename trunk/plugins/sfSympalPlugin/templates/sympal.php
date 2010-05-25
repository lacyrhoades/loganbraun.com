<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <?php $menus = get_sympal_split_menus('primary', false, 6, true) ?>
  <?php $primaryMenu = (string) $menus['primary'] ?>
  
  <?php if (isset($menus['secondary'])): ?>
    <?php $menus['secondary']->callRecursively('showChildren', true) ?>
    <?php if ($secondary = (string) $menus['secondary']): ?>
      <?php slot('sympal_right_sidebar', $secondary.get_slot('sympal_right_sidebar')) ?>
    <?php endif; ?>
  <?php endif; ?>

  <?php $subMenu = get_sympal_menu(sfSympalContext::getInstance()->getCurrentMenuItem(), true) ?>
  <?php if (has_slot('sympal_right_sidebar') || $subMenu): ?>
    <?php sympal_use_stylesheet('/sfSympalPlugin/css/right.css', 'last') ?>
  <?php endif; ?>

  <?php include_http_metas() ?>
  <?php include_metas() ?>
  <?php include_title() ?>
  <?php sympal_minify() ?>
  <?php include_stylesheets() ?>
  <?php include_javascripts() ?>
</head>
<body>

  <div id="container">
  <!-- header -->
  <div id="header">
  <div id="logo"><?php echo link_to(image_tag('/sfSympalPlugin/images/spacer.gif'), '@homepage', 'id=logo_spacer') ?></div>

  <?php if ($primaryMenu): ?>
    <!-- top navigation -->
    <div id="top_navigation">

     <div class="top_navigation_head"></div>
     <div class="top_navigation_body">
        <?php echo $primaryMenu ?>
     </div>
    </div>
  <?php endif; ?>

  <!-- end top navigation -->

  </div>
  <!-- end header -->

  <!-- content -->
  <div id="content">

  <!-- left column -->
  <div id="column_left">
    <?php echo $sf_content ?>
  </div>
  <!-- end left column -->

  <!-- right column -->
  <div id="column_right">
   <br />
   <div class="roundedbox">
    <div class="roundedbox_head"><div></div></div>
    <div class="roundedbox_body">
      <h2>Search</h2>
      <?php echo get_partial('sympal_search/form') ?>

      <?php if (has_slot('sympal_right_sidebar')): ?>
        <?php echo get_slot('sympal_right_sidebar') ?>
      <?php endif; ?>

      <?php if ($subMenu): ?>
        <div id="sympal_sub_menu">
          <?php echo $subMenu ?>
        </div>
      <?php endif; ?>
    </div>
   </div>
  </div>
  <!-- end right column -->

  <br style="clear: both;" />

  </div>
  <!-- end content -->

  <!-- box_footer -->
  <div id="box_footer">
  </div>
  <!-- end box_footer -->
  </div>

  <!-- footer -->
  <div id="footer">
  <p>
    <?php echo __('Brought to you by') ?> <?php echo link_to(image_tag('/sfSympalPlugin/images/sensio_labs_button.gif'), 'http://www.sensiolabs.com', 'target=_BLANK') ?>.<br/>
    <?php echo __('Powered by') ?> <?php echo link_to(image_tag('/sfSympalPlugin/images/symfony_button.gif'), 'http://www.symfony-project.org', 'target=_BLANK') ?> 
    <?php echo __('and') ?> <?php echo link_to(image_tag('/sfSympalPlugin/images/doctrine_button.gif'), 'http://www.doctrine-project.org', 'target=_BLANK') ?>
  </p>
  <?php echo get_sympal_menu('footer') ?>
  </div>
  <!-- end footer -->
</body>
</html>