<?php

/**
 * sfSympalContentType form base class.
 *
 * @method sfSympalContentType getObject() Returns the current form's model object
 *
 * @package    sympal
 * @subpackage form
 * @author     lacyrhoades@gmail.com
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfSympalContentTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'label'        => new sfWidgetFormInputText(),
      'default_path' => new sfWidgetFormInputText(),
      'theme'        => new sfWidgetFormInputText(),
      'template'     => new sfWidgetFormInputText(),
      'module'       => new sfWidgetFormInputText(),
      'action'       => new sfWidgetFormInputText(),
      'slug'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 255)),
      'description'  => new sfValidatorString(array('required' => false)),
      'label'        => new sfValidatorString(array('max_length' => 255)),
      'default_path' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'theme'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'template'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'module'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'action'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'slug'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'sfSympalContentType', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('sf_sympal_content_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfSympalContentType';
  }

}
