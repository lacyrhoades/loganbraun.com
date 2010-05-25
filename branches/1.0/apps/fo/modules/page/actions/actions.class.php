<?php

/**
 * page actions.
 *
 * @package    braun
 * @subpackage page
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pageActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->page = PagePeer::getByStrippedTitle($this->getRequestParameter('title'));
  	$this->forwardUnless($this->page, 'main', 'index');
  	$this->forwardUnless($this->page->getSpecialHandling() == '', $this->page->getSpecialHandling(), 'index');
  }
}
