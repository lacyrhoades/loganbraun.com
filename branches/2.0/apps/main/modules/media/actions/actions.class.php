<?php

/**
 * media actions.
 *
 * @package    braunmediapro
 * @subpackage media
 * @author     Ryan Weaver <ryan@bluedoorproject.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class mediaActions extends sfActions
{
  public function executeIndex($request)
  {
    $this->page = $request->getAttribute('page');
    $this->types = wfBasePeer::doSelectSort('MediaType');
  }
}
