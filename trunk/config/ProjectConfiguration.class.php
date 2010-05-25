<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin', 'sfSympalPlugin');
    require_once(dirname(__FILE__).'/../plugins/sfSympalPlugin/config/sfSympalPluginConfiguration.class.php');
    sfSympalPluginConfiguration::enableSympalPlugins($this);
  }

}
