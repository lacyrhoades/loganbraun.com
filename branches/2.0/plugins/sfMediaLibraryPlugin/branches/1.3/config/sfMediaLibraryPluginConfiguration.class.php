<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class sfMediaLibraryPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    if (sfConfig::get('app_sf_media_library_routes_register', true) && in_array('sfMediaLibrary', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('sfMediaLibraryRouting', 'listenToRoutingLoadConfigurationEvent'));
    }
  }
}
