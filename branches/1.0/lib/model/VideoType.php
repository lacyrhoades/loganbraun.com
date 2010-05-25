<?php

/**
 * Subclass for representing a row from the 'video_type' table.
 *
 * 
 *
 * @package lib.model
 */ 
class VideoType extends BaseVideoType
{
	public function __toString()
	{
		return $this->toString();
	}
	public function toString()
	{
		return $this->getName();
	}
	public function getVideosForSamplePage()
	{
		$c = new Criteria();
		$c->add(VideoPeer::VIDEO_TYPE_ID, $this->getId());
		$c->add(VideoPeer::INCLUDE_ON_SAMPLE, true);
		return VideoPeer::doSelect($c);
	}
}
