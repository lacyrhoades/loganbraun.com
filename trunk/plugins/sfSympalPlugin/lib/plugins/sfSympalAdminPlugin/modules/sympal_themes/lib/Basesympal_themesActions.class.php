<?php

/**
 * Base actions for the sfSympalAdminPlugin sympal_themes module.
 * 
 * @package     sfSympalAdminPlugin
 * @subpackage  sympal_themes
 * @author      Your name here
 * @version     SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
abstract class Basesympal_themesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->themes = $this->getSympalContext()->getService('theme_manager')->getAvailableThemes();

    if ($preview = $request->getParameter('preview'))
    {
      $this->getResponse()->setTitle(sprintf(__('Sympal Admin / Previewing %s'), $preview));
      $this->loadTheme($preview);
      $this->setTemplate('preview');
    } else {
      $this->getResponse()->setTitle(sprintf(__('Sympal Admin / Themes')));
    }
  }

  public function executeMake_default(sfWebRequest $request)
  {
    $theme = $request->getParameter('name');

    if ($request->getParameter('site'))
    {
      $site = $this->getSympalContext()->getService('site_manager')->getSite();
      $this->askConfirmation(__('Are you sure?'), sprintf(__('This action will change the default theme to "%s" for the "%s" site.'), $theme, $site->getTitle()));
      if ($site->getTheme() == $theme)
      {
        $site->setTheme(null);
      } else {
        $site->setTheme($theme);
      }
      $site->save();
    } else {
      $this->askConfirmation(__('Are you sure?'), sprintf(__('This action will change the global default theme to "%s"'), $theme));
      sfSympalConfig::writeSetting('theme', 'default_theme', $theme);
    }

    $this->clearCache();
    $this->getUser()->setFlash('notice', __('Theme successfully changed!'));

    $this->redirect('@sympal_themes');
  }
}
