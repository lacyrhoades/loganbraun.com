<?php

# FROZEN_SF_LIB_DIR: /opt/lampp/framework/sf12/lib

require_once dirname(__FILE__).'/../lib/symfony/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
  	sfForm::enableCSRFProtection('SDFh56dfG67');
  	sfWidgetFormSchema::setDefaultFormFormatterName('div');
  }
}
