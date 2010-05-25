<?php

require_once 'propel/engine/builder/om/php5/PHP5ExtensionPeerBuilder.php';

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @package    symfony
 * @subpackage propel
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: SfExtensionPeerBuilder.php 9567 2008-06-12 23:38:08Z dwhittle $
 */
class SfExtensionPeerBuilder extends PHP5ExtensionPeerBuilder
{
  public function build()
  {
    $code = parent::build();
    if (!DataModelBuilder::getBuildProperty('builderAddComments'))
    {
      $code = sfToolkit::stripComments($code);
    }

    return $code;
  }

  protected function addIncludes(&$script)
  {
    if (!DataModelBuilder::getBuildProperty('builderAddIncludes'))
    {
      return;
    }

    parent::addIncludes($script);
  }
}
