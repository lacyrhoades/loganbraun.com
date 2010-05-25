<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class CreateDirectoryForm extends BaseForm
{
  protected $library;

  public function __construct($library)
  {
    $this->library = $library;

    parent::__construct();
  }

  public function configure()
  {
    $this->setWidgets(array(
      'name' => new sfWidgetFormInput(array(
        'label' => 'Create a dir:'
      )),
    ));

    $this->setValidators(array(
      'name' => new sfValidatorString(
        array(),
        array('required' => 'Please enter a directory name first')
      ),
    ));

    $this->widgetSchema->setNameFormat('mkdir[%s]');
  }
}
