<?php

class sfSympalFixPermsTask extends sfSympalBaseTask
{
  protected
    $failed  = array();
  
  protected function configure()
  {
    $this->aliases = array();
    $this->namespace = 'sympal';
    $this->name = 'fix-perms';
    $this->briefDescription = 'Fixes sympal directory permissions';

    $this->detailedDescription = <<<EOF
The [sympal:fix-perms|INFO] task fixes directory permissions:

  [./symfony sympal:fix-perms|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $autoload = sfSimpleAutoload::getInstance();
    $autoload->reload();
    $autoload->saveCache();

    $items = array();

    if (file_exists(sfConfig::get('sf_upload_dir')))
    {
      $items[] = sfConfig::get('sf_upload_dir');
    }
    $items[] = sfConfig::get('sf_cache_dir');
    $items[] = sfConfig::get('sf_web_dir').'/cache';
    $items[] = sfConfig::get('sf_config_dir');
    $items[] = sfConfig::get('sf_data_dir');
    $items[] = sfConfig::get('sf_log_dir');
    $items[] = sfConfig::get('sf_lib_dir');
    $items[] = sfConfig::get('sf_plugins_dir');
    $items[] = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR.'symfony';
    $apps = glob(sfConfig::get('sf_apps_dir').'/*/config/app.yml');
    foreach ($apps as $app)
    {
      $items[] = $app;
    }

    $dirFinder = sfFinder::type('dir');
    $fileFinder = sfFinder::type('file');
    foreach ($items as $item)
    {
      if ($this->isUnix())
      {
        try
        {
          if (is_dir($item))
          {
            $this->getFilesystem()->execute('chmod -R 0777 '.$item);
          } else {
            $this->getFilesystem()->execute('chmod 0777 '.$item);          
          }
        }
        catch (RuntimeException $e)
        {
          $this->failed[] = $item;
        }
      } else {
        @$this->getFilesystem()->chmod($item, 0777);
        if (is_file($item))
        {
          continue;
        }
        @$this->getFilesystem()->chmod($dirFinder->in($items), 0777);
        @$this->getFilesystem()->chmod($fileFinder->in($items), 0666);
      }
    }
    
    // note those files that failed
    if (count($this->failed))
    {
      $this->logBlock(array_merge(
        array('Permissions on the following file(s) or dir(s) could not be fixed:', ''),
        array_map(create_function('$f', 'return \' - \'.sfDebug::shortenFilePath($f);'), $this->failed)
      ), 'ERROR_LARGE');
    }
  }
}