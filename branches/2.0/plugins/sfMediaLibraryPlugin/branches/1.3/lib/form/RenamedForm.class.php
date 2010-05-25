<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class RenameForm extends BaseForm
{
  protected $library;

  public function __construct($library, $current)
  {
    $this->library = $library;

    parent::__construct(array('name' => $current));
  }

  public function configure()
  {
    $this->setWidgets(array('name' => new sfWidgetFormInput()));
    $this->setValidators(array('name' => new sfValidatorPass()));

    $this->widgetSchema->setNameFormat('rename[%s]');
  }
}
