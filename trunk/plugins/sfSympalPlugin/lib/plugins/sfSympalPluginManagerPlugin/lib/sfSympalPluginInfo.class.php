<?php

class sfSympalPluginInfo
{
  protected
    $_readme,
    $_plugin = array();

  public function __construct($name)
  {
    $this->_name = $name;
    $this->_initialize();
  }

  public static function synchronizeDatabase()
  {
    $plugins = sfSympalPluginToolkit::getDownloadablePlugins();
    foreach ($plugins as $plugin)
    {
      $plugin = new sfSympalPluginInfo($plugin);
      $plugin->synchronizeWithDatabase();
    }
  }

  public function synchronizeWithDatabase()
  {
    $q = Doctrine_Core::getTable('sfSympalPlugin')
      ->createQuery('p')
      ->leftJoin('p.Author a')
      ->where('p.name = ?', $this->getName());

    $plugin = $q->fetchOne();
    if (!$plugin)
    {
      $plugin = new sfSympalPlugin();
    }

    foreach ($plugin as $k => $v)
    {
      if ($k == 'id')
      {
        continue;
      }
      $method = 'get'.ucfirst($k);
      $plugin->$k = $this->$method();
    }

    if ($this->getAuthor())
    {
      $author = Doctrine_Core::getTable('sfSympalPluginAuthor')->findOneByEmail($this->getAuthorEmail());
      $author = $author ? $author : new sfSympalPluginAuthor();
      $author->email = $this->getAuthorEmail();
      $author->name = $this->getAuthor();
      $plugin->setAuthor($author);
    }

    $plugin->is_downloaded = $this->isDownloaded();
    $plugin->is_installed = $this->isInstalled();
    $plugin->is_theme = $this->isTheme();
    $plugin->save();
  }

  protected function _loadFromSymfonyPlugins()
  {
    $api = new sfSympalPluginApi();
    if ($api->getUsername() && $api->getPassword())
    {
      $plugins = $api->get('categories/Sympal.xml');

      if (isset($plugins['plugins']['plugin']))
      {
        foreach ($plugins['plugins']['plugin'] as $plugin)
        {
          if ($plugin['id'] == $this->_name)
          {
            $this->_plugin = $plugin;
            $this->_plugin['name'] = $plugin['id'];
            break;
          }
        }
      }
    }
  }

  protected function _initialize()
  {
    $cachePath = sfConfig::get('sf_cache_dir').'/sympal/'.$this->_name.'.cache';
    if (!file_exists($cachePath))
    {
      $this->_loadFromSymfonyPlugins();

      if ($pluginConfiguration = sfSympalPluginToolkit::isPluginDownloaded($this->_name))
      {
        $downloadPath = sfContext::getInstance()->getConfiguration()->getPluginConfiguration($this->_name)->getRootDir();
      } else {
        $downloadPath = sfSympalPluginToolkit::getPluginDownloadPath($this->_name);
      }

      $packageXmlPath = $downloadPath.'/package.xml';
      $readmePath = $downloadPath.'/README';

      if (sfSympalToolkit::fileGetContents($packageXmlPath))
      {
        $packageXml = simplexml_load_file($packageXmlPath);
      } else if (sfSympalToolkit::fileGetContents($packageXmlPath.'.tmpl')) {
        $packageXml = simplexml_load_file($packageXmlPath.'.tmpl');
      }

      if (isset($packageXml))
      {
        $package = sfSympalPluginApi::simpleXmlToArray($packageXml);
        $this->_plugin = array_merge($package, $this->_plugin);
      }

      if ($readme = sfSympalToolkit::fileGetContents($readmePath))
      {
        $this->_plugin['readme'] = $readme;
      }

      $this->_plugin['name'] = $this->_name;

      file_put_contents($cachePath, serialize($this->_plugin));
    } else {
      $serialized = file_get_contents($cachePath);
      $this->_plugin = unserialize($serialized);
    }
  }

  public function __toString()
  {
    return $this->getName();
  }

  public function getAuthor()
  {
    return $this->get('lead', array('name'));
  }

  public function getAuthorEmail()
  {
    return $this->get('lead', array('email'));
  }

  public function getAuthorNick()
  {
    return $this->get('lead', array('user'));
  }

  public function getActionRoute($action)
  {
    return '@sympal_plugin_manager_'.$action.'?plugin='.$this->getName();
  }

  public function isDownloaded()
  {
    return sfSympalPluginToolkit::isPluginDownloaded($this->getName());
  }

  public function isInstalled()
  {
    return sfSympalPluginToolkit::isPluginInstalled($this->getName());
  }

  public function isTheme()
  {
    return strstr($this->getName(), 'ThemePlugin') ? true:false;
  }

  public function getTitle()
  {
    return sfInflector::humanize(sfInflector::tableize(sfSympalPluginToolkit::getShortPluginName($this->getName())));
  }

  public function getDescription()
  {
    return trim($this->get('description'));
  }

  public function getReadme()
  {
    return trim($this->get('readme'));
  }

  public function get($name, $arguments = array())
  {
    if (isset($this->_plugin[$name]))
    {
      $value = $this->_plugin[$name];
      if (!empty($arguments))
      {
        foreach ($arguments as $name)
        {
          $value = $value[$name];
        }
      }
      $value = current((array) $value);
      $value = preg_replace('/##(.*)##/', '', $value);
      return $value;
    } else {
      return null;
    }
  }

  public function getName()
  {
    return $this->_name;
  }

  public function getUrl()
  {
    return 'http://www.symfony-project.org/plugins/'.$this->_name;
  }

  public function __call($method, $arguments)
  {
    if (substr($method, 0, 3) == 'get')
    {
      $name = substr($method, 3, strlen($method));
      $name = sfInflector::tableize($name);

      return $this->get($name, $arguments);
    }
  }
}