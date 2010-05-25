<?php
require_once(sfConfig::get('sf_plugins_dir').'/wfCorePlugin/modules/wfContact/lib/BasewfContactActions.class.php');
/**
 * wfContact actions.
 *
 * @package    joeb
 * @subpackage wfContact
 * @author     Ryan Weaver <ryan@bluedoorproject.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class wfContactActions extends BasewfContactActions
{
	public function executeIndex($request)
	{
		parent::executeIndex($request);
		$this->page = $request->getAttribute('page');
	}
}
