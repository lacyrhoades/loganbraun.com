<?php
require_once(sfConfig::get('sf_root_dir').'/plugins/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');
/**
 * sfGuardAuth actions.
 *
 * @package    bennettpump
 * @subpackage sfGuardAuth
 * @author     Ryan Weaver <ryan@bluedoorproject.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{
 	public function executeSignin($request)
  {
    $firstAction = $this->context->getActionStack()->getFirstEntry();
    if ($request->isMethod('get') && 
        'sfGuardAuth' != $firstAction->getModuleName() && 
        'signin' != $firstAction->getActionName())
    {
      // If user was forwarded to the signin action instead of accessing it
      // directly or by redirect, set referer to the current URI.
      $this->getUser()->setReferer($this->getRequest()->getUri());
    }

    $val = parent::executeSignin($request);
    
    $widget_schema = $this->form->getWidgetSchema();
    $widget_schema['username']->setAttribute('class', 'text-input');
    $widget_schema['password']->setAttribute('class', 'text-input');
  }
}
