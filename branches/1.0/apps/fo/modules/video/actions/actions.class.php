<?php

/**
 * video actions.
 *
 * @package    braun
 * @subpackage video
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class videoActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  	$c = new Criteria();
    $this->video_types = VideoTypePeer::doSelect($c);
  }
  
  
  
  public function executeWatch()
  {
  	$this->video = VideoPeer::retrieveByPk($this->getRequestParameter('id'));
  	$this->forward404Unless($this->video);
  	
  	$this->id = 'movie_clip_container';
		$this->params = array( 	'id'								=> 	'flash_movie',
									'movie'							=>	'/uploads/video/'.$this->video->getFilename(),
									'size'							=>	'398x260',
									'version'						=>	'8',
									'background_color'	=>	'#ffffff',
									'params'						=>	array( 'allowsScriptAccess'	=>	'sameDomain',
																								'quality'							=>	'high'	),
									'create_proxy'			=>	true );
  }
}
