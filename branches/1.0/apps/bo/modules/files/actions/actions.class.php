<?php

/**
 * files actions.
 *
 * @package    braun
 * @subpackage files
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class filesActions extends sfActions
{
	public function executeFiles()
	{
		$files = array();
		if ($handle = opendir(sfConfig::get('sf_upload_dir').'/custom')) {
   		while (false !== ($file = readdir($handle))) {
       if (strpos($file, '.') !== 0) $files[] = $file;
   		}
		}
		$this->files = $files;
	}
	
	public function executeFiles_add()
	{
		$file = $this->getRequest()->getFilename('file');
		if ($file) {
			$this->getRequest()->moveFile('file', sfConfig::get('sf_upload_dir').'/custom/'.$file);
		}
		$this->redirect('/files/files');
	}
	
	public function executeFiles_delete()
	{
		$file = $this->getRequestParameter('filename');
		if ($file) {
			$full_name = sfConfig::get('sf_upload_dir').'/custom/'.$file;
			if (is_file($full_name)) unlink($full_name);
		}
		$this->redirect('/files/files');
	}
}
