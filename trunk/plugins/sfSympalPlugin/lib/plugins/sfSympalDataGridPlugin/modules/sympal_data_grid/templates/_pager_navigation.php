<?php use_helper('SympalPager') ?>
<?php echo get_sympal_pager_navigation($dataGrid->getPager(), $url, $dataGrid->getId().'[page]') ?>