<?php

/**
 * Base actions for the sfSympalPluginManagerPlugin sympal_plugin_manager module.
 * 
 * @package     sfSympalPluginManagerPlugin
 * @subpackage  sympal_plugin_manager
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class Basesympal_plugin_managerActions extends autoSympal_plugin_managerActions
{
  public function preExecute()
  {
    parent::preExecute();

    $this->checkFilePermissions();
  }

  public function redirectIfPermissionsError()
  {
    if (!$this->checkFilePermissions())
    {
      $this->redirect('@sympal_plugin_manager');
    }
  }

  public function executeIndex(sfWebRequest $request)
  {
    sfSympalPluginInfo::synchronizeDatabase();

    parent::executeIndex($request);
  }

  public function executeView(sfWebRequest $request)
  {
    $name = $request->getParameter('plugin');
    $this->sf_sympal_plugin = Doctrine_Core::getTable('sfSympalPlugin')->findOneByName($name);
  }

  public function executeUninstall(sfWebRequest $request)
  {
    $this->_executeSfAction('uninstall');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->_executeSfAction('delete');
  }

  public function executeInstall(sfWebRequest $request)
  {
    $this->_executeSfAction('install');
  }

  public function executeDownload(sfWebRequest $request)
  {
    $this->_executeSfAction('download');
  }

  protected function _executeAction($action, $pluginName)
  {
    try {
      sfToolkit::clearGlob(sfConfig::get('sf_cache_dir'));

      $manager = sfSympalPluginManager::getActionInstance($pluginName, $action);
      $manager->$action();

      sfToolkit::clearGlob(sfConfig::get('sf_cache_dir'));

      $this->getUser()->setFlash('notice', $pluginName.' "'.$action.'" action executed successfully!');

      return true;
    } catch (Exception $e) {
      $this->getUser()->setFlash('error', $pluginName.' "'.$action.'" action failed with error "'.$e->getMessage().'"!'.(sfConfig::get('sf_debug') ? "<br/><br/>".nl2br($e->getTraceAsString()):null));

      return false;
    }
  }

  protected function _executeSfAction($action)
  {
    $this->redirectIfPermissionsError();

    $request = $this->getRequest();
    $pluginName = $request->getParameter('plugin');

    if (!$request->getParameter('no_confirmation'))
    {
      $title = ucfirst($action).' '.$pluginName;
      $message = 'Are you sure you wish to run the action "'.$action.'" on the plugin named '.$pluginName.'?';
      $this->askConfirmation($title, $message);
    }

    $this->_executeAction($action, $pluginName);

    if ($action == 'download')
    {
      $this->redirect('@sympal_plugin_manager_install?plugin='.$pluginName.'&no_confirmation=1');
    }
    else if ($action == 'install')
    {
      $this->redirect($this->generateUrl('sympal_plugin_manager').'#'.$pluginName);
    }
    else
    {
      $this->redirect($request->getParameter('redirect_url').'#'.$pluginName);
    }
  }
}