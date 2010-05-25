<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class UploadForm extends BaseForm
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
      'file' => new sfWidgetFormInputFile(array(
        'label' => 'Add a file:'
      )),
    ));

    $this->setValidators(array(
      'file' => new sfValidatorFile(
        array(
          'path' => $this->library->getAbsCurrentDir(),
          'validated_file_class' => 'sfMediaLibraryValidatedFile',
        ),
        array('required' => 'Please choose a file first')
      ),
    ));

    $this->widgetSchema->setNameFormat('upload[%s]');
  }
}
