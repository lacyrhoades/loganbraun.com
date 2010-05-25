<?php

/**
 * slot actions.
 *
 * @package    uhp
 * @subpackage slot
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class slotComponents extends sfComponents
{
	public function executeDefault_left_nav()
	{
		$this->pages = PagePeer::getSortedPages();
		$this->current_page = PagePeer::getByStrippedTitle($this->getRequestParameter('title'));
		if ($this->current_page) {
			$this->current_page = $this->current_page->getId();
		} else {
			$this->current_page = -1;
		}
	}
	
	public function executeDefault_body()
	{
		
	}
	public function executeDefault_content()
	{
		
	}
	public function executeHome_body()
	{
		
	}
	public function executeHome_content()
	{
		
	}
}
