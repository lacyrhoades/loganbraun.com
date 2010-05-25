<?php

/**
 * Subclass for performing query and update operations on the 'page' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PagePeer extends BasePagePeer
{
	public static function getByStrippedTitle($title)
	{
		$pages = PagePeer::doSelect(new Criteria());
		foreach($pages as $page) {
			if ($page->getStrippedTitle() == $title) {
				return $page;
			}
		}
		return new Page();
	}
	public static function getSortedPages()
	{
		$c = new Criteria();
		$c->addAscendingOrderByColumn(PagePeer::SORT_ORDER);
		return PagePeer::doSelect($c);
	}
}
