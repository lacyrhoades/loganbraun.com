<?php

/**
 * sfSympalMenuItemGroup form base class.
 *
 * @method sfSympalMenuItemGroup getObject() Returns the current form's model object
 *
 * @package    sympal
 * @subpackage form
 * @author     lacyrhoades@gmail.com
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfSympalMenuItemGroupForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'menu_item_id' => new sfWidgetFormInputHidden(),
      'group_id'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'menu_item_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'menu_item_id', 'required' => false)),
      'group_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'group_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_sympal_menu_item_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfSympalMenuItemGroup';
  }

}
