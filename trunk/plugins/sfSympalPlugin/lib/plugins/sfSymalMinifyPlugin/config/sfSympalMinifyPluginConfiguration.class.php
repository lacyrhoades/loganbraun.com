<?php

/**
 * Configuration class for the minifier plugin
 * 
 * @package     sfSympalMinifyPlugin
 * @subpackage  config
 * @author      Ryan Weaver <ryan@thatsquality.com>
 * @since       2010-03-28
 * @version     svn:$Id$ $Author$
 */
class sfSympalMinifyPluginConfiguration extends sfPluginConfiguration
{
  
  public function initialize()
  {
    // register a listener on task.cache.clear to clear the minified files
    new sfSympalTaskClearCacheListener($this->dispatcher, $this);

    $this->dispatcher->connect('sympal.load', array($this, 'bootstrap'));
    
    // listen to sympal.pre_install to prepare the web/cache dir
    $this->dispatcher->connect('sympal.pre_install', array($this, 'sympalPreInstall'));
  }

  /**
   * Listens to the sympal.load event
   */
  public function bootstrap(sfEvent $event)
  {
    $this->configuration->loadHelpers(array('SympalMinify'));
  }

  /**
   * Listens to the sympal.pre_install event and prepares the web/cache dir
   */
  public function sympalPreInstall(sfEvent $event)
  {
    $dir = sfConfig::get('sf_web_dir').'/cache';
    if (!is_dir($dir))
    {
      mkdir($dir, 0777, true);
    }
  }
}