<?php

/**
 * Attachment form.
 *
 * @package    form
 * @subpackage attachment
 * @version    SVN: $Id: AttachmentForm.class.php 8648 2008-04-27 23:42:02Z dwhittle $
 */
class AttachmentForm extends BaseAttachmentForm
{
  public function configure()
  {
    $this->widgetSchema['file'] = new sfWidgetFormInputFile();

    $fileValidator = new sfValidatorFile();
    $fileValidator->setOption('mime_type_guessers', array());
    $this->validatorSchema['file'] = $fileValidator;
  }
}
