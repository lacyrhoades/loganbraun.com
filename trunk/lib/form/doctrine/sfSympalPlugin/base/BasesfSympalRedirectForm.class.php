<?php

/**
 * sfSympalRedirect form base class.
 *
 * @method sfSympalRedirect getObject() Returns the current form's model object
 *
 * @package    sympal
 * @subpackage form
 * @author     lacyrhoades@gmail.com
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfSympalRedirectForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'site_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => false)),
      'source'      => new sfWidgetFormInputText(),
      'destination' => new sfWidgetFormInputText(),
      'content_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Content'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'site_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Site'))),
      'source'      => new sfValidatorString(array('max_length' => 255)),
      'destination' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Content'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_sympal_redirect[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfSympalRedirect';
  }

}
