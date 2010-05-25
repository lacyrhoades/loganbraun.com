<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once('phing/Phing.php');

/**
 * @package    symfony
 * @subpackage command
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPhing.class.php 10509 2008-07-30 02:07:10Z dwhittle $
 */
class sfPhing extends Phing
{
  public static function printVersion()
  {
    print(self::getPhingVersion()."\n");
  }

  public static function getPhingVersion()
  {
    return 'sfPhing';
  }

  public static function shutdown($exitcode = 0)
  {
    self::getTimer()->stop();

    throw new Exception(sprintf('Problem executing Phing task (%s).', $exitcode));
  }
}
