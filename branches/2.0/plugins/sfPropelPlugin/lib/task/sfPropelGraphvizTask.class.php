<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/sfPropelBaseTask.class.php');

/**
 * Generates a graphviz chart of current object model.
 *
 * @package    symfony
 * @subpackage propel
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelGraphvizTask.class.php 5506 2007-10-14 10:28:15Z dwhittle $
 */
class sfPropelGraphvizTask extends sfPropelBaseTask
{
  /**
   * @see BaseTask::configure()
   */
  protected function configure()
  {
    $this->namespace = 'propel';
    $this->name = 'graphviz';
    $this->briefDescription = 'Generates a graphviz chart of current object model';
    $this->detailedDescription = <<<EOF
The [propel:graphviz|INFO] task creates a graphviz DOT
visualization for automatic graph drawing of object model:

  [./symfony propel:graphviz|INFO]
EOF;
  }

  /**
   * @see BaseTask::execute()
   */
  protected function execute($arguments = array(), $options = array())
  {
    $this->schemaToXML(self::DO_NOT_CHECK_SCHEMA, 'generated-');
    $this->copyXmlSchemaFromPlugins('generated-');
    $this->callPhing('graphviz', self::CHECK_SCHEMA);
    $this->cleanup();
  }
}