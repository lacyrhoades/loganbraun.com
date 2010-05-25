<?php

/**
 * security actions.
 *
 * @package    braun
 * @subpackage security
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class securityActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    
  }
  public function executeLogin()
  {
  	$user = $this->getRequestParameter('username');
  	$pass = $this->getRequestParameter('password');
  	if ($user && $pass) {
  		if ($user == 'admin' && $pass=='braun') {
  			$this->getUser()->setAuthenticated(true);
  			$this->redirect('/video/index');
  		} else {
  			$this->getRequest()->setError('username', 'Invalid Username and password combination');
  		}
  	}
  	$this->forward('security', 'index');
  }
}
