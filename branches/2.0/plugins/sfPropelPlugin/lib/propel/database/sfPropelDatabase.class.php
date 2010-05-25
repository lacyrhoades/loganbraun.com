<?php

/*
* This file is part of the symfony package.
* (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

/**
 * A symfony database driver for Propel, derived from the native Creole driver.
 *
 * <b>Optional parameters:</b>
 *
 * # <b>datasource</b>     - [symfony] - datasource to use for the connection
 * # <b>is_default</b>     - [false]   - use as default if multiple connections
 *                                       are specified. The parameters
 *                                       that has been flagged using this param
 *                                       is be used when Propel is initialized
 *                                       via sfPropelAutoload.
 *
 * @package    symfony
 * @subpackage propel
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelDatabase.class.php 9371 2008-05-29 18:35:33Z dwhittle $
 */
class sfPropelDatabase extends sfPDODatabase
{
  /**
   * Datasource configurations
   */
  protected static $config = array();

  /**
   * Initializes sfPropelDatabase by loading configuration and initializing Propel
   *
   * @param array $parameters The datasource parameters
   * @param string $name The datasource name
   *
   * @return void
   */
  public function initialize($parameters = null, $name = 'propel')
  {
    parent::initialize($parameters);

    if(!$this->hasParameter('datasource') && $this->hasParameter('name'))
    {
      $this->setParameter('datasource', $this->getParameter('name'));
    }
    elseif(!$this->hasParameter('datasource') && !empty($name))
    {
      $this->setParameter('datasource', $name);
    }

    $this->addConfig();

    $is_default = $this->getParameter('is_default', false);

    // first defined if none listed as default
    if ($is_default || count(self::$config['propel']['datasources']) == 1)
    {
      $this->setDefaultConfig();
    }

    Propel::setConfiguration(self::$config[$name]);

    if($this->getParameter('pooling', false))
    {
      Propel::enableInstancePooling();
    }
    else
    {
      Propel::disableInstancePooling();
    }

    if(!Propel::isInit())
    {
      Propel::initialize();
    }
  }

  /**
   * Connect to the database.
   * Stores the PDO connection in $connection
   *
   * @return void
   */
  public function connect()
  {
    $this->connection = Propel::getConnection();
  }

  /**
   * Sets the default configuration
   *
   * @return void
   */
  public function setDefaultConfig()
  {
    self::$config['propel']['datasources']['default'] = $this->getParameter('datasource');
  }

  /**
   * Adds configuration for current datasource
   *
   * @return void
   */
  public function addConfig()
  {
    if ($dsn = $this->getParameter('dsn'))
    {
      $params = array();

      // check for non-pdo dsn - to be backwards compatable
      if (false !== strpos($dsn, '//'))
      {
        if (!sfConfig::get('sf_compat_10'))
        {
          throw new sfConfigurationException('You must set "compat_10" to true if you want to use creole style dsn.');
        }

        // derive pdo dsn (etc) from old style dsn
        $params = Creole::parseDSN($dsn);;

        $dsn = $params['phptype'] . ':dbname=' . $params['database'] . ';host=' . $params['hostspec'];
        $this->setParameter('dsn', $dsn);
      }
      else
      {
        $params = $this->parseDsn($dsn);
      }

      $options = array('dsn', 'phptype', 'hostspec', 'database', 'username', 'password', 'port', 'protocol', 'encoding', 'persistent', 'socket', 'compat_assoc_lower', 'compat_rtrim_string');
      foreach ($options as $option)
      {
        if (!$this->getParameter($option) && isset($params[$option]))
        {
          $this->setParameter($option, $params[$option]);
        }
      }

    }

    self::$config['propel']['datasources'][$this->getParameter('datasource')] =
    array(
    'adapter'      => $this->getParameter('phptype'),
    'connection'   =>
    array(
    'dsn'          => $this->getParameter('dsn'),
    'user'         => $this->getParameter('username'),
    'password'     => $this->getParameter('password'),
    'classname'    => $this->getParameter('classname', 'PropelPDO'),
    'options'      => ($this->hasParameter('persistent')) ? array('ATTR_PERSISTENT' => $this->getParameter('persistent')) : array(),
    'settings'     => array('charset' => array('value' => $this->getParameter('encoding', 'utf8')), 'queries' => $this->getParameter('queries', array()))
    )
    );
  }

  /**
   * Parses PDO style DSN
   *
   * @param string $dsn
   * @return array the parsed dsn
   */
  private function parseDsn($dsn)
  {
    return array('phptype' => substr($dsn, 0, strpos($dsn, ':')));
  }

  /**
   * Returns the current databsae configuration
   *
   * @return array
   */
  public static function getConfiguration()
  {
    return self::$config;
  }

  /**
   * Sets database configuration parameter
   *
   * @param string $key
   * @param mixed $value
   */
  public function setConnectionParameter($key, $value)
  {
    if ($key == 'host')
    {
      $key = 'hostspec';
    }

    self::$config['propel']['datasources'][$this->getParameter('datasource')]['connection'][$key] = $value;
    $this->setParameter($key, $value);
  }

  /**
   * Execute the shutdown procedure.
   *
   * @return void
   */
  public function shutdown ()
  {
    if ($this->connection !== null)
    {
      @$this->connection = null;
    }
  }
}
