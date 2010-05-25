<?php

/**
 * Subclass for representing a row from the 'page' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Page extends BasePage
{
	public function getStrippedTitle()
	{
  	$result = strtolower($this->getTitle());
 
  	// strip all non word chars
  	$result = preg_replace('/\W/', ' ', $result);
 
  	// replace all white space sections with a dash
  	$result = preg_replace('/\ +/', '-', $result);
 
  	// trim dashes
  	$result = preg_replace('/\-$/', '', $result);
  	$result = preg_replace('/^\-/', '', $result);
 
  	return $result;
	}
}
