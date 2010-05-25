<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Autoloading and initialization for propel.
 *
 * @package    symfony
 * @subpackage propel
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelAutoload.php 9122 2008-05-20 23:18:21Z dwhittle $
 */

set_include_path(get_include_path().PATH_SEPARATOR.realpath(dirname(__FILE__).'/../../vendor/').'/');

require_once('propel/Propel.php');

sfPropel::initialize(sfProjectConfiguration::getActive()->getEventDispatcher());
