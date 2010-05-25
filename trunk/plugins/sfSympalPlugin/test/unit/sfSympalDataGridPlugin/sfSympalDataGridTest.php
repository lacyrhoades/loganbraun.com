<?php

/**
 * Unit test for the sfSympalDataGrid class
 * 
 * @package     sfSympalDataGridPlugin
 * @subpackage  test
 * @author      Jonathan H. Wage <jonwage@gmail.com>
 * @since       2010-03-24
 * @version     svn:$Id$ $Author$
 */

$app = 'sympal';
require_once(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(10);

$dataGrid = sfSympalDataGrid::create(sfSympalConfig::get('user_model'), 'u')
  ->addColumn('u.id', 'renderer=test/data_grid_id')
  ->addColumn('u.username', 'method=__toString')
  ->addColumn('name');

$t->is($dataGrid->getRows(), array(
  array(
    'u.id' => 'partial_1',
    'u.username' => 'Sympal Admin (admin)',
    'name' => 'Sympal Admin'
  )
), '->getRows() returns correct data for column custom method and renderer');

$t->is($dataGrid->getPagerHeader(), '<div class="sympal_pager_header"><h3>One result found.</h3></div>', '->getPagerHeader() returns correct html');

$dataGrid = sfSympalDataGrid::create('sfSympalContentType', 'c')
  ->setMaxPerPage(1)
  ->setPage(1)
  ->orderBy('c.name DESC')
  ->configureColumn('c.id', 'renderer=test/data_grid_id');

$t->is($dataGrid->getRows(), array(
    array(
      'c.id' => 'partial_2',
      'c.name' => 'sfSympalPage',
      'c.description' => 'The page content type is the default Sympal content type. It is a simple page that only consists of a title and body. The contents of the body are a sympal content slot that can be filled with your selected type of content.',
      'c.label' => 'Page',
      'c.default_path' => '/pages/:slug',
      'c.theme' => NULL,
      'c.template' => 'default_view',
      'c.module' => NULL,
      'c.action' => NULL,
      'c.slug' => 'page',
    )
  ),
  '->getRows() returns proper rows'
);

$dataGrid = sfSympalDataGrid::create('sfSympalContentType', 'c')
  ->setMaxPerPage(1)
  ->setRenderingModule('test');

$t->is($dataGrid->render(), 'Test', '->setRenderingModule() renders using specified module');

$dataGrid = sfSympalDataGrid::create('sfSympalContentType', 't')
  ->where('t.name = ?', 'sfSympalPage')
  ->addColumn('t.name');

$rows = $dataGrid->getRows();
$t->is($rows[0]['t.name'], 'sfSympalPage', '->getRows() returns correct data and array key names');

$dataGrid = sfSympalDataGrid::create('sfSympalContentType', 't')
  ->where('t.name = ?', 'sfSympalPage')
  ->addColumn('t.name', 'is_sortable=false label=Test');

$t->is($dataGrid->getColumnSortLink($dataGrid->getColumn('t.name')), 'Test', 'Test is_sortable=false on column sort link does not produce link');

$dataGrid = sfSympalDataGrid::create('sfSympalContentType', 't')
  ->where('t.name = ?', 'Register')
  ->addColumn('t.name')
  ->isSortable(false);

$t->is($dataGrid->getColumnSortLink($dataGrid->getColumn('t.name')), 'Name', 'Test non real column does not produce html for column sort link');

$dataGrid = sfSympalDataGrid::create('sfSympalContentType', 't')
  ->select('t.id, t.name')
  ->setSort('t.name', 'DESC')
  ->setMaxPerPage(2);

$t->is($dataGrid->getDql(), 'SELECT t.id, t.name FROM sfSympalContentType t ORDER BY t.name desc LIMIT 2 OFFSET 0', '->getDql() returns correct dql');

$realCount = count($dataGrid);
$t->is($realCount, 2, 'Test sfSympalDatagrid implements Countable interface');

$countCheck = 0;
foreach ($dataGrid as $key => $value)
{
  $countCheck++;
}
$t->is($countCheck, $realCount, 'Test sfSympalDataGrid implements Iterator');