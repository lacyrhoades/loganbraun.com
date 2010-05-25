<?php



class MediaType extends BaseMediaType {

	
	public function __construct()
	{
						parent::__construct();
	}
	
	public function getMediaFilesSorted()
	{
		$c = new Criteria();
		$c->add(MediaFilePeer::MEDIA_TYPE_ID, $this->getId());
		$c->addAscendingOrderByColumn(MediaFilePeer::SORT_ORDER);
		return MediaFilePeer::doSelect($c);
	}
	
	public function __toString()
	{
		return $this->getTitle();
	}

} 
